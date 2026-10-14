<?php

/*
|--------------------------------------------------------------------------
| Analizador temporal de dependencias eriosconsultores vs base_aracode
|--------------------------------------------------------------------------
| Detecta clases referenciadas en erios que no existen aquí pero sí en base,
| y métodos/configs que base tiene y erios no.
*/

$ERIOS = 'C:/laragon/www/eriosconsultores';
$BASE  = 'C:/laragon/www/base_aracode';

function phpFiles(string $root, array $dirs): array
{
    $out = [];
    foreach ($dirs as $dir) {
        $path = $root . '/' . $dir;
        if (!is_dir($path)) {
            continue;
        }
        $it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS));
        foreach ($it as $f) {
            if ($f->isFile() && strtolower($f->getExtension()) === 'php') {
                $out[] = $f->getPathname();
            }
        }
    }
    sort($out);
    return $out;
}

/**
 * Declaraciones (FQCN => [archivo, metodos]) y también raíz de namespace.
 */
function scanDeclarations(string $root, array $dirs): array
{
    $classes = [];
    foreach (phpFiles($root, $dirs) as $file) {
        $src = @file_get_contents($file);
        if ($src === false) {
            continue;
        }
        $tokens = @token_get_all($src);
        $ns = '';
        $count = count($tokens);
        for ($i = 0; $i < $count; $i++) {
            $t = $tokens[$i];
            if (!is_array($t)) {
                continue;
            }
            if ($t[0] === T_NAMESPACE) {
                $ns = '';
                for ($j = $i + 1; $j < $count; $j++) {
                    $tj = $tokens[$j];
                    if (!is_array($tj)) {
                        break;
                    }
                    if ($tj[0] === T_WHITESPACE) {
                        continue;
                    }
                    if (in_array($tj[0], [T_STRING, T_NS_SEPARATOR, T_NAME_QUALIFIED], true)) {
                        $ns .= $tj[1];
                        continue;
                    }
                    break;
                }
                $ns = trim($ns, '\\');
            }
            if (in_array($t[0], [T_CLASS, T_INTERFACE, T_TRAIT], true)) {
                // Ignorar ::class y clases anónimas ("new class").
                $prev = $tokens[$i - 1] ?? null;
                if (is_array($prev) && $prev[0] === T_DOUBLE_COLON) {
                    continue;
                }
                if (is_array($prev) && $prev[0] === T_NEW) {
                    continue;
                }
                // Nombre de la clase.
                $name = null;
                for ($j = $i + 1; $j < $count; $j++) {
                    $tj = $tokens[$j];
                    if (is_array($tj) && $tj[0] === T_WHITESPACE) {
                        continue;
                    }
                    if (is_array($tj) && $tj[0] === T_STRING) {
                        $name = $tj[1];
                    }
                    break;
                }
                if ($name === null) {
                    continue;
                }
                $fqcn = $ns !== '' ? $ns . '\\' . $name : $name;
                if (!isset($classes[$fqcn])) {
                    $classes[$fqcn] = ['file' => $file, 'methods' => []];
                }
                // Métodos declarados hasta el cierre de esta clase (aproximado).
                for ($k = $j; $k < $count; $k++) {
                    $tk = $tokens[$k];
                    if (is_array($tk) && $tk[0] === T_FUNCTION) {
                        for ($m = $k + 1; $m < $count; $m++) {
                            $tm = $tokens[$m];
                            if (is_array($tm) && $tm[0] === T_WHITESPACE) {
                                continue;
                            }
                            if (is_array($tm) && $tm[0] === T_STRING) {
                                $classes[$fqcn]['methods'][$tm[1]] = true;
                            }
                            break;
                        }
                    }
                }
            }
        }
    }
    return $classes;
}

/**
 * FQCN referenciados por un proyecto (use + usos totalmente cualificados).
 */
function scanReferences(string $root, array $dirs): array
{
    $refs = []; // FQCN => [archivos]
    foreach (phpFiles($root, $dirs) as $file) {
        $src = @file_get_contents($file);
        if ($src === false) {
            continue;
        }

        // use App\Foo\Bar;  /  use App\Foo\{A, B};
        if (preg_match_all('/^\s*use\s+([A-Za-z_][A-Za-z0-9_\\\\]*)(?:\s+as\s+[A-Za-z_][A-Za-z0-9_]*)?\s*;/m', $src, $m)) {
            foreach ($m[1] as $fq) {
                $fq = trim($fq, '\\');
                if (str_starts_with($fq, 'App\\') || str_starts_with($fq, 'Modules\\')) {
                    $refs[$fq][] = $file;
                }
            }
        }
        if (preg_match_all('/use\s+([A-Za-z_][A-Za-z0-9_\\\\]*)\\\\\{([^}]*)\}/', $src, $gm, PREG_SET_ORDER)) {
            $prefix = trim($gm[1], '\\');
            foreach (explode(',', $gm[2]) as $part) {
                $part = trim($part);
                if ($part === '') {
                    continue;
                }
                $part = preg_split('/\s+as\s+/i', $part)[0];
                $fq = $prefix . '\\' . trim($part, '\\');
                if (str_starts_with($fq, 'App\\') || str_starts_with($fq, 'Modules\\')) {
                    $refs[$fq][] = $file;
                }
            }
        }

        // Cuerpo sin las líneas namespace/use (ya extraídas arriba) para no
        // contar prefijos de namespace como si fueran clases.
        $body = preg_replace('/^\s*(?:namespace|use)\s+[^;{]*[;{]/m', '', $src);

        // Usos totalmente cualificados \App\... o App\... en el cuerpo.
        if (preg_match_all('/\b((?:App|Modules)\\\\[A-Za-z_][A-Za-z0-9_]*(?:\\\\[A-Za-z_][A-Za-z0-9_]*)*)/', $body, $fm)) {
            foreach ($fm[1] as $fq) {
                $refs[$fq][] = $file;
            }
        }
    }
    return $refs;
}

function configKeys(string $root, array $dirs): array
{
    $keys = [];
    foreach (phpFiles($root, $dirs) as $file) {
        $src = @file_get_contents($file);
        if ($src !== false && preg_match_all('/config\(\s*\'([a-z0-9_]+)(?:\.[a-z0-9_]+)?\'/i', $src, $m)) {
            foreach ($m[1] as $k) {
                $keys[$k][] = $file;
            }
        }
    }
    return $keys;
}

$scanDirs = ['app', 'Modules'];

echo "Escaneando declaraciones...\n";
$baseClasses  = scanDeclarations($BASE, $scanDirs);
$eriosClasses = scanDeclarations($ERIOS, $scanDirs);
echo '  base: ', count($baseClasses), " clases | erios: ", count($eriosClasses), " clases\n";

// PHP resuelve nombres de clase sin distinguir mayúsculas/minúsculas.
$lower = function (array $classes): array {
    $out = [];
    foreach ($classes as $k => $v) {
        $out[strtolower($k)] = $v;
    }
    return $out;
};
$baseLower  = $lower($baseClasses);
$eriosLower = $lower($eriosClasses);

// Prefijos de namespace reales: sirven para descartar falsos positivos en los
// que el regex capturó un prefijo en lugar de una clase.
$declaredPrefixes = [];
foreach (array_merge(array_keys($baseClasses), array_keys($eriosClasses)) as $fq) {
    $parts = explode('\\', $fq);
    for ($i = 1; $i < count($parts); $i++) {
        $declaredPrefixes[strtolower(implode('\\', array_slice($parts, 0, $i)))] = true;
    }
}

echo "Escaneando referencias de erios...\n";
$refs = scanReferences($ERIOS, array_merge($scanDirs, ['routes', 'config', 'database']));
echo '  ', count($refs), " FQCN referenciados\n\n";

// ---- Clases que faltan en erios pero existen en base ----
$missingInBase = [];
$unknown = [];
foreach ($refs as $fq => $files) {
    $lc = strtolower($fq);
    if (isset($eriosLower[$lc])) {
        continue;
    }
    if (isset($declaredPrefixes[$lc])) {
        // Prefijo de namespace, no una clase: descartar.
        continue;
    }
    // Podría ser una clase sin declaración textual (p.ej. alias). Verificar raíz.
    if (isset($baseLower[$lc])) {
        $missingInBase[$fq] = ['base' => $baseLower[$lc]['file'], 'usos' => array_unique($files)];
    } else {
        $unknown[$fq] = array_unique($files);
    }
}
ksort($missingInBase);
ksort($unknown);

echo "============================================================\n";
echo "CLASES REFERENCIADAS QUE FALTAN EN ERIOS Y EXISTEN EN BASE\n";
echo "============================================================\n";
if (!$missingInBase) {
    echo "(ninguna)\n";
}
foreach ($missingInBase as $fq => $info) {
    $n = count($info['usos']);
    echo sprintf("%-70s (%d uso%s)\n", $fq, $n, $n === 1 ? '' : 's');
    foreach (array_slice($info['usos'], 0, 3) as $u) {
        echo '    <- ', str_replace('\\', '/', substr($u, strlen($ERIOS) + 1)), "\n";
    }
    if ($n > 3) {
        echo '    ... y ', ($n - 3), " más\n";
    }
}

echo "\n============================================================\n";
echo "REFERENCIAS QUE NO EXISTEN NI EN ERIOS NI EN BASE (revisar)\n";
echo "============================================================\n";
if (!$unknown) {
    echo "(ninguna)\n";
}
foreach ($unknown as $fq => $files) {
    echo sprintf("%-70s (%d archivo%s)\n", $fq, count($files), count($files) === 1 ? '' : 's');
}

// ---- Métodos: clases en ambas donde base tiene métodos que erios no ----
echo "\n============================================================\n";
echo "MÉTODOS QUE BASE TIENE Y ERIOS NO (en clases presentes en ambos)\n";
echo "============================================================\n";
$anyMethod = false;
foreach ($eriosClasses as $fq => $info) {
    $lc = strtolower($fq);
    if (!isset($baseLower[$lc])) {
        continue;
    }
    // Solo clases que erios realmente referencia (comparación sin mayúsculas).
    $referenced = false;
    foreach ($refs as $rf => $rfFiles) {
        if (strtolower($rf) === $lc) {
            $referenced = true;
            break;
        }
    }
    if (!$referenced) {
        continue;
    }
    $baseOnly = array_diff_key($baseLower[$lc]['methods'], $info['methods']);
    if (!$baseOnly) {
        continue;
    }
    $anyMethod = true;
    echo $fq, ":\n";
    foreach (array_keys($baseOnly) as $met) {
        echo '    - ', $met, "()\n";
    }
}
if (!$anyMethod) {
    echo "(ninguno)\n";
}

// ---- Configs presentes en base y ausentes en erios ----
echo "\n============================================================\n";
echo "CONFIGS RAÍZ REFERENCIADOS EN ERIOS Y AUSENTES\n";
echo "============================================================\n";
$keys = configKeys($ERIOS, array_merge($scanDirs, ['routes', 'config']));
$eriosConfigs = array_map(fn ($f) => basename($f, '.php'), glob($ERIOS . '/config/*.php'));
$baseConfigs   = array_map(fn ($f) => basename($f, '.php'), glob($BASE . '/config/*.php'));
$anyCfg = false;
foreach ($keys as $k => $files) {
    if (in_array($k, $eriosConfigs, true)) {
        continue;
    }
    $anyCfg = true;
    $inBase = in_array($k, $baseConfigs, true) ? ' (existe en base)' : ' (tampoco en base -> probable config de módulo)';
    echo sprintf("%-40s%s\n", $k, $inBase);
}
if (!$anyCfg) {
    echo "(ninguno)\n";
}

echo "\n============================================================\n";
echo "CONFIGS EN BASE AUSENTES EN ERIOS (candidatos)\n";
echo "============================================================\n";
foreach (array_diff($baseConfigs, $eriosConfigs) as $c) {
    echo '  - ', $c, "\n";
}

echo "\n============================================================\n";
echo "PORTADAS/CLASES DE APP\\SUPPORT EN BASE AUSENTES EN ERIOS\n";
echo "============================================================\n";
$baseSupport = array_map(fn ($f) => basename($f, '.php'), glob($BASE . '/app/Support/*.php'));
$eriosSupport = array_map(fn ($f) => basename($f, '.php'), glob($ERIOS . '/app/Support/*.php'));
foreach (array_diff($baseSupport, $eriosSupport) as $s) {
    $ref = isset($refs['App\\Support\\' . $s]) ? '  [referenciada en erios]' : '';
    echo '  - App\\Support\\', $s, $ref, "\n";
}

<?php

/*
|--------------------------------------------------------------------------
| Comprobación de dependencias con el autoload real
|--------------------------------------------------------------------------
| Recorre app/ y Modules/ de eriosconsultores y verifica:
|  - que cada clase importada (use X;) se pueda cargar realmente;
|  - que cada llamada estática Alias::metodo() exista en la clase.
| Para cada fallo, comprueba si base_aracode sí lo ofrece.
*/

$ERIOS = 'C:/laragon/www/eriosconsultores';
$BASE  = 'C:/laragon/www/base_aracode';

require $ERIOS . '/vendor/autoload.php';

function phpFiles(string $root, array $dirs): array
{
    $out = [];
    foreach ($dirs as $dir) {
        $path = $root . '/' . $dir;
        if (!is_dir($path)) {
            continue;
        }
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path, FilesystemIterator::SKIP_DOTS)) as $f) {
            if ($f->isFile() && strtolower($f->getExtension()) === 'php') {
                $out[] = $f->getPathname();
            }
        }
    }
    sort($out);
    return $out;
}

/** Ruta esperada del archivo de una clase en un proyecto (PSR-4). */
function pathIn(string $project, string $fqcn): ?string
{
    $fqcn = ltrim($fqcn, '\\');
    if (str_starts_with($fqcn, 'App\\')) {
        $rel = 'app/' . substr($fqcn, 4);
    } elseif (str_starts_with($fqcn, 'Modules\\')) {
        $rel = 'Modules/' . substr($fqcn, 8);
    } else {
        return null;
    }
    $file = $project . '/' . str_replace('\\', '/', $rel) . '.php';
    if (is_file($file)) {
        return $file;
    }
    // En Windows la ruta puede diferir solo en mayúsculas.
    return null;
}

function baseHasClass(string $fqcn): ?string
{
    global $BASE;
    return pathIn($BASE, $fqcn);
}

function baseHasMethod(string $fqcn, string $method): bool
{
    $file = baseHasClass($fqcn);
    if ($file === null) {
        return false;
    }
    $src = @file_get_contents($file);
    return $src !== false && preg_match('/function\s+' . preg_quote($method, '/') . '\s*\(/', $src) === 1;
}

$dirs = ['app', 'Modules'];
$files = phpFiles($ERIOS, $dirs);

$missingClasses = [];   // FQCN => ['usos'=>[], 'base'=>bool]
$missingMethods = [];   // "FQCN::metodo" => ['usos'=>[], 'base'=>bool]
$checkedClasses = 0;

foreach ($files as $file) {
    $rel = str_replace('\\', '/', substr($file, strlen($ERIOS) + 1));
    $src = @file_get_contents($file);
    if ($src === false) {
        continue;
    }

    $matches = [];
    preg_match_all('/^\s*use\s+([A-Za-z_][A-Za-z0-9_\\\\]*)(?:\s+as\s+([A-Za-z_][A-Za-z0-9_]*))?\s*;/m', $src, $matches, PREG_SET_ORDER);
    $aliases = [];
    foreach ($matches as $m) {
        $fq = trim($m[1], '\\');
        // Ignorar imports de funciones/constantes y de clases de vendor conocidas.
        if (str_starts_with($fq, 'function ') || str_starts_with($fq, 'const ')) {
            continue;
        }
        $alias = (isset($m[2]) && $m[2] !== '') ? $m[2] : substr($fq, strrpos($fq, '\\') + 1);
        $aliases[$alias] = $fq;
        if (!str_starts_with($fq, 'App\\') && !str_starts_with($fq, 'Modules\\')) {
            continue;
        }
        $checkedClasses++;
        if (class_exists($fq) || interface_exists($fq) || trait_exists($fq) || enum_exists($fq)) {
            continue;
        }
        $missingClasses[$fq]['usos'][] = $rel;
        $missingClasses[$fq]['base'] = ($missingClasses[$fq]['base'] ?? false) || baseHasClass($fq) !== null;
    }

    // Llamadas estáticas Alias::metodo( o \FQ\...::metodo(
    if (preg_match_all('/\b([A-Za-z_][A-Za-z0-9_]*)::([a-zA-Z_][A-Za-z0-9_]*)\s*\(/', $src, $calls, PREG_SET_ORDER)) {
        foreach ($calls as $c) {
            [$full, $alias, $method] = $c;
            if (in_array($alias, ['self', 'static', 'parent'], true)) {
                continue;
            }
            if (!isset($aliases[$alias])) {
                continue;
            }
            $fq = $aliases[$alias];
            if (!class_exists($fq)) {
                continue; // ya reportado como clase faltante o de vendor
            }
            $ref = new ReflectionClass($fq);
            if ($ref->hasMethod('__callStatic')) {
                continue; // métodos mágicos: no fiable
            }
            if ($ref->hasMethod($method)) {
                continue;
            }
            $key = $fq . '::' . $method;
            $missingMethods[$key]['usos'][] = $rel;
            $missingMethods[$key]['base'] = ($missingMethods[$key]['base'] ?? false) || baseHasMethod($fq, $method);
        }
    }
}

ksort($missingClasses);
ksort($missingMethods);

echo "Archivos analizados: ", count($files), " | imports App/Modules comprobados: ", $checkedClasses, "\n\n";

echo "============================================================\n";
echo "CLASES IMPORTADAS QUE NO SE PUEDEN CARGAR EN ERIOS\n";
echo "============================================================\n";
$baseProvides = 0;
foreach ($missingClasses as $fq => $info) {
    $tag = $info['base'] ? '  -> EN BASE_ARACODE' : '  -> tampoco en base';
    if ($info['base']) {
        $baseProvides++;
    }
    echo sprintf("%-72s %d uso(s)%s\n", $fq, count($info['usos']), $tag);
    foreach (array_slice($info['usos'], 0, 2) as $u) {
        echo '      ', $u, "\n";
    }
}
if (!$missingClasses) {
    echo "(ninguna)\n";
}

echo "\n============================================================\n";
echo "MÉTODOS ESTÁTICOS QUE NO EXISTEN EN ERIOS\n";
echo "============================================================\n";
$metBase = 0;
foreach ($missingMethods as $key => $info) {
    $tag = $info['base'] ? '  -> EN BASE_ARACODE' : '  -> tampoco en base';
    if ($info['base']) {
        $metBase++;
    }
    echo sprintf("%-72s %d uso(s)%s\n", $key, count($info['usos']), $tag);
    foreach (array_slice($info['usos'], 0, 2) as $u) {
        echo '      ', $u, "\n";
    }
}
if (!$missingMethods) {
    echo "(ninguno)\n";
}

echo "\n============================================================\n";
echo "RESUMEN\n";
echo "============================================================\n";
echo 'Clases que base aportaría: ', $baseProvides, "\n";
echo 'Métodos que base aportaría: ', $metBase, "\n";

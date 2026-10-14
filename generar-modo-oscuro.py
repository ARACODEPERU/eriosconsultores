"""Genera public/themes/webpage/css/dark-mode.css.

Toma el CSS real del sitio (bloques <style> de las vistas Blade + las hojas del
tema) y produce las reglas equivalentes para el modo oscuro, preservando el tono
de cada color: las superficies claras se oscurecen y los textos oscuros se
aclaran, mientras que los colores saturados de marca (amarillo/azul/verde) se
mantienen.
"""

import colorsys
import pathlib
import re

ROOT = pathlib.Path(__file__).resolve().parent

BLADE_DIRS = [
    ROOT / "resources/views/pages",
    ROOT / "resources/views/components",
]
BLADE_FILES = [ROOT / "resources/views/layouts/webpage.blade.php"]
CSS_FILES = [
    ROOT / "public/themes/webpage/css/style.css",
    ROOT / "public/themes/webpage/css/default.css",
    ROOT / "public/themes/webpage/css/responsive.css",
    ROOT / "public/themes/webpage/css/sky-tabs.css",
    ROOT / "public/themes/webpage/css/nice-select.css",
]

BRAND_HUE = 221.0 / 360.0  # navy/azul de marca para los grises acromaticos

# Selectores que, en alguna vista, llevan texto sobre un fondo saturado opaco
# (botones amarillos, bandas azules): su color nunca se aclara.
PREFIX = ':where(html[data-theme="dark"]) '

VIVID_SELECTORS = set()
# Selectores que recibieron un ajuste de color de texto (solo informe).
FG_ADJUSTED = set()

COLOR_RE = re.compile(
    r"#[0-9a-fA-F]{8}\b|#[0-9a-fA-F]{6}\b|#[0-9a-fA-F]{4}\b|#[0-9a-fA-F]{3}\b"
    r"|rgba?\(\s*[0-9.]+%?\s*[, ]\s*[0-9.]+%?\s*[, ]\s*[0-9.]+%?\s*(?:[,/]\s*[0-9.]+%?\s*)?\)"
)

SKIP_PROPS = (
    "box-shadow", "text-shadow", "./", "filter", "transition", "animation",
    "background-position", "background-size", "background-repeat", "background-attachment",
)


def parse_color(tok):
    """Devuelve (r, g, b, a) normalizado 0..1 o None."""
    t = tok.strip().lower()
    if t.startswith("#"):
        h = t[1:]
        if len(h) == 3:
            r, g, b = (int(c * 2, 16) / 255 for c in h)
            return r, g, b, 1.0
        if len(h) == 4:
            r, g, b = (int(c * 2, 16) / 255 for c in h[:3])
            return r, g, b, int(h[3] * 2, 16) / 255
        if len(h) == 6:
            return int(h[0:2], 16) / 255, int(h[2:4], 16) / 255, int(h[4:6], 16) / 255, 1.0
        if len(h) == 8:
            return (
                int(h[0:2], 16) / 255,
                int(h[2:4], 16) / 255,
                int(h[4:6], 16) / 255,
                int(h[6:8], 16) / 255,
            )
        return None
    m = re.match(r"rgba?\(([^)]*)\)", t)
    if not m:
        return None
    parts = [p.strip() for p in re.split(r"[,/ ]+", m.group(1)) if p.strip()]
    if len(parts) < 3:
        return None
    vals = []
    for p in parts[:3]:
        if p.endswith("%"):
            vals.append(float(p[:-1]) / 100.0)
        else:
            vals.append(float(p) / 255.0)
    a = 1.0
    if len(parts) >= 4:
        a = float(parts[3][:-1]) / 100.0 if parts[3].endswith("%") else float(parts[3])
    return vals[0], vals[1], vals[2], a


def to_hex(r, g, b):
    f = lambda v: max(0, min(255, int(round(v * 255))))
    return "#%02x%02x%02x" % (f(r), f(g), f(b))


def fmt(r, g, b, a, original_had_alpha):
    if original_had_alpha or a < 0.999:
        return "rgba(%d, %d, %d, %s)" % (
            max(0, min(255, int(round(r * 255)))),
            max(0, min(255, int(round(g * 255)))),
            max(0, min(255, int(round(b * 255)))),
            ("%g" % round(a, 3)).rstrip("0").rstrip(".") or "0",
        )
    return to_hex(r, g, b)


def hl(hexcolor):
    r = int(hexcolor[1:3], 16) / 255
    g = int(hexcolor[3:5], 16) / 255
    b = int(hexcolor[5:7], 16) / 255
    h, l, s = colorsys.rgb_to_hls(r, g, b)
    return h, l, s


def is_vivid(color, min_alpha=0.6):
    r, g, b, a = color
    if a < min_alpha:
        return False
    _, l, s = colorsys.rgb_to_hls(r, g, b)
    return s >= 0.45 and 0.22 <= l <= 0.80


def remap_background(color):
    r, g, b, a = color
    if a < 0.6:
        return None
    h, l, s = colorsys.rgb_to_hls(r, g, b)
    light = l >= 0.93 or (l >= 0.82 and s <= 0.5)
    if not light:
        return None
    if s < 0.06:
        h = BRAND_HUE
    s2 = max(min(s, 0.35), 0.17)
    l2 = 0.10 + max(0.0, min(1.0, (l - 0.80) / 0.20)) * 0.06
    nr, ng, nb = colorsys.hls_to_rgb(h, l2, s2)
    return nr, ng, nb, a


def remap_foreground(color):
    r, g, b, a = color
    h, l, s = colorsys.rgb_to_hls(r, g, b)
    if l > 0.55:
        return None
    if s >= 0.45:
        h2, s2, l2 = h, min(s, 0.85), 0.70
    else:
        h2 = h if s >= 0.06 else BRAND_HUE
        s2 = min(s, 0.22)
        l2 = 0.87 if l < 0.25 else (0.80 if l < 0.42 else 0.72)
    nr, ng, nb = colorsys.hls_to_rgb(h2, l2, s2)
    return nr, ng, nb, a


def remap_border(color):
    r, g, b, a = color
    if a < 0.6:
        return None
    h, l, s = colorsys.rgb_to_hls(r, g, b)
    if l < 0.62 or s > 0.5:
        return None
    h2 = h if s >= 0.06 else BRAND_HUE
    s2 = max(min(s, 0.30), 0.15)
    l2 = 0.20 if l >= 0.90 else 0.24
    nr, ng, nb = colorsys.hls_to_rgb(h2, l2, s2)
    return nr, ng, nb, a


def transform_value(value, kind):
    """kind: 'bg' | 'fg' | 'border'. Devuelve (nuevo_valor, cambio)."""
    changed = False

    def repl(m):
        nonlocal changed
        tok = m.group(0)
        col = parse_color(tok)
        if col is None:
            return tok
        fn = {"bg": remap_background, "fg": remap_foreground, "border": remap_border}[kind]
        new = fn(col)
        if new is None:
            return tok
        changed = True
        return fmt(new[0], new[1], new[2], new[3], tok.lower().startswith("rgba"))

    return COLOR_RE.sub(repl, value), changed


def sits_on_vivid(sel):
    """True si el selector parece un hijo/elemento de un bloque con fondo de
    marca (relacion BEM por prefijo: bloque, elemento, descendiente o estado)."""
    sel = sel.strip()
    for vivid_sel in VIVID_SELECTORS:
        if not vivid_sel or vivid_sel == sel:
            continue
        if sel.startswith(vivid_sel) and sel[len(vivid_sel)] in "- .:#[":
            return True
    return False


def split_decls(body):
    out, buf, depth = [], "", 0
    for ch in body:
        if ch == "(":
            depth += 1
        elif ch == ")":
            depth -= 1
        if ch == ";" and depth == 0:
            out.append(buf)
            buf = ""
        else:
            buf += ch
    if buf.strip():
        out.append(buf)
    return out


def handle_rule(selector_group, body, contexts, rules_out):
    decls = []
    raws = []
    for raw in split_decls(body):
        if ":" not in raw:
            continue
        prop, _, val = raw.partition(":")
        prop = prop.strip().lower()
        val = val.strip()
        if not prop or prop.startswith("--") or prop.startswith("%"):
            continue
        raws.append((prop, val))

    vivid = False
    for prop, val in raws:
        if prop in ("background", "background-color", "background-image"):
            for m in COLOR_RE.finditer(val):
                col = parse_color(m.group(0))
                if col and is_vivid(col):
                    vivid = True
    if vivid:
        for sel in selector_group.split(","):
            VIVID_SELECTORS.add(sel.strip())

    for prop, val in raws:
        if prop.startswith(SKIP_PROPS):
            continue
        if prop in ("background", "background-color", "background-image"):
            kind = "bg"
        elif prop == "color":
            # Si en ESTA regla el fondo es de marca opaco (amarillo/azul), el
            # texto ya es legible: no se aclara.
            if vivid:
                continue
            # Igual si el elemento vive DENTRO de un bloque con fondo de marca
            # (badges amarillos, bandas azules): p. ej. .erc-about__badge-num
            # dentro de .erc-about__badge.
            if any(sits_on_vivid(sel) for sel in selector_group.split(",")):
                continue
            kind = "fg"
        elif prop.startswith("border") or prop == "outline" or prop.startswith("outline"):
            kind = "border"
        elif prop in ("fill", "stroke"):
            kind = "fg"
        else:
            continue
        newval, changed = transform_value(val, kind)
        if changed:
            decls.append("%s: %s" % (prop, newval))
            if kind == "fg":
                for sel in selector_group.split(","):
                    FG_ADJUSTED.add(sel.strip())

    if not decls:
        return

    sels = []
    for sel in selector_group.split(","):
        sel = sel.strip()
        if not sel:
            continue
        # "body.dark-only" es un mecanismo antiguo de otra plantilla (no se aplica).
        if "dark-only" in sel:
            continue
        # :where() no aporta especificidad: la regla conserva la jerarquía
        # original de la cascada y solo gana por ir mas abajo en el documento
        # (las hojas se cargan al final del body).
        if ":root" in sel:
            sels.append(sel.replace(":root", PREFIX.strip()))
        elif sel == "html":
            sels.append(PREFIX.strip())
        elif sel.startswith("@"):
            continue
        else:
            sels.append(PREFIX + sel)
    if not sels:
        return
    rules_out.append((contexts, ", ".join(sels), decls))


def walk(css, contexts, rules_out):
    i, n = 0, len(css)
    while i < n:
        brace = css.find("{", i)
        if brace == -1:
            return
        prelude = css[i:brace].strip()
        depth, j = 1, brace + 1
        while j < n and depth:
            if css[j] == "{":
                depth += 1
            elif css[j] == "}":
                depth -= 1
            j += 1
        body = css[brace + 1: j - 1]
        if prelude.startswith("@"):
            at = prelude.split()[0].lower().lstrip("@")
            if at in ("media", "supports", "layer", "container"):
                walk(body, contexts + [prelude], rules_out)
        elif prelude:
            handle_rule(prelude, body, contexts, rules_out)
        i = j


def extract_blade_css(path):
    text = path.read_text(encoding="utf-8", errors="ignore")
    return "\n".join(re.findall(r"<style[^>]*>(.*?)</style>", text, re.S | re.I))


def main():
    sources = []
    for f in BLADE_FILES:
        if f.exists():
            sources.append(extract_blade_css(f))
    for d in BLADE_DIRS:
        for f in sorted(d.rglob("*.blade.php")):
            if "email" in f.name or "plantillas" in str(f) or "aracode" in str(f) or "kirafact" in str(f):
                continue
            sources.append(extract_blade_css(f))
    for f in CSS_FILES:
        if f.exists():
            sources.append(f.read_text(encoding="utf-8", errors="ignore"))

    # Pasada 1: descubrir que selectores aparecen sobre fondos de marca opacos.
    parsed = []
    for css in sources:
        css = re.sub(r"/\*.*?\*/", "", css, flags=re.S)
        parsed.append(css)
    for css in parsed:
        walk(css, [], [])

    # Pasada 2: emitir las reglas del modo oscuro.
    rules_out = []
    for css in parsed:
        walk(css, [], rules_out)

    lines = [
        "/* ============================================================================",
        "   ERIOS CONSULTORES · Modo oscuro",
        "",
        "   Generado con storage/app/theme-gen.py a partir del CSS real del sitio:",
        "   cada superficie clara se oscurece y cada texto oscuro se aclara",
        "   conservando el tono original; los colores de marca saturados",
        "   (amarillo #ffc600, azul #004aad, WhatsApp, verde) no se modifican.",
        "",
        "   Se activa con <html data-theme=\"dark\">. La carga por defecto es el",
        "   modo claro. No editar a mano: regenerar con el script.",
        "",
        "   El prefijo :where(...) no suma especificidad: cada regla conserva su",
        "   peso original y gana solo por ir despues en el documento (estas hojas",
        "   se cargan al final del <body>). Asi una regla de clase del sitio",
        "   (p. ej. texto blanco sobre una banda azul) sigue ganando a un",
        "   generico 'p' del tema.",
        "   ============================================================================ */",
        "",
    ]
    media_stack = None
    for contexts, selector, decls in rules_out:
        if contexts != media_stack:
            if media_stack:
                lines.append("")
                lines.extend("    }" for _ in media_stack)
                lines.append("")
            for c in contexts or []:
                lines.append(c + " {")
            media_stack = contexts
        indent = "    " * len(contexts or [])
        lines.append("%s%s {" % (indent, selector))
        for d in decls:
            lines.append("%s    %s;" % (indent, d))
        lines.append("%s}" % indent)
    if media_stack:
        lines.append("")
        lines.extend("    }" for _ in media_stack)

    out = ROOT / "public/themes/webpage/css/dark-mode.auto.css"
    out.write_text("\n".join(lines) + "\n", encoding="utf-8")
    print("reglas:", len(rules_out), "bytes:", out.stat().st_size,
          "selectores-vivos:", len(VIVID_SELECTORS))
    # Informe: selectores donde el texto se aclaro y ademas existen en alguna
    # vista sobre un fondo de marca opaco (posible contraste bajo a revisar).
    (ROOT / "theme-gen-vivid.txt").write_text(
        "\n".join(sorted(FG_ADJUSTED & VIVID_SELECTORS)), encoding="utf-8")


if __name__ == "__main__":
    main()

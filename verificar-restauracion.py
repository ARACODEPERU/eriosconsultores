#!/usr/bin/env python3
"""Comprueba que el contenido de la web de ERIOS volvió a la base de datos.

Se usa después de restaurar `base_app_eriosconsultores` (ver RESTAURACION-BD.md).
Hace dos bloques de comprobaciones:

  1. SQL  : filas de las tablas críticas (las que alimentan la web) y huellas de
            contenido conocido (logo del CMS, correo del pie, usuario admin...).
  2. HTTP : cada página pública debe responder 200 y contener sus textos.

Flujo recomendado (comparar lo restaurado contra una referencia):

  # 1) Importar el dump en una base local de prueba y guardar la referencia
  python verificar-restauracion.py --solo-sql --host 127.0.0.1 --user root \
      --password '' --db erios_restore_check --guardar-baseline baseline.json

  # 2) Tras restaurar la base real, comparar contra esa referencia
  python verificar-restauracion.py --solo-sql --baseline baseline.json

  # 3) Y comprobar las páginas (local y/o producción)
  python verificar-restauracion.py --base http://eriosconsultores.test
  python verificar-restauracion.py --base https://eriosconsultores.com

Sin argumentos usa las credenciales del .env y http://eriosconsultores.test.
Solo ejecuta consultas de lectura; nunca escribe en la base de datos.
"""

import argparse
import json
import os
import shutil
import subprocess
import sys
import unicodedata
import urllib.error
import urllib.request

RAIZ = os.path.dirname(os.path.abspath(__file__))

# ---------------------------------------------------------------- qué se espera

# Tablas de contenido propio del sitio: sin filas aquí, la web no se puede
# pintar (el CMS guarda cabecera, pie, home y FAQ en cms_*; los cursos y
# docentes salen de aca_*). Mínimo de filas que debe haber tras restaurar.
TABLAS_CRITICAS = {
    "users": 1,
    "cms_items": 1,
    "cms_pages": 1,
    "cms_page_sections": 1,
    "cms_sections": 1,
    "cms_section_items": 1,
    "cms_testimonies": 1,
    "aca_courses": 1,
    "aca_teachers": 1,
}

# Tablas que ya traen datos las migraciones: su valor actual no prueba nada,
# pero sirven de suelo y se comparan contra la referencia (--baseline).
TABLAS_BASE = ["people", "roles", "model_has_roles", "permissions", "parameters",
               "cms_item_types", "aca_category_courses", "aca_subscription_types",
               "countries", "departments", "provinces", "districts"]

# Tablas que deberían tener datos pero dependen del uso real del sistema: solo
# se informan (si están a 0 hay que mirar si es legítimo).
TABLAS_A_REVISAR = [
    "companies", "sedes", "onli_items", "aca_students", "aca_cap_registrations",
    "complaints_books", "contact_messages", "cms_landings", "cms_advertisings",
    "cms_subscribers", "blog_articles", "expenses", "sales", "sale_documents",
]

# Consultas de huella: (descripción, SQL que debe devolver >= 1)
HUELLAS = [
    ("logo de la cabecera guardado en el CMS",
     "select count(*) from cms_items where content like '%cms/items/%'"),
    ("correo del pie en el CMS",
     "select count(*) from cms_items where content like '%@eriosconsultores.com%'"),
    ("texto del hero guardado en el CMS",
     "select count(*) from cms_items where content like '%Tranquilidad%'"),
    ("docente del equipo (persona 'Esther')",
     "select count(*) from people where concat_ws(' ', names, full_name) like '%Esther%'"),
]

# Marcas presentes en TODAS las páginas: cabecera (logo del CMS) y pie (correo).
MARCAS_GLOBALES = ["/storage/uploads/cms/items/", "info@eriosconsultores.com",
                   "aracode smart solutions"]

# Página -> textos propios que deben aparecer.
PAGINAS = [
    ("/", ["bienvenidos a erios", "erios consultores tributarios", "conocer mas"]),
    ("/nosotros", ["nosotros"]),
    ("/servicios", ["servicios"]),
    ("/cursos", ["cursos"]),
    ("/docentes", ["nuestros docentes", "esther", "contador publico colegiado"]),
    ("/liderazgo", ["liderazgo"]),
    ("/contable", ["contable"]),
    ("/tax-compliance", ["tax compliance"]),
    ("/contactanos", ["mantente en contacto", "envianos un mensaje",
                      "informacion de contacto"]),
    ("/libro-de-reclamaciones", ["libro de reclamaciones", "registra tu reclamo"]),
    ("/politicas-privacidad", ["privacidad"]),
    ("/politicas-de-devoluciones", ["devoluciones"]),
    ("/curso/dolores-eiusmod-ipsa", ["preguntas frecuentes", "brochure"]),
    ("/curso-descripcion/dolores-eiusmod-ipsa", ["dolores-eiusmod-ipsa"]),
    ("/curso-landing-preview/dolores-eiusmod-ipsa", ["dolores-eiusmod-ipsa"]),
]


def norm(texto):
    """Minúsculas, sin acentos y con espacios simples, para comparar textos."""
    sin = unicodedata.normalize("NFKD", texto).encode("ascii", "ignore").decode()
    return " ".join(sin.lower().split())


# ---------------------------------------------------------------- acceso a datos

def leer_env(ruta):
    datos = {}
    if not os.path.isfile(ruta):
        return datos
    with open(ruta, encoding="utf-8", errors="replace") as f:
        for linea in f:
            linea = linea.strip()
            if not linea or linea.startswith("#") or "=" not in linea:
                continue
            clave, valor = linea.split("=", 1)
            datos[clave.strip()] = valor.strip().strip('"').strip("'")
    return datos


class Base:
    def __init__(self, args):
        env = leer_env(os.path.join(RAIZ, ".env"))
        self.host = args.host or env.get("DB_HOST", "127.0.0.1")
        self.puerto = args.port or env.get("DB_PORT", "3306")
        self.usuario = args.user or env.get("DB_USERNAME", "root")
        self.clave = args.password if args.password is not None else env.get("DB_PASSWORD", "")
        self.nombre = args.db or env.get("DB_DATABASE", "")
        self.mysql = args.mysql or shutil.which("mysql") or "mysql"
        if not self.nombre:
            raise SystemExit("No se pudo determinar la base de datos (usa --db).")

    def consulta(self, sql):
        """Devuelve la primera celda de un SELECT (uso interno, solo lectura)."""
        cmd = [self.mysql, "-h", self.host, "-P", str(self.puerto), "-u", self.usuario]
        if self.clave:
            cmd.append("-p" + self.clave)
        cmd += ["--connect-timeout=10", "-N", "-B", self.nombre, "-e", sql]
        proceso = subprocess.run(cmd, capture_output=True, text=True, timeout=180)
        if proceso.returncode != 0:
            lineas = [l for l in (proceso.stderr or "").splitlines() if l.strip()]
            # El cliente avisa del password en la línea de comandos: no es el error.
            lineas = [l for l in lineas if "password on the command line" not in l]
            raise RuntimeError(lineas[-1] if lineas else "error de conexión")
        return (proceso.stdout or "").strip()


def revisar_sql(base, baseline_path, guardar_path):
    print("== 1. Base de datos: %s@%s/%s ==" % (base.usuario, base.host, base.nombre))
    try:
        base.consulta("select 1")
    except Exception as e:
        print("   ERROR de conexión: %s" % e)
        return False, {}

    fallos = 0
    conteos = {}

    print("\n   Tablas críticas (mínimo esperado):")
    for tabla, minimo in sorted(TABLAS_CRITICAS.items()):
        try:
            filas = int(base.consulta("select count(*) from `%s`" % tabla))
        except Exception as e:
            print("   %-26s ERROR %s" % (tabla, e))
            fallos += 1
            continue
        conteos[tabla] = filas
        if filas < minimo:
            print("   %-26s %-7d !! esperado >= %d" % (tabla, filas, minimo))
            fallos += 1
        else:
            print("   %-26s %-7d ok" % (tabla, filas))

    print("\n   Tablas base (vienen de las migraciones; se comparan con la referencia):")
    for tabla in TABLAS_BASE:
        try:
            filas = int(base.consulta("select count(*) from `%s`" % tabla))
        except Exception:
            continue
        conteos[tabla] = filas
        print("   %-26s %-7d" % (tabla, filas))

    print("\n   Tablas a revisar (0 puede ser legítimo):")
    for tabla in TABLAS_A_REVISAR:
        try:
            filas = int(base.consulta("select count(*) from `%s`" % tabla))
        except Exception:
            continue
        conteos[tabla] = filas
        print("   %-26s %-7d %s" % (tabla, filas, "" if filas else "<-- revisar"))

    print("\n   Huellas de contenido:")
    for descripcion, sql in HUELLAS:
        try:
            n = int(base.consulta(sql))
        except Exception as e:
            print("   %-42s ERROR %s" % (descripcion, e))
            fallos += 1
            continue
        conteos["huella:" + descripcion] = n
        print("   %-42s %-6d %s" % (descripcion, n, "ok" if n else "!! falta"))
        if not n:
            fallos += 1

    # Señal de alarma: todas las migraciones en un solo lote = base recién creada.
    try:
        lotes = int(base.consulta("select count(distinct batch) from migrations"))
        migraciones = int(base.consulta("select count(*) from migrations"))
        conteos["migrations"] = migraciones
        if lotes <= 1:
            print("   %-42s %s" % ("migraciones en %d lote(s)" % lotes,
                                   "!! sospechoso: base recién migrada"))
            fallos += 1
        else:
            print("   %-42s %d en %d lotes ok" % ("migraciones", migraciones, lotes))
    except Exception:
        pass

    if baseline_path:
        try:
            with open(baseline_path, encoding="utf-8") as f:
                referencia = json.load(f)
        except Exception as e:
            print("\n   No se pudo leer la referencia %s: %s" % (baseline_path, e))
            return False, conteos
        print("\n   Comparación con la referencia %s:" % os.path.basename(baseline_path))
        for tabla, esperado in sorted(referencia.items()):
            actual = conteos.get(tabla)
            if actual is None:
                continue
            if actual < esperado:
                print("   %-42s %d < %d !! faltan filas" % (tabla, actual, esperado))
                fallos += 1
            elif actual > esperado:
                print("   %-42s %d > %d (más que en la referencia)" % (tabla, actual, esperado))
            else:
                print("   %-42s %d = %d ok" % (tabla, actual, esperado))

    if guardar_path:
        with open(guardar_path, "w", encoding="utf-8") as f:
            json.dump(conteos, f, indent=2, ensure_ascii=False, sort_keys=True)
        print("\n   Referencia guardada en %s" % guardar_path)

    return fallos == 0, conteos


# ---------------------------------------------------------------- acceso a la web

def revisar_paginas(base_url, timeout=25):
    print("\n== 2. Páginas: %s ==" % base_url)
    fallos = 0
    for ruta, textos in PAGINAS:
        url = base_url.rstrip("/") + ruta
        peticion = urllib.request.Request(url, headers={
            "User-Agent": "verificador-contenido-erios",
            "Accept-Language": "es",
        })
        try:
            with urllib.request.urlopen(peticion, timeout=timeout) as r:
                estado = r.status
                cuerpo = r.read().decode("utf-8", "replace")
        except urllib.error.HTTPError as e:
            estado = e.code
            try:
                cuerpo = e.read().decode("utf-8", "replace")
            except Exception:
                cuerpo = ""
        except Exception as e:
            estado = 0
            cuerpo = ""
            print("   %-44s ERROR %s" % (ruta, e))
            fallos += 1
            continue

        plano = norm(cuerpo)
        faltan = [t for t in MARCAS_GLOBALES + list(textos) if norm(t) not in plano]
        if estado != 200 or faltan:
            fallos += 1
            detalle = "HTTP %s" % estado
            if faltan:
                detalle += " | faltan: " + ", ".join(faltan)
            print("   %-44s %s" % (ruta, detalle))
        else:
            print("   %-44s HTTP 200 ok" % ruta)
    return fallos == 0


def main():
    p = argparse.ArgumentParser(description="Verifica el contenido restaurado de la web.")
    p.add_argument("--solo-sql", action="store_true", help="no comprobar páginas")
    p.add_argument("--solo-web", action="store_true", help="no comprobar la base")
    p.add_argument("--base", default="http://eriosconsultores.test",
                   help="URL base de las páginas (por defecto el entorno local)")
    p.add_argument("--host", help="host de la base de datos")
    p.add_argument("--port", help="puerto de la base de datos")
    p.add_argument("--user", help="usuario de la base de datos")
    p.add_argument("--password", help="contraseña de la base de datos")
    p.add_argument("--db", help="nombre de la base de datos")
    p.add_argument("--mysql", help="ruta al cliente mysql")
    p.add_argument("--baseline", help="JSON de referencia con los conteos esperados")
    p.add_argument("--guardar-baseline", help="guardar los conteos en un JSON")
    p.add_argument("--consultas", action="store_true",
                   help="imprimir las consultas SQL usadas (para pegar en phpMyAdmin) y terminar")
    args = p.parse_args()

    if args.consultas:
        print("-- Tablas críticas: deben tener filas tras restaurar")
        for tabla, minimo in sorted(TABLAS_CRITICAS.items()):
            print("-- esperado >= %d" % minimo)
            print("select count(*) from `%s`;" % tabla)
        print("\n-- Tablas base (las llenan las migraciones; sirven de suelo)")
        for tabla in TABLAS_BASE:
            print("select count(*) from `%s`;" % tabla)
        print("\n-- Tablas a revisar (0 puede ser legítimo)")
        for tabla in TABLAS_A_REVISAR:
            print("select count(*) from `%s`;" % tabla)
        print("\n-- Huellas de contenido")
        for descripcion, sql in HUELLAS:
            print("-- %s" % descripcion)
            print(sql + ";")
        print("\n-- Señal de alarma: un solo lote = base recién migrada")
        print("select count(*) as migraciones, count(distinct batch) as lotes from migrations;")
        return 0

    ok = True
    if not args.solo_web:
        try:
            ok_sql, _ = revisar_sql(Base(args), args.baseline, args.guardar_baseline)
        except SystemExit:
            raise
        except Exception as e:
            print("ERROR: %s" % e)
            ok_sql = False
        ok = ok and ok_sql
    if not args.solo_sql:
        ok = revisar_paginas(args.base) and ok

    print("\n%s" % ("TODO CORRECTO" if ok else "HAY COMPROBACIONES FALLIDAS: el contenido no está completo"))
    return 0 if ok else 1


if __name__ == "__main__":
    sys.exit(main())

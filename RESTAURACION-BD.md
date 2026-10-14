# Restauración de `base_app_eriosconsultores`

Guía para recuperar el contenido de la web de ERIOS después del borrado accidental
del **14/10/2026** (una ejecución de `php artisan test` usó la base de datos
remota del `.env`; `RefreshDatabase` hizo `migrate:fresh`).

Verificador asociado: [`verificar-restauracion.py`](verificar-restauracion.py)

---

## 1. Punto de partida (medido)

| Elemento | Estado |
| --- | --- |
| Esquema | **Intacto**: 301 tablas y las 570 migraciones aplicadas |
| Contenido | **Perdido**: 238 de 301 tablas vacías; `users` = 0; todo `cms_*` y `aca_*` de la web |
| Ficheros subidos | **Intactos**: `https://eriosconsultores.com/storage/uploads/cms/items/...` responde 200 |
| MariaDB remoto | 10.5.29 en Debian 11, `log_bin = OFF` → **sin point-in-time recovery** |
| Copias locales | No hay ningún dump de ERIOS en el equipo; no existe otra base `erios*` en ese servidor |
| Web pública | `https://eriosconsultores.com` → HTTP 500 |

Consecuencia: **la única vía de recuperación es un backup del hosting (anterior al
14/10/2026) o un dump del equipo del proyecto**. Esta guía cubre obtenerlo,
probarlo, restaurarlo y verificar que el contenido volvió.

---

## 2. Reglas antes de empezar

- **Prohibido** ejecutar contra la base real: `php artisan migrate:fresh`, `db:wipe`,
  `db:seed` a secas, y `php artisan test` (ya está blindado en `phpunit.xml`, pero
  mientras no exista `base_app_eriosconsultores_testing` los tests fallan a propósito).
- Avisar al equipo/cliente: durante la restauración el panel y la web no deben usarse.
- No hace falta desplegar código: el problema es solo de datos.
- Ejecutar todo desde la raíz del proyecto. Las credenciales salen del `.env`
  (no las escribas en ningún documento ni en el chat).

Receta para cargarlas en la sesión de shell:

```bash
set -a; source .env; set +a
# comprobar sin imprimir la contraseña:
echo "$DB_HOST / $DB_DATABASE / $DB_USERNAME"
```

---

## 3. Paso 0 — Respaldo del estado actual (por si hay que volver atrás)

La base está casi vacía, así que es rápido y da un punto de retorno del esquema:

```bash
set -a; source .env; set +a
MYSQL_PWD="$DB_PASSWORD" mysqldump --default-character-set=utf8mb4 \
  -h "$DB_HOST" -u "$DB_USERNAME" --single-transaction --routines --triggers \
  "$DB_DATABASE" > estado-vacio-$(date +%F-%H%M).sql
```

---

## 4. Paso 1 — Conseguir el backup correcto

Pedir **una copia anterior a la incidencia** (14/10/2026, antes de las ~12:15 hora
del servidor). Los backups automáticos de hoy son posteriores al borrado: si se
restaura uno de hoy, no sirve de nada.

Tres vías, en orden de preferencia:

1. **Panel del hosting de `aracodeperu.cc`** (cPanel: *Archivos → Copias de seguridad*;
   DirectAdmin: *Crear/Restaurar copias*; o el módulo de backups de la base de datos).
   Buscar el backup de base de datos **del día anterior**.
2. **Ticket al hosting** pidiendo la restauración de `base_app_eriosconsultores`
   desde su copia más reciente anterior al incidente. Indicar que es MariaDB 10.5 y
   que no hay binlog, así que necesitan restauración desde backup lógico.
   Es la opción recomendada: la hace el servidor, sin subir cientos de MB.
3. **Dump del equipo/cliente**: el que se usó en el último despliegue o una copia
   de trabajo. Cuanto más reciente, mejor.

Al recibir el archivo, comprobar que es utilizable:

```bash
ls -lh dump.sql
grep -c "DROP TABLE IF EXISTS" dump.sql     # > 0: reimportable tal cual
grep -c "CREATE TABLE \`cms_section_items\`" dump.sql
grep -m1 "INSERT INTO \`users\`" dump.sql    # hay filas de usuarios
```

Si el dump **no** trae `DROP TABLE IF EXISTS`, la base destino debe vaciarse antes
de importar (lo más limpio: `DROP DATABASE` + `CREATE DATABASE` con el mismo
cotejamiento, y recién entonces importar).

---

## 5. Paso 2 — Probar el dump en local sin riesgo

Nunca se importa “a ciegas” en la base del servidor: primero se mide en local y se
guarda la referencia de conteos que después servirá para verificar.

```bash
# 1) base local de trabajo (usa tu MySQL local, no el servidor)
mysql -h 127.0.0.1 -u root -e "CREATE DATABASE IF NOT EXISTS erios_restore_check \
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"

# 2) importar (avisa si el dump pide otro cotejamiento)
mysql --default-character-set=utf8mb4 -h 127.0.0.1 -u root erios_restore_check < dump.sql

# 3) medir y guardar la referencia
python verificar-restauracion.py --solo-sql --host 127.0.0.1 --user root \
  --password '' --db erios_restore_check --guardar-baseline baseline.json
```

Qué mirar en la salida:

- **Tablas críticas**: `users`, `cms_items`, `cms_pages`, `cms_page_sections`,
  `cms_sections`, `cms_section_items`, `cms_testimonies`, `aca_courses`,
  `aca_teachers` deben tener filas. Si alguna sale a 0, el dump no sirve (o es de
  otra instalación).
- **Huellas de contenido**: logo de la cabecera, correo del pie, texto del hero y
  la persona «Esther». Si están a 0, ese backup no contiene la web de ERIOS.
- **Migraciones**: anotar cuántas trae (`select count(*) from migrations`). Si trae
  menos de 570, faltan migraciones posteriores: se aplican en el paso 4.

`baseline.json` queda como la foto de lo que hay que recuperar.

---

## 6. Paso 3 — Restaurar

### Opción A (recomendada): lo hace el hosting

Pedir la restauración de la base con el backup elegido. Al terminar, confirmar por
ticket la fecha del backup aplicado y verificarlo con el paso 5.

### Opción B: importamos nosotros

Con el dump en el equipo (avisar que el sitio público está en 500, así que no hay
tráfico real que perder):

```bash
set -a; source .env; set +a
# opcional pero recomendado: dejar la base destino limpia antes de importar
MYSQL_PWD="$DB_PASSWORD" mysql -h "$DB_HOST" -u "$DB_USERNAME" \
  -e "DROP DATABASE IF EXISTS \`$DB_DATABASE\`; CREATE DATABASE \`$DB_DATABASE\` \
      CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
# importar (puede tardar: hacerlo sin cortar la conexión)
MYSQL_PWD="$DB_PASSWORD" mysql --default-character-set=utf8mb4 \
  -h "$DB_HOST" -u "$DB_USERNAME" --max_allowed_packet=256M "$DB_DATABASE" < dump.sql
```

Notas: el host es remoto, así que la subida depende del ancho de banda; si el dump
es grande (>500 MB), es mejor copiarlo al servidor y usar `mysql` allí (o dejar que
el hosting lo haga). Al terminar, cerrar la sesión de shell para no dejar la
contraseña en el entorno.

---

## 7. Paso 4 — Reconciliar esquema y cachés

El backup es anterior al incidente, así que puede no tener las últimas migraciones
(las hay del 13 y 14/10/2026):

```bash
php artisan migrate:status | tail -20     # pendientes
php artisan migrate --force               # aplica solo las que falten
php artisan optimize:clear
```

Si tras migrar faltan permisos nuevos del panel, valorar (revisar antes, no lanzar
a ciegas):

```bash
php artisan db:seed --class=PermissionsReconcileSeeder --force
```

No usar `migrate:fresh` en ningún caso: volvería a borrar lo restaurado.

---

## 8. Paso 5 — Verificar los datos (SQL)

Contra la base real, comparando con la referencia del paso 2:

```bash
python verificar-restauracion.py --solo-sql --baseline baseline.json
# solo conteos, sin comparar:
python verificar-restauracion.py --solo-sql
```

Sale `TODO CORRECTO` (código 0) solo si: todas las tablas críticas tienen filas, las
huellas existen y ninguna tabla tiene menos filas que la referencia.

Para pegar las comprobaciones a mano en phpMyAdmin, el propio script escribe el SQL
que usa:

```bash
python verificar-restauracion.py --consultas
```

Consultas sueltas útiles (sustituir `mysql … "$DB_DATABASE"` por la conexión del
`.env`):

```sql
-- contenido de la web por sección del CMS
select s.id, s.component_id, count(si.id) as elementos
from cms_sections s left join cms_section_items si on si.section_id = s.id
group by s.id, s.component_id order by s.id;

-- páginas del CMS y sus secciones
select p.id, p.title, count(ps.id) as secciones
from cms_pages p left join cms_page_sections ps on ps.page_id = p.id
group by p.id, p.title;

-- cursos y docentes publicados
select count(*) from aca_courses;
select count(*) from aca_teachers t join people p on p.id = t.person_id;

-- usuarios del sistema (panel)
select id, name, email from users order by id limit 10;

-- coherencia: todas las migraciones en un solo lote = base recién creada
select count(*) as migraciones, count(distinct batch) as lotes from migrations;
```

Señal de alarma: si `lotes = 1`, la base está recién migrada (vacía), no restaurada.

---

## 9. Paso 6 — Verificar página por página

```bash
python verificar-restauracion.py                                  # local (.test)
python verificar-restauracion.py --base https://eriosconsultores.com
```

Cada página debe dar **HTTP 200** y contener sus textos. Marcas presentes en todas
(prueban cabecera y pie del CMS): `/storage/uploads/cms/items/`,
`info@eriosconsultores.com`, `aracode smart solutions`.

| Página | Además debe contener |
| --- | --- |
| `/` | Bienvenidos a ERIOS · ERIOS CONSULTORES TRIBUTARIOS · Conocer más |
| `/nosotros` | Nosotros |
| `/servicios` | Servicios |
| `/cursos` | Cursos |
| `/docentes` | Nuestros Docentes · Esther · Contador Publico Colegiado |
| `/liderazgo` | Liderazgo |
| `/contable` | Contable |
| `/tax-compliance` | Tax Compliance |
| `/contactanos` | Mantente en contacto · Envíanos un mensaje · Información de contacto |
| `/libro-de-reclamaciones` | Libro de Reclamaciones · Registra tu reclamo |
| `/politicas-privacidad` | Privacidad |
| `/politicas-de-devoluciones` | Devoluciones |
| `/curso/dolores-eiusmod-ipsa` | Preguntas frecuentes · Brochure |
| `/curso-descripcion/dolores-eiusmod-ipsa` | dolores-eiusmod-ipsa |
| `/curso-landing-preview/dolores-eiusmod-ipsa` | dolores-eiusmod-ipsa |

Las dos últimas devuelven 404 cuando la base está vacía (el controlador no encuentra
el curso): un 404 ahí es señal de que el contenido no ha vuelto.

---

## 10. Paso 7 — Prueba manual y cierre

1. Navegador en móvil (390 px) y escritorio, en **claro y oscuro**, en `/`, `/docentes`,
   `/contactanos`, `/libro-de-reclamaciones` y la landing de curso. Comprobar imágenes,
   menú móvil e interruptor de tema.
2. Formularios: hacer **un** envío de prueba en contacto y en libro de reclamaciones
   (envían correo real; avisar a quien reciba) y borrar después ese registro.
3. Anotar en este documento: fecha/hora de la restauración, dump usado (fecha y
   origen), migraciones aplicadas y resultado del verificador.

---

## 11. Prevención (no repetir el incidente)

1. **Tests aislados** (ya aplicado): `phpunit.xml` fija
   `DB_DATABASE=base_app_eriosconsultores_testing`. Falta crear esa base para poder
   correr la suite; mientras no exista, los tests fallan con «Unknown database»
   — es el comportamiento deseado, no un error a "arreglar".
2. **Nunca** usar la base del servidor como base de desarrollo. Si algún entorno
   local debe leer datos de producción, que sea con usuario de solo lectura.
3. **Copias propias**: `mysqldump` diario por cron con copia fuera del servidor, o
   instalar `spatie/laravel-backup` (no está instalado). Un backup del hosting no
   basta si no se prueba que se puede restaurar.
4. **Antes de cualquier operación destructiva** (`migrate:fresh`, importaciones,
   `db:wipe`), hacer un dump previo del estado actual.

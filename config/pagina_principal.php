<?php

/*
|--------------------------------------------------------------------------
| Página principal del dominio
|--------------------------------------------------------------------------
|
| Registro de las portadas que se pueden publicar en la raíz del dominio («/»).
| El valor elegido se guarda en el parámetro PW00001 (Parámetros → «Pagina web
| principal»): la opción seleccionada ahí decide qué portada responde en /.
|
| Lo lee App\Support\PaginaPrincipal, que es lo único que consume este archivo:
| WebPageController para saber qué vista renderizar en la raíz y la lista de
| Parámetros para publicar las opciones del desplegable. Las vistas nunca leen
| este archivo directo.
|
| Cada portada declara:
|
|  - clave     Valor que se guarda en PW00001. Se conservan el 1 y el 2 que ya
|              existían en el catálogo anterior y se siguen agregando números:
|              un valor nuevo NUNCA reutiliza uno viejo.
|  - nombre    Cómo se llama la portada en el desplegable de Parámetros.
|  - vista     Blade que se renderiza en /. Tiene que existir.
|
| ESTADO EN ERIOS CONSULTORES: hoy solo existe la portada corporativa
| (resources/views/pages/home.blade.php), así que el catálogo publica una sola
| opción. El 2 (portada de torneos) ya no está: los torneos de este proyecto se
| publican por edición en /torneos/{slug}, no como portada del dominio. Cuando
| se agregue una portada nueva, se suma aquí con un valor nuevo y su vista.
|
| Alternar la portada NO despublica el resto del sitio: las demás páginas siguen
| respondiendo en sus URLs.
|
| Recuerda ejecutar `php artisan config:clear` (o `config:cache` en producción)
| después de editar este archivo.
|
*/

return [

    'paginas' => [

        '1' => [
            'nombre' => 'ERIOS Consultores',
            'vista' => 'pages.home',
        ],

    ],

];

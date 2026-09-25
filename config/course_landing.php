<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Orden de las secciones de la landing de curso
    |--------------------------------------------------------------------------
    |
    | Esta lista define el orden en que se renderizan las secciones de
    | resources/views/components/courselanding/* en las dos rutas que comparten
    | la vista pages/course-landing:
    |
    |   - /curso/{slug}          (publica, resuelve por url_slug)
    |   - /landing_preview/{id}  (interna, resuelve por id)
    |
    | Para reordenar la landing basta mover lineas aqui: no hace falta tocar
    | ninguna vista ni componente. Los nombres deben coincidir con los archivos
    | de resources/views/components/courselanding/.
    |
    | Si un curso necesita un orden propio, el modelo AcaCourseLanding puede
    | exponer un atributo `sections_order` (arreglo de nombres): las secciones
    | listadas se muestran primero, en ese orden, y el resto se agrega al final
    | conservando el orden por defecto.
    |
    */

    'sections' => [
        'hero',
        'professional-development-info',
        'the-problem',
        'study-plan',
        'staff',
        'results',
        'investment',
        'testimonials',
        'faq',
        'professional-development-form',
        'certificate-template',
        'course-testimonials',
    ],

];

# Auditoría del amarillo de marca (`#FFC600`) — ERIOS Consultores

Fecha: 16 de octubre de 2026. Alcance: todo el repositorio salvo `vendor/`, `node_modules/`, `.git/` y `storage/`.

## Método

1. **Recuento de tokens** en el código: `#ffc600` / `#FFC600`, `rgba(255, 198, 0, …)`, `#b58100` (amarillo apagado), `#f4d671`, `var(--erc-yellow)` y `var(--erc-yellow-dark)`.
2. **Comprobación en el navegador de lo que de verdad se pinta**: barrido de **estilos computados** de todos los elementos de cada página, incluidos los pseudoelementos `::before` y `::after`, sobre `color`, `background-color`, `background-image`, los cuatro bordes, `box-shadow`, `fill` y `stroke`.
3. Páginas comprobadas en vivo (11): `/`, `/nosotros`, `/servicios`, `/cursos`, `/contable`, `/tax-compliance`, `/liderazgo`, `/docentes`, `/contactanos`, `/libro-de-reclamaciones` y `/politicas-privacidad`.
4. **Comprobación de llaves** de todos los bloques `<style>` de las vistas (salió a la luz un bloque roto; ver el apartado H).

**Números totales:** 166 apariciones del amarillo en 26 archivos — 98 líneas en `public/themes/webpage/css/style.css` (92 selectores), 63 líneas en 22 `.blade.php` (4 de ellas son comentarios que citan el amarillo, no declaraciones), 3 en `dark-mode.css`, 1 en `generar-modo-oscuro.py` y 1 en `CourseLandingPresenter.php`. `AGENTS.md` solo lo documenta.

## Resumen de lo que se ve hoy

| Página | Qué se ve amarillo | Cuántos |
| --- | --- | --- |
| `/contable` | iconos de las tarjetas de puntos | 4 |
| `/tax-compliance` | iconos de las tarjetas de puntos | 4 |
| `/libro-de-reclamaciones` | 2 barras del rótulo, borde izquierdo y icono del aviso legal | 4 |
| `/contactanos` | barras del rótulo de cabecera (2) y del rótulo del formulario (1) | 3 |
| `/servicios` (con el modal abierto) | anillo de adorno de la cabecera del modal, al 15 % | 1 |
| Todo el sitio | hover del botón flotante de WhatsApp (verde → amarillo) | 1 |

En el **modo oscuro** ninguno de ellos sale amarillo: el generador de `dark-mode.auto.css` pasa el amarillo al celeste `#00b6ff`, y `dark-mode.css` reescribe las variables de la landing (`--erc-yellow: #00b6ff`). Es decir, hoy el mismo elemento tiene dos colores según el tema.

El resto del amarillo del repositorio **no se renderiza**: o está en el tema base con el marcado comentado, o vive en páginas que no tienen datos.

## A. Iconos (amarillo como color de letra)

| Archivo:línea | Selector | Qué pinta | Estado |
| --- | --- | --- | --- |
| `pages/accounting.blade.php:80` | `.erc-acc-point i` | iconos de las 4 tarjetas de `/contable` | visible |
| `pages/taxcompliance.blade.php:80` | `.erc-tax-point i` | iconos de las 4 tarjetas de `/tax-compliance` | visible |
| `pages/complaints-book.blade.php:35` | `.erc-claims__notice i` | icono del aviso legal | visible |
| `pages/complaints-book.blade.php:130` | `.erc-claims__info i.erc-claims__info-icon` | icono de la columna informativa | muerto (bloque roto, ver H) |
| `pages/course-description.blade.php:57` | `.erc-cd__cert i` | icono de la tarjeta de certificación | sin datos |
| `pages/curso-descripcion.blade.php:163` | `.erc-cd__themes li::before` | tilde de cada tema del temario | sin datos |
| `components/courselanding/faq.blade.php:91` | `.erc-cl-faq__question i` | flecha de cada pregunta del FAQ | landing sin publicar |
| `components/courselanding/course-testimonials.blade.php:119` | `.erc-cl-ct__stars` | estrellas de valoración | landing sin publicar |
| `components/courselanding/testimonials.blade.php:93` | `.erc-cl-testi__mark` | comilla del testimonio | landing sin publicar |

**Choque:** el amarillo como icono o letra sobre blanco da **1,57:1**. Incumple el 3:1 de gráficos y el 4,5:1 de texto, y además es justo el caso que tus notas apartan del celeste («rellenos, barras, píldoras y adornos, nunca texto»), así que el icono amarillo queda fuera de las dos reglas a la vez. En `complaints-book:35` el icono es informativo (un aviso legal), así que no cuenta como adorno.

## B. Adornos (barras, bordes, anillos, sombras)

| Archivo:línea | Selector | Qué pinta | Estado |
| --- | --- | --- | --- |
| `pages/contact.blade.php:30` | `.erc-contact__head .erc-contact__eyebrow::before` y `::after` | 2 barras flanqueando el rótulo | visible |
| `pages/contact.blade.php:77` | `.erc-form-card__eyebrow::before` | barra del rótulo del formulario | visible |
| `pages/complaints-book.blade.php:20` | `.erc-claims__eyebrow::before` y `::after` | 2 barras del rótulo | visible |
| `pages/complaints-book.blade.php:30` | `.erc-claims__notice` | filete izquierdo del aviso legal | visible |
| `components/services-two.blade.php:315` | `.erc-svc-modal__head::after` | anillo al 15 % de la cabecera del modal | visible con el modal abierto |
| `pages/complaints-book.blade.php:126` | `.erc-claims__info::after` | círculo punteado de la columna informativa | muerto (bloque roto) |
| `pages/home.blade.php:115` | `.erc-slick-dots .slick-active button` | barra activa del carrusel del hero | muerto (no hay puntos en el DOM) |
| `pages/course-description.blade.php:46`, `:99`, `:157` | `.erc-cd__section-title::before`, `.erc-cd__price-card::after`, `.erc-cd__related-title::before` | barras de título y círculo punteado | sin datos |
| `pages/curso-descripcion.blade.php:144` | `.erc-cd__section h3::before` | barra de título de sección | sin datos |
| `courselanding/styles.blade.php:94`, `:108` | `.erc-sec-eyebrow::before` / `::after` | barras de los rótulos de la landing | landing sin publicar |
| `courselanding/styles.blade.php:218`, `:332` | `.erc-card:hover`, `.erc-cl-empty` | borde al 60 % y filete de 5 px | landing sin publicar |
| `courselanding/study-plan.blade.php:69`, `:94`, `:126` | `.erc-cl-plan__badge`, `.erc-cl-plan__item…::before`, `.erc-cl-plan__item:hover .erc-cl-plan__text` | sombra amarilla, línea de tiempo y borde al 60 % | landing sin publicar |
| `courselanding/testimonials.blade.php:85` | `.erc-cl-testi__card:hover` | borde al 60 % | landing sin publicar |
| `courselanding/investment.blade.php:306` | `.erc-cl-inv__plan` | filete superior de 5 px | landing sin publicar |
| `courselanding/certificate-template.blade.php:69` | `.erc-cl-cert__media::after` | marco de 3 px | landing sin publicar |
| `courselanding/course-testimonials.blade.php:118`, `courselanding/results.blade.php:57`, `courselanding/professional-development-info.blade.php:48` | `…__card:hover` | borde superior en hover | landing sin publicar |

**Choque:** el amarillo es un **adorno permitido** por tus notas (rellenos, barras, píldoras), así que no hay problema de contraste aquí. El choque es de tema: en oscuro estos mismos adornos son celestes, y un filete de 2 px al 15-25 % de opacidad apenas se distingue del blanco (≈1,2:1 sobre la tarjeta, por debajo de los 3:1 que se piden para un elemento que comunica, como el filete del aviso legal).

## C. Rellenos (fondo amarillo)

| Archivo:línea | Selector | Qué pinta | Estado |
| --- | --- | --- | --- |
| `components/whatsapp.blade.php:55` y `:60` | `#whatsapp .wtsapp:hover` y `:before` | hover del botón flotante (con el icono en navy) | visible, solo al pasar el ratón |
| `pages/complaints-book.blade.php:138` | `.erc-claims__step-num` | círculo numerado de los pasos | muerto (bloque roto) |
| `pages/complaints-book.blade.php:129` | `.erc-claims__info i.erc-claims__info-icon` | caja del icono, tinte al 15 % | muerto (bloque roto) |
| `pages/course-description.blade.php:106`, `pages/curso-descripcion.blade.php:188` | `.erc-cd__price-note` | píldora de nota de precio, tinte al 14 % con letra `#b58100` | sin datos |
| `courselanding/styles.blade.php:256` | `.erc-card:hover .erc-chip-icon` | relleno azul con la letra en amarillo | landing sin publicar |
| `courselanding/study-plan.blade.php:62`, `:114` | `.erc-cl-plan__badge`, `.erc-cl-plan__item:hover .erc-cl-plan__num` | píldora y número de paso | landing sin publicar |
| `courselanding/investment.blade.php:319`, `:332` | `.erc-cl-inv__plan-head`, `.erc-cl-inv__tag` | tinte al 7 % y etiqueta | landing sin publicar |

**Choque:** el relleno amarillo con la letra en navy da **9,3:1**, así que es correcto por contraste; choca con el formato que acordamos para los botones (degradado navy con letra blanca) y con el tema oscuro, donde se vuelve celeste. Ya no queda ningún botón amarillo relleno: los dos que había («Enviar solicitud» del modal y «Enviar» del formulario de contacto) pasaron al formato de «Aula Virtual».

## D. Textos (amarillo como color de letra)

| Archivo:línea | Selector | Qué pinta | Estado |
| --- | --- | --- | --- |
| `pages/services.blade.php:196` | `.erc-service-card__link:hover` | «Leer más» de cada tarjeta, en hover | **sin marcado**: esa clase no existe en ninguna vista (las tarjetas usan `.erc-svc-btn`) |
| `pages/course-description.blade.php:129`, `pages/curso-descripcion.blade.php:203` | `.erc-wa-cta`, `.erc-cd__btn--cart` | letra del botón de WhatsApp y del de carrito, sobre el degradado navy | sin datos |
| `pages/curso-descripcion.blade.php:112` | `.erc-cd__modality` | rótulo de modalidad sobre píldora navy al 88 % | sin datos |
| `pages/leadership.blade.php:168` | `.erc-wa-cta` | letra del botón de WhatsApp | **sin marcado en esa página**: su definición no la usa nadie; el único marcado con esa clase está en `course-description.blade.php:340`, sin datos |
| `pages/course-description.blade.php:106`, `pages/curso-descripcion.blade.php:188` | `.erc-cd__price-note` | letra `#b58100` sobre el tinte del 14 % | sin datos |
| `courselanding/course-testimonials.blade.php:147`, `courselanding/staff.blade.php:150`, `:162`, `:211` | `.erc-cl-ct__more:hover`, `.erc-cl-staff__body small`, `…__hint`, `…__modal-role` | rótulos `#b58100` | landing sin publicar |

**Choque:** `#b58100` sobre blanco da **3,44:1** y sobre su propio tinte del 14 % baja a **3,21:1**: no llega al 4,5:1 que pide un texto de 12-13 px. El amarillo pleno sobre el degradado navy (`leadership:168`) da 9,3:1 y se lee bien, pero es el caso que el cliente ya descartó («sobre fondo azul oscuro no queda amarillo»), y en modo oscuro ese mismo botón ya sale con la letra en blanca.

## E. Hovers con relleno amarillo

| Archivo:línea | Selector | Estado |
| --- | --- | --- |
| `components/whatsapp.blade.php:53-61` | `#whatsapp .wtsapp:hover` y `:focus-visible` (+ el anillo pulsante) | visible en todo el sitio |
| `courselanding/course-testimonials.blade.php:192` | `.erc-cl-ct__video:hover` | landing sin publicar |

Son los dos únicos hovers del sitio que llevan relleno amarillo; el resto de hovers con relleno van en celeste con la letra en blanco, como pide la regla del cliente.

## F. Variables y fuentes de color

| Archivo:línea | Qué es |
| --- | --- |
| `components/courselanding/styles.blade.php:20-21` | `--erc-yellow: #ffc600` y `--erc-yellow-dark: #b58100`, el origen del amarillo de la landing |
| `public/themes/webpage/css/dark-mode.css:230-231` | En oscuro esas dos variables se reescriben a `#00b6ff`: aquí está la asimetría entre temas |
| `generar-modo-oscuro.py:122-133` | `es_amarillo()` y la regla «en el tema oscuro no queda amarillo, ni en rellenos ni en velados» |
| `app/Support/CourseLandingPresenter.php:37` | `'#ffc600' // Amarillo institucional` en la paleta que ofrece el armador de landings |

`CourseLandingPresenter::colors()` merece atención: el color se elige por configuración y se emite en línea, así que **el generador de modo oscuro no puede verlo**. Un bloque pintado desde ahí se queda amarillo también en oscuro, al contrario que todos los demás.

## G. Código muerto (no se renderiza hoy)

| Archivo | Amarillos | Por qué no se ve |
| --- | --- | --- |
| `public/themes/webpage/css/style.css` | 98 líneas en 92 selectores | es el tema base; su marcado está comentado en las vistas (`.main-btn`, `.single-counter`, `.single-teachers`, `.single-publication`, los carruseles de cursos). Verificado: 0 amarillos en las 11 páginas |
| `pages/course-description.blade.php` | 8 | ruta `/curso-r/{slug}` comentada y 0 ítems en `onli_items` |
| `pages/curso-descripcion.blade.php` | 6 | 0 ítems, igual que `/cursos` |
| `components/courselanding/*.blade.php` | 27 en 10 archivos | 0 landings en `aca_course_landings`: `/curso/{slug}` no resuelve |
| `pages/complaints-book.blade.php:126, 129, 130, 138` | 4 | bloque de estilos roto (apartado H) |
| `pages/header.blade.php:171, 384`, `pages/home.blade.php:50` y `courselanding/styles.blade.php:5` | 4 | son comentarios (`/* … */`), no pintan nada |

Ojo con una excepción que parece viva y no lo está: `.section-title h5::before { background-color: #ffc600 }` (style.css:178) apunta a `.section-title`, que **sí** existe en el marcado de `/politicas-privacidad` (8 bloques), pero esos bloques no llevan un `h5`, así que la barra amarilla nunca se dibuja.

## H. Bug encontrado durante la auditoría (no es amarillo, pero salió aquí)

`pages/complaints-book.blade.php:108-116`: a `.erc-claims__submit:hover` **le falta la llave de cierre**. Los editores modernos lo leen como anidamiento CSS, así que todo lo que viene detrás queda colgado de ese selector:

```
.erc-claims__submit:hover {
    background: …; color: #fff;
                                 ← falta «}»
    .erc-claims__submit[disabled] { … }
    .erc-claims__info { … }        ← esto pasa a ser «& .erc-claims__info»
    …
    @media (max-width: 767px) { … }
```

Comprobado en el navegador: la hoja de estilos tiene `.erc-claims__info`, `.erc-claims__step-num` y el resto **anidados un nivel por debajo de `.erc-claims__submit:hover`**, y sus estilos computados no se aplican. Consecuencia visible: la columna informativa del libro de reclamaciones **no tiene su fondo navy** (queda transparente con la letra en blanco), y se pierden el círculo punteado, la caja del icono, los números de paso amarillos y las reglas de móvil de esa página. Es el **único** bloque `<style>` desbalanceado de los 44 archivos con bloque `<style>` que hay en las vistas.

## I. Recomendación

1. **Arreglar la llave de `complaints-book.blade.php`** antes que nada: sin eso, la columna informativa está ilegible y cuatro de los amarillos de la lista ni siquiera se ven.
2. **Iconos** (`accounting:80`, `taxcompliance:80`): pasarlos al celeste de marca, como ya se hizo con los de liderazgo, que son el mismo componente. Ojo con el 2,3:1 del celeste sobre blanco: si se quiere cumplir 3:1 hay que meterlos en una píldora celeste con el icono en navy (6,4:1).
3. **Adornos y letras amarillas**: al celeste donde ya se decidió (barras de rótulo y filetes), y `#b58100` de las notas de precio a navy sobre el tinte claro, que es lo que da contraste suficiente a 12 px.
4. **Textos amarillos sobre navy** (`erc-wa-cta`, `erc-cd__btn--cart`, `erc-cd__modality`): pasarlos a blanco, que es lo que ya hace el modo oscuro.

Además, dos definiciones sin marcado que conviene borrar cuando se toquen esos archivos: `services.blade.php:195-198` (`.erc-service-card__link`, sustituida por `.erc-svc-btn`) y `leadership.blade.php:162-186` (`.erc-wa-cta`, que en esa página no tiene marcado).
5. **Hover de WhatsApp**: pasarlo al celeste con el icono en blanco, como el resto de hovers del sitio.
6. **Paleta del armador de landings**: si el amarillo no debe volver, quitarlo de `CourseLandingPresenter::colors()` o dejarlo solo para secciones que nunca caen sobre fondo oscuro.
7. **Tema base**: las 98 líneas de `style.css` son deuda del tema original. No se ven, pero siguen ahí y confunden cualquier auditoría futura; lo razonable es borrarlas por bloques a medida que se confirme que ningún marcado las usa.

## Anexo A · Inventario completo de `public/themes/webpage/css/style.css`

Tema base del sitio: 98 declaraciones en 92 selectores. Se detallan por si algún día se limpia el archivo o se revive alguna de sus secciones.

| Línea | Selector | Declaración |
| --- | --- | --- |
| 130 | `.main-btn` | border: 1px solid #ffc600 |
| 144 | `.main-btn` | background-color: #ffc600 |
| 147 | `.main-btn:hover` | color: #ffc600 |
| 154 | `.main-btn-2` | color: #ffc600 |
| 162 | `.main-btn-2:hover` | background-color: #ffc600 |
| 163 | `.main-btn-2:hover` | border-color: #ffc600 |
| 178 | `.section-title h5::before` | background-color: #ffc600 |
| 199 | `.preloader .color-1` | background-color: #ffc600 !important |
| 616 | `.header-right .social ul li a:hover` | color: #ffc600 |
| 628 | `.login-register ul li::before` | color: #ffc600 |
| 637 | `.login-register ul li a` | color: #ffc600 |
| 701 | `.navigation .navbar .navbar-nav>li>a.active, .navigation .navbar .navbar-nav>li:hover>a` | color: #ffc600 |
| 731 | `.navigation .navbar .navbar-nav li .sub-menu li a.active, .navigation .navbar .navbar-nav li .sub-menu li a:hover` | color: #ffc600 |
| 786 | `.right-icon ul li a span` | background-color: #ffc600 |
| 813 | `.header-two .header-right .social ul li a:hover` | color: #ffc600 |
| 822 | `.header-two .login-register ul li a` | background: #ffc600 |
| 847 | `.header-two .navigation .navbar .navbar-nav li .sub-menu li a.active, .header-two .navigation .navbar .navbar-nav li .sub-menu li a:hover` | color: #ffc600 |
| 865 | `.header-three .navigation .navbar .navbar-nav li a:hover` | color: #ffc600 |
| 880 | `.header-three .navigation.sticky .navbar .navbar-nav li a:hover` | color: #ffc600 |
| 893 | `.header-three .navigation .navbar .navbar-nav li .sub-menu li a:hover` | color: #ffc600 |
| 905 | `.header-four .navigation .navbar .navbar-nav li .sub-menu li a.active, .header-four .navigation .navbar .navbar-nav li .sub-menu li a:hover` | color: #ffc600 |
| 1041 | `.slider-active .slick-arrow i:hover` | background-color: #ffc600 |
| 1042 | `.slider-active .slick-arrow i:hover` | border-color: #ffc600 |
| 1254 | `.category-slide .slick-arrow i:hover` | background-color: #ffc600 |
| 1320 | `.about-event ul li .single-event span i` | color: #ffc600 |
| 1335 | `.about-event ul li .single-event a:hover h4` | color: #ffc600 |
| 1416 | `.apply .apply-cont .main-btn:hover` | border-color: #ffc600 |
| 1503 | `.single-course .thum .price span` | background-color: #ffc600 |
| 1522 | `.single-course .cont ul li>i` | color: #ffc600 |
| 1538 | `.single-course .cont h4:hover` | color: #ffc600 |
| 1566 | `.single-course .course-teacher .name a:hover h6` | color: #ffc600 |
| 1589 | `.single-course .course-teacher .admin ul li a:hover` | color: #ffc600 |
| 1619 | `.course-slide .slick-arrow:hover i` | border-color: #ffc600 |
| 1620 | `.course-slide .slick-arrow:hover i` | background-color: #ffc600 |
| 1646 | `.video i` | background-color: #ffc600 |
| 1757 | `.single-teachers .cont a:hover h6` | color: #ffc600 |
| 1822 | `.single-publication .image .add-cart ul li a` | color: #ffc600 |
| 1825 | `.single-publication .image .add-cart ul li a` | border: 1px solid #ffc600 |
| 1831 | `.single-publication .image .add-cart ul li a:hover` | background-color: #ffc600 |
| 1844 | `.single-publication .content .book-title a:hover` | color: #ffc600 |
| 1937 | `.single-testimonial .testimonial-thum .quote i` | background-color: #ffc600 |
| 1976 | `.testimonial-slide .slick-dots li.slick-active button` | background-color: #ffc600 |
| 2001 | `.single-news .news-cont ul li a i` | color: #ffc600 |
| 2019 | `.single-news .news-cont a:hover h3` | color: #ffc600 |
| 2060 | `.footer-about ul li a:hover` | background-color: #ffc600 |
| 2088 | `.footer-link ul li a i` | color: #ffc600 |
| 2093 | `.footer-link ul li a:hover` | color: #ffc600 |
| 2111 | `.footer-address ul li .icon i` | color: #ffc600 |
| 2202 | `.category-2-items .single-items .items-cont h5:hover` | color: #ffc600 |
| 2217 | `.category-form .form-title h3` | color: #ffc600 |
| 2276 | `.single-course-2>.thum .price span` | background-color: #ffc600 |
| 2306 | `.single-course-2>.thum .course-teacher .name h6:hover` | color: #ffc600 |
| 2316 | `.single-course-2>.thum .course-teacher .review ul li` | color: #ffc600 |
| 2330 | `.single-course-2 .cont h4:hover` | color: #ffc600 |
| 2342 | `.single-counter span` | color: #ffc600 |
| 2411 | `.teachers-2 .teachers-2-single .cont a:hover h5` | color: #ffc600 |
| 2422 | `.teachers-2 .teachers-2-single .cont span i` | color: #ffc600 |
| 2514 | `.event-2 ul li .single-event span i` | color: #ffc600 |
| 2529 | `.event-2 ul li .single-event a:hover h4` | color: #ffc600 |
| 2552 | `.single-event-list-2 .event-cont span i` | color: #ffc600 |
| 2567 | `.single-event-list-2 .event-cont a:hover h4` | color: #ffc600 |
| 2585 | `.count-down-cont h2` | color: #ffc600 |
| 2623 | `.category-form-3 .form-title` | background-color: #ffc600 |
| 2637 | `.category-form-3 .main-btn:hover` | color: #ffc600 |
| 2659 | `.page-banner-cont .breadcrumb .breadcrumb-item` | color: #ffc600 |
| 2721 | `.courses-top-search .nav .nav-item a.active` | color: #ffc600 |
| 2771 | `.courses-pagination .pagination .page-item a.active, .courses-pagination .pagination .page-item a:hover` | background-color: #ffc600 |
| 2772 | `.courses-pagination .pagination .page-item a.active, .courses-pagination .pagination .page-item a:hover` | border-color: #ffc600 |
| 2831 | `.courses-single-left .course-terms ul li .review ul li a` | color: #ffc600 |
| 2931 | `.curriculum-cont .accordion .card .card-header a ul li>i` | color: #ffc600 |
| 3067 | `.reviews-cont ul li .single-reviews .reviews-description .rating ul li` | color: #ffc600 |
| 3109 | `.reviews-cont .reviews-form .form-single .rate:hover, .reviews-cont .reviews-form .form-single .rate.selected` | color: #ffc600 |
| 3140 | `.course-features ul li i` | color: #ffc600 |
| 3157 | `.course-features .price-button span b` | color: #ffc600 |
| 3204 | `.You-makelike .single-makelike .cont h4:hover` | color: #ffc600 |
| 3209 | `.You-makelike .single-makelike .cont ul li` | color: #ffc600 |
| 3254 | `.single-event-list .event-cont span i` | color: #ffc600 |
| 3269 | `.single-event-list .event-cont a:hover h4` | color: #ffc600 |
| 3292 | `.events-left span i` | color: #ffc600 |
| 3316 | `.events-coundwon .count-down-time .single-count .number` | color: #ffc600 |
| 3343 | `.events-address ul li .single-address .icon i` | color: #ffc600 |
| 3471 | `.single-blog .blog-cont a:hover h3` | color: #ffc600 |
| 3488 | `.single-blog .blog-cont ul li a i` | color: #ffc600 |
| 3546 | `.sidebar .categories ul li a:hover` | color: #ffc600 |
| 3580 | `.sidebar .sidebar-post ul li a .single-post .cont h6:hover` | color: #ffc600 |
| 3612 | `.blog-details .cont ul li a i` | color: #ffc600 |
| 3636 | `.blog-details .cont .share li a i` | background-color: #ffc600 |
| 3748 | `.shop-top-search .nav .nav-item a.active` | color: #ffc600 |
| 4064 | `.single-teacher-2 .teacher-content .teacher-title a:hover` | color: #ffc600 |
| 4100 | `.admission-info span` | color: #ffc600 |
| 4155 | `.single-course-three .course-content .rating li` | color: #ffc600 |
| 4170 | `.single-course-three .course-content .course-title a:hover` | color: #ffc600 |
| 4200 | `.course-meta .admin ul li a:hover` | color: #ffc600 |
| 4214 | `.course-signup .content .signup-title` | color: #ffc600 |
| 4316 | `.faq-accordion-cont .accordion .card .card-header a ul li>i` | color: #ffc600 |
| 4366 | `.privacy-list ul li a:hover` | color: #ffc600 |
| 4409 | `a.term-service:hover` | color: #ffc600 |
| 4424 | `a.loginhere-link:hover` | color: #ffc600 |

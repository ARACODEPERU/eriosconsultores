# ERIOS Consultores — notas para agentes

## Vocabulario de color (leer antes de tocar estilos)

- **«celeste» = `#00B6FF`**, el celeste del logo de ERIOS. Cuando el usuario diga «celeste»
  sin dar un código, es este, siempre.
- No confundir con el celeste claro del modo oscuro (`#71A9F4`), que es una variante pensada
  para fondos oscuros, ni con el celeste heredado `#00A0F0` (ver deuda abajo).
- Navy: `#083058` (identidad) y `#07294D` (el que usa el tema en botones y pie).
- Azul fuerte: `#0048B0` / `#004AAD`. Amarillo: `#FFC600`.

### Límite de contraste del celeste

`#00B6FF` sobre blanco da **2,3:1**: sirve para rellenos, barras, píldoras y adornos, nunca
para texto. Sobre el navy oscuro `#121B2C` da **7,5:1**, así que en modo oscuro sí puede
llevar texto (y sale algo mejor que el `#71A9F4` actual, 7,1:1). Texto blanco sobre celeste
tampoco vale (2,3:1).

### Reglas de hover (petición expresa del cliente)

- **Todo hover con relleno celeste lleva la letra (o el icono) en blanco.** Aplicado en el
  botón «Aula Virtual», el switch de tema, los iconos del topbar y los botones del hero. El
  2,3:1 del blanco sobre celeste queda como decisión asumida, no como descuido: no hace falta
  volver a plantearlo.
- **Excepciones: los velos, que no son rellenos.** En las píldoras del menú el hover es un
  velo translúcido, así que la letra no va en blanco: en claro es azul fuerte `#004AAD`
  (velo del 10-20 % sobre blanco) y en oscuro es celeste `#00B6FF` (velo del 14-22 % sobre
  navy). Pendiente de decidir si en oscuro esas píldoras pasan a letra blanca: ganarían
  contraste (12,4:1 frente a 5,4:1).

### Deuda conocida: el celeste antiguo `#00A0F0`

Doce archivos usan `#00A0F0` o `rgba(0, 160, 240, …)`, varios de ellos comentándolo como
«los colores del logotipo ERIOS». Es una aproximación vieja: el logo real es `#00B6FF`
(comprobado muestreando los píxeles de `public/themes/webpage/images/Logo_Web.jpg`,
`Logo_Icon.png` y `Logo_Web_Negativo.png`). Al tocar cualquiera de esos sitios, unificar al
celeste de marca. Archivos afectados: `resources/views/pages/home.blade.php`,
`resources/views/components/page-hero.blade.php`, `resources/views/components/header.blade.php`,
`resources/views/components/courselanding/styles.blade.php`,
`resources/views/pages/leadership.blade.php`,
`public/themes/webpage/css/dark-mode.css`, `taxcompliance`, `curso-descripcion`,
`course-description`, `complaints-book`, `accounting` y `about`.

## Convenciones del proyecto

- Laravel + Blade. Componentes en `resources/views/components`, páginas en
  `resources/views/pages`, clases de vista en `app/View/Components`.
- El CSS propio de cada sección vive **dentro del blade** con clases prefijadas `erc-`;
  el CSS global está en `public/themes/webpage/css/` (`style.css`, `responsive.css`,
  `dark-mode.css`) y `dark-mode.auto.css` es generado.
- Modo oscuro: se escribe con `:where(html[data-theme="dark"])` y, cuando hay que ganarle
  al tema, con `!important` sobre el color.
- Tipografía Montserrat; la barra de navegación usa 12px en mayúsculas.
- Respeta `prefers-reduced-motion` en cualquier animación nueva.
- Comentarios en español, y explican el porqué del cambio, no el qué.
- Los `.blade.php` y `.css` del árbol de trabajo están en **CRLF**: consérvalo al editar
  (el repo fuerza LF vía `.gitattributes`, así que cambiar a LF genera un diff de todo el archivo).
- Los assets del logotipo y de las imágenes vienen de `storage/`, no de `public/themes`.

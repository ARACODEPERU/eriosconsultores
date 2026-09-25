{{--
    Carrito publico de cursos.

    Guarda en localStorage "carrito" solo el id del item de tienda (onli_items.id),
    que es lo que espera onlineshop_get_item_carrito + la pagina del carrito.

    Contrato: cualquier elemento con [data-erc-cl-inscribe] (y opcionalmente
    data-cart-id, data-course-name, data-price, data-cart-url) agrega el curso.
    Es el mismo contrato que usa la landing del curso, asi que puede incluirse en
    varias paginas sin duplicar handlers ni depender de educcap-carrito.js.
--}}
<script>
    (function () {
        if (window.ercOnliCartReady) return;
        window.ercOnliCartReady = true;

        var CART_KEY = 'carrito';

        function withSwal(callback) {
            if (window.Swal) { callback(); return; }

            var script = document.createElement('script');
            script.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
            script.onload = callback;
            script.onerror = callback;
            document.head.appendChild(script);
        }

        function readCart() {
            try {
                var cart = JSON.parse(localStorage.getItem(CART_KEY) || '[]');
                return Array.isArray(cart) ? cart : [];
            } catch (error) {
                return [];
            }
        }

        function addToCart(id) {
            var cart = readCart();
            var exists = cart.some(function (item) {
                return parseInt(item.id, 10) === parseInt(id, 10);
            });

            if (!exists) {
                cart.push({ id: parseInt(id, 10) });
                localStorage.setItem(CART_KEY, JSON.stringify(cart));
            }

            return exists;
        }

        document.addEventListener('click', function (event) {
            var button = event.target.closest('[data-erc-cl-inscribe]');
            if (!button) return;

            event.preventDefault();

            var id = button.getAttribute('data-cart-id');
            var name = button.getAttribute('data-course-name') || 'Curso';
            var price = parseFloat(button.getAttribute('data-price') || '0');
            var cartUrl = button.getAttribute('data-cart-url') || '{{ route('web_carrito') }}';
            var isFree = price <= 0;

            if (!id || parseInt(id, 10) <= 0) {
                withSwal(function () {
                    if (window.Swal) {
                        Swal.fire({
                            icon: 'info',
                            title: 'Curso no disponible',
                            text: 'No encontramos este curso en la tienda. Escríbenos por WhatsApp y te ayudamos.',
                            confirmButtonColor: '#004aad'
                        });
                    }
                });
                return;
            }

            var alreadyInCart = addToCart(id);

            withSwal(function () {
                if (!window.Swal) {
                    window.location.href = cartUrl;
                    return;
                }

                if (alreadyInCart) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Ya está en tu carrito',
                        text: 'Este curso ya fue agregado anteriormente.',
                        showCancelButton: true,
                        confirmButtonText: 'Ir al carrito',
                        cancelButtonText: 'Seguir viendo',
                        confirmButtonColor: '#004aad',
                        cancelButtonColor: '#6b7280'
                    }).then(function (result) {
                        if (result.isConfirmed) window.location.href = cartUrl;
                    });
                    return;
                }

                Swal.fire({
                    icon: 'success',
                    title: isFree ? '¡Inscripción gratuita!' : 'Curso agregado',
                    html: '<strong>' + name + '</strong> se agregó a tu carrito.' +
                        (isFree ? '<br><br><span style="color: #00ab55; font-weight: 600;">Este curso es gratuito. Ve al carrito para completar tu inscripción sin costo.</span>' : ''),
                    showCancelButton: true,
                    confirmButtonText: 'Ir al carrito',
                    cancelButtonText: 'Seguir viendo',
                    confirmButtonColor: '#004aad',
                    cancelButtonColor: '#6b7280'
                }).then(function (result) {
                    if (result.isConfirmed) window.location.href = cartUrl;
                });
            });
        });
    })();
</script>

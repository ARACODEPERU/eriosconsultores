@extends('layouts.webpage')
@section('heades')
    <script src="https://sdk.mercadopago.com/js/v2"></script>
@endsection
@section('content')


    <!-- Start main-content -->
    <section class="page-title"
        style="background-image: url({{ asset('themes/webpage/images/background/page-title.jpg') }});">
        <div class="auto-container">
            <div class="title-outer">
                <h1 class="title">
                    Pagar
                </h1>
                <ul class="page-breadcrumb">
                    <li>
                        <a href="{{ route('index_main') }}">Home</a>
                    </li>
                    <li>Pagar</li>
                </ul>
            </div>
        </div>
    </section>
    <!-- end main-content -->


    {{-- codigo de recapcha --}}


    <section>
        <div class="container pb-100">
            <div class="section-content">
                <div class="row">
                    <div class="col-md-8">
                        <span id = "total_productos">0 programas en el carrito.</span>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered tbl-shopping-cart">
                                <thead>
                                    <tr>
                                        <th style="width: 30px;">Imagen</th>
                                        <th>Producto</th>
                                        <th style="width: 135px;">Precio</th>
                                    </tr>
                                </thead>
                                <tbody id="cart">

                                </tbody>
                            </table>
                        </div>
                        <div class="sidebar__single sidebar__post wow fadeInUp animated animated" data-wow-delay="0.2s"
                            style="padding: 15px 25px; visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <h2 class="sidebar__title" style="margin-top: 10px;">
                                <i class="fa fa-heart" aria-hidden="true"></i>&nbsp; TOTAL : &nbsp; <div id="totalid">S/
                                    0.00</div>
                            </h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <h4>Datos del pagador</h4>
                        <div>
                            <div id="cardPaymentBrick_container"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        cargarItemsCarritoBD();

        function cargarItemsCarritoBD() {
            document.getElementById('cart').innerHTML =
                ""; // BORRAR contenido de la vista, antes de cargar de la base de datos
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            myIds = [];
            carrito.forEach(function(item) {
                // Hacer algo con cada elemento del carrito

                myIds.push(parseInt(item.id));
            });

            realizarConsulta(myIds);
        }

        function realizarConsulta(ids) {
            // Realizar la petición Ajax
            var csrfToken = "{{ csrf_token() }}";


            $.ajax({
                url: "{{ route('onlineshop_get_item_carrito') }}",
                type: 'POST',
                data: {
                    ids: ids
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(respuesta) {


                    respuesta.items.forEach(function(item) {
                        // Accede a las propiedades del objeto
                        renderProducto(item);

                    });


                },
                error: function(xhr) {
                    // Ocurrió un error al realizar la consulta
                    console.log(xhr.responseText);
                    // Aquí puedes manejar el error de alguna manera
                }
            });

        }

        function renderProducto(respuesta) {

            var cart = document.getElementById('cart');
            if (cart != null) {
                var id = respuesta.id;
                var teacher = respuesta.teacher;
                var teacher_id = respuesta.teacher_id;
                var avatar = respuesta.avatar;
                var image = respuesta.image;
                var name = respuesta.name;
                var price = respuesta.price;
                var modalidad = respuesta.additional;
                var url_campus = "";
                var url_descripcion_programa = "/descripcion-programa/" +
                    id; // esta ruta deberá corregirse si se cambia el el get de la RUTA :S

                cart.innerHTML += `
                    <tr class="cart_item" id="` + id + `_pc">
                        <td class="product-thumbnail">
                            <a href="#">
                                <img alt="product" src="` + image + `">
                            </a>
                        </td>
                        <td class="product-name">
                            <a href="` + url_descripcion_programa + `" target="_blank">` + name + `</a>
                            <ul class="variation">
                                <li class="variation-size"><b>` + modalidad + `</b></li>
                            </ul>
                        </td>
                        <td class="product-price"><span class="amount"><b>S/ ` + price + `</b></span></td>
                    </tr>
                      `;
            }
        }
    </script>

@stop
@section('javaScripts')
    @if ($preference_id)
        <script>
            const mp = new MercadoPago("{{ env('MERCADOPAGO_KEY') }}", {
                locale: 'es-PE'
            });
            const bricksBuilder = mp.bricks();
            const renderCardPaymentBrick = async (bricksBuilder) => {
                const settings = {
                    initialization: {
                        preferenceId: "{{ $preference_id }}",
                        amount: {{ $price }},
                    },
                    customization: {
                        visual: {
                            style: {
                                customVariables: {
                                    theme: 'bootstrap',
                                }
                            }
                        },
                        paymentMethods: {
                            maxInstallments: 1,
                        }
                    },
                    callbacks: {
                        onReady: () => {
                            // callback llamado cuando Brick esté listo
                        },
                        onSubmit: (cardFormData) => {
                            cardFormData.sale_id = "{{ $sale_id }}";
                            //  callback llamado cuando el usuario haga clic en el botón enviar los datos
                            //  ejemplo de envío de los datos recolectados por el Brick a su servidor
                            return new Promise((resolve, reject) => {
                                fetch("{{ route('web_client_account_process') }}", {
                                        method: "POST",
                                        headers: {
                                            "Content-Type": "application/json",
                                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                        },
                                        body: JSON.stringify(cardFormData)
                                    })
                                    .then((response) => {
                                        if (!response.ok) {
                                            return response.json().then(error => {
                                                throw new Error(error.error);
                                            });
                                        }
                                        return response.json();

                                    })
                                    .then((data) => {
                                        if (data.status == 'approved') {
                                            window.location.href = data.url;
                                        } else {
                                            alert(data.message);
                                            window.location.reload();
                                        }
                                    })
                                    .catch((error) => {
                                        if (error instanceof SyntaxError) {
                                            // Si hay un error de sintaxis al analizar la respuesta JSON
                                            alert('Error al procesar el pago.');
                                        } else {
                                            // Mostrar la alerta con el mensaje de error devuelto por el backend
                                            alert(error.message);
                                        }
                                        window.location.reload();
                                    })
                            });
                        },
                        onError: (error) => {
                            console.log(error)
                        },
                    },
                };
                window.cardPaymentBrickController = await bricksBuilder.create('cardPayment',
                    'cardPaymentBrick_container', settings);
            };
            renderCardPaymentBrick(bricksBuilder);
        </script>
    @endif
@stop

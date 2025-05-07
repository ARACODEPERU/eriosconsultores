@extends('layouts.webpage')

@section('content')

	<!-- Start main-content -->
	<section class="page-title" style="background-image: url(images/background/page-title.jpg);">
		<div class="auto-container">
			<div class="title-outer">
				<h1 class="title">Contactanos</h1>
				<ul class="page-breadcrumb">
					<li><a href="">Home</a></li>
					<li>Contactanos</li>
				</ul>
			</div>
		</div>
	</section>
	<!-- end main-content -->
	<!--Contact Details Start-->
	<section class="contact-details">
		<div class="container ">
			<div class="row">
				<div class="col-xl-7 col-lg-6">
					<div class="sec-title">
						<span class="sub-title">Envíanos un correo electrónico</span>
						<h2>Siéntete libre de escribir</h2>
					</div>
					<!-- Contact Form -->
					<form id="contact_form" name="contact_form" class="" action="includes/sendmail.php" method="post">
						<div class="row">
							<div class="col-sm-12">
								<div class="mb-3">
									<input name="form_name" class="form-control" type="text" placeholder="Nombre completo">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-6">
								<div class="mb-3">
									<input name="form_email" class="form-control required email" type="email" placeholder="Correo electronico">
								</div>
							</div>
							<div class="col-sm-6">
								<div class="mb-3">
									<input name="form_phone" class="form-control" type="text" placeholder="Teléfono">
								</div>
							</div>
						</div>
						<div class="mb-3">
							<textarea name="form_message" class="form-control required" rows="7" placeholder="Mensaje"></textarea>
						</div>
						<div class="mb-3">
							<input name="form_botcheck" class="form-control" type="hidden" value="" />
							<button type="submit" class="theme-btn btn-style-one" data-loading-text="Please wait..."><span class="btn-title">Enviar mensaje</span></button>
							{{-- <button type="reset" class="theme-btn btn-style-one bg-theme-color5"><span class="btn-title">Reset</span></button> --}}
						</div>
					</form>
					<!-- Contact Form Validation-->
				</div>
				<div class="col-xl-5 col-lg-6">
					<div class="contact-details__right">
						<div class="sec-title">
							<span class="sub-title">¿Necesitas ayuda?</span>
							<h2>Ponte en contacto con nosotros</h2>
							<div class="text">
								Texto corto que invite a comunicarse con la institución
							</div>
						</div>
						<ul class="list-unstyled contact-details__info">
							<li>
								<div class="icon">
									<span class="lnr-icon-phone-plus"></span>
								</div>
								<div class="text">
									<h6>¿Tienes alguna pregunta?</h6>
									<a href="tel:980089850">+51 977627207</a>
								</div>
							</li>
							<li>
								<div class="icon">
									<span class="lnr-icon-envelope1"></span>
								</div>
								<div class="text">
									<h6>Escribenos</h6>
									<a href="">
                                        correo@dominio.com
                                    </a>
								</div>
							</li>
							<li>
								<div class="icon">
									<span class="lnr-icon-location"></span>
								</div>
								<div class="text">
									<h6>Visitanos</h6>
									<span>Dirección de la oficina principal</span>
								</div>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Contact Details End-->

	<!-- Divider: Google Map -->
	<section>
		<div class="container-fluid p-0">
			<div class="row">
				<!-- Google Map HTML Codes -->
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.843149788316!2d144.9537131159042!3d-37.81714274201087!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad65d4c2b349649%3A0xb6899234e561db11!2sEnvato!5e0!3m2!1sbn!2sbd!4v1583760510840!5m2!1sbn!2sbd" data-tm-width="100%" height="500" frameborder="0" allowfullscreen=""></iframe>
			</div>
		</div>
	</section>

@stop
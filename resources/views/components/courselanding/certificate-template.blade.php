<section class="erc-cl-sec erc-cl-sec--soft erc-cl-cert">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5" data-reveal>
                <div class="erc-cl-cert__text">
                    <span class="erc-sec-eyebrow erc-cl-cert__eyebrow">
                        <i class="fa fa-certificate" aria-hidden="true"></i>
                        Certificación
                    </span>

                    <h2>Certifica tu conocimiento y eleva tu perfil profesional</h2>

                    <p>
                        Al completar el programa recibes un certificado digital verificable de
                        ERIOS CONSULTORES que respalda tus competencias y fortalece tu
                        posicionamiento frente a empleadores, clientes y equipos de trabajo.
                    </p>

                    <ul class="erc-checklist erc-cl-cert__list">
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i> Emitido a tu nombre y con código de verificación.</li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i> Descarga en PDF lista para adjuntar en tu CV o LinkedIn.</li>
                        <li><i class="fa fa-check-circle" aria-hidden="true"></i> Respaldado por la plana docente del programa.</li>
                    </ul>
                </div>
            </div>

            <div class="col-lg-6 offset-lg-1" data-reveal data-reveal-delay="120">
                <div class="erc-cl-cert__media">
                    <img src="{{ asset('themes/webpage/images/certificado.jpg') }}"
                        alt="Certificado de ERIOS CONSULTORES" loading="lazy"
                        class="erc-media erc-cl-cert__img">
                    <span class="erc-cl-cert__note">* Imagen referencial</span>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* ============ ERIOS · Landing de curso · Certificado ============ */
        .erc-cl-cert__eyebrow { margin-bottom: 10px; }
        .erc-cl-cert__text h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 32px;
            font-weight: 700;
            line-height: 1.28;
            color: var(--erc-ink);
            margin: 0 0 16px;
        }
        .erc-cl-cert__text p {
            font-family: 'Roboto', sans-serif;
            font-size: 15.5px;
            line-height: 27px;
            color: var(--erc-text);
            margin: 0 0 22px;
        }
        .erc-cl-cert__list li { font-size: 15px; }

        .erc-cl-cert__media { position: relative; padding: 0 20px 20px 0; }
        .erc-cl-cert__img { position: relative; z-index: 1; border: 9px solid #fff; }
        /* Marco amarillo decorativo, mismo recurso que la home.
           Va debajo de la imagen pero por delante del fondo de la banda (z-index: 0). */
        .erc-cl-cert__media::after {
            content: '';
            position: absolute;
            right: 0;
            bottom: 0;
            width: 46%;
            height: 46%;
            border: 3px solid var(--erc-yellow);
            border-radius: var(--erc-radius);
            z-index: 0;
        }
        .erc-cl-cert__note {
            position: absolute;
            left: 22px;
            bottom: 34px;
            background: #fff;
            color: var(--erc-muted);
            font-size: 12.5px;
            font-weight: 600;
            padding: 7px 14px;
            border-radius: 50px;
            box-shadow: 0 8px 20px rgba(14, 23, 38, 0.12);
        }

        @media (max-width: 991px) {
            .erc-cl-cert__text { margin-bottom: 30px; }
            .erc-cl-cert__media { padding: 0 14px 14px 0; }
        }
        @media (max-width: 575px) {
            .erc-cl-cert__text h2 { font-size: 25px; }
            .erc-cl-cert__note { left: 18px; bottom: 26px; }
        }
    </style>
</section>

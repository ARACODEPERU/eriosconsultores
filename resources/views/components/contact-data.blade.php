<div>
    <div class="erc-cdata" data-reveal>
        <h3 class="erc-cdata__title">Información de contacto</h3>
        <p class="erc-cdata__sub">Estamos ubicados en Trujillo, atiende cualquier consulta</p>

        <ul class="erc-cdata__list">
            <li>
                <span class="erc-cdata__icon"><i class="fa fa-home" aria-hidden="true"></i></span>
                <div>
                    <h6>Dirección</h6>
                    <p>{{ $contactData[0]->content }}</p>
                </div>
            </li>
            <li>
                <span class="erc-cdata__icon"><i class="fa fa-phone" aria-hidden="true"></i></span>
                <div>
                    <h6>Teléfono</h6>
                    <p>{{ $contactData[1]->content }}</p>
                </div>
            </li>
            <li>
                <span class="erc-cdata__icon"><i class="fa fa-envelope" aria-hidden="true"></i></span>
                <div>
                    <h6>Correo</h6>
                    <p><a href="mailto:{{ $contactData[2]->content }}">{{ $contactData[2]->content }}</a></p>
                </div>
            </li>
        </ul>

        <a class="erc-cdata__wa"
            href="https://wa.link/4bu45u"
            target="_blank" rel="noopener noreferrer">
            <i class="fa fa-whatsapp" aria-hidden="true"></i>
            Escríbenos por WhatsApp
        </a>

        <div class="erc-cdata__map">
            <iframe
                src="https://www.google.com/maps?q=Urbanizaci%C3%B3n%20Los%20Rosales%20de%20Santa%20In%C3%A9s%2C%20Trujillo%2C%20Per%C3%BA&output=embed"
                width="100%" height="230" style="border:0;" allowfullscreen loading="lazy"
                referrerpolicy="no-referrer-when-downgrade" title="Ubicación ERIOS CONSULTORES"></iframe>
        </div>
    </div>

    <style>
        /* ============ ERIOS · Datos de contacto (autocontenido) ============ */
        .erc-cdata {
            background: linear-gradient(160deg, #051d38 0%, #07294d 55%, #0b3a6b 100%);
            border-radius: 16px;
            padding: 34px 30px;
            box-shadow: 0 14px 40px rgba(7, 41, 77, 0.25);
            position: relative;
            overflow: hidden;
            font-family: 'Montserrat', sans-serif;
        }
        .erc-cdata::before {
            content: '';
            position: absolute;
            width: 240px;
            height: 240px;
            border-radius: 50%;
            border: 2px solid rgba(255, 198, 0, 0.14);
            top: -90px;
            right: -70px;
            pointer-events: none;
        }
        .erc-cdata__title {
            position: relative;
            color: #fff;
            font-size: 21px;
            font-weight: 700;
            margin: 0 0 6px;
        }
        .erc-cdata__sub {
            position: relative;
            color: rgba(255, 255, 255, 0.65);
            font-size: 13.5px;
            line-height: 22px;
            margin: 0 0 24px;
        }
        .erc-cdata__list {
            list-style: none;
            margin: 0 0 26px;
            padding: 0;
            position: relative;
        }
        .erc-cdata__list li {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 14px 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .erc-cdata__list li:last-child { border-bottom: 0; }
        .erc-cdata__icon {
            flex: none;
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: rgba(255, 198, 0, 0.14);
            color: #ffc600;
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all .35s ease;
        }
        .erc-cdata__list li:hover .erc-cdata__icon {
            background: #ffc600;
            color: #07294d;
            transform: rotate(-6deg);
        }
        .erc-cdata__list h6 {
            color: #ffc600;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            margin: 2px 0 4px;
        }
        .erc-cdata__list p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 14px;
            line-height: 22px;
            margin: 0;
        }
        .erc-cdata__list a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            transition: color .3s ease;
        }
        .erc-cdata__list a:hover { color: #ffc600; text-decoration: none; }

        .erc-cdata__wa {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: #25D366;
            color: #fff;
            font-weight: 700;
            font-size: 14.5px;
            padding: 14px 20px;
            border-radius: 50px;
            text-decoration: none;
            transition: all .35s ease;
            box-shadow: 0 10px 24px rgba(37, 211, 102, 0.3);
        }
        .erc-cdata__wa i { font-size: 19px; }
        .erc-cdata__wa:hover {
            background: #fff;
            color: #1ebe5a;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 12px 28px rgba(255, 255, 255, 0.18);
        }

        .erc-cdata__map {
            position: relative;
            margin-top: 22px;
            border-radius: 12px;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.15);
            line-height: 0;
        }
        .erc-cdata__map iframe { display: block; }
    </style>
</div>

{{--
    Sistema de diseno ERIOS para las landings de curso.

    Es el mismo lenguaje visual de pages/home.blade.php (azul #004aad, amarillo
    #ffc600, navy #07294d, bandas navy, tarjetas, eyebrows con barras amarillas)
    pero centralizado: las secciones de resources/views/components/courselanding/
    solo agregan su CSS especifico.

    Se incluye una sola vez por pagina, dentro de @section('page_styles'):
        <x-courselanding.styles />
--}}
<style>
    /* ============================================================
       ERIOS · Landing de curso · tokens
       ============================================================ */
    .erc-cl {
        --erc-blue: #004aad;
        --erc-blue-mid: #0e4a8f;
        --erc-blue-soft: #4a86e8;
        --erc-yellow: #ffc600;
        --erc-yellow-dark: #b58100;
        --erc-navy: #07294d;
        --erc-ink: #1d2025;
        --erc-text: #505050;
        --erc-muted: #6b7280;
        --erc-line: #eceff5;
        --erc-soft: #f6f9fd;
        --erc-chip: #eaf1ff;
        --erc-green: #00ab55;
        --erc-wa: #25d366;
        --erc-radius: 16px;
        --erc-shadow: 0 8px 26px rgba(14, 23, 38, 0.05);
        --erc-shadow-hover: 0 18px 40px rgba(0, 74, 173, 0.14);
        color: var(--erc-ink);
    }

    /* ---- Ritmo de bandas ---- */
    .erc-cl-sec {
        position: relative;
        padding: 90px 0;
    }
    .erc-cl-sec--soft { background: var(--erc-soft); }
    .erc-cl-sec--white { background: #fff; }
    .erc-cl-sec--dark {
        background: linear-gradient(135deg, var(--erc-navy) 0%, #0b3a6b 60%, var(--erc-blue-mid) 100%);
        color: #fff;
        padding: 84px 0 92px;
        overflow: hidden;
    }
    .erc-cl-sec--dark::before,
    .erc-cl-sec--dark::after {
        content: '';
        position: absolute;
        border-radius: 50%;
        border: 2px solid rgba(255, 198, 0, 0.12);
        pointer-events: none;
    }
    .erc-cl-sec--dark::before { width: 320px; height: 320px; top: -120px; right: -80px; }
    .erc-cl-sec--dark::after { width: 420px; height: 420px; bottom: -180px; left: -120px; }
    .erc-cl-sec--dark .container { position: relative; z-index: 1; }
    /* Bandas que rematan contra la siguiente seccion sin dejar un hueco grande */
    .erc-cl-sec--tight { padding-bottom: 40px; }
    .erc-cl-sec--top-tight { padding-top: 40px; }

    /* ---- Cabecera de seccion (identica a la home) ---- */
    .erc-sec-head {
        text-align: center;
        max-width: 760px;
        margin: 0 auto 46px;
        padding: 0 15px;
    }
    .erc-sec-head--left { text-align: left; margin-left: 0; padding: 0; }
    .erc-sec-eyebrow {
        display: inline-block;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: var(--erc-blue);
        position: relative;
        padding-bottom: 12px;
        margin-bottom: 12px;
    }
    .erc-sec-eyebrow i { margin-right: 7px; }
    .erc-sec-eyebrow::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 35px;
        height: 2px;
        background: var(--erc-yellow);
    }
    .erc-sec-head:not(.erc-sec-head--left) .erc-sec-eyebrow::before {
        left: 50%;
        transform: translateX(calc(-100% - 8px));
    }
    .erc-sec-head:not(.erc-sec-head--left) .erc-sec-eyebrow::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(8px);
        width: 35px;
        height: 2px;
        background: var(--erc-yellow);
    }
    .erc-sec-head h2 {
        font-family: 'Montserrat', sans-serif;
        font-size: 36px;
        font-weight: 700;
        color: var(--erc-ink);
        line-height: 1.28;
        margin: 0 0 14px;
    }
    .erc-sec-head p {
        font-size: 16px;
        line-height: 28px;
        color: var(--erc-text);
        margin: 0;
    }
    .erc-sec-head--dark h2 { color: #fff; }
    .erc-sec-head--dark p { color: rgba(255, 255, 255, 0.78); }
    .erc-sec-head--dark .erc-sec-eyebrow { color: var(--erc-yellow); }

    /* ---- Botones ---- */
    .erc-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14.5px;
        padding: 13px 28px;
        border-radius: 5px;
        border: 2px solid transparent;
        text-decoration: none;
        cursor: pointer;
        transition: all .35s ease;
    }
    .erc-btn:hover { text-decoration: none; transform: translateY(-2px); }
    .erc-btn--yellow { background: var(--erc-yellow); color: var(--erc-navy); box-shadow: 0 10px 26px rgba(255, 198, 0, 0.35); }
    .erc-btn--yellow:hover { background: var(--erc-blue); color: var(--erc-yellow); }
    .erc-btn--blue { background: var(--erc-blue); color: #fff; }
    .erc-btn--blue:hover { background: var(--erc-navy); color: #fff; }
    .erc-btn--ghost { border-color: rgba(255, 255, 255, 0.55); color: #fff; }
    .erc-btn--ghost:hover { background: var(--erc-yellow); border-color: var(--erc-yellow); color: var(--erc-navy); }
    .erc-btn--outline { border-color: var(--erc-blue); color: var(--erc-blue); background: #fff; }
    .erc-btn--outline:hover { background: var(--erc-blue); color: #fff; }
    .erc-btn--outline-dark { border-color: rgba(255, 255, 255, 0.35); color: #fff; background: transparent; }
    .erc-btn--outline-dark:hover { background: #fff; color: var(--erc-navy); }
    .erc-btn--wa { background: var(--erc-wa); color: #063a2a; box-shadow: 0 10px 24px rgba(37, 211, 102, 0.28); }
    .erc-btn--wa:hover { background: #063a2a; color: var(--erc-wa); }
    .erc-btn--block { width: 100%; }
    .erc-btn--lg { padding: 16px 42px; font-size: 15.5px; }
    .erc-btn[disabled] { opacity: .6; cursor: not-allowed; transform: none; }

    /* ---- Tarjetas ---- */
    .erc-card {
        height: 100%;
        background: #fff;
        border: 1px solid var(--erc-line);
        border-radius: var(--erc-radius);
        padding: 30px 28px;
        box-shadow: var(--erc-shadow);
        transition: transform .35s ease, box-shadow .35s ease, border-color .35s ease;
    }
    .erc-card:hover {
        transform: translateY(-6px);
        border-color: rgba(255, 198, 0, 0.6);
        box-shadow: var(--erc-shadow-hover);
    }
    .erc-card h3 {
        font-family: 'Montserrat', sans-serif;
        font-size: 18px;
        font-weight: 700;
        color: var(--erc-ink);
        margin: 0 0 10px;
    }
    .erc-card p { font-size: 14.5px; line-height: 25px; color: var(--erc-muted); margin: 0; }

    .erc-card--dark {
        background: rgba(255, 255, 255, 0.05);
        border-color: rgba(255, 255, 255, 0.1);
        box-shadow: none;
    }
    .erc-card--dark:hover {
        background: rgba(255, 255, 255, 0.09);
        border-color: rgba(255, 198, 0, 0.45);
        box-shadow: none;
    }
    .erc-card--dark h3 { color: #fff; }
    .erc-card--dark p { color: rgba(255, 255, 255, 0.72); }

    /* ---- Chips de icono ---- */
    .erc-chip-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 52px;
        height: 52px;
        border-radius: 14px;
        background: var(--erc-chip);
        color: var(--erc-blue);
        font-size: 20px;
        transition: all .35s ease;
    }
    .erc-card:hover .erc-chip-icon { background: var(--erc-blue); color: var(--erc-yellow); }
    .erc-chip-icon--dark { background: rgba(255, 198, 0, 0.14); color: var(--erc-yellow); }
    .erc-card--dark:hover .erc-chip-icon--dark { background: var(--erc-yellow); color: var(--erc-navy); }
    .erc-chip-icon--lg { width: 68px; height: 68px; border-radius: 20px; font-size: 26px; }

    /* ---- Numeros fantasma (como las tarjetas de la home) ---- */
    .erc-ghost-num {
        font-family: 'Montserrat', sans-serif;
        font-size: 42px;
        font-weight: 700;
        line-height: 1;
        color: #eef2f9;
        user-select: none;
    }
    .erc-cl-sec--dark .erc-ghost-num { color: rgba(255, 255, 255, 0.14); }

    /* ---- Pills y listas ---- */
    .erc-pill {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--erc-chip);
        color: var(--erc-navy);
        font-size: 13px;
        padding: 8px 15px;
        border-radius: 50px;
    }
    .erc-pill i { color: var(--erc-blue); }
    .erc-pill--dark {
        background: rgba(255, 255, 255, 0.08);
        border: 1px solid rgba(255, 255, 255, 0.18);
        color: rgba(255, 255, 255, 0.9);
    }
    .erc-pill--dark i { color: var(--erc-yellow); }

    .erc-checklist { list-style: none; margin: 0; padding: 0; }
    .erc-checklist li {
        display: flex;
        align-items: flex-start;
        gap: 11px;
        font-size: 14.5px;
        line-height: 25px;
        color: var(--erc-text);
        margin-bottom: 12px;
    }
    .erc-checklist li:last-child { margin-bottom: 0; }
    .erc-checklist li i { color: var(--erc-blue); margin-top: 5px; }
    .erc-cl-sec--dark .erc-checklist li { color: rgba(255, 255, 255, 0.85); }
    .erc-cl-sec--dark .erc-checklist li i { color: var(--erc-yellow); }

    /* ---- Utilidades ---- */
    .erc-muted { color: var(--erc-muted); }
    .erc-cl-sec--dark .erc-muted { color: rgba(255, 255, 255, 0.7); }
    .erc-media {
        width: 100%;
        display: block;
        border-radius: var(--erc-radius);
        box-shadow: 0 16px 40px rgba(14, 23, 38, 0.1);
    }
    .erc-media--fallback {
        object-fit: contain;
        padding: 34px;
        background: linear-gradient(135deg, var(--erc-navy), var(--erc-blue-mid));
    }
    .erc-cl-ratio { position: relative; padding-top: 56.25%; border-radius: var(--erc-radius); overflow: hidden; }
    .erc-cl-ratio iframe { position: absolute; inset: 0; width: 100%; height: 100%; border: 0; }

    /* ---- Aviso de landing sin datos ---- */
    .erc-cl-empty {
        max-width: 620px;
        margin: 90px auto;
        padding: 34px 30px;
        text-align: center;
        background: #fff;
        border: 1px solid var(--erc-line);
        border-left: 5px solid var(--erc-yellow);
        border-radius: var(--erc-radius);
        box-shadow: var(--erc-shadow);
    }
    .erc-cl-empty h2 {
        font-family: 'Montserrat', sans-serif;
        font-size: 22px;
        font-weight: 700;
        color: var(--erc-ink);
        margin: 0 0 12px;
    }
    .erc-cl-empty p { font-size: 15px; line-height: 26px; color: var(--erc-text); margin: 0; }

    @media (max-width: 991px) {
        .erc-cl-sec { padding: 64px 0; }
        .erc-cl-sec--dark { padding: 60px 0 68px; }
        .erc-cl-sec--tight { padding-bottom: 30px; }
    }
    @media (max-width: 767px) {
        .erc-sec-head { margin-bottom: 32px; }
        .erc-card { padding: 26px 22px; }
    }
    @media (max-width: 575px) {
        .erc-cl-sec { padding: 52px 0; }
        .erc-sec-head h2 { font-size: 26px; }
        .erc-sec-head p { font-size: 15px; line-height: 26px; }
        .erc-btn { padding: 12px 22px; font-size: 14px; }
    }
</style>

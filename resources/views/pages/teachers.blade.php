@extends('layouts.webpage')

@section('meta_title', 'Docentes')
@section('meta_description', 'Conoce al equipo de docentes de ERIOS CONSULTORES: especialistas en tributación, auditoría y gestión fiscal con amplia trayectoria profesional y académica.')

@section('page_styles')
<style>
    .erc-teachers-hero {
        background: linear-gradient(135deg, #07294d 0%, #0b3a6b 60%, #0e4a8f 100%);
        padding: 70px 0 78px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .erc-teachers-hero::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        border-radius: 50%;
        border: 2px solid rgba(255, 198, 0, 0.15);
        top: -110px;
        right: -70px;
    }
    .erc-teachers-hero::after {
        content: '';
        position: absolute;
        width: 380px;
        height: 380px;
        border-radius: 50%;
        border: 2px solid rgba(255, 198, 0, 0.12);
        bottom: -170px;
        left: -110px;
    }
    .erc-teachers-hero .container { position: relative; z-index: 1; }
    .erc-teachers-hero__eyebrow {
        display: inline-block;
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        font-size: 14px;
        letter-spacing: 2.5px;
        text-transform: uppercase;
        color: #ffc600;
        position: relative;
        padding-bottom: 12px;
        margin-bottom: 12px;
    }
    .erc-teachers-hero__eyebrow::before,
    .erc-teachers-hero__eyebrow::after {
        content: '';
        position: absolute;
        bottom: 0;
        width: 35px;
        height: 2px;
        background: #ffc600;
    }
    .erc-teachers-hero__eyebrow::before { left: 50%; transform: translateX(calc(-100% - 8px)); }
    .erc-teachers-hero__eyebrow::after { left: 50%; transform: translateX(8px); }
    .erc-teachers-hero h1 {
        color: #fff;
        font-size: 40px;
        font-weight: 700;
        margin: 0 0 12px;
    }
    .erc-teachers-hero p {
        color: rgba(255, 255, 255, 0.78);
        font-size: 16px;
        line-height: 28px;
        max-width: 640px;
        margin: 0 auto;
    }
</style>
@endsection

@section('content')

    {{-- ======== Hero de la página ======== --}}
    <section class="erc-teachers-hero">
        <div class="container">
            <span class="erc-teachers-hero__eyebrow">Equipo ERIOS</span>
            <h1>Nuestros Docentes</h1>
            <p>Especialistas en tributación, auditoría y gestión fiscal, con trayectoria profesional en el sector público y privado, dedicados a formar a los próximos profesionales.</p>
        </div>
    </section>

    {{-- ======== Listado completo de docentes ======== --}}
    <x-teachers :limit="999" />

@endsection

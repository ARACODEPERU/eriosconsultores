@extends('layouts.webpage')

@section('meta_title', 'Docentes')
@section('meta_description', 'Conoce al equipo de docentes de ERIOS CONSULTORES: especialistas en tributación, auditoría y gestión fiscal con amplia trayectoria profesional y académica.')

@section('content')

    {{-- ======== Hero de la página ======== --}}
    <x-page-hero eyebrow="Equipo ERIOS" title="Nuestros Docentes"
        subtitle="Especialistas en tributación, auditoría y gestión fiscal, con trayectoria profesional en el sector público y privado, dedicados a formar a los próximos profesionales." />

    {{-- ======== Listado completo de docentes ======== --}}
    <x-teachers :limit="999" />

@endsection

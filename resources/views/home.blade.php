@extends('layouts.main')

@section('title')
    <title>Seja bem vindo</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="home">
        <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="5000">
                    <img src="{{ asset(path: 'assets/images/home_1.svg') }}" class="carousel-img img-pc" alt="...">
                    <img src="{{ asset(path: 'assets/images/home_1_mobile.svg') }}" class="carousel-img img-mobile" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                    <img src="{{ asset(path: 'assets/images/home_2.svg') }}" class="carousel-img img-pc" alt="...">
                    <img src="{{ asset(path: 'assets/images/home_2_mobile.svg') }}" class="carousel-img img-mobile" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="5000">
                    <img src="{{ asset('assets/images/home_3.svg') }}" class="carousel-img img-pc" alt="...">
                    <img src="{{ asset('assets/images/home_3_mobile.svg') }}" class="carousel-img img-mobile" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="prev">
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
                data-bs-slide="next">
            </button>
        </div>

         <p class="activies">Nossas atividades</p>
        <div class="cards">
            <div class="card cults">
                <p class="emoji">⛪</p>
                <p class="titulo">Cultos</p>
                <p class="corpo">Venha viver momentos de fé e comunhão conosco! Nossos cultos são ocasiões especiais para adorar, refletir e fortalecer os laços com Deus e com a comunidade.  </p>
                <a href="{{ route('events') }}"><button class="botao">Ver horários</button></a>
            </div>
            <div class="card projects">
                <p class="emoji">👩🏽‍🏫</p>
                <p class="titulo">Projetos</p>
                <p class="corpo">Estamos sempre trabalhando em novos projetos para fortalecer nossa comunidade e promover o bem-estar de todos. Queremos que você esteja a par de todas as iniciativas e participe ativamente.</p>
                <a href="{{ route('projects') }}"><button class="botao">Conhecer projetos</button></a>
            </div>
            <div class="card meetings">
                <p class="emoji">🫂</p>
                <p class="titulo">Reuniões</p>
                <p class="corpo">Nossas reuniões são momentos preciosos de união e crescimento espiritual. Venha compartilhar experiências, aprender e fortalecer sua fé em um ambiente acolhedor e fraterno.</p>
                <a href="{{ route('events') }}"><button class="botao">Participar</button></a>
            </div>
        </div>
    </section>

    @include('layouts.footer')
@endsection

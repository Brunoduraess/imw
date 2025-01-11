@extends('layouts.main')

@section('title')
    <title>Seja bem vindo</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="container home">
        <div class="show-img">
            <img src="{{ asset('assets/images/home.jpg') }}" alt="">
        </div>
        <p class="activies">Nossas atividades</p>
        <div class="cards">
            <div class="card cults">
                <p class="titulo">Cultos</p>
                <p class="corpo">Fique por dentro dos nossos eventos. Aqui, você encontra todas as informações sobre os
                    eventos e atividades que preparamos com muito carinho e dedicação para nossa comunidade. </p>
                <a href="{{ route('events') }}"><button class="botao"> Saiba mais</button></a>
            </div>
            <div class="card projects">
                <p class="titulo">Projetos</p>
                <p class="corpo">Fique por dentro dos nossos eventos. Aqui, você encontra todas as informações sobre os
                    eventos e atividades que preparamos com muito carinho e dedicação para nossa comunidade. </p>
                <a href="{{ route('projects') }}"><button class="botao"> Saiba mais</button></a>
            </div>
            <div class="card meetings">
                <p class="titulo">Reuniões</p>
                <p class="corpo">Fique por dentro dos nossos eventos. Aqui, você encontra todas as informações sobre os
                    eventos e atividades que preparamos com muito carinho e dedicação para nossa comunidade. </p>
                <a href="{{ route('events') }}"><button class="botao"> Saiba mais</button></a>
            </div>
        </div>
    </section>
    @include('layouts.footer')
@endsection

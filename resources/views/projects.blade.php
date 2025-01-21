@extends('layouts.main')

@section('title')
    <title>Nossos projetos</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="container projetos">
        <div class="dados-pagina">
            <div class="titulo">
                Projetos
            </div>
            <div class="pagina">
                <a href="{{ route('home') }}">Menu</a> / Nossos Projetos
            </div>
        </div>
        <p class="descricao-pagina">
            Conheça nossos projetos! Aqui, você encontra todas as informações sobre as iniciativas e ações que desenvolvemos
            com amor e propósito, visando impactar vidas e transformar nossa comunidade. Cada projeto é planejado com
            dedicação para refletir nossos valores e levar esperança, apoio e cuidado a quem mais precisa.
        </p>
        <div class="projeto">
            <img src="{{ asset('assets/images/projeto.png') }}" alt="" class="logo-projeto">
            <div class="detalhe-projeto">
                <p class="nome-projeto">Projeto Segunda Chance</p>
                <p class="descricao-projeto">O Projeto Segunda Chance foi criado com a finalidade de oferecer cursos
                    acessíveis à comunidade residente nas proximidades da igreja, bem como aos membros. </p>
                <a href="{{ route('project_detail', ['tipo' => 'educacional']) }}">Ver mais detalhes sobre esse projeto
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                    </svg>
                </a>
            </div>
        </div>
        <div class="projeto">
            <img src="{{ asset('assets/images/projeto_2.png') }}" alt="" class="logo-projeto">
            <div class="detalhe-projeto">
                <p class="nome-projeto">GCEU</p>
                <p class="descricao-projeto"> Inspirados pela visão de construir relacionamentos sólidos e fortalecer a fé,
                    os encontros do GCEU oferecem um espaço acolhedor onde cada pessoa é valorizada e encorajada a viver
                    plenamente o propósito de Deus.

                    Por meio de momentos de estudo da Palavra, oração, louvor e evangelização prática, o GCEU busca não
                    apenas edificar seus participantes, mas também alcançar vidas e impactar a comunidade ao nosso redor.
                    Juntos, cultivamos unidade, apoio mútuo e uma fé que transforma corações e gera frutos para o Reino.
                </p>
                <a href="{{ route('project_detail', ['tipo' => 'externo']) }}">Ver mais detalhes sobre esse projeto
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-arrow-right-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M4 8a.5.5 0 0 1 .5-.5h5.793L8.146 5.354a.5.5 0 1 1 .708-.708l3 3a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708-.708L10.293 8.5H4.5A.5.5 0 0 1 4 8" />
                    </svg>
                </a>
            </div>
        </div>
    </section>

    @include('layouts.footer')
@endsection

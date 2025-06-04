@extends('layouts.main')

@section('title')
    <title>{{ $evento->nome }}</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="detalhe_evento">
        <div class="dados-pagina">
            <div class="titulo">
                <a href="{{ route('events') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                    </svg>
                    Voltar para a agenda
                </a>
            </div>
            <div class="pagina">
                <a href="{{ route('home') }}">Menu</a> / <a href="{{ route('events') }}">Agenda </a> / {{ $evento->nome }}
            </div>
        </div>
        <img class="banner" src="{{ asset('storage/' . $evento->imagem_detalhe . '') }}" alt="">
        <p class="nome_evento">{{ $evento->nome }}</p>
        <p class="horario_evento">{{ $evento->data }}, {{ $evento->horario }} horas.</p>
        <p class="descricao_evento">{{ $evento->descricao }}
        <p>
        <div class="local_evento">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-geo-fill"
                viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411" />
            </svg>
            <p>{{ $local->rua . ', ' . $local->numero . ', ' . $local->bairro . ', ' . $local->cidade . '.' }}</p>
        </div>
        @if ($evento->inscricao)
            <div class="valor_evento">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cash"
                    viewBox="0 0 16 16">
                    <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                    <path
                        d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
                </svg>
                <p>Inscrição: R$ {{ $evento->inscricao }}.</p>
            </div>
        @endif

    </section>

    @include('layouts.footer')
@endsection

@extends('layouts.main')

@section('title')
    <title>Agenda da igreja</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="agenda">
        <div class="dados-pagina">
            <div class="titulo">
                Agenda
            </div>
            <div class="pagina">
                <a href="{{ route('home') }}">Menu</a> / Agenda
            </div>
        </div>
        <p class="descricao-pagina">
            Fique por dentro dos nossos eventos. Aqui, você encontra todas as informações sobre os eventos e atividades que
            preparamos com muito carinho e dedicação para nossa comunidade.
        </p>
        <p class="periodo">Nessa semana</p>
        <section class="eventos">
            @foreach ($eventosSemanaAtual as $eventoSemanaAtual)
                <a href="{{ route('event_detail', ['id' => $eventoSemanaAtual->id]) }}" class="card-evento">
                    <div>
                        <img src="{{ asset('storage/' . $eventoSemanaAtual->imagem_agenda . '') }}" alt="">
                        <p class="titulo-evento">{{ $eventoSemanaAtual->nome }}</p>
                        <p class="data-evento">{{ $eventoSemanaAtual->data }}, {{ $eventoSemanaAtual->horario }} horas.</p>
                    </div>
                </a>
            @endforeach
        </section>
        <p class="periodo">Próximas semanas</p>
        <section class="eventos">
            @foreach ($eventosProximaSemana as $eventoProximaSemana)
                <a href="{{ route('event_detail', ['id' => $eventoProximaSemana->id]) }}" class="card-evento">
                    <div>
                        <img src="{{ asset('storage/' . $eventoProximaSemana->imagem_agenda . '') }}" alt="">
                        <p class="titulo-evento">{{ $eventoProximaSemana->nome }}</p>
                        <p class="data-evento">{{ $eventoProximaSemana->data }}, {{ $eventoProximaSemana->horario }} horas.
                        </p>
                    </div>
                </a>
            @endforeach
        </section>
        @if (count($eventosProximoMes) > 0)
            <p class="periodo">Próximos meses</p>
            <section class="eventos">
                @foreach ($eventosProximoMes as $eventoProximoMes)
                    <a href="{{ route('event_detail', ['id' => $eventoProximoMes->id]) }}" class="card-evento">
                        <div>
                            <img src="{{ asset('storage/' . $eventoProximoMes->imagem_agenda . '') }}" alt="">
                            <p class="titulo-evento">{{ $eventoProximoMes->nome }}</p>
                            <p class="data-evento">{{ $eventoProximoMes->data }}, {{ $eventoProximoMes->horario }} horas.
                            </p>
                        </div>
                    </a>
                @endforeach
            </section>
        @endif
    </section>

    @include('layouts.footer')
@endsection

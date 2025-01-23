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
            <a href="{{ route('event_detail') }}" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento.png') }}" alt="">
                    <p class="titulo-evento">Culto da Rede Move</p>
                    <p class="data-evento">08 de junho, 18:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_2.png') }}" alt="">
                    <p class="titulo-evento">Culto de Mulheres</p>
                    <p class="data-evento">08 de dezembro, 19:30 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
        </section>
        <p class="periodo">Próximas semanas</p>
        <section class="eventos">
            <a href="{{ route('event_detail') }}" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento.png') }}" alt="">
                    <p class="titulo-evento">Culto da Rede Move</p>
                    <p class="data-evento">08 de junho, 18:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_2.png') }}" alt="">
                    <p class="titulo-evento">Culto de Mulheres</p>
                    <p class="data-evento">08 de dezembro, 19:30 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
        </section>
        <p class="periodo">Próximos meses</p>
        <section class="eventos">
            <a href="{{ route('event_detail') }}" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento.png') }}" alt="">
                    <p class="titulo-evento">Culto da Rede Move</p>
                    <p class="data-evento">08 de junho, 18:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_2.png') }}" alt="">
                    <p class="titulo-evento">Culto de Mulheres</p>
                    <p class="data-evento">08 de dezembro, 19:30 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
            <a href="" class="card-evento">
                <div>
                    <img src="{{ asset('assets/images/evento_3.png') }}" alt="">
                    <p class="titulo-evento">Culto de adoração</p>
                    <p class="data-evento">19 de janeiro, 19:00 horas.</p>
                </div>
            </a>
        </section>
    </section>

    @include('layouts.footer')
@endsection

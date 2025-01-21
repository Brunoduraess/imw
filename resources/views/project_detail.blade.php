@extends('layouts.main')

@section('title')
    <title>{{ $nome }}</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="detalhe_projeto">
        <div class="dados-pagina">
            <div class="titulo">
                <a href="{{ route('projects') }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                        class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                        <path fill-rule="evenodd"
                            d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5" />
                    </svg>
                    Voltar para Nossos Projetos
                </a>
            </div>
            <div class="pagina">
                <a href="{{ route('home') }}">Menu</a> / <a href="{{ route('projects') }}">Nossos Projetos </a> /
                {{ $nome }}
            </div>
        </div>
        <img src="{{ asset('assets/images/detalhe_projeto_' . $img . '.png') }}" alt="" class="logo-projeto">
        <p class="nome-projeto">{{ $nome }}</p>
        <p class="descricao-projeto">{{ $descricao }}</p>
        @if ($tipo == 'educacional')
            <p class="cursos-titulo">Cursos do projeto</p>
            <div class="cursos">
                <div class="curso">
                    <img src="{{ asset('assets/images/logo_curso_1.png') }}" class="logo-curso">
                    <a href=""><button class="interesse-curso">Quero me inscrever no(a) jiu jitsu</button></a>
                </div>
                <div class="curso">
                    <img src="{{ asset('assets/images/logo_curso_2.png') }}" class="logo-curso">
                    <a href=""><button class="interesse-curso">Quero me inscrever no(a) taekwondo</button></a>
                </div>
                <div class="curso">
                    <img src="{{ asset('assets/images/logo_curso_3.png') }}" class="logo-curso">
                    <a href=""><button class="interesse-curso">Quero me inscrever no(a) violão</button></a>
                </div>
                <div class="curso">
                    <img src="{{ asset('assets/images/logo_curso_4.jpg') }}" class="logo-curso">
                    <a href=""><button class="interesse-curso">Quero me inscrever no(a) bateria</button></a>
                </div>
                <div class="curso">
                    <img src="{{ asset('assets/images/logo_curso_5.jpg') }}" class="logo-curso">
                    <a href=""><button class="interesse-curso">Quero me inscrever no(a) canto</button></a>
                </div>
            </div>
            <div class="local_curso">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                    class="bi bi-geo-fill" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411" />
                </svg>
                <p>Rua Miguel da Fonseca Rego, 75, Ponte Alta, Volta Redonda.</p>
            </div>
            <div class="valor_curso">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-cash"
                    viewBox="0 0 16 16">
                    <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4" />
                    <path
                        d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2z" />
                </svg>
                <p><b>Matrícula</b>: R$ 50 / <b>Mensalidade</b>: R$ 50</p>
            </div>
        @else
            <p class="encontrar">Encontre o {{ $nome }} mais perto de você <svg xmlns="http://www.w3.org/2000/svg" width="20"
                    height="20" fill="currentColor" class="bi bi-arrow-down-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4" />
                </svg></p>

            <div class="locais">
                <div class="local">
                    <p class="responsavel">
                        Casa do Pr Fábio
                    </p>
                    <p class="endereco">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-geo-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411" />
                        </svg>
                        Rua das couves, 123, Paraíso, Barra Mansa
                    </p>
                    <a href="">
                        <button class="interesse">Quero participar desse {{ $nome }}</button>
                    </a>
                </div>
                <div class="local">
                    <p class="responsavel">
                        Casa do Pr Fábio
                    </p>
                    <p class="endereco">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-geo-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411" />
                        </svg>
                        Rua das couves, 123, Paraíso, Barra Mansa
                    </p>
                    <a href="">
                        <button class="interesse">Quero participar desse {{ $nome }}</button>
                    </a>
                </div>
                <div class="local">
                    <p class="responsavel">
                        Casa do Pr Fábio
                    </p>
                    <p class="endereco">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-geo-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411" />
                        </svg>
                        Rua das couves, 123, Paraíso, Barra Mansa
                    </p>
                    <a href="">
                        <button class="interesse">Quero participar desse {{ $nome }}</button>
                    </a>
                </div>
                <div class="local">
                    <p class="responsavel">
                        Casa do Pr Fábio
                    </p>
                    <p class="endereco">
                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor"
                            class="bi bi-geo-fill" viewBox="0 0 16 16">
                            <path fill-rule="evenodd"
                                d="M4 4a4 4 0 1 1 4.5 3.969V13.5a.5.5 0 0 1-1 0V7.97A4 4 0 0 1 4 3.999zm2.493 8.574a.5.5 0 0 1-.411.575c-.712.118-1.28.295-1.655.493a1.3 1.3 0 0 0-.37.265.3.3 0 0 0-.057.09V14l.002.008.016.033a.6.6 0 0 0 .145.15c.165.13.435.27.813.395.751.25 1.82.414 3.024.414s2.273-.163 3.024-.414c.378-.126.648-.265.813-.395a.6.6 0 0 0 .146-.15l.015-.033L12 14v-.004a.3.3 0 0 0-.057-.09 1.3 1.3 0 0 0-.37-.264c-.376-.198-.943-.375-1.655-.493a.5.5 0 1 1 .164-.986c.77.127 1.452.328 1.957.594C12.5 13 13 13.4 13 14c0 .426-.26.752-.544.977-.29.228-.68.413-1.116.558-.878.293-2.059.465-3.34.465s-2.462-.172-3.34-.465c-.436-.145-.826-.33-1.116-.558C3.26 14.752 3 14.426 3 14c0-.599.5-1 .961-1.243.505-.266 1.187-.467 1.957-.594a.5.5 0 0 1 .575.411" />
                        </svg>
                        Rua das couves, 123, Paraíso, Barra Mansa
                    </p>
                    <a href="">
                        <button class="interesse">Quero participar desse {{ $nome }}</button>
                    </a>
                </div>
            </div>
        @endif

    </section>

    @include('layouts.footer')
@endsection

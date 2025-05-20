@extends('layouts.main')

@section('title')
    <title>Criar novo evento</title>
@endsection

@section('content')
    @include('admin.navbar')

    <section class="formulario">
        <div class="dados-pagina">
            <div class="titulo">
                Cadastrar novo tipo de evento
            </div>
            <div class="pagina">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('eventsAdmin') }}">Eventos</a><a href="{{ route('eventsType')}}"> / Tipos de evento</a> / Cadastrar novo tipo de evento
            </div>
        </div>
        <form action="{{ route('createEventTypeSubmit') }}" method="post" enctype="multipart/form-data" class="row">
            @csrf
            <div class="form-group col-xl-12">
                <label for="nome">Nome do tipo de evento:</label>
                <input type="text" name="nome" id="nome" class="form-control"
                    placeholder="Informe o nome do tipo de evento" value="{{ old('nome') }}">
                @error('nome')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="4" class="form-control"
                    placeholder="Informe aqui as principais características do tipo de evento">{{ old('descricao') }}</textarea>
                @error('descricao')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="duracao">Duração do evento (em dias):</label>
                <input type="number" name="duracao" id="duracao" class="form-control" placeholder="Informe a duração do evento em dias">
                @error('duracao')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-6">
                <button type="submit" class="btn btn-success">Cadastrar tipo de evento</button>
            </div>
            <div class="form-group col-xl-6">
                <a href="{{ route('eventsType') }}"><button type="button" class="btn btn-danger">Voltar para o menu de
                        tipos de evento</button></a>
            </div>
        </form>
    </section>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#valor').mask('#0,00', {
                reverse: true
            });
        });
    </script>
@endsection

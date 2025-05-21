@extends('layouts.main')

@section('title')
    <title>Criar novo local</title>
@endsection

@section('content')
    @include('admin.navbar')

    <section class="formulario">
        <div class="dados-pagina">
            <div class="titulo">
                Cadastrar novo local
            </div>
            <div class="pagina">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('eventsAdmin') }}">Eventos</a><a
                    href="{{ route('locations') }}"> / Locais</a> / Cadastrar novo local
            </div>
        </div>
        <form action="{{ route('createLocationSubmit') }}" method="post" enctype="multipart/form-data" class="row">
            @csrf
            <div class="form-group col-xl-12">
                <label for="nome">Nome do local:</label>
                <input type="text" name="nome" id="nome" class="form-control"
                    placeholder="Informe o nome do local" value="{{ old('nome') }}">
                @error('nome')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="rua">Rua:</label>
                <input type="text" name="rua" id="rua" class="form-control" placeholder="Informe o nome da rua"
                    value="{{ old('rua') }}">
                @error('rua')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="numero">Número:</label>
                <input type="text" name="numero" id="numero" class="form-control"
                    placeholder="Informe o número do local" value="{{ old('numero') }}">
                @error('numero')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="bairro">Bairro:</label>
                <input type="text" name="bairro" id="bairro" class="form-control"
                    placeholder="Informe o nome do bairro" value="{{ old('bairro') }}">
                @error('bairro')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="cidade">Cidade:</label>
                <select name="cidade" id="cidade" class="form-control">
                    <option value="">-- Selecione a cidade -- </option>
                    @php
                        $cities = ['Barra Mansa', 'Volta Redonda'];
                    @endphp
                    @foreach ($cities as $city)
                        <option value="{{ $city }}" {{ old('cidade') == $city ? 'selected' : '' }}>
                            {{ $city }}</option>
                    @endforeach
                </select>
                @error('cidade')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group col-xl-12">
                <label for="cep">CEP:</label>
                <input type="text" name="cep" id="cep" class="form-control"
                    placeholder="Informe o CEP do local" value="{{ old('cep') }}">
                @error('cep')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="responsavel">Nome do responsável:</label>
                <input type="text" name="responsavel" id="responsavel" class="form-control"
                    placeholder="Informe o nome do responsável" value="{{ old('responsavel') }}">
                @error('responsavel')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="tel_responsavel">Telefone do responsável:</label>
                <input type="text" name="tel_responsavel" id="tel_responsavel" class="form-control"
                    placeholder="Informe o telefone do responsável" value="{{ old('tel_responsavel') }}">
                @error('tel_responsavel')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-6">
                <button type="submit" class="btn btn-success">Cadastrar local</button>
            </div>
            <div class="form-group col-xl-6">
                <a href="{{ route('locations') }}"><button type="button" class="btn btn-danger">Voltar para o menu de
                        locais</button></a>
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
            $('#cep').mask('00000-000');
            $('#tel_responsavel').mask('(00) 00000-0000');
        });
    </script>
@endsection

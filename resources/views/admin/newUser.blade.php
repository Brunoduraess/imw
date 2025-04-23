@extends('layouts.main')

@section('title')
    <title>Cadastrar novo usuário</title>
@endsection
@section('content')
    @include('admin.navbar')
    <section class="formulario">
        <p class="titulo">Cadastrar novo usuario</p>
        <form action="{{ route('createUser') }}" method="post" class="row">
            @csrf
            <div class="form-group col-xl-12">
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" class="form-control"
                    placeholder="Informe o nome completo do usuário" value="{{ old('nome') }}">
                @error('nome')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="cpf">CPF:</label>
                <input type="text" name="cpf" id="cpf" class="form-control"
                    placeholder="Informe o CPF do usuário" value="{{ old('cpf') }}">
                @error('cpf')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" class="form-control"
                    placeholder="Informe o email pessoal do usuário" value="{{ old('email') }}">
                @error('email')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="acesso">Nível de acesso:</label>
                <select name="acesso" id="acesso" class="form-control">
                    <option value=""> -- Selecione uma opção --</option>
                    <option>Administrador</option>
                </select>
                @error('acesso')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12"></div>
            <div class="form-group col-xl-6">
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
            <div class="form-group col-xl-6">
                <a href="{{ route('users') }}" class="btn btn-danger">Voltar para o menu</a>
            </div>
        </form>
    </section>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#cpf').mask('000.000.000-00');
        });
    </script>
@endsection

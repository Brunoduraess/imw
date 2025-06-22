@extends('layouts.main')

@section('title')
    <title>Login - Administração</title>
@endsection

@section('content')
    <section class="login">
        <div class="descricao">
            <img src="{{ asset('assets/images/logo.svg') }}" alt="Logo da igreja">
            <p class="titulo">Cadastrar nova senha</p>
        </div>

        <form action="{{ route('forgot_password_submit') }}" id="form" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Informe o seu email:</label>
                <input type="text" class="form-control" id="email" name="email" placeholder="Informe o seu email"
                    value="{{ old('email') }}">
            </div>
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            @if (session('error'))
                <p class="text-danger">
                    {{ session('error') }}
                </p>
            @endif
            <button type="submit" class="btn btn-success">Continuar para cadastro de nova senha...</button>
        </form>
    </section>
@endsection

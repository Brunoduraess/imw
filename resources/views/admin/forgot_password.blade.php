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
            {{-- <div class="mb-3 senha">
                <label for="senha" class="form-label">Nova senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Informe a nova senha"
                    value="{{ old('senha') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="olho" id="olho" fill="currentColor" class="bi bi-eye"
                    viewBox="0 0 16 16">
                    <path
                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="pirata" id="pirata" fill="currentColor"
                    class="bi bi-eye-slash" viewBox="0 0 16 16">
                    <path
                        d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z" />
                    <path
                        d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z" />
                    <path
                        d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z" />
                </svg>
            </div>
            @error('senha')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <div class="mb-3 senha">
                <label for="senha" class="form-label">Confirme a nova senha:</label>
                <input type="password" class="form-control" id="confirmaSenha" name="confirmaSenha"
                    placeholder="Confirme a senha informada" value="{{ old('confirmaSenha') }}">
                <svg xmlns="http://www.w3.org/2000/svg" class="olho" id="olhoConfirma" fill="currentColor" class="bi bi-eye"
                    viewBox="0 0 16 16">
                    <path
                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                </svg>
                <svg xmlns="http://www.w3.org/2000/svg" class="pirata" id="pirataConfirma" fill="currentColor"
                    class="bi bi-eye-slash" viewBox="0 0 16 16">
                    <path
                        d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z" />
                    <path
                        d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z" />
                    <path
                        d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z" />
                </svg>
            </div>
            @error('senha')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            @if (session('loginError'))
                <div class="class alert alert-danger">
                    {{ session('loginError') }}
                </div>
            @endif --}}
            <button type="submit" class="btn btn-success">Continuar para cadastro de nova senha...</button>
        </form>
    </section>
    <script>
        var senha = $('#senha');
        var olho = $("#olho");
        var pirata = $("#pirata");

        olho.mousedown(function() {
            senha.attr("type", "text");
            $('#pirata').show();
            $('#olho').hide();
        });

        olho.mouseenter(function() {
            senha.attr("type", "password");
        });

        pirata.mousedown(function() {
            senha.attr("type", "password");
            $('#pirata').hide();
            $('#olho').show();
        });

        var confirmaSenha = $('#confirmaSenha');
        var olhoConfirma = $("#olhoConfirma");
        var pirataConfirma = $("#pirataConfirma");

        olhoConfirma.mousedown(function() {
            confirmaSenha.attr("type", "text");
            $('#pirataConfirma').show();
            $('#olhoConfirma').hide();
        });

        olhoConfirma.mouseenter(function() {
            confirmaSenha.attr("type", "password");
        });

        pirataConfirma.mousedown(function() {
            confirmaSenha.attr("type", "password");
            $('#pirataConfirma').hide();
            $('#olhoConfirma').show();
        });

        document.getElementById("form").addEventListener("submit", function(event) {
            const password = document.getElementById("senha").value;
            const confirmPassword = document.getElementById("confirmaSenha").value;
            const errorMessage = document.getElementById("errorMessage");

            const hasUpperCase = /[A-Z]/.test(password);
            const hasNumber = /[0-9]/.test(password);
            const hasSymbol = /[\W_]/.test(password); // Qualquer caractere que não seja letra ou número

            errorMessage.textContent = "";

            if (password !== confirmPassword) {
                errorMessage.textContent = "As senhas não são iguais.";
                event.preventDefault();
                return;
            }

            if (!hasUpperCase) {
                errorMessage.textContent = "A senha deve conter pelo menos uma letra maiúscula.";
                event.preventDefault();
                return;
            }

            if (!hasNumber) {
                errorMessage.textContent = "A senha deve conter pelo menos um número.";
                event.preventDefault();
                return;
            }

            if (!hasSymbol) {
                errorMessage.textContent = "A senha deve conter pelo menos um símbolo.";
                event.preventDefault();
                return;
            }

        });
    </script>
@endsection

@extends('layouts.main')

@section('title')
    <title>Fale Conosco</title>
@endsection

@section('content')
    @include('layouts.navbar')

    <section class="contact">
        <p class="titulo">Fale Conosco</p>
        <div class="dados">
            <img src="{{ asset('assets/images/fale_conosco.svg') }}" alt="" class="mensagem">
            <form action="{{ route('contactSubmit') }}" method="post">
                @csrf
                <div class="form-group col-xl-12">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" name="nome" id="nome" class="form-control"
                        placeholder="Informe seu nome completo" value="{{ old('nome') }}">
                    @error('nome')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-xl-12">
                    <label for="telefone">DDD + Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control"
                        placeholder="Informe o seu telefone + DDD" value="{{ old('telefone') }}">
                    @error('telefone')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-xl-12">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="Informe o seu e-mail" value="{{ old('email') }}">
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-xl-12">
                    <label for="assunto">Assunto</label>
                    <select name="assunto" id="assunto" class="form-control">
                        <option value=""> -- Selecione uma opção --</option>
                        @php
                            $opcoes = ['Pedido de oração', 'Quero ser membro', 'Dúvida sobre algum evento', 'Outro'];
                        @endphp
                        @foreach ($opcoes as $opcao)
                            <option value="{{ $opcao }}" {{ old('assunto') == $opcao ? 'selected' : '' }}>
                                {{ $opcao }}
                            </option>
                        @endforeach
                    </select>
                    @error('assunto')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group col-xl-12">
                    <label for="mensagem">Mensagem:</label>
                    <textarea name="mensagem" id="mensagem" rows="4" class="form-control">{{ old('mensagem') }}</textarea>
                    @error('mensagem')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <button type="submit" class="btn btn-success">Enviar</button>
            </form>
        </div>
    </section>

    @include('layouts.footer')
    
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#telefone').mask('(00) 00000-0000');
        });
    </script>
@endsection

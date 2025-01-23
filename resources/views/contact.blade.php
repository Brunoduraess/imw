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
            <form action="" method="post">
                <div class="form-group col-xl-12">
                    <label for="nome">Nome Completo:</label>
                    <input type="text" name="nome" id="nome" class="form-control"
                        placeholder="Informe seu nome completo">
                </div>
                <div class="form-group col-xl-12">
                    <label for="telefone">DDD +Telefone</label>
                    <input type="text" name="telefone" id="telefone" class="form-control"
                        placeholder="Informe o seu telefone + DDD">
                </div>
                <div class="form-group col-xl-12">
                    <label for="email">E-mail:</label>
                    <input type="email" name="email" id="email" class="form-control"
                        placeholder="Informe o seu e-mail">
                </div>
                <div class="form-group col-xl-12">
                    <label for="assunto">Assunto</label>
                    <select name="assunto" id="assunto" class="form-control">
                        <option value=""> -- Selecione uma opção --</option>
                        <option value="">Pedido de oração</option>
                        <option value="">Quero ser membro</option>
                        <option value="">Dúvida sobre algum evento</option>
                        <option value="">Outro</option>
                    </select>
                </div>
                <div class="form-group col-xl-12">
                    <label for="mensagem">Mensagem:</label>
                    <textarea name="mensagem" id="mensagem" rows="4" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Enviar</button>
            </form>
        </div>
    </section>

    @include('layouts.footer')
@endsection

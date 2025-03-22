@extends('layouts.main')

@section('title')
    <title>Menu - Administração</title>
@endsection

@section('content')
    @include('admin.navbar')
    <section class="menu">
        <div class="opcoes">
            <div class="opcao">
                <img src="{{ asset('assets/images/detalhe_evento.png') }}" alt="logo">
                <p class="nome">Eventos</p>
                <p class="descricao">Utilize essa opção para gerenciar os eventos cadastrados ou cadastrar novos eventos</p>
                <a href=''><button class="btn btn-success">Gerenciar eventos</button></a>
            </div>
            <div class="opcao">
                <img src="{{ asset('assets/images/detalhe_projeto_externo.png') }}" alt="logo">
                <p class="nome">Projetos</p>
                <p class="descricao">Utilize essa opção para gerenciar os projetos cadastrados ou cadastrar novos projetos</p>
                <a href=''><button class="btn btn-success">Gerenciar projetos</button></a>
            </div>
            <div class="opcao">
                <img src="{{ asset('assets/images/midia.png') }}" alt="logo">
                <p class="nome">Usuários</p>
                <p class="descricao">Utilize essa opção para gerenciar os usuários cadastrados ou cadastrar novos usuários</p>
                <a href=''><button class="btn btn-success">Gerenciar usuários</button></a>
            </div>
        </div>
    </section>
@endsection

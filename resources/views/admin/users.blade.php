@extends('layouts.main')

@section('title')
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}">
    <title>Usuários - Administração</title>
@endsection

@section('content')
    @include('admin.navbar')
    <section class="registros">
        <div class="acoes">
            <p class="titulo">Usuários</p>
            <a href="{{ route('newUser') }}" class="btn btn-success">Cadastrar novo usuário</a>
        </div>
        <input type="text" name="search" id="search" class="form-control search" placeholder="Pesquisar...">
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Perfil</th>
                        <th>Último acesso</th>
                        <th>Criado em</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->nome }}</td>
                            <td>{{ $user->cpf }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->acesso }}</td>
                            <td>{{ $user->ultimo_acesso }}</td>
                            <td>{{ $user->criado_em }}</td>
                            <td style="white-space: nowrap;">
                                <a href='{{ route('editUser', ['id' => $user->id]) }}'>
                                    <button type="button" class="btn btn-success">Editar</button>
                                </a>
                                @if ($user->status != 'Inativo')
                                    <a href=''>
                                        <button type="button" class="btn btn-success">Desativar</button>
                                    </a>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('search');
            const tableRows = document.querySelectorAll('.table tbody tr');

            searchInput.addEventListener('keyup', function() {
                const searchValue = searchInput.value.toLowerCase();

                tableRows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    row.style.display = rowText.includes(searchValue) ? '' : 'none';
                });
            });
        });
    </script>
@endsection

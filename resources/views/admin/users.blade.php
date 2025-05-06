@extends('layouts.main')

@section('title')
    <link rel="stylesheet" href="{{ asset('assets/css/datatable.css') }}">
    <title>Usuários - Administração</title>
@endsection

@section('content')
    @include('admin.navbar')
    <section class="registros">
        <div class="dados-pagina">
            <div class="titulo">
                Usuários
            </div>
            <div class="pagina">
                <a href="{{ route('menu') }}">Menu</a> / Usuários
            </div>
        </div>
        <div class="cards">
            <div class="card">
                <p class="titulo">Usuários por status</p>
                @foreach ($userPerStatus as $status)
                    @if ($status->status == 'Ativo')
                        <div class="resultado">
                            <p class="status">✅ {{ $status->status }}</p>
                            <p class="total">{{ $status->total }}</p>
                        </div>
                        <hr>
                    @else
                        <div class="resultado">
                            <p class="status">⛔ {{ $status->status }}</p>
                            <p class="total">{{ $status->total }}</p>
                        </div>
                        <hr>
                    @endif
                @endforeach
                <a href="{{ route('newUser') }}" class="btn btn-success">Cadastrar novo usuário -></a>
            </div>
            <div class="card">
                <p class="titulo">Usuários por perfil</p>
                <div class="lista">
                    @foreach ($userPerProfile as $profile)
                        <div class="resultado">
                            <p class="status">*️⃣ {{ $profile->acesso }}</p>
                            <p class="total">{{ $profile->total }}</p>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
            <div class="card">
                <p class="titulo">Últimos logins</p>
                <div class="lista">
                    @foreach ($lastAccess as $access)
                        <div class="resultado">
                            <p class="status">⏰ {{ $access->nome }}</p>
                            <p class="total">{{ $access->data_acesso }}</p>
                        </div>
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="acoes">
            <p class="titulo">Pesquisar</p>
            <input type="text" name="search" id="search" class="form-control search" placeholder="Pesquisar...">
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Perfil</th>
                        <th>Status</th>
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
                            <td style="width: 100px">
                                @if ($user->status == 'Ativo')
                                    <p class="ativo">{{ $user->status }}</p>
                                @else
                                    <p class="inativo">{{ $user->status }}</p>
                                @endif
                            </td>
                            <td>{{ $user->ultimo_acesso }}</td>
                            <td>{{ $user->data_criacao }}</td>
                            <td style="white-space: nowrap;">
                                @if ($user->status != 'Inativo')
                                    <a href='{{ route('editUser', ['id' => $user->id]) }}'>
                                        <button type="button" class="btn btn-success">Editar ✏️</button>
                                    </a>
                                    <a href='{{ route('disableUser', ['id' => $user->id]) }}'>
                                        <button type="button" class="btn btn-success">Desativar ⛔</button>
                                    </a>
                                @else
                                    <a href='{{ route('enableUser', ['id' => $user->id]) }}'>
                                        <button type="button" class="btn btn-success">Ativar ✅</button>
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

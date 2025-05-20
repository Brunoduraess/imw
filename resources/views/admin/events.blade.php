@extends('layouts.main')

@section('title')
    <title>Administrar eventos</title>
@endsection

@section('content')
    @include('admin.navbar')

    <section class="registros">
        <div class="dados-pagina">
            <div class="titulo">
                Eventos
            </div>
            <div class="pagina">
                <a href="{{ route('menu') }}">Menu</a> / Eventos
            </div>
        </div>
        <div class="cards">
            <div class="card">
                <p class="titulo">Eventos por status</p>
                @foreach ($eventsPerStatus as $status)
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
                <a href="{{ route('createEvent') }}" class="btn btn-success">Criar novo evento -></a>
            </div>
            <div class="card">
                <p class="titulo">Eventos por tipo</p>
                <div class="lista">
                    @foreach ($eventsPerType as $type)
                        <div class="resultado">
                            <p class="status">*️⃣ {{ $type->tipo }}</p>
                            <p class="total">{{ $type->total }}</p>
                        </div>
                        <hr>
                    @endforeach
                </div>
                <a href="{{ route('eventsType') }}" class="btn btn-success">Consultar tipos -></a>
            </div>
            <div class="card">
                <p class="titulo">Eventos por local</p>
                <div class="lista">
                    @foreach ($eventPerLocation as $location)
                        <div class="resultado">
                            <p class="status">🏡 {{ $location->nome }}</p>
                            <p class="total">{{ $location->total }}</p>
                        </div>
                        <hr>
                    @endforeach
                </div>
                <a href="{{ route('createEvent') }}" class="btn btn-success">Consultar locais -></a>
            </div>
        </div>
        <div class="acoes">
            <p class="titulo">Pesquisar</p>
            <input type="text" name="search" id="search" class="form-control search"
                placeholder="Procure por algum dado do evento...">
        </div>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Tipo</th>
                        <th>Data</th>
                        <th>Horário</th>
                        <th>Inscrição</th>
                        <th>Status</th>
                        <th>Criador</th>
                        <th>Criado em</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($events as $event)
                        <tr>
                            <td>{{ $event->nome }}</td>
                            <td>{{ $event->descricao }}</td>
                            <td>{{ $event->tipo }}</td>
                            <td>{{ $event->data }}</td>
                            <td>{{ $event->horario }}</td>
                            <td>{{ $event->inscricao }}</td>
                            <td style="width: 100px">
                                @if ($event->status == 'Ativo')
                                    <p class="ativo">{{ $event->status }}</p>
                                @else
                                    <p class="inativo">{{ $event->status }}</p>
                                @endif
                            </td>
                            <td>{{ $event->criado_por }}</td>
                            <td>{{ $event->data_criacao }}</td>
                            <td style="white-space: nowrap;">
                                @if ($event->status != 'Inativo')
                                    <a href='{{ route('editEvent', ['id' => $event->id]) }}'>
                                        <button type="button" class="btn btn-success">Editar ✏️</button>
                                    </a>
                                    <a href='{{ route('disableEvent', ['id' => $event->id]) }}'>
                                        <button type="button" class="btn btn-success">Desativar ⛔</button>
                                    </a>
                                @else
                                    <a href='{{ route('enableEvent', ['id' => $event->id]) }}'>
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

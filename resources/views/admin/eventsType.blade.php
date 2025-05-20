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
                <a href="{{ route('menu') }}">Menu</a><a href="{{ route('eventsAdmin') }}"> / Eventos</a> / Tipos de evento
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
                        <th>Duração (Em dias)</th>
                        <th><a href="{{ route('createEventType') }}" class="btn btn-success">Criar tipo de evento</a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($eventsType as $event)
                        <tr>
                            <td>{{ $event->nome }}</td>
                            <td>{{ $event->descricao }}</td>
                            <td>{{ $event->total_dias }}</td>
                            <td style="white-space: nowrap; width: 200px;">
                                <a href='{{ route('editEventType', ['id' => $event->id]) }}'>
                                    <button type="button" class="btn btn-success">Editar ✏️</button>
                                </a>
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

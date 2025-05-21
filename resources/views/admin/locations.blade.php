@extends('layouts.main')

@section('title')
    <title>Administrar locais</title>
@endsection

@section('content')
    @include('admin.navbar')

    <section class="registros">
        <div class="dados-pagina">
            <div class="titulo">
                Localizações
            </div>
            <div class="pagina">
                <a href="{{ route('menu') }}">Menu</a><a href="{{ route('eventsAdmin') }}"> / Eventos</a> / Locais
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
                        <th>Local</th>
                        <th>Endereço</th>
                        <th>CEP</th>
                        <th>Responsável</th>
                        <th>Tel. responsável</th>
                        <th><a href="{{ route('createLocation') }}" class="btn btn-success">Criar novo local</a></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations as $location)
                        <tr>
                            <td>{{ $location->nome }}</td>
                            <td>{{ $location->endereco }}</td>
                            <td>{{ $location->cep }}</td>
                            <td>{{ $location->responsavel }}</td>
                            <td>{{ $location->tel_responsavel }}</td>
                            <td style="white-space: nowrap; width: 200px;">
                                <a href='{{ route('editLocation', ['id' => $location->id]) }}'>
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

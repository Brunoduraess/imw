@extends('layouts.main')

@section('title')
    <title>Criar novo evento</title>
@endsection

@section('content')
    @include('admin.navbar')

    <section class="formulario">
        <div class="dados-pagina">
            <div class="titulo">
                Cadastrar novo evento
            </div>
            <div class="pagina">
                <a href="{{ route('menu') }}">Menu</a> / <a href="{{ route('eventsAdmin') }}">Eventos</a> / Cadastrar novo
                evento
            </div>
        </div>
        <form action="{{ route('createEventSubmit') }}" method="post" enctype="multipart/form-data" class="row">
            @csrf
            <div class="form-group col-xl-12">
                <label for="tipo">Tipo de evento:</label>
                <select name="tipo" id="tipo" class="form-control">
                    <option value="">-- Selecione uma opção --</option>
                    @foreach ($types as $type)
                        {
                        <option value="{{ $type->id }} / {{ $type->descricao }} / {{ $type->nome }}"
                            {{ old('tipo') == $type->id ? 'selected' : '' }}>
                            {{ $type->nome }}
                        </option>
                    @endforeach
                    }
                </select>
                @error('tipo')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="nome">Nome do evento:</label>
                <input type="text" name="nome" id="nome" class="form-control"
                    placeholder="Informe o nome do evento" value="{{ old('nome') }}">
                @error('nome')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="descricao">Descrição:</label>
                <textarea name="descricao" id="descricao" rows="4" class="form-control"
                    placeholder="Informe aqui as principais características do evento">{{ old('descricao') }}</textarea>
                @error('descricao')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-6">
                <label for="data">Data do evento:</label>
                <input type="date" name="data" id="data" min="{{ date('Y-m-d') }}" class="form-control">
                @error('data')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-6">
                <label for="horario">Horário do evento:</label>
                <input type="time" name="horario" id="horario" class="form-control">
                @error('horario')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="local">Local do evento:</label>
                <select name="local" id="local" class="form-control">
                    <option value="">-- Selecione uma opção --</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}" {{ old('local') == $location->id ? 'selected' : '' }}>
                            {{ $location->nome }}
                        </option>
                    @endforeach
                </select>
                @error('local')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group col-xl-12">
                <label for="inscricao">Valor da inscrição:</label>
                <input type="text" name="valor" id="valor" class="form-control"
                    placeholder="Caso tenha, informe aqui o valor da inscrição do evento">
            </div>
            <div class="form-group col-xl-12">
                <label for="imagem_agenda">Imagem que será exibida na aba agenda (200px x 200px)</label>
                <input type="file" name="imagem_agenda" id="imagem_agenda" accept="image/png,image/jpg,imagem/jpeg"
                    class="form-control">
                @error('imagem_agenda')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-12">
                <label for="imagem_detalhe">Imagem que será exibida na aba detalhes do evento (1200px x 400px)</label>
                <input type="file" name="imagem_detalhe" id="imagem_detalhe" accept="image/png,image/jpg,imagem/jpeg"
                    class="form-control">
                @error('imagem_detalhe')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group col-xl-6">
                <button type="submit" class="btn btn-success">Cadastrar evento</button>
            </div>
            <div class="form-group col-xl-6">
                <a href="{{ route('eventsAdmin') }}"><button type="button" class="btn btn-danger">Voltar para o menu de
                        eventos</button></a>
            </div>
        </form>
    </section>
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.mask.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#valor').mask('#0,00', {
                reverse: true
            });
        });

        function onTipoChange(event) {
            const selectedValue = event.target.value;
            const descricao = selectedValue.split(' / ')[1];

            if (descricao) {
                const inputDescricao = document.getElementById('descricao');
                inputDescricao.value = descricao;
            }

            const nome = selectedValue.split(' / ')[2];
            if (nome) {
                const inputNome = document.getElementById('nome');
                inputNome.value = nome;
            }
        }

        document.getElementById('tipo').addEventListener('change', onTipoChange);
    </script>
@endsection

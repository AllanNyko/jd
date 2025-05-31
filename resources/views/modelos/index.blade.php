@extends('layouts.app')

@section('title', 'Modelos')


@section('content')
 
    <div class="container py-5">

        {{-- Flash de sucesso --}}
        @if (session('success'))
        <div class="alert alert-success text-center col-md-8 mx-auto">
            {{ session('success') }}
        </div>
        @endif

        {{-- Card com tabela e botão --}}
        <div class="card shadow-sm col-md-8 mx-auto">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Modelos Cadastrados</h5>
                <button id="btnNovaMarca" class="btn btn-primary btn-sm">+ Novo Modelo</button>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th style="width: 140px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach (($modelos ?? []) as $modelo)
                        @if(is_object($modelo))
                        <tr>
                            <td>{{ $modelo->id ?? '' }}</td>
                            <td>{{ $modelo->nome ?? '' }}</td>
                            <td class="d-flex justify-content-center">
                                <button class="btn btn-sm btn-warning btn-editar me-3"
                                    data-route="{{ isset($modelo->id) ? route('modelos.update', $modelo->id) : '#' }}"
                                    data-nome="{{ $modelo->nome ?? '' }}">Editar</button>
                                <button class="btn btn-sm btn-danger btn-excluir"
                                    data-route="{{ isset($modelo->id) ? route('modelos.destroy', $modelo->id) : '#' }}"
                                    data-nome="{{ $modelo->nome ?? '' }}">Excluir</button>
                            </td>
                        </tr>
                        @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal de criação / edição --}}
    <div class="modal fade" id="modalModelo" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formModelo" method="POST" action="{{ route('modelos.store') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalModeloLabel">Novo Modelo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="inputNome" class="form-label">Marca</label>
                        <select name="marca" id="marca" class="form-select @error('marca') is-invalid @enderror">
                            <option value="">Selecione uma marca</option>
                            @foreach (($marcas ?? []) as $marca)
                            @if(is_object($marca))
                            <option value="{{ $marca->id ?? '' }}">{{ $marca->nome ?? '' }}</option>
                            @endif
                            @endforeach
                        </select>
                        <br>
                        <label for="inputNome" class="form-label">Modelo</label>
                        <input type="text" id="inputNome" name="nome"
                            class="form-control @error('nome') is-invalid @enderror"
                            placeholder="Digite o nome do modelo" value="{{ old('nome') }}">
                        @error('nome')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>

    {{-- Modal de confirmação de exclusão --}}
    <div class="modal fade" id="modalExcluir" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <form id="formExcluir" method="POST" action="#" class="modal-content">
                @csrf
                @method('DELETE')
                <div class="modal-header">
                    <h5 class="modal-title">Confirmar Exclusão</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <p id="mensagemExcluir">Tem certeza que deseja excluir este modelo?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>

 @endsection   

    @section('bottom-script')
    <script>
        $(function() {
            const modalModelo = new bootstrap.Modal($('#modalModelo')[0]);
            const modalExcluir = new bootstrap.Modal($('#modalExcluir')[0]);

            $('#btnNovaMarca').on('click', function() {
                $('#modalModeloLabel').text('Novo Modelo');
                $('#formModelo')
                    .attr('action', '{{ route('modelos.store') }}')
                    .find('input[name="_method"]').remove();
                $('#inputNome').val('').removeClass('is-invalid');
                modalModelo.show();
            });

            $('.btn-editar').on('click', function() {
                const route = $(this).data('route');
                const nome = $(this).data('nome');
                $('#modalModeloLabel').text('Editar Modelo');
                $('#formModelo')
                    .attr('action', route)
                    .append(function() {
                        if (!$(this).find('input[name="_method"]').length) {
                            return '<input type="hidden" name="_method" value="PUT">';
                        }
                    });
                $('#inputNome').val(nome).removeClass('is-invalid');
                modalModelo.show();
            });

            $('.btn-excluir').on('click', function() {
                const route = $(this).data('route');
                const nome = $(this).data('nome');
                $('#formExcluir').attr('action', route);
                $('#mensagemExcluir').text('Deseja realmente excluir o modelo "' + nome + '"?');
                modalExcluir.show();
            });

            @if($errors-> any())
            modalModelo.show();
            @endif
        });
    </script>
    @endsection
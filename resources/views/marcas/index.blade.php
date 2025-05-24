{{-- resources/views/marcas/index.blade.php --}}
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciamento de Marcas</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <header>
        <nav>
            <div class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Celulares</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page"
                                    href="{{ route('modelos.index') }}">Modelos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('marcas.index') }}">Marcas</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
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
                <h5 class="mb-0">Marcas Cadastradas</h5>
                <button id="btnNovaMarca" class="btn btn-primary btn-sm">
                    + Nova Marca
                </button>
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
                        @foreach ($marcas as $marca)
                            <tr>
                                <td>{{ $marca->id }}</td>
                                <td>{{ $marca->nome }}</td>
                                <td class=" d-flex justify-content-center">
                                    <button class="btn btn-sm btn-warning btn-editar me-3"
                                        data-route="{{ route('marcas.update', $marca->id) }}"
                                        data-nome="{{ $marca->nome }}">Editar</button>
                                    <button class="btn btn-sm btn-danger btn-excluir"
                                        data-route="{{ route('marcas.destroy', $marca->id) }}"
                                        data-nome="{{ $marca->nome }}">Excluir</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    {{-- Modal de criação / edição --}}
    <div class="modal fade" id="modalMarca" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="formMarca" method="POST" action="{{ route('marcas.store') }}" class="modal-content">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalMarcaLabel">Nova Marca</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="inputNome" class="form-label">Nome</label>
                        <input type="text" id="inputNome" name="nome"
                            class="form-control @error('nome') is-invalid @enderror"
                            placeholder="Digite o nome da marca" value="{{ old('nome') }}">
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
                    <p id="mensagemExcluir">Tem certeza que deseja excluir esta marca?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </div>
            </form>
        </div>
    </div>

    <!-- jQuery e Bootstrap Bundle JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(function() {
            // inicializa os modais
            var modalMarca = new bootstrap.Modal($('#modalMarca')[0]);
            var modalExcluir = new bootstrap.Modal($('#modalExcluir')[0]);

            // botao "Nova Marca"
            $('#btnNovaMarca').on('click', function() {
                $('#modalMarcaLabel').text('Nova Marca');
                $('#formMarca')
                    .attr('action', '{{ route('marcas.store') }}')
                    .find('input[name="_method"]').remove();
                $('#inputNome')
                    .val('')
                    .removeClass('is-invalid');
                modalMarca.show();
            });

            // botão "Editar"
            $('.btn-editar').on('click', function() {
                var route = $(this).data('route');
                var nome = $(this).data('nome');
                $('#modalMarcaLabel').text('Editar Marca');
                $('#formMarca')
                    .attr('action', route)
                    .append(function() {
                        if (!$(this).find('input[name="_method"]').length) {
                            return '<input type="hidden" name="_method" value="PUT">';
                        }
                    });
                $('#inputNome')
                    .val(nome)
                    .removeClass('is-invalid');
                modalMarca.show();
            });

            // botão "Excluir"
            $('.btn-excluir').on('click', function() {
                var route = $(this).data('route');
                var nome = $(this).data('nome');
                $('#formExcluir').attr('action', route);
                $('#mensagemExcluir')
                    .text('Deseja realmente excluir a marca "' + nome + '"?');
                modalExcluir.show();
            });

            // reabre modal de criar/editar em caso de erro de validação

        });
    </script>
    @if ($errors->any())
        <script>
            modalMarca.show();
        </script>
    @endif
</body>

</html>

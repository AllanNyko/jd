<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Modelos de Celulares</title>
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
              <a class="nav-link active" aria-current="page" href="{{ route('modelos.index') }}">Modelos</a>
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
        <div class="card mx-auto" style="max-width: 400px;">
            <div class="card-header text-center">
                <h5 class="mb-0 ">Cadastro de Modelos de Celulares</h5>
            </div>
            <div class="card-body">

                {{-- Flash messages de sucesso ou erro genérico --}}
                <!-- @if (session('success'))
<div class="alert alert-success">
            {{ session('success') }}
          </div>
@endif

        @if (session('error'))
<div class="alert alert-danger">
            {{ session('error') }}
          </div>
@endif -->

                {{-- Se quiser mostrar *todos* os erros de validação de uma vez --}}
                <!-- @if ($errors->any())
<div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $msg)
<li>{{ $msg }}</li>
@endforeach
            </ul>
          </div>
@endif -->

                <form action="{{ route('modelos.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="marca" class="form-label">Escolha a marca</label>
                        <select class="form-select @error('marca') is-invalid @enderror" id="marca" name="marca">
                            <option value="">Selecione uma marca</option>
                            @foreach ($marcas as $marca)
                                <option value="{{ $marca->id }}">{{ $marca->nome }}</option>
                            @endforeach
                        </select>
                        {{-- Mensagem específica do campo "marca" --}}
                        @error('marca')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <br>
                    <label for="nome" class="form-label">Nome do modelo</label>
                    <input type="text" id="nome" name="nome"
                        class="form-control @error('nome') is-invalid @enderror" value="{{ old('nome') }}"
                        placeholder="Nome da marca">
                    {{-- Mensagem específica do campo "nome" --}}
                    @error('nome')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Enviar</button>
            </form>
        </div>
    </div>
    </div>



    <!-- Bootstrap 5 Bundle JS (Popper + JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO" crossorigin="anonymous">
    </script>
</body>

</html>

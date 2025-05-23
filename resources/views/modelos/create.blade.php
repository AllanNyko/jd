<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT"
    crossorigin="anonymous">
  <title>Cadastro de Marca</title>
</head>
<body>
  <div class="container py-5">
    <div class="card mx-auto" style="max-width: 400px;">
      <div class="card-header text-center">
        <h5 class="mb-0 ">Cadastro</h5>
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

        <form action="{{ route('marcas.store') }}" method="POST">
          @csrf

          <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input
              type="text"
              id="nome"
              name="nome"
              class="form-control @error('nome') is-invalid @enderror"
              value="{{ old('nome') }}"
              placeholder="Nome da marca"
            >
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
  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
    crossorigin="anonymous"></script>
</body>
</html>

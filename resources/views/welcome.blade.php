<!-- Exemplo de estrutura HTML com 2 cards usando Bootstrap 5 e jQuery -->
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Exemplo de 2 Cards</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <div class="container py-5">
    <div class="row justify-content-center">
      <div class="col-md-4 mb-4">
        <div class="card shadow">
          <div class="card-header bg-primary text-white">
            Card 1
          </div>
          <div class="card-body">
            <p class="card-text">Conteúdo do primeiro card.</p>
            <button class="btn btn-outline-primary btn-card" data-card="1">Ação Card 1</button>
          </div>
        </div>
      </div>
      <div class="col-md-4 mb-4">
        <div class="card shadow">
          <div class="card-header bg-success text-white">
            Card 2
          </div>
          <div class="card-body">
            <p class="card-text">Conteúdo do segundo card.</p>
            <button class="btn btn-outline-success btn-card" data-card="2">Ação Card 2</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- jQuery e Bootstrap Bundle JS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    $(function() {
      $('.btn-card').on('click', function() {
        var card = $(this).data('card');
        alert('Você clicou no Card ' + card);
      });
    });
  </script>
</body>
</html>
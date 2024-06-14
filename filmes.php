<?php
session_start();
include "cabecalho.php";
include "banco.php";

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}

$usuario = $_SESSION['usuario'];
$is_admin = $_SESSION['is_admin'];
$filmes = getFilmes();

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Filmesflix</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">FILMESFLIX</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="filmes.php">Filmes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
          <?php if ($is_admin): ?>
            <li class="nav-item">
              <a class="nav-link" href="cadastrar_filme.php">Cadastrar Filme</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h2>Lista de Filmes</h2>
    <div class="row">
      <?php if ($filmes): ?>
        <?php foreach ($filmes as $filme): ?>
          <div class="col-md-4 mb-4">
            <div class="card">
              <img src="<?= htmlspecialchars($filme['poster']) ?>" class="card-img-top" alt="<?= htmlspecialchars($filme['titulo']) ?>">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($filme['titulo']) ?></h5>
                <p class="card-text"><?= htmlspecialchars($filme['descricao']) ?></p>
                <p class="text-muted">Nota: <?= htmlspecialchars($filme['nota']) ?></p>
                <?php if ($is_admin): ?>
                  <a href="editar.php?id=<?= $filme['id'] ?>" class="btn btn-warning">Editar</a>
                  <a href="excluir.php?id=<?= $filme['id'] ?>" class="btn btn-danger">Excluir</a>
                <?php endif; ?>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>Nenhum filme encontrado.</p>
      <?php endif; ?>
    </div>
  </div>
</body>
</html>

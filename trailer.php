<?php
session_start();
include "cabecalho.php";
include "banco.php";

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit;
}


if (!isset($_GET['id'])) {
    header('Location: filmes.php');
    exit;
}

$id = $_GET['id'];

$filme = getFilmeById($id);
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trailer - <?= htmlspecialchars($filme['titulo']) ?></title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
          <?php if ($_SESSION['is_admin']): ?>
            <li class="nav-item">
              <a class="nav-link" href="cadastrar.php">Cadastrar Filme</a>
            </li>
          <?php endif; ?>
        </ul>
        <form class="d-flex ms-auto">
          <input class="form-control me-2" type="search" placeholder="Pesquisar" aria-label="Pesquisar">
          <button class="btn btn-outline-success" type="submit">Pesquisar</button>
        </form>
      </div>
    </div>
  </nav>

  <div class="container mt-5">
    <h2>Trailer de <?= htmlspecialchars($filme['titulo']) ?></h2>
    <div class="embed-responsive embed-responsive-16by9">

      <iframe width="560" height="315" src="<?= htmlspecialchars($filme['trailer']) ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

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
    <link rel="stylesheet" href="trailer.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .btn-voltar {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
<<<<<<< HEAD
<header class="header">
    <a class="navbar-brand" href="filmes.php">FILMES<span class="highlight">FLIX</span></a>
        <style>
    .highlight {
        color: #ff0000;
        font-weight: bold; 
    }
    a.navbar-brand{
        margin-right: -370px;
        padding-right: 50px;
    }
</style>
        <input type="checkbox" id="check">

        <label for="check" class="icons">
            <i class='bx bx-menu' id="menu-icon"></i>
            <i class='bx bx-x' id="close-icon"></i>
        </label>

        <nav class="navbar">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="filmes.php">Filmes</a>
          </li>
        </ul>
        </nav>


    </header>
=======
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
      <a class="navbar-brand" href="filmes.php">FILMES<span class="highlight">FLIX</span></a>
        <style>
          .highlight {
          color: #ff0000;
          font-weight: bold; 
          }
        </style>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                </ul>
            </div>
        </div>
    </nav>

    <button type="button" class="btn btn-secondary btn-voltar" onclick="location.href='filmes.php'">Voltar</button>
>>>>>>> 7bf3531c582204f9d600fc2aa554eb6f5215698e

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

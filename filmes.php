<?php include "cabecalho.php"; ?>
<?php include "banco-filmes.php"; ?>

<?php
$filmes = getFilmes();
?>

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
                        <a class="nav-link" href="cadastrar.php">Cadastrar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="editar.php">Editar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="excluir.php">Excluir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="row">
            <?php foreach ($filmes as $filme) : ?>
                <div class="col-md-3 mb-4">
                    <div class="card h-100">
                        <img src="<?= $filme["poster"] ?>" class="card-img-top" alt="Poster do Filme">
                        <div class="card-body">
                            <h5 class="card-title"><?= $filme["titulo"] ?></h5>
                            <p class="card-text">
                                <i class="bi bi-star-fill text-warning"></i> <?= $filme["nota"] ?>
                            </p>
                            <p class="card-text"><?= $filme["descricao"] ?></p>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-outline-danger"><i class="bi bi-heart"></i></button>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>

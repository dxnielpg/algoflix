<?php include "cabecalho.php"; ?>
<?php include "banco-filmes.php"; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = $_POST['titulo'];
    $nota = $_POST['nota'];
    $descricao = $_POST['descricao'];
    $poster = $_POST['poster'];
    criarFilme($titulo, $nota, $descricao, $poster, true);
    header('Location: filmes.php');
    exit;
}
?>

<body>
    <div class="container mt-4">
        <h1>Cadastrar Novo Filme</h1>
        <form method="post">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" required>
            </div>
            <div class="mb-3">
                <label for="nota" class="form-label">Nota</label>
                <input type="number" step="0.1" class="form-control" id="nota" name="nota" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="poster" class="form-label">URL do Poster</label>
                <input type="url" class="form-control" id="poster" name="poster" required>
            </div>
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>

</html>

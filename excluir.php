<?php include "cabecalho.php"; ?>
<?php include "banco-filmes.php"; ?>

<body>
    <div class="container mt-4">
        <h1>Excluir Filme</h1>
        <form method="get">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome do Filme</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

        <?php
        if (isset($_GET['nome'])) {
            $nome = $_GET['nome'];
            $filmes = getFilmeByNome($nome);
            if ($filmes) {
                echo "<h2>Resultados da busca:</h2>";
                echo "<ul>";
                foreach ($filmes as $filme) {
                    echo "<li>
                        {$filme['titulo']} - Nota: {$filme['nota']}
                        <a href='excluir.php?id={$filme['id']}' class='btn btn-danger btn-sm'>Excluir</a>
                    </li>";
                }
                echo "</ul>";
            } else {
                echo "<p>Nenhum filme encontrado com esse nome.</p>";
            }
        }

        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);
            $filme = getFilmeById($id);
            if (!$filme) {
                echo "Filme não encontrado.";
                exit;
            }
        }
        ?>

        <?php if (isset($_GET['id']) && isset($filme)) : ?>
        <h2>Confirmar Exclusão do Filme</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $filme['id']; ?>">
            <p>Tem certeza que deseja excluir o filme <strong><?php echo $filme['titulo']; ?></strong>?</p>
            <button type="submit" class="btn btn-danger">Excluir</button>
            <a href="filmes.php" class="btn btn-secondary">Cancelar</a>
        </form>
        <?php endif; ?>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id']);
            deletarFilme($id, true);
            echo "<p>Filme excluído com sucesso.</p>";
            header('Refresh: 1; filmes.php');
        }
        ?>
    </div>
</body>

</html>

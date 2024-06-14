<?php include "cabecalho.php"; ?>
<?php include "banco-filmes.php"; ?>

<body>
    <div class="container mt-4">
        <h1>Editar Filme</h1>
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
                        <a href='editar.php?id={$filme['id']}' class='btn btn-warning btn-sm'>Editar</a>
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
        <h2>Editar Detalhes do Filme</h2>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $filme['id']; ?>">
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control" id="titulo" name="titulo" value="<?php echo $filme['titulo']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="nota" class="form-label">Nota</label>
                <input type="number" step="0.1" class="form-control" id="nota" name="nota" value="<?php echo $filme['nota']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required><?php echo $filme['descricao']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="poster" class="form-label">URL do Poster</label>
                <input type="url" class="form-control" id="poster" name="poster" value="<?php echo $filme['poster']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
        <?php endif; ?>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = intval($_POST['id']);
            $titulo = $_POST['titulo'];
            $nota = $_POST['nota'];
            $descricao = $_POST['descricao'];
            $poster = $_POST['poster'];
            atualizarFilme($id, $titulo, $nota, $descricao, $poster, true);
            echo "<p>Filme atualizado com sucesso.</p>";
            header('Refresh: 1; filmes.php');
        }
        ?>
    </div>
</body>

</html>

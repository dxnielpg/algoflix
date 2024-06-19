<?php include "cabecalho.php"; ?>
<?php include "banco.php"; ?>

<body>
<style>
        body{
        background: rgb(10,8,41);
        background: radial-gradient(circle, rgba(10,8,41,1) 0%, rgba(17,12,64,1) 64%, 
        rgba(0,0,0,1) 100%);
        }  
        label{
            color: white;
        }
        h1{
            color: white;
            text-align: center;
        }
        form {
            max-width: 600px; /* Define a largura máxima do formulário */
            margin: 40px auto; /* Centraliza o formulário na página */
            padding: 20px;
            border: 1px solid #ccc; /* Adiciona uma borda fina ao formulário */
            border-radius: 5px; /* Arredonda os cantos do formulário */
        }
        h2, li{
            color: white;
        }
    </style>
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

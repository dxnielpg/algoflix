<?php
session_start();
include "banco.php";

if (isset($_SESSION['usuario'])) {
    header('Location: filmes.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $query = $banco->prepare("SELECT * FROM usuarios WHERE usuario = ?");
    $query->bind_param('s', $usuario);
    $query->execute();
    $result = $query->get_result();
    $usuario_data = $result->fetch_assoc();

    if ($usuario_data && password_verify($senha, $usuario_data['senha'])) {
        $_SESSION['usuario'] = $usuario_data['usuario'];
        $_SESSION['is_admin'] = $usuario_data['is_admin'];

        if ($_SESSION['is_admin']) {
            header('Location: admin_filmes.php');
        } else {
            header('Location: filmes.php');
        }
        exit;
    } else {
        $erro = "Usuário ou senha inválidos";
    }
}
?>

<?php include "cabecalho.php"; ?>

<body>
    <div class="container mt-4">
        <h1>Login</h1>
        <?php if (isset($erro)) : ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $erro; ?>
            </div>
        <?php endif; ?>
        <form method="post">
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <button type="submit" class="btn btn-primary">Entrar</button>
        </form>
    </div>
</body>

</html>

<?php
session_start();

if (isset($_SESSION['usuario'])) {
    header('Location: filmes.php');
    exit();
}

require_once 'banco.php';

$usu = $_POST['usuario'] ?? null;
$sen = $_POST['senha'] ?? null;
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($usu && $sen) {
        $busca = $banco->query("SELECT * FROM usuarios WHERE usuario='$usu'");
        if ($busca->num_rows == 0) {
            $error = 'Usuário não existe';
        } else {
            $obj = $busca->fetch_object();
            if ($sen === $obj->senha) {
                $_SESSION['usuario'] = $usu;
                $_SESSION['cod_usuario'] = $obj->cod;
                header('Location: filmes.php');
                exit();
            } else {
                $error = 'Senha incorreta';
            }
        }
    } else {
        $error = 'Por favor, preencha todos os campos';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <?php if ($error) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $error ?>
                        </div>
                        <?php endif; ?>
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="usuario" class="form-label">Usuário</label>
                                <input type="text" class="form-control" id="usuario" name="usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="senha" class="form-label">Senha</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
<?php
session_start();
if (!isset($_SESSION['admin']) || !$_SESSION['admin']) {
    header('Location: filmes.php');
    exit;
}
include "banco.php";
include "cabecalho.php";
?>

<body>
    <div class="container mt-4">
        <h1>Painel Administrativo de Filmes</h1>
    </div>
</body>

</html>

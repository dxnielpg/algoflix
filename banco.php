<pre>
<?php

$banco = new mysqli("localhost:3307", "root", "", "filmesflix");

function createOnDB(string $into, string $value, $debug = false): void
{
    global $banco;

    $q = "INSERT INTO $into VALUE $value";
    $resp = $banco->query($q);

    if ($debug) {
        echo "<br> Query: $q";
        echo "<br> Resp: " . var_dump($resp);
    }
}


function updateOnDB(string $data, string $set, string $where, $debug = false): void
{
    global $banco;

    $q = "UPDATE $data SET $set WHERE $where";
    $resp = $banco->query($q);

    if ($debug) {
        echo "<br> Query: $q";
        echo "<br> Resp: " . var_dump($resp);
    }
}

function deleteFromDB(string $data, string $where, bool $debug = false): void
{
    global $banco;

    $q = "DELETE FROM $data WHERE $where";
    $resp = $banco->query($q);

    if ($debug) {
        echo "<br> Query: $q";
        echo "<br> Resp: " . var_dump($resp);
    }
}


function criarUsuario(string $usuario, string $nome, string $senha, $debug = false): void
{
    $senha = password_hash($senha, PASSWORD_DEFAULT);
    createOnDB("usuarios(cod, usuario, nome, senha)", "(NULL, '$usuario', '$nome', '$senha')", $debug);
}

function atualizarUsuario(string $usuario, string $nome = "", string $senha = "", $debug = false)
{

    if ($nome != "" && $senha != "") {
        // atualiza nome e senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $set = "nome='$nome', senha='$senhaHash'";
    } else if ($nome != "") {
        // atualiza nome
        $set = "nome='$nome'";
    } else if ($senha != "") {
        // atualiza senha
        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);
        $set = "senha='$senhaHash'";
    }

    updateOnDB("usuarios", $set, "usuario='$usuario'");
}

function deletarUsuario(string $usuario, $debug = false)
{
    deleteFromDB("usuarios", "usuario='$usuario'", $debug);
}


?>
</pre>
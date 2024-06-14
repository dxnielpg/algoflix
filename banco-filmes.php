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

function criarFilme(string $titulo, float $nota, string $descricao, string $poster, $debug = false): void
{
    createOnDB("filmes(id, titulo, nota, descricao, poster)", "(NULL, '$titulo', $nota, '$descricao', '$poster')", $debug);
}

function atualizarFilme(int $id, string $titulo = "", float $nota = 0, string $descricao = "", string $poster = "", $debug = false)
{
    $set = [];

    if ($titulo != "") {
        $set[] = "titulo='$titulo'";
    }
    if ($nota != 0) {
        $set[] = "nota=$nota";
    }
    if ($descricao != "") {
        $set[] = "descricao='$descricao'";
    }
    if ($poster != "") {
        $set[] = "poster='$poster'";
    }

    $setString = implode(", ", $set);
    updateOnDB("filmes", $setString, "id=$id", $debug);
}

function deletarFilme(int $id, $debug = false)
{
    deleteFromDB("filmes", "id=$id", $debug);
}

function getFilmes(): array
{
    global $banco;

    $result = $banco->query("SELECT * FROM filmes");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function getFilmeById(int $id): ?array
{
    global $banco;

    $result = $banco->query("SELECT * FROM filmes WHERE id = $id");
    if ($result->num_rows > 0) {
        return $result->fetch_assoc();
    } else {
        return null;
    }
}

function getFilmeByNome(string $nome): ?array
{
    global $banco;

    $nome = $banco->real_escape_string($nome);
    $result = $banco->query("SELECT * FROM filmes WHERE titulo LIKE '%$nome%'");
    if ($result->num_rows > 0) {
        return $result->fetch_all(MYSQLI_ASSOC);
    } else {
        return null;
    }
}


?>

<?php
include('conexao.php');

$nome = $_POST["nome"];
$senha = $_POST["senha"];

$sql = "SELECT * FROM Usuarios
        WHERE nome = '{$nome}'
        AND senha = '{$senha}'";

$res = $conn->query($sql) or die($conn->error);

$row = $res->fetch_object();

$qtd = $res->num_rows;

if($qtd > 0) {
    $_SESSION["nome"] = $row->nome;
    $_SESSION["tipo"] = $row->tipo;
    print "<script>location.href='dashboard.php';</script>";
} else {
    print "<script>alert('Usuário e/ou senha incorreto(s)');</script>";
    print "<script>location.href='tela_login.php';</script>";
}

?>
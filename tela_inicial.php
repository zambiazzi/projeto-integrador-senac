<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_tela_inicial.css">
    <title>Notícias</title>
</head>
<header>
        <a href="tela_inicial.php">Home</a>
    <nav class="filtros">
        <a href="TelaPoliticas.php">Política</a>
        <a href="TelaEsportes.php">Esportes</a>
        <a href="TelaEntretenimento.php">Entretenimento</a>
        <a href="TelaTempo.php">Tempo</a>
    </nav>
    <div class="login">
        <a href="login.php">Login</a>
    </div>
    
</header>
<body>
<?php
include 'conexao.php';

$sql = "SELECT * FROM noticias ORDER BY data DESC;";
$result = $conn->query($sql);

if (!$result) {
    die("Erro na consulta SQL: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>
                <h2>".$row['titulo']."</h2>
                <h3>".$row['data']."</h3>
                <p>".$row['subtitulo']."</p>
                <p>".$row['corpo']."</p>
              </div>";
    }
} else {
    echo "<div>Nenhuma notícia encontrada.</div>";
}

$conn->close();
?>

</body>
</html>

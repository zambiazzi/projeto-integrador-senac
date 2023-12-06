<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tempo</title>
</head>
<header>
        <a href="tela_inicial.php">Home</a>
    <nav class="filtros">
        <a href="TelaPolitica.php">Política</a>
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

$categoryName = 'Tempo';
$stmt = $conn->prepare("SELECT n.titulo, n.subtitulo, n.corpo, n.data, c.nome AS categoria 
                       FROM Noticias n 
                       JOIN Categorias c ON n.categoriasID = c.id 
                       WHERE c.nome = ? 
                       ORDER BY n.data DESC;");
$stmt->bind_param("s", $categoryName);

$result = $stmt->execute();

if (!$result) {
    echo "Erro na consulta SQL: " . $stmt->error;
}

$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div>
                <h2>" . $row['titulo'] . "</h2>
                <h3>" . $row['data'] . "</h3>
                <p>" . $row['subtitulo'] . "</p>
                <p>" . $row['corpo'] . "</p>
              </div>";
    }
} else {
    echo "<div>Nenhuma notícia encontrada para a categoria 'Tempo'.</div>";
}

$conn->close();
?>




</body>
</html>
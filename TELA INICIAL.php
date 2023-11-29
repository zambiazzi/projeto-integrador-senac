<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notícias</title>
</head>
<body>
    <div>
        <form method="get">
            <label>
                <b>Filtragem</b>
                <div>
                    <select name="category">
                        <option value="1">Política</option>
                        <option value="2">Esportes</option>
                        <option value="3">Entretenimento</option>
                        <option value="4">Tempo</option>
                    </select>
                </div>
            </label>
            <label>
                <input type="submit" value="Filtrar">
            </label>
        </form>
    </div>

    <?php
    include 'conexao.php';

    if(isset($_GET['category'])) {
        $categoryID = $_GET['category'];
        $sql = "SELECT * FROM noticias WHERE categoriasID = $categoryID ORDER BY data DESC;";
    } else {
      
        $sql = "SELECT * FROM noticias ORDER BY data DESC;";
    }

    $result = $conn->query($sql);
    if (!$result) {
        die("Erro na consulta SQL: " . $conn->error);
    }

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div>
                    <h2>".$row['titulo']."</h2>
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

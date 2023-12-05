<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Cadastrar Notícia</title>
</head>

<body>
    <div class="admin-container">
        <h2>Cadastrar Notícia</h2>

        <form action="" method="post" enctype="multipart/form-data">
            <label for="titulo">Título:</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="subtitulo">Subtítulo:</label>
            <textarea id="subtitulo" name="subtitulo" rows="4"></textarea>

            <label for="corpo">Corpo:</label>
            <textarea id="corpo" name="corpo" rows="8" required></textarea>

            <label for="categoria">Categoria:</label>
            <select id="categoria" name="categoria" required>
                <option value="Politica">Política</option>
                <option value="Esportes">Esportes</option>
                <option value="Entretenimento">Entretenimento</option>
                <option value="Tempo">Tempo</option>
            </select>

            <label for="imagem">Imagem:</label>
            <input type="file" id="imagem" name="imagem" accept="image/*" required>

            <button type="submit">Cadastrar Notícia</button>
        </form>
    </div>

    <?php
    include 'conexao.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $titulo = $_POST["titulo"];
        $subtitulo = $_POST["subtitulo"];
        $corpo = $_POST["corpo"];
        $categoria = $_POST["categoria"];
        $imagem = $_FILES["imagem"]["tmp_name"];

        $sql = "INSERT INTO Noticias (titulo, subtitulo, corpo, categoriasID, data) VALUES (?, ?, ?, (SELECT id FROM Categorias WHERE nome = ?), NOW())";
        $stmt = $conn->prepare($sql);

        if(!$stmt) {
            die('Error in SQL query: '.$conn->error);
        }

        $stmt->bind_param("ssss", $titulo, $subtitulo, $corpo, $categoria);

        if($stmt->execute()) {
            $noticiaID = $stmt->insert_id;

            $stmt->close();

            if($imagem) {
                $conteudoImagem = addslashes(file_get_contents($imagem));

                $sqlImagem = "INSERT INTO fotos (conteudo) VALUES (?)";
                $stmtImagem = $conn->prepare($sqlImagem);

                if(!$stmtImagem) {
                    die('Error in SQL query: '.$conn->error);
                }

                $stmtImagem->bind_param("s", $conteudoImagem);
                if($stmtImagem->execute()) {
                    $imagemID = $stmtImagem->insert_id;

                    $sqlAssociarImagem = "UPDATE Noticias SET imagemID = ? WHERE id = ?";
                    $stmtAssociarImagem = $conn->prepare($sqlAssociarImagem);

                    if(!$stmtAssociarImagem) {
                        die('Error in SQL query: '.$conn->error);
                    }

                    $stmtAssociarImagem->bind_param("ii", $imagemID, $noticiaID);
                    $stmtAssociarImagem->execute();

                    $stmtAssociarImagem->close();
                } else {
                    echo "Erro ao inserir a imagem: ".$stmtImagem->error;
                }

                $stmtImagem->close();
            }

            echo "Notícia cadastrada com sucesso!";
        } else {
            echo "Erro ao cadastrar notícia: ".$stmt->error;
        }

        $conn->close();
    }
    ?>
    </form>
    </div>
</body>

</html>
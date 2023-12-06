<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_cadastrar.css">
    <link rel="stylesheet" href="css/style_index.css">
    <link rel="icon" href="imgs/coroa.png">
    <title>Cadastrar Notícia</title>
</head>
<style>
    .admin-container {
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
    }

    .news-form {
        display: flex;
        flex-direction: column;
    }

    label {
        margin-top: 10px;
    }

    input,
    textarea,
    select {
        padding: 8px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    button {
        padding: 10px;
        background-color: #000;
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    textarea {
    padding: 8px;
    margin: 5px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: none; 
}
</style>

<body>
    <div class="data">
        <?php
        date_default_timezone_set('America/Sao_Paulo');

        $dia_semana = date('D');
        $dia = date('j');
        $mes = date('F');
        $ano = date('Y');

        $traducao_dias = array(
            'Mon' => 'Seg',
            'Tue' => 'Ter',
            'Wed' => 'Qua',
            'Thu' => 'Qui',
            'Fri' => 'Sex',
            'Sat' => 'Sab',
            'Sun' => 'Dom'
        );

        $dia_semana_traduzido = $traducao_dias[$dia_semana];

        $traducao_meses = array(
            'January' => 'Janeiro',
            'February' => 'Fevereiro',
            'March' => 'Março',
            'April' => 'Abril',
            'May' => 'Maio',
            'June' => 'Junho',
            'July' => 'Julho',
            'August' => 'Agosto',
            'September' => 'Setembro',
            'October' => 'Outubro',
            'November' => 'Novembro',
            'December' => 'Dezembro'
        );

        $mes_traduzido = $traducao_meses[$mes];

        echo $dia_semana_traduzido.'. '.$dia.' de '.$mes_traduzido.', '.$ano;
        ?>

        <a class="botao-login" href="tela_login.php">Logoff</a>
    </div>
    </header>

    <br>
    <a href="index.php"><img src="imgs/logo.png" class="logoTelaInicial"></a>
    <br>

    <div class="linha-horizontal1"></div>

    <div class="nav-bar">
        <a href="dashboard.php" class="nav-link">Dashboard</a>
        <div class="line"></div>
        <a href="cadastrar.php" class="nav-link">Cadastrar usuários</a>
        <div class="line"></div>
        <a href="atualizar.php" class="nav-link">Atualizar usuários</a>
        <div class="line"></div>
        <a href="deletar.php" class="nav-link">Deletar usuários</a>
        <div class="line"></div>
        <a href="cadastrar_noticias.php" class="nav-link active">Cadastrar notícias</a>
        <a href="atualizar_noticias.php" class="nav-link">Atualizar notícias</a>
        <div class="line"></div>
    </div>

    <div class="linha-horizontal2"></div>

    <h1>Cadastrar notícia</h1>

    <div class="admin-container">

        <form action="" method="post" enctype="multipart/form-data">
            <label for="titulo">Título:</label> <br>
            <input type="text" id="titulo" name="titulo" required>
            <br>
            <label for="subtitulo">Subtítulo:</label> <br>
            <textarea id="subtitulo" name="subtitulo" rows="4"></textarea>
            <br>
            <label for="corpo">Corpo:</label> <br>
            <textarea id="corpo" name="corpo" rows="8" required></textarea>
            <br>
            <label for="categoria">Categoria:</label><br>
            <select id="categoria" name="categoria" required>
                <option value="Politica">Política</option>
                <option value="Esportes">Esportes</option>
                <option value="Entretenimento">Entretenimento</option>
                <option value="Tempo">Tempo</option>
            </select>
            <br>
            <label for="imagem">Imagem:</label><br>
            <input type="file" id="imagem" name="imagem" accept="image/*" required>
            <br><br>
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
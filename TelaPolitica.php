<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style_index.css">
    <title>Política</title>
    <link rel="icon" href="imgs/coroa.png">
</head>

<body>
    <header>
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

            <a class="botao-login" href="tela_login.php">Login</a>
        </div>
    </header>

    <br>
    <a href="index.php"><img src="imgs/logo.png" class="logoTelaInicial"></a>
    <br>

    <div class="linha-horizontal1"></div>

    <div class="nav-bar">
        <a href="index.php" class="nav-link">Todas</a>
        <div class="line"></div>
        <a href="TelaPolitica.php" class="nav-link active">Política</a>
        <div class="line"></div>
        <a href="TelaEsportes.php" class="nav-link">Esportes</a>
        <div class="line"></div>
        <a href="TelaEntretenimento.php" class="nav-link">Entretenimento</a>
        <div class="line"></div>
        <a href="TelaTempo.php" class="nav-link">Tempo</a>
        <div class="line"></div>
    </div>

    <div class="linha-horizontal2"></div>

    <div class="linha-rodape"></div>

    <br>
    <a href="index.php"><img src="imgs/logo2.png" class="logoTelaInicial"></a>
    <span id="frase-rodape">© 2023 Kingnews, Inc. Todos os direitos reservados.</span>       


    <?php
    include 'conexao.php';

    $sql = "SELECT noticias.*, fotos.conteudo AS imagem FROM noticias LEFT JOIN fotos ON noticias.id = fotos.id ORDER BY data DESC;";
    $result = $conn->query($sql);

    if(!$result) {
        die("Erro na consulta SQL: ".$conn->error);
    }

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<div>
                <h2>".$row['titulo']."</h2>
                <h3>".$row['data']."</h3>
                <p>".$row['subtitulo']."</p>
                <p>".$row['corpo']."</p>";

            if(!empty($row['imagem'])) {
                $imagemBase64 = base64_encode($row['imagem']);

                echo '<img src="data:image/jpeg;base64,'.$imagemBase64.'>';
            } else {
                echo '<div>Nenhuma imagem disponível</div>';
            }

            echo "</div>";
        }
    }

    $conn->close();
    ?>

</body>

</html>
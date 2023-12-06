<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Cadastro de Usuários</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style_cadastrar.css">
    <link rel="stylesheet" href="css/style_index.css">
    <link rel="icon" href="imgs/coroa.png">
</head>

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
        <a href="cadastrar.php" class="nav-link active">Cadastrar usuários</a>
        <div class="line"></div>
        <a href="atualizar.php" class="nav-link">Atualizar usuários</a>
        <div class="line"></div>
        <a href="deletar.php" class="nav-link">Deletar usuários</a>
        <div class="line"></div>
        <a href="cadastrar_noticias.php" class="nav-link">Cadastrar notícias</a>
        <div class="line"></div>
        <a href="atualizar_noticias.php" class="nav-link">Atualizar notícias</a>
        <div class="line"></div>
    </div>

    <div class="linha-horizontal2"></div>

    <h1>Cadastrar Usuário</h1>
    <form action="#" method="post">
        <div class="input-group">
            <label for="nome">Usuário: </label>
            <input type="text" id="nome" name="nome" required>
        </div>
        <div class="input-group">
            <label for="senha">Senha: </label>
            <input type="password" id="senha" name="senha" required>
        </div>
        <button type="submit" class="submit-btn">Adicionar</button>
    </form>

    <?php
    include 'conexao.php';

    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        $sql = "INSERT INTO usuarios (nome, senha) VALUES (?, ?)";
        $insert = $conn->prepare($sql);
        $insert->bind_param("ss", $nome, $senha);

        if($insert->execute()) {
            echo "<p>Usuário Adicionado com sucesso!</p>";
        } else {
            echo "<p>Erro ao adicionar aluno: ".$conn->error."</p>";
        }
        $insert->close();
    }

    $conn->close();
    ?>
</body>

</html>
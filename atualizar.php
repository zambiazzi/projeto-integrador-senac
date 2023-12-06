<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Usuário</title>
    <link rel="stylesheet" href="css/style_atualizar.css">
    <link rel="stylesheet" href="css/style_index.css">
    <link rel="icon" href="imgs/coroa.png">
    <script>
        function preencherFormulario(id, nome, senha) {
            document.getElementById('id_usuarios').value = id;
            document.getElementById('nome').value = nome;
            document.getElementById('senha').value = senha;
        }
    </script>
    <style>
        .tabela {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:last-child td {
            border-bottom: none;
        }
    </style>
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
        <a href="cadastrar.php" class="nav-link">Cadastrar usuários</a>
        <div class="line"></div>
        <a href="atualizar.php" class="nav-link active">Atualizar usuários</a>
        <div class="line"></div>
        <a href="deletar.php" class="nav-link">Deletar usuários</a>
        <div class="line"></div>
        <a href="cadastrar_noticias.php" class="nav-link">Cadastrar notícias</a>
        <div class="line"></div>
        <a href="atualizar_noticias.php" class="nav-link">Atualizar notícias</a>
    </div>

    <div class="linha-horizontal2"></div>

    <h1>Atualizar Usuário</h1>
    <div id="lista-usuarios"></div>

    <form action="#" method="post" class="input-group">
        <input class="input" type="hidden" id="id_usuarios" name="id_usuarios">

        <label for="nome">Usuário:</label><br>
        <input class="input" type="text" id="nome" name="nome" required><br>

        <label for="senha">Senha:</label><br>
        <input class="input" type="text" id="senha" name="senha" required><br>

        <input class="submit-btn" type="submit" value="Atualizar">
    </form>

    <br>
    <?php
    include 'conexao.php';

    if($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id_usuarios'];
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        if(!is_numeric($id)) {
            echo "ID inválido";
            exit;
        }

        $sql = "UPDATE usuarios SET nome='$nome', senha='$senha' WHERE id=$id";

        if($conn->query($sql) === TRUE) {
            echo "Usuário Atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar Usuário: ".$conn->error;
        }
    }

    $sql = "SELECT id, nome, senha FROM usuarios";
    $result = $conn->query($sql);

    echo "<table border='1' class='tabela'>
            <tr>
                <th>ID</th>
                <th>Usuários</th>
                <th>Senha</th>
                <th>Ações</th>
            </tr>";

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['nome']."</td>
        <td>".$row['senha']."</td>
        <td><button onclick='preencherFormulario(".$row['id'].",\"".$row['nome']."\", \"".$row['senha']."\")'>Atualizar</button></td>
        </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Nenhum Usuário Cadastrado</td></tr>";
    }
    echo "</table>";

    $conn->close();
    ?>

</body>

</html>
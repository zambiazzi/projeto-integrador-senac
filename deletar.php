<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Deleção de Usuários</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style_deletar.css">
    <link rel="stylesheet" href="css/style_index.css">
    <link rel="icon" href="imgs/coroa.png">
    <script>
        function ConfirmarDelecao(id) {
            var resposta = confirm("Você tem certeza que deseja apagar o usuario com o ID " + id + "?");
            if (resposta) {
                window.location.href = "deletar.php?id=" + id;
            }
        }
    </script>
    <style>
        <style>.tabela {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            color: black;
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
        <a href="atualizar.php" class="nav-link">Atualizar usuários</a>
        <div class="line"></div>
        <a href="deletar.php" class="nav-link active">Deletar usuários</a>
        <div class="line"></div>
        <a href="cadastrar_noticias.php" class="nav-link">Cadastrar notícias</a>
        <div class="line"></div>
        <a href="atualizar_noticias.php" class="nav-link">Atualizar notícias</a>
    </div>

    <div class="linha-horizontal2"></div>

    <h1>Deletar Usuário</h1>
    <div id="lista-deletar-usuarios">
    </div>
</body>

</html>

<?php
include 'conexao.php';


$sql = "SELECT id,nome,senha FROM usuarios";
$result = $conn->query($sql);

echo "<table border='1' class='tabela'>
        <tr>
            <th>ID</th>
            <th>Usuário</th>
            <th>Senha</th>
            <th>Deletar</th>
        </tr>";

if($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['nome']."</td>
        <td>".$row['senha']."</td>
        <td><button onclick='ConfirmarDelecao(".$row['id'].")'>Deletar</button></td>
        </tr>";
    }
} else {
    echo "<tr><td colspan='4'>Nenhum usuario Cadastrado</td></tr>";
}
echo "</table>";
echo "<br>";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM usuarios WHERE id = $id";

    if($conn->query($sql) === TRUE) {
        echo "Usuário Deletado com Sucesso <br>";
    } else {
        echo "Erro ao deletar usuário: ".$conn->error;
    }
}

$conn->close();
?>
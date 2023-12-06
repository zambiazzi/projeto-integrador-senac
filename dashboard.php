<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style_cadastrar.css">
    <link rel="stylesheet" href="css/style_index.css">
    <link rel="icon" href="imgs/coroa.png">
    <style>
        .tabela {
            font-family: 'Noto Sans', sans-serif;
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

        button {
            padding: 10px;
            background-color: #000;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
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
        <a href="dashboard.php" class="nav-link active">Dashboard</a>
        <a href="cadastrar.php" class="nav-link">Cadastrar usuários</a>
        <div class="line"></div>
        <a href="atualizar.php" class="nav-link">Atualizar usuários</a>
        <div class="line"></div>
        <a href="deletar.php" class="nav-link">Deletar usuários</a>
        <div class="line"></div>
        <a href="cadastrar_noticias.php" class="nav-link">Cadastrar notícias</a>
        <div class="line"></div>
        <a href="atualizar_noticias.php" class="nav-link">Atualizar notícias</a>
    </div>

    <div class="linha-horizontal2"></div>

    <h1 style="font-family: 'Noto Sans', sans-serif;">Gerenciar Contas</h1>

    <?php
    include 'conexao.php';

    $sql = "SELECT id, nome FROM usuarios";
    $result = $conn->query($sql);

    echo "<table border='1' class='tabela'>
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                        </tr>";

    if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                                <td>".$row['id']."</td>
                                <td>".$row['nome']."</td>
                              </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Nenhum Usuário Cadastrado</td></tr>";
    }

    echo "</table>";

    $conn->close();
    ?>
    <br>
    <form class="#" action="gerar_pdf.php" method="post" target="_blank">
        <button type="submit">Gerar PDF</button>
    </form>
</body>

</html>
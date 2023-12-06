<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Administrador</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style_dashboard.css">
    <style>
        .action-buttons {
            display: flex;
            gap: 10px; 
        }

        .action-buttons button {
            background-color: #5cb85c;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .action-buttons button:hover {
            background-color: #4cae4c;
        }
    </style>
</head>
<body>
    <div class="action-buttons">
        <button style="background-color: black" onclick="window.location.href='logoff.php'">Sair</button>
    </div>
    <div id="container">
        <h1>Gerenciar Contas</h1>
        <div id="relatorio-usuarios">
            <?php
                include 'conexao.php';

                $sql = "SELECT id, nome FROM usuarios";
                $result = $conn->query($sql);

                echo "<table class='center-table'>
                        <tr>
                            <th>ID</th>
                            <th>Usuário</th>
                        </tr>";
                
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
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
        </div> 
            <div class="action-buttons" style="margin-left: 165px; margin-top: 10px;">
                <button style="background-color: black" onclick="window.location.href='cadastrar.php'">Cadastrar</button>
                <button style="background-color: black" onclick="window.location.href='atualizar.php'">Atualizar</button>
                <button style="background-color: black" onclick="window.location.href='deletar.php'">Deletar</button>
                <button style="background-color: black" onclick="window.location.href='gerar_pdf.php'">Gerar PDF</button>
            </div>
        </div>
    </div>
</body>
</html>

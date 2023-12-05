<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atualizar Usuário</title>
    <link rel="stylesheet" href="css/style_atualizar.css">
    <script>
        function preencherFormulario(id, nome, senha) {
            document.getElementById('id_usuarios').value = id;
            document.getElementById('nome').value = nome; 
            document.getElementById('senha').value = senha;
        }
    </script>
</head>
<body>
    <h1>Atualizar Usuário</h1>
    <div id="lista-usuarios"></div>

    <form action="#" method="post">
        <input type="hidden" id="id_usuarios" name="id_usuarios">

        <label for="nome">Usuário:</label><br>
        <input type="text" id="nome" name="nome" required><br> 

        <label for="senha">Senha:</label><br>
        <input type="text" id="senha" name="senha" required><br> 

        <input type="submit" value="Atualizar">
    </form>
</body>
</html>

<?php
include 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_usuarios'];
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    if (!is_numeric($id)) {
        echo "ID inválido";
        exit;
    }

    $sql = "UPDATE usuarios SET nome='$nome', senha='$senha' WHERE id=$id"; // Corrigido aqui

    if ($conn->query($sql) === TRUE) {
        echo "Usuário Atualizado com sucesso";
    } else {
        echo "Erro ao atualizar Usuário: " . $conn->error;
    }
}

$sql = "SELECT id, nome, senha FROM usuarios";
$result = $conn->query($sql);

echo "<table>
            <tr>
                <th>ID</th>
                <th>Usuários</th>
                <th>Senha</th>
                <th>Ações</th>
            </tr>";

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
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

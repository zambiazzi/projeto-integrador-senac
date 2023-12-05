<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Deletar Alunos</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style_deletar.css">
    <script>
        function ConfirmarDelecao(id){
            var resposta = confirm("Você tem certeza que deseja apagar o usuario com o ID "+id+"?");
            if(resposta){
              window.location.href="deletar.php?id="+id;  
            }
        }
    </script>
  </head>
  <body>
    <h1>Deletar Usuário</h1>
    <div id="lista-deletar-usuarios">
    </div>
  </body>
</html>

<?php
include 'conexao.php';

if(isset($_GET['id'])){
    $id=$_GET['id'];

    $sql="DELETE FROM usuarios WHERE id = $id";

    if($conn->query($sql)===TRUE){
        echo "Usuário Deletado com Sucesso";
    }
    else{
        echo "Erro ao deletar usuario: ".$conn->error;
    }
}

$sql = "SELECT id,nome,senha FROM usuarios";
$result = $conn->query($sql);

echo "<table>
            <tr>
                <th>ID</th>
                <th>Usuário</th>
                <th>Senha</th>
                <th>Deletar</th>
            </tr>";

if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        echo "<tr>
        <td>".$row['id']."</td>
        <td>".$row['nome']."</td>
        <td>".$row['senha']."</td>
        <td><button onclick='ConfirmarDelecao(".$row['id'].")'>Deletar</button></td>
        </tr>";
    }
}else{
    echo "<tr><td colspan='4'>Nenhum usuario Cadastrado</td></tr>";
}
echo "</table>";



$conn->close();
?>
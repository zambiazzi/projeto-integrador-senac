<!DOCTYPE html>
<html lang="pt-br">
<head>
    <title>Adicionar Usuários</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/style_cadastrar.css">
</head>
<body>
    <h2>Adicionar Usuário</h2>
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

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        $sql = "INSERT INTO usuarios (nome, senha) VALUES (?, ?)";
        $insert = $conn->prepare($sql);
        $insert->bind_param("ss", $nome, $senha);

        if($insert->execute()){
            echo "<p>Usuário Adicionado com sucesso!</p>";
        } else {
            echo "<p>Erro ao adicionar aluno: " . $conn->error . "</p>";
        }
        $insert->close();
    }

    $conn->close();
    ?>
</body>
</html>

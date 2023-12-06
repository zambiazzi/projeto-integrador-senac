<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style_login.css" media="screen" />
  <title>Página de Login</title>
</head>

<body>
  <img src="imgs/coroa.png" class="coroa-image">
  <div class="login-card">
    <div class="card-header">
      <h1>Bem-vindo</h1>
    </div>
    <div class="card-body">
      <form action="login.php" method="POST">
        <div class="form-group">
          <label for="username">Usuário</label>
          <input type="text" id="username" name="nome">
        </div>
        <div class="form-group">
          <label for="password">Senha</label>
          <input type="password" id="password" name="senha">
        </div>
        <div class="form-group">
          <button type="submit" class="login-button">Login</button>
        </div>
      </form>
      <a href="index.php" class="botaoTelaInicial">voltar à tela inicial</a>
    </div>
  </div>
</body>

</html>
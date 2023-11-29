<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" type="text/css" href="css/style.css" media="screen"/>
  <title>Página de Login</title>
</head>
<body>
<div class="login-card">
  <div class="card-header">
    <h1>Login</h1>
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
    </div>
  </div>
</body>
</html>

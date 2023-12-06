<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Atualização De Noticias</title>
  <link rel="stylesheet" type="text/css" href="css/style_cadastrar.css">
  <link rel="stylesheet" type="text/css" href="css/style_index.css">
  <link rel="icon" href="imgs/coroa.png">
  <meta charset="utf-8">
  <style>
    .update-form {
      background-color: #fff;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 300px;
    }

    .input-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input,
    select,
    textarea {
      width: 100%;
      padding: 8px;
      margin: 5px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      padding: 10px;
      background-color: #007BFF;
      color: #fff;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s;
    }

    button:hover {
      background-color: #0056b3;
    }
  </style>
  <script>
    function preencherFormulario(id, titulo, subtitulo, corpo, data, categoria, imagem) {
      document.getElementById('id').value = id;
      document.getElementById('titulo').value = titulo;
      document.getElementById('subtitulo').value = subtitulo;
      document.getElementById('corpo').value = corpo;
      document.getElementById('data').value = data;
      document.getElementById('categoria').value = categoria;
      document.getElementById('imagem').value = imagem;
    }
  </script>
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
    <a href="deletar.php" class="nav-link">Deletar usuários</a>
    <div class="line"></div>
    <a href="cadastrar_noticias.php" class="nav-link">Cadastrar notícias</a>
    <div class="line"></div>
    <a href="atualizar_noticias.php" class="nav-link active">Atualizar notícias</a>
  </div>

  <div class="linha-horizontal2"></div>

  <h1>Atualização de notícias</h1>
  <form action="#" method="post">
    <div class="input-group">
      <label for="id">ID: </label>
      <input type="text" id="id" name="id" readonly>
    </div>
    <div class="input-group">
      <label for="login">Titulo: </label>
      <input type="text" id="login" name="titulo" required>
    </div>
    <div class="input-group">
      <label for="senha">Subtitulo: </label>
      <input type="text" id="senha" name="Subtitulo" required>
    </div>
    <div class="-group">
      <label for="senha">Corpo: </label>
      <input type="password" id="senha" name="Corpo" required>
    </div>
    <div>
      <label for="dia">Data: </label>
      <input type="date" id="bday" name="dia" required pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" />
      <span class="validity"></span>
    </div>
    <div class="input-group">
      <label for="categoria">Categoria:</label>
      <select id="categoria" name="categoria" required>
        <option value="Politica">Política</option>
        <option value="Esportes">Esportes</option>
        <option value="Entretenimento">Entretenimento</option>
        <option value="Tempo">Tempo</option>
        <option value="Outro">Outro</option>
      </select>
    </div>
    <div class="input-group">
      <label for="imagem">Imagem:</label>
      <input type="file" id="imagem" name="imagem" accept="image/*" required>

      <input type="hidden" id="hiddenId" name="hiddenId">
    </div>
    <button type="submit" name="submit" class="submit-btn">Atualizar</button>
  </form>
  </form>

  <div id="atualizacao">
    <?php
    include 'conexao.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
      $id = $_POST['id'];
      $titulo = $_POST['titulo'];
      $subtitulo = $_POST['subtitulo'];
      $corpo = $_POST['corpo'];
      $data = $_POST['data'];
      $categoria = $_POST['categoria'];
      $foto = $_FILES['imagem'];

      $conn = $conn->prepare("UPDATE Noticias SET titulo=?, subtitulo=?, corpo=?, data=?, categoriasID=?, imagemID=? WHERE id=?");
      $conn->bind_param("ssssiii", $titulo, $subtitulo, $corpo, $data, $categoria, $foto, $id);

      if($conn->execute()) {
        echo "Notícia atualizada com sucesso";
      } else {
        echo "Erro ao atualizar notícia: ".$conn->error;
      }

      $conn->close();
    } else {
      echo "ID da notícia não especificado.";
    }

    $sql = "SELECT id, titulo, subtitulo,corpo,data,categoriasID,imagemID from noticias;";
    $result = $conn->query($sql);

    echo "<table>
      <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Subtítulo</th>
        <th>Corpo</th>
        <th>Data</th>
        <th>Categoria</th>
        <th>Imagem</th>
        <th>Ações</th>
      </tr>";

    if($result === false) {
      die("Erro na consulta: ".$conn->error);
    }

    if($conn->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        echo "<tr>
              <td>".$row['id']."</td>
              <td>".$row['titulo']."</td>
              <td>".$row['subtitulo']."</td>
              <td>".$row['corpo']."</td>
              <td>".$row['data']."</td>
              <td>".$row['categoriasID']."</td>
              <td>".$row['imagemID']."</td>

              
              <td><button onclick='preencherFormulario(".$row['id'].",\"".$row['titulo']."\",\"".$row['subtitulo']."\",\"".$row['corpo']."\",\"".$row['data']."\",\"".$row['categoriasID']."\",\"".$row['imagemID']."\")'>Atualizar</button></td>
            </tr>";
      }
    } else {
      echo "<tr><td colspan='4'>Nenhuma notícia cadastrada</td></tr>";
    }
    echo "</table>";

    $conn->close();
    ?>

  </div>
</body>

</html>
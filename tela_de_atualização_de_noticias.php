<!DOCTYPE html>
<html lang="pt-br">

<head>
  <title>Atualização De Noticias</title>
  <link rel="stylesheet" type="text/css" href="css/cssSql.css">
  <meta charset="utf-8">
  <style>
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
  <header>
    <a href="tela_inicial.php">Home</a>
    <nav class="filtros">
      <a href="TelaPoliticas.php">Política</a>
      <a href="TelaEsportes.php">Esportes</a>
      <a href="TelaEntretenimento.php">Entretenimento</a>
      <a href="TelaTempo.php">Tempo</a>
    </nav>
    <div class="login">
      <a href="login.php">Login</a>
    </div>
  </header>
  <h1 class="titulo">ATUALIZAÇÃO DE NOTÍCIAS</h1>
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
    <input
      type="date"
      id="bday"
      name="dia"
      required
      pattern="[0-9]{4}-[0-9]{2}-[0-9]{2}" />
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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $titulo = $_POST['titulo'];
    $subtitulo = $_POST['subtitulo'];
    $corpo = $_POST['corpo'];
    $data = $_POST['data'];
    $categoria = $_POST['categoria'];
    $foto = $_FILES['imagem'];

    $stmt = $conn->prepare("UPDATE Noticias SET titulo=?, subtitulo=?, corpo=?, data=?, categoriasID=?, imagemID=? WHERE id=?");
    $stmt->bind_param("ssssiii", $titulo, $subtitulo, $corpo, $data, $categoria, $foto, $id);

    if ($stmt->execute()) {
        echo "Notícia atualizada com sucesso";
    } else {
        echo "Erro ao atualizar notícia: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID da notícia não especificado.";
}

$sql = "SELECT id, titulo, subtitulo,corpo,data,categoriaId,imagem FROM Noticias";
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

if ($stmt !== false && $searchResult->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
              <td>" . $row['id'] . "</td>
              <td>" . $row['titulo'] . "</td>
              <td>" . $row['subtitulo'] . "</td>
              <td>" . $row['corpo'] . "</td>
              <td>" . $row['data'] . "</td>
              <td>" . $row['categoriaID'] . "</td>
              <td>" . $row['imagemID'] . "</td>

              
              <td><button onclick='preencherFormulario(" . $row['id'] . ",\"" . $row['titulo'] . "\",\"" . $row['subtitulo'] . "\",\"" . $row['corpo'] . "\",\"" . $row['data'] . "\",\"" . $row['categoriasID'] . "\",\"" . $row['imagemID'] . "\")'>Atualizar</button></td>
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

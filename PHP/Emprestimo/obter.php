<?php
  $servidor = "localhost";
  $user = "root";
  $password = "";
  $bd = "cadastrophp";

  $conn = new mysqli($servidor, $user, $password, $bd);
  if(!$conn) {
    echo"<p>Erro de conexão!</p>";
  }

  if($_SERVER["REQUEST_METHOD"] == "GET") {
    $emprestimo_id = $_GET["emprestimo_id"];

    $sql = "SELECT * FROM emprestimo WHERE id = '$emprestimo_id'";
    $retorno = $conn->query($sql);

    if($retorno -> num_rows > 0) {
      $row = $retorno -> fetch_assoc();
      echo "Id do emprestimo: " . $row["id"]. "<br>";
      echo "Registro do usuário: " . $row["usuario_reg"]. "<br>";
      echo "Registro do livro: " . $row["livro_reg"]. "<br>";
      echo "Situação: " . $row["situacao"]. "<br>";
    } else {
      echo "Emprestimo não encontrado";
    }

    $conn->close();
  }
?>
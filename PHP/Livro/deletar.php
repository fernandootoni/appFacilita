<?php
  $servidor = "localhost";
  $user = "root";
  $password = "";
  $bd = "cadastrophp";

  $conn = new mysqli($servidor, $user, $password, $bd);
  if(!$conn) {
    echo"<p>Erro de conexão!</p>";
  }

  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $numero_registro = $_POST["numero_registro"];

    $sqlVerificacao = "SELECT numero_registro from livro WHERE numero_registro = '$numero_registro'";
    $resultadoVerificacao = $conn->query($sqlVerificacao);

    if($resultadoVerificacao->num_rows === 0) {
      echo "Livro não encontrado";
    } else {
      $sql = "DELETE FROM livro WHERE numero_registro = '$numero_registro'";

      if($conn->query($sql) === true) {
        echo "Livro deletado!";
      } else {
        echo "Erro!";
      }
  
      $conn->close();
    }
  }
?>/
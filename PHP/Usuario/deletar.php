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
    $numero_cadastro = $_POST["numero_cadastro"];

    $sql = "DELETE FROM usuario WHERE numero_cadastro = '$numero_cadastro'";

    $sqlVerificacao = "SELECT numero_cadastro from usuario WHERE numero_cadastro = '$numero_cadastro'";
    $resultadoVerificacao = $conn->query($sqlVerificacao);

    if($resultadoVerificacao->num_rows === 0) {
      echo "Usuário não encontrado!";
    } else {
      if($conn->query($sql) === true) {
        echo "Usuário deletado!";
      } else {
        echo "Erro!";
      }
  
      $conn->close();
    }
  }
?>/
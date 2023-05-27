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
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $numero_cadastro = $_POST["numero_cadastro"];

    $sqlVerificacao = "SELECT numero_cadastro from usuario WHERE numero_cadastro = '$numero_cadastro'";
    $resultadoVerificacao = $conn->query($sqlVerificacao);

    if($resultadoVerificacao->num_rows === 0) {
      echo "Usuário não encontrado";
    } else {
      $sql = "UPDATE usuario SET nome = '$nome', email = '$email' WHERE numero_cadastro = '$numero_cadastro'";
    
      if($conn->query($sql) === true) {
        echo"<p>Usuário atualizado!</p>";
      } else {
        echo"<p>Erro ao atualizar</p>". $conn->error;
      }
  
      $conn->close();
    }
  }
?>
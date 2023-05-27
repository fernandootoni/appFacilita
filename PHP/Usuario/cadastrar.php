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

    $sql = "SELECT * FROM usuario WHERE nome = '$nome'";
    $retorno = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($retorno);

    if($row){
      echo"<p>Usuário já existe!</p>";
    } else {
      $sql = "INSERT INTO usuario (nome, email) values('$nome', '$email')";
      $retorno = mysqli_query($conn, $sql);

      if($retorno === true) {
        echo"<p>Cadastro realizado!</p>";
      } else {
        echo"<p>Erro ao cadastrar</p>". $conn->error;
      }
    }

    $conn->close();
  }
?>/
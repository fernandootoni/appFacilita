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
    $numero_cadastro = $_GET["numero_cadastro"];

    $sql = "SELECT * FROM usuario WHERE numero_cadastro = '$numero_cadastro'";
    $retorno = $conn->query($sql);

    if($retorno -> num_rows > 0) {
      $row = $retorno -> fetch_assoc();
      echo "Nome: " . $row["nome"]. "<br>";
      echo "Email: " . $row["email"]. "<br>";
    } else {
      echo "Usuário não encontrado";
    }

    $conn->close();
  }
?>
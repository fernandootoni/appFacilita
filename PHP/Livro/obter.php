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
    $numero_registro = $_GET["numero_registro"];

    $sql = "SELECT * FROM livro WHERE numero_registro = '$numero_registro'";
    $retorno = $conn->query($sql);

    if($retorno -> num_rows > 0) {
      $row = $retorno -> fetch_assoc();
      echo "Nome: " . $row["nome"]. "<br>";
      echo "Autor: " . $row["autor"]. "<br>";
      echo "Genero: " . $row["genero"]. "<br>";
      echo "Disponivel: " . $row["disponivel"]. "<br>";
    } else {
      echo "Livro não encontrado";
    }

    $conn->close();
  }
?>
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
    $genero = $_GET["genero"];

    $sql = "SELECT * FROM livro WHERE genero = '$genero'";
    $retorno = $conn->query($sql);

    if($retorno -> num_rows > 0) {
      while($row = $retorno->fetch_assoc()) {
        echo "Nome: " . $row["nome"]. "<br>";
        echo "Autor: " . $row["autor"]. "<br>";
        echo "Genero: " . $row["genero"]. "<br>";
        echo "Disponivel: " . $row["disponivel"]. "<br>";
        echo "---------------------------------------" . "<br>";
      }
    } else {
      echo "Não há nenhum livro destes genero!";
    }

    $conn->close();
  }
?>
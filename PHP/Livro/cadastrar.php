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
    $autor = $_POST["autor"];
    $genero = $_POST["genero"];
    $disponivel = "Disponivel";

    $sql = "SELECT * FROM livro WHERE nome = '$nome' and autor = '$autor'";
    $retorno = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($retorno);

    if($row){
      echo"<p>Livro já existe!</p>";
    } else {
      $sql = "INSERT INTO livro (nome, autor, genero, disponivel) values('$nome', '$autor', '$genero', '$disponivel')";
      $retorno = mysqli_query($conn, $sql);

      if($retorno === true) {
        echo"<p>Livro cadastrado!</p>";
      } else {
        echo"<p>Erro ao cadastrar</p>". $conn->error;
      }
    }

    $conn->close();
  }
?>/
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
    $nome = $_POST["nome"];
    $autor = $_POST["autor"];
    $genero = $_POST["genero"];
    $disponivel = $_POST["disponivel"];

    $sqlVerificacao = "SELECT numero_registro from livro WHERE numero_registro = '$numero_registro'";
    $resultadoVerificacao = $conn->query($sqlVerificacao);

    if($resultadoVerificacao->num_rows === 0) {
      echo "Livro não encontrado";
    } else {

      if($disponivel === "Emprestado" || $disponivel === "Disponivel") {
        $sql = "UPDATE livro SET nome = '$nome', autor = '$autor', genero = '$genero', disponivel = '$disponivel' WHERE numero_registro = '$numero_registro'";
    
        if($conn->query($sql) === true) {
          echo"<p>Livro atualizado!</p>";
        } else {
          echo"<p>Erro ao atualizar</p>". $conn->error;
        }
  
        $conn->close();
      } else {
        echo "Valor invalido no campo Situação";
      }
    }
  }
?>
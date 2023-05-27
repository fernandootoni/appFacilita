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
    $emprestimo_id = $_POST["emprestimo_id"];
    $situacao = $_POST["situacao"];

    $sqlVerificacao = "SELECT id from emprestimo WHERE id = '$emprestimo_id'";
    $resultadoVerificacao = $conn->query($sqlVerificacao);

    if($resultadoVerificacao->num_rows === 0) {
      echo "Emprestimo não encontrado";
    } else {
      if($situacao === "Atrasado" || $situacao === "Devolvido") {
        $sql = "UPDATE emprestimo SET situacao = '$situacao' WHERE id = '$emprestimo_id'";
    
        if($conn->query($sql) === true) {
          if($situacao === "Devolvido") {
            $sqlObterLivroReg = "SELECT livro_reg FROM emprestimo WHERE id = '$emprestimo_id'";
            $resultadoObterLivroReg = $conn->query($sqlObterLivroReg);

            if($resultadoObterLivroReg->num_rows > 0) {
              $rowLivroReg = $resultadoObterLivroReg->fetch_assoc();
              $livro_reg = $rowLivroReg["livro_reg"];

              $sqlLivro = "UPDATE livro SET disponivel = 'Disponivel' WHERE numero_registro = '$livro_reg'";
              if($conn->query($sqlLivro) === true) {
                echo"<p>Emprestimo e livro atualizado!</p>";
              } else {
                echo"<p>Erro ao atualizar</p>". $conn->error;
              }
            }

          } else {
            echo"<p>Emprestimo atualizado!</p>";
          }
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
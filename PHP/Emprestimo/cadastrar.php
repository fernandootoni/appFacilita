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
    $usuario_reg = $_POST["usuario_reg"];
    $livro_reg = $_POST["livro_reg"];
    $data = $_POST["data"];
    $situacao = "Em andamento";

    $sqlVerificacaoLivro = "SELECT * from livro WHERE numero_registro = '$livro_reg'";
    $resultadoVerificacaoLivro = $conn->query($sqlVerificacaoLivro);

    $sqlVerificacaoUsuario = "SELECT numero_cadastro from usuario WHERE numero_cadastro = '$usuario_reg'";
    $resultadoVerificacaoUsuario = $conn->query($sqlVerificacaoUsuario);

    if($resultadoVerificacaoLivro->num_rows === 0){
      echo "Livro não encontrado";
    } else if($resultadoVerificacaoUsuario->num_rows === 0) {
      echo "Usuário não encontrado";
    } 
    else {
      $livro = $resultadoVerificacaoLivro->fetch_assoc();
      if($livro["disponivel"] === "Emprestado") {
        echo "O livro está indisponivel no momento";
      } else {
        $sql = "INSERT INTO emprestimo (usuario_reg, livro_reg, data_devolucao, situacao) values('$usuario_reg', '$livro_reg', '$data', '$situacao')";
        $retorno = mysqli_query($conn, $sql);

        $sqlLivro = "UPDATE livro SET disponivel = 'Emprestado' WHERE numero_registro = '$livro_reg'";
        $livroRetorno = mysqli_query($conn, $sqlLivro);

        if($retorno === true) {
          echo"<p>Emprestimo cadastrado!</p>";
        } else {
          echo"<p>Erro ao cadastrar</p>". $conn->error;
        }
        if($livroRetorno === true) {
          echo"<p>Livro atualizado!</p>";
        } else {
          echo"<p>Erro ao atualizar</p>". $conn->error;
        }
      }
    }
    

    $conn->close();
  }
?>/
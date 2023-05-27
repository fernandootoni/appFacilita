CREATE DATABASE cadastrophp;

USE cadastrophp;

CREATE TABLE livro (
  numero_registro INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  autor VARCHAR(255) NOT NULL,
  genero VARCHAR(255) NOT NULL,
  disponivel VARCHAR(20) NOT NULL
);

CREATE TABLE usuario (
  numero_cadastro INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL
);

CREATE TABLE emprestimo (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_reg INT,
    livro_reg INT,
    data_devolucao VARCHAR(10),
    situacao VARCHAR(20),
    FOREIGN KEY (usuario_reg) REFERENCES usuario (numero_cadastro),
    FOREIGN KEY (livro_reg) REFERENCES livro (numero_registro)
);
CREATE DATABASE IF NOT EXISTS site_senac
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE site_senac;

-- Usuários cadastrados. O login é feito pelo nome, por isso ele é único.
CREATE TABLE IF NOT EXISTS cadastro (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL UNIQUE,
  email VARCHAR(150) NOT NULL UNIQUE,
  telefone CHAR(11) NOT NULL,
  cidade VARCHAR(100) NOT NULL,
  estado VARCHAR(30) NOT NULL,
  cpf CHAR(11) NOT NULL UNIQUE,
  -- 255 caracteres comportam o hash de password_hash mesmo se o algoritmo mudar.
  senha VARCHAR(255) NOT NULL,
  criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

-- Mensagens enviadas pela página Fale Conosco.
CREATE TABLE IF NOT EXISTS faleconosco (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  estado VARCHAR(30) NOT NULL,
  cidade VARCHAR(100) NOT NULL,
  email VARCHAR(150) NOT NULL,
  confirmaemail VARCHAR(150) NOT NULL,
  telefone CHAR(11) NOT NULL,
  modalidade VARCHAR(20),
  cpf CHAR(11) NOT NULL,
  assunto VARCHAR(30) NOT NULL,
  mensagem TEXT NOT NULL,
  criado_em TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
);

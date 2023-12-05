CREATE DATABASE db_ProjetoIntegrador;
USE db_ProjetoIntegrador;

CREATE TABLE Usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100),
    senha VARCHAR(100)
);

CREATE TABLE Categorias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100)
);

CREATE TABLE fotos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    conteudo MEDIUMBLOB NOT NULL
) ENGINE=InnoDB;

CREATE TABLE Noticias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(200),
    subtitulo TEXT,
    corpo TEXT,
    data DATE,
    categoriasID INT,
    imagemID INT,
    FOREIGN KEY (categoriasID) REFERENCES Categorias (id),
    FOREIGN KEY (imagemID) REFERENCES fotos (id)
);

INSERT INTO Usuarios (nome, senha) VALUES ("admin", "123");

INSERT INTO Categorias (nome) VALUES ("Política"), ("Esportes"), ("Entretenimento"), ("Tempo");
SELECT * FROM Categorias;
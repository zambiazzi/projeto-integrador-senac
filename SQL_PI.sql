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

CREATE TABLE fotos(
	id INT(10) AUTO_INCREMENT PRIMARY KEY,
    conteudo MEDIUMBLOB NOT NULL,
	tipo varchar(20) NOT NULL,
	tamanho  int(10) unsigned NOT NULL
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

-- Inserção da notícia de Política
INSERT INTO Noticias (titulo, subtitulo, corpo, categoriasID)
VALUES ('Presidente assina lei de reforma tributária para impulsionar a economia',
        'Medidas visam simplificar o sistema e estimular investimentos no país',
        'O presidente anunciou hoje a assinatura de uma nova lei de reforma tributária, marcando um passo significativo em direção à simplificação do sistema fiscal. As medidas têm como objetivo estimular investimentos, reduzir a burocracia e aumentar a competitividade do país no cenário internacional. A expectativa é de que as mudanças tenham impacto positivo no crescimento econômico e na geração de empregos nos próximos anos.', 1);

-- Inserção da notícia de Esportes
INSERT INTO Noticias (titulo, subtitulo, corpo, categoriasID)
VALUES ('Equipe nacional conquista ouro inédito em campeonato mundial de esportes aquáticos',
        'Atletas brasileiros brilham nas competições realizadas no exterior',
        'A delegação brasileira fez história no campeonato mundial de esportes aquáticos, ao conquistar a medalha de ouro pela primeira vez na história do país. Os atletas demonstraram talento e determinação, superando desafios e competindo em alto nível. A vitória não apenas enche de orgulho a nação, mas também destaca a qualidade do esporte brasileiro em âmbito global.', 2);

-- Inserção da notícia de Entretenimento
INSERT INTO Noticias (titulo, subtitulo, corpo, categoriasID)
VALUES ('Nova produção cinematográfica nacional conquista prêmio internacional',
        'Filme brasileiro é reconhecido em importante festival de cinema',
        'Uma produção cinematográfica nacional acaba de conquistar um prestigioso prêmio internacional em um renomado festival de cinema. O filme, que conta uma história envolvente e inovadora, recebeu elogios da crítica e do público. A conquista destaca o talento dos profissionais envolvidos na produção audiovisual brasileira, reafirmando a posição do país no cenário mundial do entretenimento.', 3);
        
-- Inserção da notícia de Tempo
INSERT INTO Noticias (titulo, subtitulo, corpo, categoriasID)
VALUES ('Alerta de tempestade tropical nas regiões costeiras nos próximos dias',
        'Autoridades recomendam precauções de segurança à população',
        'Autoridades meteorológicas emitiram um alerta de tempestade tropical que se aproxima das regiões costeiras nos próximos dias. A população está sendo orientada a tomar precauções de segurança, como reforçar estruturas, estocar alimentos e, se necessário, evacuar áreas de risco. A previsão detalhada será atualizada regularmente, e as autoridades pedem que os cidadãos fiquem atentos às informações oficiais para garantir a segurança durante o evento climático.', 4);

-- Inserção de uma nova notícia de Política
INSERT INTO Noticias (titulo, subtitulo, corpo, categoriasID)
VALUES ('Congresso Nacional aprova reforma previdenciária para equilibrar as contas públicas',
        'Medidas buscam garantir sustentabilidade do sistema a longo prazo',
        'O Congresso Nacional aprovou, por ampla maioria, uma abrangente reforma previdenciária com o objetivo de equilibrar as contas públicas. As medidas buscam garantir a sustentabilidade do sistema previdenciário a longo prazo, enfrentando os desafios demográficos e econômicos que o país enfrenta.', 1);

-- Inserção de uma nova notícia de Esportes
INSERT INTO Noticias (titulo, subtitulo, corpo, categoriasID)
VALUES ('Time de futebol brasileiro conquista título inédito na Liga dos Campeões',
        'Jogadores celebram a vitória após uma emocionante final',
        'O time brasileiro de futebol fez história ao conquistar o título inédito na Liga dos Campeões. Em uma final emocionante, a equipe demonstrou habilidade e determinação, vencendo o jogo por uma margem estreita. A conquista representa um marco para o esporte brasileiro e enche de orgulho os fãs.', 2);

-- Inserção de uma nova notícia de Entretenimento
INSERT INTO Noticias (titulo, subtitulo, corpo, categoriasID)
VALUES ('Artista brasileiro recebe prêmio internacional de melhor atuação em filme dramático',
        'Reconhecimento internacional destaca o talento do artista',
        'Um renomado artista brasileiro foi premiado internacionalmente como o melhor em sua atuação em um filme dramático. O reconhecimento destaca o talento excepcional do artista e coloca o Brasil no cenário global do entretenimento. A premiação foi recebida com entusiasmo pela indústria cinematográfica nacional.', 3);

-- Inserção de uma nova notícia de Tempo
INSERT INTO Noticias (titulo, subtitulo, corpo, categoriasID)
VALUES ('Frente fria se aproxima, trazendo temperaturas mais baixas e chuvas intensas',
        'População deve se preparar para condições climáticas adversas',
        'Uma frente fria está se aproximando da região, prevendo temperaturas mais baixas e chuvas intensas nos próximos dias. As autoridades meteorológicas alertam a população para se preparar, adotando medidas como agasalhos adequados, evitar áreas de risco de enchentes e garantir a segurança das residências durante o período de condições climáticas adversas.', 4);

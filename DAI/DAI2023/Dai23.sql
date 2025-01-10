CREATE DATABASE db_commande;
USE db_commande;

CREATE TABLE client (
    num INT PRIMARY KEY,
    nom VARCHAR(50),
    email VARCHAR(50)
);

CREATE TABLE commande (
    numCmd VARCHAR(15) PRIMARY KEY,
    dateCmd DATE,
    num INT,
    etat VARCHAR(30),
    dateValidation DATE,
    FOREIGN KEY (num) REFERENCES client(num)
);

CREATE TABLE article (
    code VARCHAR(15) PRIMARY KEY,
    libelle VARCHAR(50),
    prix FLOAT
);

CREATE TABLE ligneCmd (
    numCmd VARCHAR(15),
    code VARCHAR(15),
    Qte INT,
    PRIMARY KEY (numCmd, code),
    FOREIGN KEY (numCmd) REFERENCES commande(numCmd),
    FOREIGN KEY (code) REFERENCES article(code)
);


INSERT INTO client VALUES
(1, 'eljaafari zainab', 'zai@gmail.com'),
(2, 'bououd basma', 'b.basmaa@gmail.com');

INSERT INTO article VALUES
('001', 'DELL I7', 6500),
('002', 'hp book', 3000),
('003', 'lenovo', 4000),
('004', 'asus', 6000);
select * from commande;
select * from ligneCmd;
select * from client;
select * from article;
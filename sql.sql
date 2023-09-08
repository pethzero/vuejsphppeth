CREATE DATABASE data_vue;

USE data_vue;

CREATE TABLE people (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL
);

INSERT INTO people (name) VALUES
    ('John Doe'),
    ('Jane Smith'),
    ('Michael Johnson'),
    ('Emily Davis'),
    ('William Brown');
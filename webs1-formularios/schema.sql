-- Esquema de la base de dades "formulari".
-- NOTA: reconstruït a partir de les consultes del codi PHP (la memòria només en mostra captures de dades).
-- Revisa tipus i longituds si vols fer-lo coincidir exactament amb l'original.
CREATE DATABASE IF NOT EXISTS formulari CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE formulari;

-- Usuaris que poden iniciar sessió (admin i conserge). La contrasenya es guarda com a SHA-256.
CREATE TABLE IF NOT EXISTS `administració` (
  nom         VARCHAR(50) PRIMARY KEY,
  contrasenya CHAR(64)    NOT NULL
);
-- Canvia les contrasenyes d'exemple abans d'usar-ho!
INSERT INTO `administració` (nom, contrasenya) VALUES
  ('admin',    SHA2('canvia_admin', 256)),
  ('conserge', SHA2('canvia_conserge', 256));

-- Dades bàsiques del professor (les introdueix el conserge al Formulari 2)
CREATE TABLE IF NOT EXISTS profesores (
  id             INT AUTO_INCREMENT PRIMARY KEY,
  nom            VARCHAR(50)  NOT NULL,
  primerCognom   VARCHAR(50)  NOT NULL,
  segonCognom    VARCHAR(50)  NULL,
  correuProfessor VARCHAR(100) NOT NULL UNIQUE,
  numeroTelefon  CHAR(9)      NOT NULL UNIQUE,
  codigo         VARCHAR(6)   NOT NULL        -- codi aleatori de registre enviat per correu
);

-- Dades que completa el professor al Formulari 3
CREATE TABLE IF NOT EXISTS profesores2 (
  id               INT PRIMARY KEY,
  fecha_nacimiento DATE         NOT NULL,
  dni              VARCHAR(9)   NOT NULL UNIQUE,
  foto             VARCHAR(255) NOT NULL,
  FOREIGN KEY (id) REFERENCES profesores(id) ON DELETE CASCADE
);

-- Titulacions del professor (tipus d'estudi + nom)
CREATE TABLE IF NOT EXISTS TitolProfe (
  id     INT PRIMARY KEY,
  tipus  VARCHAR(30)  NOT NULL,
  nombre VARCHAR(150) NOT NULL,
  FOREIGN KEY (id) REFERENCES profesores(id) ON DELETE CASCADE
);
CREATE TABLE IF NOT EXISTS TitolProfe2 (
  id      INT PRIMARY KEY,
  tipus2  VARCHAR(30)  NOT NULL,
  nombre2 VARCHAR(150) NOT NULL,
  FOREIGN KEY (id) REFERENCES profesores(id) ON DELETE CASCADE
);

-- Catàleg de títols disponibles al desplegable (s'amplia quan algú tria "Altre")
CREATE TABLE IF NOT EXISTS titulos (
  id     INT AUTO_INCREMENT PRIMARY KEY,
  nombre VARCHAR(150) NOT NULL
);

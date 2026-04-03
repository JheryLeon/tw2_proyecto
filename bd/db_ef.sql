-- Crear base de datos
CREATE DATABASE db_ef;

-- Usar la base de datos
USE db_ef;

-- Crear tabla users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(250),
    apellido VARCHAR(250),
    correo VARCHAR(250),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

ALTER TABLE users
  ADD COLUMN password VARCHAR(255) ,
  ADD COLUMN language VARCHAR(10) DEFAULT 'es';
ADD COLUMN telefono VARCHAR(20) NULL;


-- Crear tabla eventos
CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(250) NOT NULL,
    fecha DATE NOT NULL,
    ubicacion VARCHAR(250) NOT NULL,
    capacidad INT NULL,
    publico_objetivo VARCHAR(100) DEFAULT 'General',
    organizador VARCHAR(250) NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
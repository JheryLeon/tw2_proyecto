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
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    password VARCHAR(255),
    language VARCHAR(10) DEFAULT 'es',
    role VARCHAR(20) DEFAULT 'user',
    telefono VARCHAR(20)
);

-- Crear tabla eventos
CREATE TABLE eventos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(250) NOT NULL,
    fecha DATE NOT NULL,
    ubicacion VARCHAR(250) NOT NULL,
    capacidad INT NULL,
    publico_objetivo VARCHAR(100) DEFAULT 'General',
    organizador VARCHAR(250) NULL,
    descripcion_es TEXT,
    descripcion_en TEXT,
    user_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
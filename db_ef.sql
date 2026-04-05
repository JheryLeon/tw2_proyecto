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

-- Insertar usuarios de prueba
INSERT INTO users (nombre, apellido, correo, password, language, role, telefono) VALUES
('test', 'admin', 'test@gmail.com', '$2y$10$abc123def456', 'es', 'admin', '00000000'),
('test2', 'user', 'test2@gmail.com', '$2y$10$abc123def456', 'en', 'user', '11111111');

-- Insertar eventos de prueba
INSERT INTO eventos (titulo, fecha, ubicacion, capacidad, publico_objetivo, organizador, descripcion_es, descripcion_en, user_id) VALUES
('Conferencia de Tecnología', '2026-05-15', 'Auditorio Principal', 100, 'Estudiantes', 'Ing. Jared López', 'Primera conferencia tecnológica del año', 'First technology conference of the year', 1),
('Taller de Programación', '2026-05-20', 'Laboratorio 101', 30, 'Estudiantes', 'Lic. Maria García', 'Taller práctico de programación web', 'Practical web programming workshop', 1);


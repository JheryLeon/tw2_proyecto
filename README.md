# CakePHP Application - Entregable Final

![Build Status](https://github.com/cakephp/app/actions/workflows/ci.yml/badge.svg?branch=5.x)
[![Total Downloads](https://img.shields.io/packagist/dt/cakephp/app.svg?style=flat-square)](https://packagist.org/packages/cakephp/app)

Este proyecto implementa un sistema de autenticación y gestión de usuarios y eventos con CakePHP 5.x.

---

## Requisitos Implementados

### Autenticación de Usuarios

- **Validación de credenciales**: Verifica correo y contraseña contra la base de datos
- **Contraseñas con hashing (bcrypt)**: Las contraseñas se almacenan de forma segura usando `DefaultPasswordHasher`
- **Manejo de sesiones**: Usa el autenticador `Authentication.Session`
- **Protección de rutas**: Todas las rutas del CRUD requieren autenticación
- **Cambio de contraseña**: Sistema separado para cambiar contraseña (contraseña actual + nueva)

### CRUD de Usuarios

- **Index**: Listado de usuarios con paginación
- **View**: Ver detalles de un usuario
- **Add**: Crear nuevos usuarios (contraseña se hashea automáticamente)
- **Edit**: Editar datos del usuario (sin cambiar contraseña)
- **Change Password**: Cambiar contraseña (requiere contraseña actual)
- **Delete**: Eliminar usuarios con confirmación

### CRUD de Eventos

- **Index**: Listado de eventos
- **View**: Ver detalles de un evento
- **Add**: Crear nuevos eventos
- **Edit**: Editar eventos existentes
- **Delete**: Eliminar eventos

### Diseño

- **Bootstrap 5**: Framework CSS moderno y responsivo
- **TemaClaro/Oscuro**: Botón para cambiar entre modo claro y oscuro
- **Iconos Bootstrap**: Iconos en la interfaz
- **Diseño responsivo**: Se adapta a dispositivos móviles

---

## Base de Datos
-- Datos configurados en config/app_local.php

-- Crear base de datos
CREATE DATABASE db_ef;

-- Usar la base de datos
USE db_ef;

### Tabla Users

```sql
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nombre VARCHAR(250),
    apellido VARCHAR(250),
    correo VARCHAR(250),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    password VARCHAR(255),
    language VARCHAR(10) DEFAULT 'es',
    telefono VARCHAR(20)
);
```

### Tabla Eventos

```sql
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
```

---

## Estructura de Archivos

### Autenticación

| Archivo | Descripción |
|---------|-------------|
| `src/Application.php` | Configuración del middleware de autenticación |
| `src/Controller/AppController.php` | Carga del componente Authentication |
| `src/Controller/UsersController.php` | Métodos: login, logout, changePassword |
| `templates/Users/login.php` | Formulario de login |
| `templates/Users/change_password.php` | Formulario para cambiar contraseña |
| `src/Command/MigratePasswordsCommand.php` | Comando para migrar passwords a bcrypt |

### CRUD Users

| Archivo | Descripción |
|---------|-------------|
| `src/Controller/UsersController.php` | Métodos: index, view, add, edit, delete, changePassword |
| `src/Model/Table/UsersTable.php` | Tabla con validaciones |
| `src/Model/Entity/User.php` | Entidad con campos y setter de password |
| `templates/Users/index.php` | Listado de usuarios |
| `templates/Users/view.php` | Ver usuario |
| `templates/Users/add.php` | Crear usuario |
| `templates/Users/edit.php` | Editar usuario |
| `templates/Users/change_password.php` | Cambiar contraseña |

### CRUD Eventos

| Archivo | Descripción |
|---------|-------------|
| `src/Controller/EventosController.php` | Métodos: index, view, add, edit, delete |
| `src/Model/Table/EventosTable.php` | Tabla con validaciones |
| `src/Model/Entity/Evento.php` | Entidad |
| `templates/Eventos/index.php` | Listado de eventos |
| `templates/Eventos/view.php` | Ver evento |
| `templates/Eventos/add.php` | Crear evento |
| `templates/Eventos/edit.php` | Editar evento |

### Diseño

| Archivo | Descripción |
|---------|-------------|
| `templates/layout/default.php` | Layout principal con Bootstrap 5 y tema oscuro |
| CDN Bootstrap 5 | Framework CSS |
| CDN Bootstrap Icons | Iconos |

---

## Rutas

### Usuarios

| Ruta | Descripción | Acceso |
|------|-------------|--------|
| `/` | CRUD de usuarios | Requiere login |
| `/login` | Formulario de login | Público |
| `/logout` | Cerrar sesión | Requiere login |
| `/users` | Listado de usuarios | Requiere login |
| `/users/add` | Crear usuario | Requiere login |
| `/users/view/:id` | Ver usuario | Requiere login |
| `/users/edit/:id` | Editar usuario | Requiere login |
| `/users/changePassword/:id` | Cambiar contraseña | Requiere login |
| `/users/delete/:id` | Eliminar usuario | Requiere login |

### Eventos

| Ruta | Descripción | Acceso |
|------|-------------|--------|
| `/eventos` | Listado de eventos | Público |
| `/eventos/add` | Crear evento | Requiere login |
| `/eventos/view/:id` | Ver evento | Público |
| `/eventos/edit/:id` | Editar evento | Requiere login |
| `/eventos/delete/:id` | Eliminar evento | Requiere login |

---

## Cómo Ejecutar

### Iniciar el servidor

```bash
cd /home/live/cakePhp/entregablefinal/app_ef
bin/cake server -H 0.0.0.0
```

### Acceder a la aplicación

- URL: `http://IP:8765/`
- Sin login: Redirige a `/login`
- Con login: Muestra el CRUD de usuarios

---

## Características de Seguridad

### Contraseñas

- Las contraseñas se hashean con bcrypt antes de guardar
- El campo `password` está oculto en respuestas JSON
- Cambio de contraseña requiere contraseña actual

### Protección de Rutas

- Solo usuarios autenticados pueden acceder al CRUD
- El login es público
- Las rutas no autenticadas redirigen a `/login`

---

## Com Útiles

### Migrar contraseñas a bcrypt

Si tienes usuarios con passwords en texto plano:

```bash
bin/cake users migrate_passwords
```

---

## Usuarios de Prueba

| Usuario | Correo | Password |
|---------|--------|----------|
| Test  | test@gmail.com | test123 |

---

## Tecnologías Usadas

- **CakePHP 5.x** - Framework PHP
- **cakephp/authentication** - Plugin de autenticación
- **Bootstrap 5** - Framework CSS
- **Bootstrap Icons** - Iconos
- **MySQL** - Base de datos

---

## Notas

- El sistema usa sesiones PHP para mantener la autenticación
- El tema claro/oscuro se guarda en localStorage del navegador
- El diseño es completamente responsivo
- Los formularios usan validación del lado del servidor

# CakePHP Application - Sistema de Gestión de Eventos con Perfiles Multilingües

Proyecto desarrollado con CakePhp

---

## Pasos para instalar

Después de clonar el repositorio, ejecutar estos comandos:

```bash
# 1. Instalar dependencias
composer install

# 2. Copiar archivo de configuración de base de datos
cp config/app_local.example.php config/app_local.php

# 3. Editar config/app_local.php con tus credenciales de MySQL

# 4. Importar la base de datos
mysql -h TU_HOST -u TU_USUARIO -pTU_PASSWORD db_ef < db_ef.sql

# 5. Dar permisos a carpetas
chmod -R 777 tmp logs

# 6. Iniciar servidor
bin/cake server -H 0.0.0.0  o podman-compose up
```
---

## Características del Proyecto

### Funcionalidades Implementadas

- ✅ Registro y autenticación de usuarios con contraseña hasheada (bcrypt)
- ✅ Perfiles con idioma de preferencia (español/inglés)
- ✅ CRUD completo de usuarios y eventos
- ✅ Cada usuario gestiona solo sus propios eventos (relación user_id)
- ✅ Descripciones bilingües en eventos (descripcion_es, descripcion_en)
- ✅ Cambio de idioma dinámico desde el navbar
- ✅ Filtros de búsqueda en eventos (texto, público objetivo, fecha)
- ✅ Diseño Bootstrap 5 con tema claro/oscuro
- ✅ Control de versiones con Git
- ✅ Documentación de uso de IA (Bitácora)
- ✅ Configuración Docker/Podman para despliegue

---

## Instalación - CakePHP Directo (Sin Docker)

### Requisitos

- PHP 8.1 o superior
- Composer
- MySQL/MariaDB
- Apache/Nginx (o usar servidor built-in de PHP)

### Pasos de Instalación

1. **Clonar el proyecto**
   ```bash
   git clone https://github.com/tu-usuario/app_ef.git
   cd app_ef
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   ```

3. **Configurar base de datos**

   Editar `config/app_local.php` con las credenciales de MySQL:
   ```php
   'Datasources' => [
       'default' => [
           'host' => '',  // IP de tu servidor MySQL
           'port' => '3306',
           'username' => '',
           'password' => '',
           'database' => 'db_ef',
       ]
   ]
   ```

4. **Importar base de datos**
   ```bash
   mysql -h (IP) -u (usuario) -p(password) db_ef < db_ef.sql
   ```

5. **Permisos de carpetas**
   ```bash
   chmod -R 777 tmp logs
   ```

6. **Iniciar servidor**
   ```bash
   bin/cake server -H 0.0.0.0 -p 8765
   ```

7. **Acceder a la aplicación**

   Abrir en el navegador: `http://localhost:8765`

---

## Instalación - Docker/Podman

### Requisitos

- Docker o Podman instalado
- docker-compose o podman-compose
- Base de datos MySQL/MariaDB externa

### Archivos de Configuración Docker

| Archivo | Descripción |
|---------|-------------|
| `Dockerfile` | Imagen PHP 8.4 con Apache |
| `docker-compose.yml` | Configuración del contenedor web |

### Pasos de Instalación

1. **Clonar el proyecto**
   ```bash
   git clone https://github.com/tu-usuario/app_ef.git
   cd app_ef
   ```

2. **Instalar dependencias**
   ```bash
   composer install
   ```

3. **Permisos de carpetas**
   ```bash
   chmod -R 777 tmp logs
   ```

4. **Configurar base de datos** (si es diferente al default)

   Editar `config/app_local.php` con la IP de tu servidor MySQL

5. **Ejecutar contenedor**
   ```bash
   podman-compose up -d web
   ```

6. **Acceder a la aplicación**

   ```
   http://localhost:8085
   ```

### Configuración del Dockerfile

- PHP 8.4 con Apache
- Extensiones: pdo, pdo_mysql, zip, intl, mbstring, xml
- Puerto expuesto: 8085
- Montaje de carpetas: vendor, logs, tmp

---

## Base de Datos

### Estructura de Tablas

#### Tabla Users

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

#### Tabla Eventos

```sql
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
```

### Importar Base de Datos

El archivo `db_ef.sql` contiene la estructura completa y datos de ejemplo:

```bash
mysql -h (Ip) -u (Usuario) -p(password) db_ef < db_ef.sql
```

Compatible con MySQL y MariaDB.

---

## Internacionalización (i18n)

### Idiomas Soportados

- Español (es) - Por defecto
- Inglés (en)

### Cómo Funciona

1. Cada usuario tiene un campo `language` en su perfil
2. El idioma se puede cambiar desde el navbar (dropdown)
3. La interfaz se actualiza dinámicamente al idioma seleccionado

### Cambio de Idioma

- Desde el navbar: haga clic en el ícono de.globo (🌐) y seleccione el idioma
- Los textos de la interfaz cambian automáticamente

---

## Filtros de Búsqueda en Eventos

El listado de eventos incluye:

- **Búsqueda por texto**: Busca en título, descripción y ubicación
- **Filtro por público objetivo**: Seleccionar categoría
- **Filtro por fecha**: Rango desde/hasta

---

## Rutas del Sistema

### Usuarios

| Ruta | Descripción | Acceso |
|------|-------------|--------|
| `/users` | Listado de usuarios | Requiere login |
| `/users/add` | Crear usuario | Requiere login |
| `/users/view/:id` | Ver usuario | Requiere login |
| `/users/edit/:id` | Editar usuario | Requiere login |
| `/users/changePassword/:id` | Cambiar contraseña | Requiere login |
| `/users/delete/:id` | Eliminar usuario | Requiere login |

### Eventos

| Ruta | Descripción | Acceso |
|------|-------------|--------|
| `/eventos` | Listado de eventos | Requiere login |
| `/eventos/add` | Crear evento | Requiere login |
| `/eventos/view/:id` | Ver evento | Requiere login |
| `/eventos/edit/:id` | Editar evento | Requiere login |
| `/eventos/delete/:id` | Eliminar evento | Requiere login |

---

## Características de Seguridad

### Contraseñas

- Las contraseñas se hashean con bcrypt antes de guardar
- El campo `password` está oculto en respuestas JSON
- Cambio de contraseña requiere contraseña actual

### Protección de Rutas

- Solo usuarios autenticados pueden acceder al CRUD
- Las rutas no autenticadas redirigen a `/login`
- Cada usuario solo puede ver/editar sus propios eventos

---

## Tecnologías Utilizadas

- **CakePHP 5.x** - Framework PHP
- **cakephp/authentication** - Plugin de autenticación
- **Bootstrap 5** - Framework CSS
- **Bootstrap Icons** - Iconos
- **MySQL/MariaDB** - Base de datos
- **Docker/Podman** - Contenedores

---

## Notas Adicionales

- El sistema usa sesiones PHP para mantener la autenticación
- El tema claro/oscuro se guarda en localStorage del navegador
- El diseño es completamente responsivo
- Los formularios usan validación del lado del servidor
- Los eventos son propios de cada usuario (filtrados por user_id)

---

## Bitácora de IA

Ver el archivo `BITACORA_IA.md` para documentación completa del uso de herramientas de IA durante el desarrollo del proyecto.

---

## Repositorio Git

El proyecto está versionado en Git. Para clonar:

```bash
git clone https://github.com/tu-usuario/app_ef.git
```

---


*Proyecto - Tecnología Web II*
*Fecha: Abril 2026*
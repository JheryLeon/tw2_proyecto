# CakePHP Application - Sistema de Gestión de Eventos con Perfiles Multilingües y Roles

Proyecto desarrollado con CakePHP con CRUD de usuarios y eventos

---

## Características del Proyecto

### Funcionalidades Implementadas

- ✅ Registro y autenticación de usuarios con contraseña hasheada (bcrypt)
- ✅ Sistema de roles: Administrador y Usuario
- ✅ Perfiles con idioma de preferencia (español/inglés)
- ✅ CRUD completo de usuarios y eventos
- ✅ Permisos por rol:
  - **Admin**: Ve todos los usuarios y eventos, puede crear/editar/eliminar cualquier usuario
  - **User**: Solo ve su propia cuenta, solo sus propios eventos
- ✅ Descripciones bilingües en eventos (descripcion_es, descripcion_en)
- ✅ Filtros de búsqueda en eventos (texto, público objetivo, fecha)
- ✅ Diseño Bootstrap 5 con tema claro/oscuro (toggle)
- ✅ Mensajes de alerta con diseño Bootstrap
- ✅ Panel de usuario en navbar (muestra nombre del usuario logeado)
- ✅ Eliminación de cuenta propia cierra sesión automáticamente
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

   Modifica la carpeta `config/app_local.php` con tus credenciales de MySQL:
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

3. **Configurar base de datos**
   
   Editar `docker-compose.yml` con los datos de tu servidor MySQL:
   ```yaml
   environment:
     - DB_HOST=TU_IP_MYSQL
     - DB_PORT=3306
     - DB_NAME=db_ef
     - DB_USER=TU_USUARIO
     - DB_PASSWORD=TU_PASSWORD
   ```

4. **Copiar archivo de configuración**
   ```bash
   cp config/app_local.example.php config/app_local.php
   ```
   
   Editar `config/app_local.php` con las credenciales de MySQL.

5. **Permisos de carpetas**
   ```bash
   chmod -R 777 tmp logs
   ```

6. **Ejecutar contenedor**
   ```bash
   podman-compose up -d --build
   ```

7. **Acceder a la aplicación**

   ```
   http://localhost:8085
   ```

---

## Sistema de Roles

### Roles Definidos

| Rol | Descripción |
|-----|-------------|
| `admin` | Administrador - acceso total |
| `user` | Usuario regular - acceso limitado |

### Permisos por Rol

#### Administrador (admin)
- ✅ Ver todos los usuarios
- ✅ Crear nuevos usuarios
- ✅ Editar cualquier usuario
- ✅ Eliminar cualquier usuario
- ✅ Ver todos los eventos
- ✅ Editar/eliminar cualquier evento
- ✅ Asignar rol a usuarios

#### Usuario (user)
- ✅ Ver solo su propia cuenta
- ✅ Editar solo su propia cuenta
- ✅ Eliminar su propia cuenta (cierra sesión automáticamente)
- ✅ Ver solo sus propios eventos
- ✅ Crear/editar/eliminar solo sus propios eventos

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
    role VARCHAR(20) DEFAULT 'user',
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

---

## Internacionalización (i18n)

### Idiomas Soportados

- Español (es) - Por defecto
- Inglés (en)

### Cómo Funciona

1. Cada usuario tiene un campo `language` en su perfil
2. Al iniciar sesión, la interfaz se muestra en el idioma configurado del usuario
3. Los textos de la interfaz, mensajes y botones se traducen automáticamente

---

## Filtros de Búsqueda en Eventos

El listado de eventos incluye:

- **Búsqueda por texto**: Busca en título y descripción
- **Filtro por público objetivo**: Seleccionar categoría
- **Filtro por fecha**: Rango desde/hasta

---

## Rutas del Sistema

### Usuarios

| Ruta | Descripción | Acceso |
|------|-------------|--------|
| `/users` | Listado de usuarios | Requiere login |
| `/users/add` | Crear usuario | Solo admin |
| `/users/view/:id` | Ver usuario | Requiere login |
| `/users/edit/:id` | Editar usuario | Propia cuenta o admin |
| `/users/changePassword/:id` | Cambiar contraseña | Propia cuenta o admin |
| `/users/delete/:id` | Eliminar usuario | Propia cuenta o admin |

### Eventos

| Ruta | Descripción | Acceso |
|------|-------------|--------|
| `/eventos` | Listado de eventos | Requiere login |
| `/eventos/add` | Crear evento | Requiere login |
| `/eventos/view/:id` | Ver evento | Requiere login |
| `/eventos/edit/:id` | Editar evento | Propio evento o admin |
| `/eventos/delete/:id` | Eliminar evento | Propio evento o admin |

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
- Solo el admin puede crear usuarios

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
- Los usuarios regulares solo ven su propia cuenta en el listado

---

## Bitácora de IA

Ver el archivo `BITACORA_IA.md` para documentación completa del uso de herramientas de IA durante el desarrollo del proyecto.

---

*Proyecto - Tecnología Web II*
*Universidad Privada Domingo Savio (UPDS)*
*Abril 2026*

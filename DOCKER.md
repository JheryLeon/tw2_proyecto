# CakePHP App - Docker

Este proyecto incluye configuración Docker para ejecutar la aplicación.

## Requisitos

- Docker o Podman
- docker-compose o podman-compose
- Base de datos MySQL/MariaDB externa

---

## Configuración de Base de Datos

### Base de datos externa (Configuración actual)

La aplicación se conecta a una base de datos MySQL externa (servidor: 192.168.56.250).

Editar `config/app_local.php` si necesitas cambiar las credenciales:

```php
'Datasources' => [
    'default' => [
        'host' => '',  // IP de tu servidor MySQL
        'port' => '3306',
        'username' => '',
        'password' => '',
        'database' => 'db_ef',
    ],
],
```

---

## Archivos

- `Dockerfile` - Imagen de la aplicación PHP + Apache
- `docker-compose.yml` - Configuración del contenedor web
- `.dockerignore` - Archivos a excluir del build

---

## Instrucciones de uso

### 1. Prerrequisitos

- Tener Composer instalado
- Tener una base de datos MySQL/MariaDB configurada

### 2. Instalar dependencias

```bash
cd /home/live/cakePhp/entregablefinal/app_ef
composer install
```

### 3. Configurar base de datos

Editar `config/app_local.php` con los datos de tu servidor MySQL:

```php
'host' => 'TU_IP_SERVIDOR_MYSQL',
'username' => 'TU_USUARIO',
'password' => 'TU_PASSWORD',
'database' => 'TU_BASE_DE_DATOS',
```

### 4. Ejecutar contenedor

```bash
podman-compose up -d web
```

### 5. Acceder a la aplicación

```
http://localhost:8085
```

---

## Servicios

| Servicio | Puerto | Descripción |
|----------|--------|-------------|
| web | 8085 | Aplicación CakePHP |

**Nota**: La base de datos es externa (servidor MySQL).

---

## Configuración de la App

- **PHP**: 8.4 con Apache
- **Framework**: CakePHP 5.x

---

## Troubleshooting

### Error de conexión a la base de datos
1. Verificar que el servidor MySQL esté corriendo
2. Verificar credenciales en `config/app_local.php`
3. Verificar que la IP sea accesible desde el contenedor
4. Verificar que la base de datos exista

### Error de permisos
```bash
chmod -R 777 tmp logs
```

### Detener el contenedor
```bash
podman-compose down
```

### Ver logs
```bash
podman-compose logs -f web
```
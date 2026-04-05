# Bitácora de Uso de Inteligencia Artificial

## Proyecto: Sistema de Gestión de Eventos con Perfiles Multilingües y Roles

---

## 1. Autenticación y Hash de Contraseñas

### Prompt:
> Cómo implementar hashing de contraseñas en CakePHP 5.x con autenticación?

### Respuesta de IA:
Se sugirió usar `DefaultPasswordHasher` de Authentication plugin de CakePHP.

### Decisión:
**Aceptada con modificaciones.** Se implementó en la entidad `User.php` con el método `_setPassword()` que verifica longitud mínima de 6 caracteres.

---

## 2. Separación de Edición de Usuario y Cambio de Contraseña

### Prompt:
> El formulario de edición de usuario está sobrescribiendo la contraseña con hash vacío

### Problema:
Al editar usuario, el campo password se enviaba vacío y sobrescribía el hash en la base de datos.

### Respuesta de IA:
Se sugirió separar el cambio de contraseña en una acción distinta.

### Decisión:
**Aceptada.** Se creó el método `changePassword()` en `UsersController.php` y se remove el campo password del formulario de edición.

---

## 3. Diseño Bootstrap 5 con Tema Oscuro

### Prompt:
> Cómo implementar modo oscuro/claro en CakePHP con Bootstrap y persistencia?

### Respuesta de IA:
Se sugirió usar CSS con `data-bs-theme` y localStorage para persistencia.

### Decisión:
**Aceptada.** Se implementó en `templates/layout/default.php` con:
- Botón toggle para cambiar tema
- CSS específico para modo oscuro
- Persistencia con localStorage

---

## 4. Internacionalización (i18n)

### Prompt:
> Cómo implementar multilingüe en CakePHP 5.x donde cada usuario vea la interfaz en su idioma?

### Problema:
Los archivos .po no se estaban usando, la interfaz siempre mostraba textos en español del código.

### Respuesta de IA:
Se sugirió:
1. Crear archivos .po en `resources/locales/`
2. Configurar locale en `config/app.php`
3. Usar `I18n::setLocale()` en el controlador basado en el idioma del usuario

### Decisión:
**Aceptada.** Se implementó:
- Archivos `es_ES/default.po` y `en_US/default.po`
- Cambio de locale en `AppController.php` según `user.language`
- Los textos del código (como `__('Eventos')`) ahora se traducen

---

## 5. Filtros de Búsqueda en Eventos

### Prompt:
> Cómo agregar filtros por texto, público objetivo y fecha en el listado de CakePHP?

### Respuesta de IA:
Se sugirió usar query strings y construir el query dinámicamente en el controlador.

### Decisión:
**Aceptada.** Se implementó en `EventosController.php`:
- Filtro por búsqueda (titulo, descripcion, ubicacion)
- Filtro por público objetivo
- Filtro por rango de fechas (desde/hasta)

---

## 6. Sistema de Roles (Admin/User)

### Prompt:
> Cómo implementar roles de usuario en CakePHP donde admin puede ver todos los usuarios y user solo su propia cuenta?

### Problema:
Todos los usuarios podían ver y editar todos los usuarios y eventos. Necesitábamos restricción por rol.

### Respuesta de IA:
Se sugirió:
1. Agregar campo `role` a la tabla users
2. Crear método `isAdmin()` en la entidad
3. Verificar rol en cada controlador

### Decisión:
**Aceptada.** Se implementó:
- Campo `role` en tabla users (admin/user)
- Validación en `UsersTable.php`
- Métodos `isAdmin()` y `getCurrentUserId()` en `AppController.php`
- Restricciones en `UsersController` y `EventosController`
- Vistas actualizadas con columna de rol y badges

---

## 7. Mensajes Flash con Bootstrap

### Prompt:
> Cómo estilizar los mensajes flash (success, error) con Bootstrap en CakePHP?

### Respuesta de IA:
Se sugirió crear templates en `templates/element/flash/` con clases Bootstrap.

### Decisión:
**Aceptada.** Se crearon:
- `default.php` → `alert alert-info`
- `success.php` → `alert alert-success`
- `error.php` → `alert alert-danger`
- Todos con botón de cerrar (dismissible)

---

## 8. Usuario Logeado en Navbar

### Prompt:
> Cómo mostrar el nombre del usuario logeado en el navbar de CakePHP?

### Respuesta de IA:
Se sugirió usar `$this->request->getAttribute('identity')` para obtener datos del usuario.

### Decisión:
**Aceptada.** Se agregó en `templates/layout/default.php`:
```php
<span class="navbar-text">
    <i class="bi bi-person-circle"></i> <?= h($identity->nombre) ?>
</span>
```

---

## 9. Eliminación de Cuenta Propia

### Prompt:
> Qué hacer cuando un usuario elimina su propia cuenta?

### Problema:
Al eliminar su propia cuenta, el sistema intentaba usar un usuario ya eliminado y fallaba.

### Respuesta de IA:
Se sugirió hacer logout antes de redirigir.

### Decisión:
**Aceptada.** Se modificó `UsersController::delete()` para:
- Verificar si el usuario eliminado es el mismo que está logeado
- Si es así, hacer `$this->Authentication->logout()`
- Redirigir a login

---

## 10. Validación de Formularios

### Prompt:
> Los usuarios no se pueden crear, el botón guardar no funciona

### Problema:
Validación muy estricta que impedía guardar.

### Respuesta de IA:
Se sugirió revisar la validación en `UsersTable.php` y agregar `required => true` en las vistas.

### Decisión:
**Aceptada.** Se modificó:
- Validación de nombre, apellido como requeridos
- Validación de correo con email()
- Campo role con setter para normalizar valores inválidos
- Vistas con `required => true`

---

## Resumen de Decisiones

| Aspecto | Decisión |
|---------|----------|
| Hash contraseñas | Aceptada - Entity User con _setPassword |
| Edit vs Change Password | Aceptada - Métodos separados |
| Tema oscuro | Aceptada - CSS + localStorage |
| Internacionalización | Aceptada - I18n + archivos .po |
| Filtros eventos | Aceptada - Query con condiciones dinámicas |
| Sistema de roles | Aceptada - Campo role + permisos en controladores |
| Flash messages | Aceptada - Templates Bootstrap |
| Usuario en navbar | Aceptada - Identity display |
| Eliminar cuenta propia | Aceptada - Auto logout |
| Validación formularios | Aceptada - Modificaciones en Table + vistas |

---

## Tecnologías y Herramientas IA Usadas

- **Asistentes de código**: Suggestiones de código y diseño
- **Refactorización**: Mejora de estructura de controladores
- **Documentación**: Ayuda para escribir README y bitácoras

---

*Documento generado como evidencia del uso de IA en el desarrollo del proyecto.*
*Proyecto: Tecnología Web II - Universidad Privada Domingo Savio (UPDS)*
*Fecha: Abril 2026*

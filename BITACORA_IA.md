# Bitácora de Uso de Inteligencia Artificial

## Proyecto: Sistema de Gestión de Eventos con Perfiles Multilingües

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

## Resumen de Decisiones

| Aspecto | Decisión |
|---------|----------|
| Hash contraseñas | Aceptada - Entity User con _setPassword |
| Edit vs Change Password | Aceptada - Métodos separados |
| Tema oscuro | Aceptada - CSS + localStorage |
| Internacionalización | Aceptada - I18n + archivos .po |
| Filtros eventos | Aceptada - Query con condiciones dinámicas |

---

*Documento generado como evidencia del uso de IA en el desarrollo del proyecto.*
*Fecha: Abril 2026*
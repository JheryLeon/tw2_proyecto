# Sistema de Gestión de Eventos con Perfiles de Usuario Multilingües

## Proyecto Final Individual – Tecnología Web II

### Universidad Privada Domingo Savio (UPDS)

### Carrera: Ingeniería de Sistemas

### Docente: Ing. Jared López L.

---

## Introducción

En la actualidad, personas y organizaciones necesitan herramientas digitales que les permitan gestionar sus actividades de forma eficiente y adaptada a la diversidad lingüística y cultural en la que viven y trabajan. Muchas aplicaciones de gestión de eventos y tareas están diseñadas para un solo idioma, lo que limita su uso en contextos globalizados y en comunidades con diferentes lenguas. Esta situación plantea el reto de construir sistemas web con soporte multilingüe y con una sensibilidad básica hacia las particularidades culturales de los usuarios.

Desde el enfoque socioformativo, el proyecto formativo se concibe como una oportunidad para que el estudiante desarrolle competencias técnicas, éticas y sociales al resolver problemas del contexto. En la asignatura Tecnología Web II de la Universidad Privada Domingo Savio (UPDS), el uso de frameworks y tecnologías web no se orienta únicamente a producir código funcional, sino a crear soluciones pertinentes para un mundo globalizado y cambiante.

En este marco, se plantea el desarrollo individual de un sistema de gestión de eventos con perfiles de usuario multilingües. El sistema permite a cada usuario gestionar sus eventos personales en un entorno adaptado a su idioma de preferencia, integrando: registro y autenticación, perfiles con información básica e idioma, CRUD de eventos con descripciones traducibles, filtros de búsqueda y theme toggle. Para ello se utiliza el framework CakePHP 5.x con base de datos MariaDB, control de versiones con Git y asistentes de inteligencia artificial como apoyo al proceso de programación.

El objetivo general del proyecto es diseñar e implementar un sistema web de gestión de eventos que responda a la necesidad de administrar actividades en contextos multilingües, consolidando competencias en desarrollo web estructurado, internacionalización, uso responsable de IA y reflexión sobre la inclusión lingüística y cultural, en coherencia con el modelo educativo por competencias de la UPDS.

---

## Métodos

El proyecto se desarrolla con un enfoque aplicado, orientado a la construcción de un prototipo funcional que responde a un problema de contexto: la gestión de eventos por parte de usuarios con distintos idiomas. Se sigue la lógica del proyecto formativo socioformativo (identificación del problema, contextualización, actuación, mejora y socialización), buscando integrar el aprendizaje técnico con la formación ética y social del estudiante.

Se emplea el framework web CakePHP 5.x, basado en el patrón MVC (Modelo-Vista-Controlador), que facilita la organización del código y siguiendo las mejores prácticas de desarrollo PHP moderno. Como motor de base de datos se utiliza MariaDB, para almacenar usuarios, perfiles e información de eventos. Se utiliza Git como sistema de control de versiones, con un repositorio remoto en GitHub para registrar el historial de cambios y evidenciar el proceso de desarrollo. Además, se configuran mecanismos básicos de internacionalización (i18n) para soportar dos idiomas en la interfaz: español e inglés, mediante archivos de idioma, funciones de traducción y selección de idioma según la preferencia del usuario.

Durante el desarrollo se recurrió a asistentes de inteligencia artificial como apoyo para obtener sugerencias de código, ideas de diseño y apoyo en la refactorización. El uso de estas herramientas se documenta en una bitácora llamada BITACORA_IA.md, registrando los prompts más relevantes, las respuestas obtenidas y las decisiones del estudiante (aceptación, modificación o rechazo de las propuestas).

El proceso de trabajo se estructuró en las siguientes etapas:

1. **Identificación del problema**: definición del escenario donde se necesitan eventos multilingües para una institución educativa.
2. **Análisis y diseño**: modelado de entidades (usuarios, eventos), casos de uso y modelo de datos con relaciones entre tablas.
3. **Implementación**: desarrollo del registro y autenticación, perfil multilingüe, CRUD de eventos, filtros y theme toggle, integrado al framework CakePHP.
4. **Configuración de base de datos**: creación de la base de datos db_ef, tablas users y eventos, y conexión desde la aplicación.
5. **Pruebas y mejora**: verificación de funcionalidad, internacionalización, filtros de búsqueda y ajustes de diseño Bootstrap.
6. **Documentación y socialización**: elaboración del README técnico, de la documentación en Docker y de las evidencias del sistema en funcionamiento.

---

## Resultados

El resultado del proyecto es un sistema web individual de gestión de eventos con perfiles de usuario multilingües, utilizando un servidor web (Apache+PHP) y un motor de base de datos (MariaDB). El sistema permite a cada usuario registrarse, autenticarse y administrar sus propios eventos, en una interfaz que se adapta al idioma que el usuario ha configurado en su perfil.

El módulo de autenticación permite crear nuevas cuentas, iniciar y cerrar sesión, restringiendo el acceso a la gestión de eventos únicamente a usuarios autenticados. Las contraseñas se almacenan de forma segura utilizando el algoritmo de hashing bcrypt. Cada usuario dispone de un perfil con datos personales (nombre, apellido, correo, teléfono) y un campo de idioma preferido. A partir de esta preferencia, la aplicación carga las traducciones correspondientes para menús, botones, mensajes de éxito y error, y otros textos de la interfaz.

El módulo de eventos implementa un CRUD completo: creación, listado, edición y eliminación de eventos asociados al usuario autenticado. Cada evento incluye: título, fecha, ubicación, capacidad, público objetivo, organizador, descripción en español (descripcion_es) y descripción en inglés (descripcion_en). La relación entre usuarios y eventos se establece mediante una clave foránea (user_id), garantizando que cada usuario solo pueda visualizar y gestionar sus propios eventos.

El sistema incorpora filtros y búsquedas sobre los eventos (por texto, público objetivo y rango de fechas), cuyos textos y mensajes se muestran también en el idioma elegido. Adicionalmente, se implementó un theme toggle que permite al usuario elegir entre modo claro y modo oscuro, con persistencia en localStorage del navegador.

El código fuente se encuentra versionado en un repositorio remoto de GitHub, que incluye un archivo README con instrucciones de instalación y ejecución, documentación sobre Docker, y las indicaciones necesarias para poner en funcionamiento el sistema.

### Especificaciones Técnicas del Sistema

- **Framework**: CakePHP 5.x
- **Base de datos**: MariaDB (MySQL compatible)
- **Servidor web**: Apache con PHP 8.4
- **Diseño**: Bootstrap 5 con theme toggle
- **Idiomas soportados**: Español (es), Inglés (en)
- **Autenticación**: bcrypt hashing
- **Contenedores**: Docker/Podman configurado

---

## Discusión

El desarrollo del sistema de gestión de eventos con perfiles de usuario multilingües permitió integrar diversos componentes de la formación en Tecnología Web II en la UPDS: uso de frameworks estructurados (CakePHP MVC), bases de datos relacionales (MariaDB), internacionalización (i18n con archivos de idioma), y buenas prácticas de desarrollo como el uso de separate password change, validación de formularios y protección de rutas.

La elección de MariaDB acercó la experiencia a prácticas habituales en entornos profesionales, favoreciendo una comprensión más realista del ciclo de vida de una aplicación web. La configuración de Docker/Podman permitió crear un entorno de desarrollo reproducible y facilitar el despliegue.

Desde la perspectiva socioformativa, el proyecto contribuyó a que el estudiante reconozca la relevancia de la diversidad lingüística y cultural en el diseño de sistemas. La necesidad de adaptar la interfaz, los mensajes y el contenido a diferentes idiomas permitió reflexionar sobre la inclusión de usuarios que habitualmente quedan excluidos cuando el software se ofrece solo en una lengua dominante. Al mismo tiempo, el uso de asistentes de inteligencia artificial como apoyo al desarrollo promovió el pensamiento crítico y la responsabilidad: el estudiante tuvo que evaluar las sugerencias, comprender el código propuesto y decidir de manera fundamentada cómo integrarlo.

Entre las principales dificultades encontradas se pueden mencionar la configuración adecuada de la internacionalización con CakePHP, la gestión coherente de las traducciones en los distintos módulos, y la configuración de permisos en entornos de desarrollo y producción (tanto directo como en contenedores Docker). Sin embargo, la superación de estos retos fortaleció la autonomía técnica, la capacidad de resolución de problemas y la conciencia sobre la importancia de la documentación y de las buenas prácticas.

El sistema desarrollado ofrece una base sólida para futuras ampliaciones: incorporación de más idiomas, eventos compartidos entre usuarios, integración con calendarios externos, roles de usuario diferenciados (administrador vs usuario regular), o export a PDF de eventos. Más allá del producto técnico, la experiencia del proyecto aporta al proyecto ético de vida del estudiante de Ingeniería de Sistemas de la UPDS, al mostrar que la ingeniería puede contribuir a construir tecnologías más inclusivas y sensibles a la diversidad cultural.

---

## Anexos

### Usuarios de Prueba

| Correo | Contraseña |
|--------|-------------|
| test@gmail.com | test123 |
| test2@gmail.com | test123 |

### Archivos del Proyecto

- **README.md**: Documentación principal de instalación
- **DOCKER.md**: Guía de configuración con Docker/Podman
- **BITACORA_IA.md**: Registro del uso de herramientas de IA
- **db_ef.sql**: Estructura y datos de la base de datos
- **Dockerfile**: Imagen PHP 8.4 con Apache
- **docker-compose.yml**: Configuración de servicios

---

*Proyecto desarrollado como trabajo final de Tecnología Web II*

*Universidad Privada Domingo Savio (UPDS)*

*Abril 2026*
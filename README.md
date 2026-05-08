<p align="center">
  <img src="public/kognit-banner.webp" width="600" alt="Kognit Logo">
</p>

<p align="center">
  <strong>Gestión Académica Moderna</strong><br>
  Plataforma para la administración y seguimiento de procesos en instituciones educativas.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13.x-FF2D20?style=flat-square&logo=laravel" alt="Laravel 13">
  <img src="https://img.shields.io/badge/Vue.js-3.5-4FC08D?style=flat-square&logo=vue.js" alt="Vue 3.5">
  <img src="https://img.shields.io/badge/Tailwind_CSS-4.0-06B6D4?style=flat-square&logo=tailwind-css" alt="Tailwind 4">
  <img src="https://img.shields.io/badge/Inertia.js-3.0-9553E9?style=flat-square&logo=inertia" alt="Inertia 3">
</p>

## Sobre el proyecto

Kognit es una herramienta diseñada para facilitar la gestión académica en colegios, institutos o academias. Puede integrarse como el sistema principal de gestión o utilizarse como una plataforma complementaria para centralizar el seguimiento de cursos, alumnos y docentes.

Actualmente el proyecto se encuentra en desarrollo, buscando ofrecer una interfaz limpia y eficiente para mejorar la organización educativa.

## Características

- **Control de Acceso (RBAC):** Gestión de permisos mediante roles (Admin, Profesor, Estudiante).
- **Interfaz Reactiva:** Navegación fluida sin recargas de página gracias al uso de Inertia.js y Vue 3.5.
- **Arquitectura Moderna:** Uso de las últimas versiones del ecosistema Laravel y Tailwind CSS 4.0.
- **Sistema de Colas y Caché:** Optimizado con Redis para un rendimiento superior.
- **Autenticación Tradicional:** Sistema de acceso seguro mediante correo y contraseña (soporte para Social Auth en planes futuros).

## Stack Tecnológico

- **Backend:** Laravel 13 (PHP 8.3+)
- **Frontend:** Vue.js 3.5 & Inertia.js 3.0
- **Estilos:** Tailwind CSS 4.0
- **Base de Datos:** MySQL / MariaDB
- **Caché/Colas:** Redis
- **Build Tool:** Vite 8.0

## Instalación

1. **Clonar repositorio:**

    ```bash
    git clone https://github.com/imhvit/kognit.git
    cd kognit
    ```

2. **Configuración automática:**

    ```bash
    composer setup
    ```

3. **Configuración manual (opcional):**

    ```bash
    composer install
    npm install
    cp .env.example .env
    php artisan key:generate
    php artisan migrate --seed
    ```

4. **Ejecutar en desarrollo:**
    ```bash
    composer run dev
    ```
    _Este comando inicia simultáneamente `php artisan serve`, el worker de colas y el servidor de Vite._

## Requisitos y Notas

- **Idiomas:** La interfaz de usuario (UI) y los mensajes principales están en **Español**. El código y la configuración base utilizan Inglés. El soporte completo multilenguaje está planeado para versiones futuras.
- **Servidor Web:** Compatible con Apache (recomendado), Nginx o el servidor embebido de Laravel.
- **Redis:** Es necesario tener Redis instalado para el correcto funcionamiento de las sesiones, caché y colas.

## Contribuir

Si deseas contribuir al desarrollo de Kognit:

1. Realiza un **Fork** del repositorio.
2. Crea una rama para tu mejora con nombres en minúscula (ej: `auth`, `fix-ui-auth`, `config-vue-inertia`).
3. Realiza tus cambios y haz commit con mensajes descriptivos en minúscula (ej: `add: nueva funcionalidad`, `fix: error en login`).
4. Envía un **Pull Request**.

## Licencia

Este software es de código abierto bajo la licencia [MIT](LICENSE).

<p align="center">
  Desarrollado por <a href="https://github.com/imhvit">imhvit</a>
</p>

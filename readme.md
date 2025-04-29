# residential-voting-api

## Descripción

Este es un sistema de votaciones web destinado a propietarios de un conjunto residencial. Permite la creación de preguntas y opciones de votación, y permite a los propietarios emitir su voto de manera segura, almacenando y mostrando los resultados en tiempo real. Está desarrollado utilizando **Laravel 11** en el backend y **Vue.js** en el frontend.

## Características

- **Gestión de usuarios:** Registro de propietarios y autenticación básica.
- **Gestión de preguntas:** Creación de preguntas y opciones de votación.
- **Sistema de votación:** Los propietarios pueden votar por una opción en cada pregunta.
- **Resultados de votación:** Los resultados se muestran en tiempo real, con el número de votos por opción.
- **Interfaz de administración:** Los administradores pueden gestionar preguntas, opciones y usuarios.
- **Interfaz de usuario:** Los propietarios pueden votar de forma sencilla y ver los resultados.

## Tecnologías

- **Backend:** Laravel 11
- **Frontend:** Vue.js
- **Base de datos:** MySQL / SQLite
- **Control de versiones:** Git y GitHub

## Requisitos

Antes de ejecutar el proyecto, asegúrate de tener instalados los siguientes programas:

- **PHP 8.2 o superior**
- **Composer** para gestionar las dependencias de PHP
- **Node.js** y **npm** para gestionar las dependencias de frontend
- **MySQL** o **SQLite** para la base de datos

## Instalación

### 1. Clonar el repositorio

```bash
git clone https://github.com/josetresdev/residential-voting-api.git
cd residential-voting-api

```

### 2. Configuración del entorno

Copia el archivo `.env.example` a `.env`:

```bash
cp .env.example .env
```

Luego, edita el archivo `.env` con las configuraciones necesarias para tu entorno. Asegúrate de definir correctamente los valores de la base de datos, correo electrónico y otros parámetros de entorno.

### 3. Instalar dependencias de PHP

Ejecuta el siguiente comando para instalar las dependencias de PHP utilizando Composer:

```bash
composer install
```

### 4. Generar la clave de la aplicación

Laravel requiere una clave única para la aplicación. Ejecuta este comando para generar la clave:

```bash
php artisan key:generate
```

### 5. Migrar la base de datos

Si estás utilizando MySQL o SQLite, ejecuta las migraciones para crear las tablas necesarias en la base de datos:

```bash
php artisan migrate
```

### 6. Instalar dependencias de Node.js

Si tu proyecto tiene frontend con Vue.js, instala las dependencias de Node.js:

```bash
npm install
```

### 7. Compilar los assets (Frontend)

Compila los assets para la producción o el desarrollo:

```bash
npm run dev    # Para desarrollo
npm run build  # Para producción
```

### 8. Ejecutar el servidor local

Para ejecutar el servidor de desarrollo de Laravel, usa el siguiente comando:

```bash
php artisan serve
```

Esto debería poner la API disponible en `http://localhost:8000`.

## Contribuciones

Las contribuciones son bienvenidas. Si deseas colaborar en el proyecto, sigue estos pasos:

1. Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
2. Realiza tus cambios y haz commit (`git commit -am 'Añadida nueva funcionalidad'`).
3. Sube tus cambios (`git push origin feature/nueva-funcionalidad`).
4. Crea un pull request en GitHub.

## Licencia

Este proyecto está licenciado bajo la **MIT License**. Consulta el archivo `LICENSE` para más detalles.

## Contacto

Si tienes alguna pregunta o sugerencia, no dudes en contactarme a través de correo electrónico: [josetrespalaciosbedoya@gmail.com](mailto:josetrespalaciosbedoya@gmail.com)

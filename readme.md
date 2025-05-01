# residential-voting-api

## Descripción

Este es un sistema de votaciones web destinado a propietarios de un conjunto residencial. Permite la creación de preguntas y opciones de votación, y permite a los propietarios emitir su voto de manera segura, almacenando y mostrando los resultados en tiempo real. Está desarrollado utilizando **Laravel 11** en el backend y **Vue.js** en el frontend.

## Características

- **Gestión de usuarios:** Registro de propietarios y autenticación mediante JWT.
- **Gestión de preguntas:** Creación, actualización y eliminación de preguntas y opciones de votación.
- **Sistema de votación:** Los propietarios pueden emitir votos por una opción en cada pregunta.
- **Resultados de votación:** Los resultados se actualizan en tiempo real, mostrando el número de votos por opción.
- **Interfaz de administración (backend):** Los administradores pueden gestionar preguntas, opciones, resultados y usuarios desde el backend.
- **Protección de rutas:** Acceso restringido a las funcionalidades mediante autenticación con Bearer tokens (JWT).

## Arquitectura del sistema

El sistema sigue una arquitectura basada en **API RESTful**, utilizando **Laravel 11** en el backend y **Vue.js** en el frontend. El backend es responsable de gestionar los recursos y las rutas, mientras que el frontend consume esas rutas para mostrar la información al usuario. Aquí se detalla la estructura básica de la arquitectura:

### Rutas y controladores

El sistema utiliza rutas para gestionar la interacción entre el cliente y el servidor. Estas rutas están protegidas por **middleware** para asegurar que solo los usuarios autenticados puedan acceder a ciertos recursos.

#### Ejemplos de rutas importantes

- **POST** `/api/login` → Controlador `AuthController@login`
- **POST** `/api/register` → Controlador `AuthController@register`
- **GET** `/api/questions` → Controlador `QuestionController@index`
- **POST** `/api/votes` → Controlador `VoteController@store`
  
Las rutas del sistema están definidas principalmente en `routes/api.php`, y cada ruta se asigna a un controlador correspondiente.

### Controladores

Los controladores son responsables de manejar la lógica del negocio relacionada con las solicitudes HTTP. En este sistema, los controladores principales incluyen:

- **AuthController**: Maneja la autenticación de usuarios y la creación de tokens.
- **QuestionController**: Gestiona la creación y visualización de preguntas de votación.
- **OptionController**: Gestiona las opciones disponibles para cada pregunta.
- **VoteController**: Maneja la emisión de votos por parte de los propietarios.
  
### Modelos

Los recursos (Usuarios, Preguntas, Opciones, Votos) se gestionan mediante **Eloquent ORM**. Para consultas complejas o optimización de rendimiento, se puede utilizar **Query Builder**, permitiendo consultas más dinámicas y eficientes sin escribir SQL directamente.

### Ejemplo de uso de Query Builder

Para obtener todas las preguntas activas creadas después de una fecha específica, podemos usar **Query Builder** de esta manera:

```php
use Illuminate\Support\Facades\DB;

$questions = DB::table('questions')
    ->where('status', 'active')
    ->where('created_at', '>', '2025-01-01')
    ->get();
```

### Middleware y autenticación

El sistema usa **JWT-Auth** con **Bearer Token** para la autenticación. Las rutas protegidas requieren un token válido en los encabezados HTTP. El middleware `auth:api` asegura que solo los usuarios autenticados puedan acceder a ellas.

- El usuario se registra o inicia sesión en `/api/register` o `/api/login`.
- Tras la autenticación, se devuelve un **token** JWT, que se incluye en las solicitudes subsecuentes como `Authorization: Bearer {token}`.

### Respuestas estandarizadas

Las respuestas de la API siguen un formato estandarizado para facilitar la integración con el frontend. Ejemplo de una respuesta:

```json
{
    "status": "success",
    "message": "Success",
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "uuid": "2f492897-bafa-4d13-be75-e51b85f658d4",
                "title": "Presidencia del condominio",
                "status": "active",
                "created_at": "2025-05-01T15:04:34.000000Z"
            }
        ],
        "code": 200
    }
}
```

## Tecnologías

- **Backend:** Laravel 11
- **Frontend:** Vue.js (v3.2.13)
- **Base de datos:** MySQL
- **Control de versiones:** Git y GitHub

## Requisitos

Antes de ejecutar el proyecto, asegúrate de tener instalados los siguientes programas:

- **PHP 8.2 o superior**
- **Composer** para gestionar las dependencias de PHP
- **Node.js** y **npm** para gestionar las dependencias de frontend
- **MySQL** para la base de datos

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

Si estás utilizando MySQL, ejecuta las migraciones para crear las tablas necesarias en la base de datos:

```bash
php artisan migrate
```

```bash
php artisan db:seed
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

Esto debería poner la API disponible en `http://localhost:8000/api`.

## Frontend

Este es el **Backend** de la aplicación. El **Frontend** correspondiente a este sistema de votaciones está disponible en el siguiente repositorio:

[**residential-voting-frontend**](https://github.com/josetresdev/residential-voting-frontend)

Este repositorio está desarrollado en **Vue.js** y se comunica con la API de este backend para gestionar la votación, usuarios y resultados en tiempo real.

### Colección de Postman

La colección de Postman para interactuar con la API se encuentra en el archivo `resources/collections/VotingAPICollection.json`. Este archivo contiene todas las rutas y métodos disponibles en el sistema, lo que facilita la prueba y exploración de la API.

Puedes importar esta colección directamente en Postman para realizar pruebas de manera rápida y efectiva.

## Contribuciones

Las contribuciones son bienvenidas. Si deseas colaborar en el proyecto, sigue estos pasos:

1. Crea una nueva rama (`git checkout -b feature/nueva-funcionalidad`).
2. Realiza tus cambios y haz commit (`git commit -am 'Añadida nueva funcionalidad'`).
3. Sube tus cambios (`git push origin feature/nueva-funcionalidad`).
4. Crea un pull request en GitHub.

## Licencia

Este proyecto está licenciado bajo la **MIT License**. Consulta el archivo `LICENSE` para más detalles.

## Autor

Este proyecto fue desarrollado por **Jose Trespalacios**. Puedes contactarme a través del correo electrónico: [josetrespalaciosbedoya@gmail.com](mailto:josetrespalaciosbedoya@gmail.com).

## Desarrollador responsable

El desarrollo y mantenimiento de este sistema está bajo la responsabilidad de **Jose Trespalacios**. Cualquier contribución, mejora o reporte de errores debe ser dirigida a la misma dirección de contacto o a través del repositorio en GitHub.

# Laravel 8 Todo App

Una aplicación simple de Todo con edición y eliminación masiva de registros

Este proyecto fue construido con el Framework Laravel 8. Fue construido con fines de demostración.

## Installation

Clone el repositorio
```
git clone https://github.com
```

Luego cd en la carpeta con este comando-
```
cd laravel-todo
```

Luego haga una instalación de composer
```
composer install
```

Luego crear el archivo `.env` usando este comando-
```
cp .env.example .env
```

Luego edite el archivo `.env` con las credenciales apropiadas para su servidor de base de datos. Edite estos dos parámetros (`DB_USERNAME`, `DB_PASSWORD`).

Luego cree una base de datos llamada `todo_app` y luego realice una migración de base de datos usando este comando-
```
php artisan migrate
```

Finalmente, genere la clave de la aplicación, que se utilizará para el hash de contraseña, la sesión y el cifrado de cookies, etc.
```
php artisan key:generate
```

## Ejecutar servidor

Corra el servidor usando este comando-
```
php artisan serve
```

Visite `http://localhost:8000` desde su navegador y vea la aplicación.

## Pantallazos

![Todo List](/screenshot/1.png)
![Add Todo](/screenshot/2.png)
![Edit Todo](/screenshot/3.png)


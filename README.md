# Laravel 8 Todo App

Una aplicación simple de Todo con edición y eliminación masiva de registros

Este proyecto fue construido con el Framework Laravel 8. Fue construido con fines de demostración.

## Installation

Clone el repositorio
```
git clone https://github.com/nazho248/Tareas_laravel.git
```

Luego cd en la carpeta con este comando-
```
cd Tareas_laravel
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

## Ejecutar Server Desarrollo

Corra el servidor usando este comando-
```
php artisan serve
```

Visite `http://localhost:8000` desde su navegador y vea la aplicación.

## Pantallazos

![Lista de tareas](/screenshot/1.png)
![Editar Tarea](/screenshot/2.png)
![Editar estado de multiples tareas](/screenshot/3.png)

## Montaje En Google Cloud Platform

### Requisitos del proyecto

Para instalar este proyecto en Google Cloud se requiere:
- Ubuntu 20.04 LTS
- PHP >= 7.3
- MySQL 8.0
- Composer
- Git
- Google Cloud Platform
- Ansible
### Configuración del Servidor GCP.
Se crea una nueva instancia desde google cloud platform con las siguientes caracteristicas:
- Configuracion de maquina: E2 micro, esto para que sea lo mas económico
- Region: Cualquiera
- Tipo de maquina e2-micro (1 vCPU, 1 GB de memoria)
- modelo de aprovisionamiento: Estándar
- Disco de arranque: Cambiar a Ubuntu 20.04 LTS con 20GB de almacenamiento
- Firewall: Permitir trafico HTTP y HTTPS
<br>
Crear el servidor y seguir el procedimiento:

---

## Procedimiento para configuración
Se habilita usuario root en el cliente, colocamos una contraseña para el usuario root
```
sudo -i
passwd
exit
```
Configuramos sshd_config para que permita el acceso con contraseña
```
sudo nano /etc/ssh/sshd_config
```
Buscamos la linea que dice PasswordAuthentication y la cambiamos a yes
```
PasswordAuthentication yes
# agregamos la siguiente linea
PermitRootLogin yes
```
Reiniciamos el servicio ssh
```
sudo systemctl restart ssh
```

### Instalación de Ansible
iniciamos sesion como root con la contraseña que configuramos anteriormente
```
sudo -i
```
y realizamos los siguientes comandos para instalar ansible
```
apt install software-properties-common
apt update
apt install ansible
ansible --version
```
Creamos las llaves ssh para el usuario root
```
cd
ssh-keygen
```
copiar las llaves ssh del servidor al cliente, nos pide paraphrase, la dejamos en blanco (para mas seguridad se puede colocar una)
```
ssh-copy-id -i ~/.ssh/id_rsa.pub root@localhost
```
Creamos el directorio de ansible y el archivo hosts para configurarlo
```
sudo mkdir /etc/ansible
sudo nano /etc/ansible/hosts
```
Los campos a agregar dentro del archivo hosts son los siguientes:
```
[servers]
server1 ansible_host=localhost

[all:vars]
ansible_python_interpreter=/usr/bin/python3
```
Realizamos un ping para verificar que la conexión se haya realizado correctamente, esto nos tiene que responder con un pong
```
ansible -m ping all
```
A partir de aqui ya podemos realizar la configuración de nuestro servidor con ansible :)


### Configuración de servidor con Ansible
Una vez tengamos todo instalado, procedemos a crear los playbooks para la configuración de nuestro servidor, para esto creamos un directorio llamado ansible en nuestro home.<br>
Para esto Creamos los archivos .yaml con el comando ```nano playbook.yaml``` y agregamos el contenido de [/Ansible_playbooks](Ansible_playbooks), cada uno en un archivo independiente. <br>
Copiamos su contenido y lo pegamos en el archivo creado con nano, guardamos y salimos con ctrl+x, confirmamos con "Y" y damos enter.

En este caso como se requiere instalar php 7.3 y mysql se hace antes de instalar apache para que no haya problemas de dependencias.

****Nota:**** Para ejecutar los playbooks usamos el comando ```ansible-playbook playbook.yaml```

****Posdata:**** Cuando se realiza la instalación de apache2, ya debe ser posible acceder a la ip del servidor desde el navegador y ver la pagina de apache2 (en http)

#### Instalacion de PHP 7.3
Ejecutamos:
```
sudo apt install php7.4 php7.4-fpm php7.4-mysql php7.4-mbstring php7.4-dom
#dependencias para composer
sudo apt install php-zip
sudo apt install unzip
#reiniciamos el servicio de apache
sudo systemctl restart apache2
```
#### Instalacion de MySQL 8.0
Ejecutamos:
```
sudo apt install mysql-server
sudo mysql_secure_installation
```
Creamos la base de datos y el usuario para la aplicación
```
sudo mysql
CREATE DATABASE todo_app;
CREATE USER 'todo_app'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON todo_app.* TO 'todo_app'@'localhost';
FLUSH PRIVILEGES;
#verificamos la creacion de base de datos
SHOW DATABASES;
#verificamos la creacion de usuario
SELECT User FROM mysql.user;
#salimos de mysql
exit
```
#### Instalación del proyecto
Para la instalación del proyecto es necesario ejecutar
```
sudo a2enmod rewrite
systemctl restart apache2
```
y luego editar el archivo de configuración de apache2 con
```
sudo nano /etc/apache2/apache2.conf
```
Buscar las siguientes lineas y modificar AllowOverride None por AllowOverride All
```
<Directory /var/www/>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
</Directory>
```
Eliminamos la carpeta por defecto que crea apache2
```
cd /var/www
rm -R html
```
Clonamos el repositorio y renombramos la carpeta
```
git clone https://github.com/nazho248/Tareas_laravel.git
mv Tareas_laravel/ html
```
Entramos a la carpeta y hacemos la instalación del proyecto. y configuramos variables de entorno, corremos el proyecto etc.
```
cd html
cp .env.example .env
#editamos el archivo .env con las credenciales de la base de datos, usuario y contraseña
nano .env
```

instalamos composer
```
composer install
php artisan key:generate
php artisan storage:link
php artisan cache:clear
php artisan config:cache
php artisan config:clear
sudo chmod -R 777 storage
```

Ejecutamos las migraciones de la db
```
php artisan migrate:fresh --seed
```
Si todo hasta aqui no ha arrojado error todo OK :). Ahora solo falta modificar el htaccess en la carpeta html.
```
nano .htaccess
```
Su contenido debe ser
```
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews
    </IfModule>

        DirectoryIndex index.php

        RewriteEngine On
        RewriteRule ^$ public/index.php [L]
        RewriteRule ^((?!public/).*)$ public/$1 [L,NC]
</IfModule>
```
Entramos a /public y editamos el .htaccess
```
nano .htaccess
#con el contenido:
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews
    </IfModule>

    RewriteEngine On

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(.)/$ /$1 [L,R=301]

    # Handle Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule . - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]
</IfModule>
```
Finalmente reiniciamos el servicio de apache2
```
systemctl restart apache2
```
# Y ya lo tendríamos montado en el servidor de google cloud platform :D 😊👌

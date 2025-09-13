# Proyecto Laravel + Filament

Este proyecto está desarrollado con [Laravel](https://laravel.com/) y utiliza el panel administrativo de [Filament](https://filamentphp.com/). La base de datos utilizada es MySQL.

## Tecnologías utilizadas

- PHP 8.2.12
- Laravel
- Filament
- MySQL
- Node.js 22.19.0
- Composer
- XAMPP (como servidor local)

---

## Requisitos previos

Asegúrate de tener instalados los siguientes programas:

1. [XAMPP](https://www.apachefriends.org/index.html)
2. [PHP 8.2.12](https://www.php.net/downloads) *(incluido en XAMPP)*
3. [Composer](https://getcomposer.org/) (opcional, para crear el proyecto usando el instaldor   de filament)
4. [Node.js 22.19.0](https://nodejs.org/)
5. [Visual Studio Code](https://code.visualstudio.com/) (opcional, pero recomendado)

---

## Configuración inicial

### 1. Habilitar extensiones necesarias en PHP

Después de instalar XAMPP:

- Abre el archivo `php.ini` desde el panel de control de XAMPP (botón *Config > php.ini*).
- Asegúrate de descomentar (quitar el `;`) las siguientes líneas:

```ini
extension=zip
extension=intl
Guarda los cambios y reinicia Apache desde el panel de XAMPP.

1. Clonar el proyecto Laravel

git clone https://github.com/tu-usuario/tu-repo.git
cd tu-repo

2 crea una bd vacia (sin tablas)

3. Configurar entorno
Copia el archivo de entorno:

cp .env.example .env (este comando esta copiando .env.example y la está nombrando .env)
Edita el archivo .env con la configuración de tu base de datos:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_tu_base_de_datos_que_creaste_previamente
DB_USERNAME=root
DB_PASSWORD=
Luego, instala las dependencias y genera la clave de la aplicación:
4. composer installer (suele demorar unos minutos)
5. php artisan key:generate

6. Ejecutar migraciones y seeders para crear las tablar y poblar la base de datos
php artisan migrate:fresh --seed

7. Levantar el servidor local
Abre tu editor de código fuente preferido y ejecuta:

php artisan serve
Esto iniciará el servidor en: http://127.0.0.1:8000

Acceder al panel administrativo de Filament
Dirígete a:

http://127.0.0.1:8000/admin

Credenciales de acceso
correo: vip2cars@gmail.com
contraseña: password

⚠️ Nota Importante:

La primera vez que accedas al panel de Filament, es posible que el tiempo de carga sea más largo de lo habitual. Esto se debe a que Filament realiza una carga inicial de recursos (como configuraciones y caché) en su primer uso. Sin embargo, después de esta primera carga, el panel funcionará con normalidad y los tiempos de carga se reducirán significativamente en accesos posteriores.
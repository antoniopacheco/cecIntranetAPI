CEC INTRANET
Instalación:
composer install
php artisan vendor:publish

Base de datos:
se debe crear archivo .env en la raíz del proyecto
ejemplo:
APP_ENV=local
APP_DEBUG=true
APP_KEY=APPKEY

DB_HOST=localhost
DB_DATABASE=database
DB_USERNAME=username
DB_PASSWORD=password

CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=sync

MAIL_DRIVER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null

La estructura del proyecto se encuentra en database/structure.sql
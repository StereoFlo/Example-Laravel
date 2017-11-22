#### Как установить систему

1) **git clone ...** сливаем
2) **cd engine** 
3) **php composer.phar update**
4) Настроить БД для нового проекта
5) Настрокить файл **.env**:

``` bash
APP_NAME=Recycle
APP_ENV=local
APP_KEY=base64:uCBluamUo2CE/dtbPboTp7XFiBu9OGruUhnVRrlSmXc=
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL=http://recycle.lan
WEBMASTER_ADDRESS=fb@stereoflo.ru

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=recycle
DB_USERNAME=recycle
DB_PASSWORD=recycle

BROADCAST_DRIVER=log
CACHE_DRIVER=file
SESSION_DRIVER=database
SESSION_LIFETIME=120000
QUEUE_DRIVER=sync

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_DRIVER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=0e25e654c2c73c
MAIL_PASSWORD=b6609845739bbd
MAIL_ENCRYPTION=null
```

6) запустить миграции **php artisan migrate:install** && **php artisan migrate:refresh --seed**
7) запустить php artisan key:generate
8) готово 
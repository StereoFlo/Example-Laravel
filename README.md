####An english version contained below

#### О проекте
Реальнеый проект для людей знамающимися искуством recycle art. 

#### Благодарности
@silaevd  - верстка + js программирование

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


### English version


#### About 
It's a real project for people interesting for the recycle art

#### Regards
@silaevd  - layout and javascript programming

#### How to install

1) **git clone ...** for clone a repo
2) **cd engine** go to framework folder
3) **php composer.phar install** for download a composer dependencies
4) Set up a database for project. Make a database, user, password, etc...
5) make a file **.env** in a current folder and put the content below (WARNING! This file for local use only!):

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

6) run install migrations **php artisan migrate:install** && run refresh migrations with sample data (--seed) **php artisan migrate:refresh --seed**
7) then run a command **php artisan key:generate** for make a unique key for you project
8) project are ready for use! log in into an admin section with credentials admin@recycle.lan:admin and set up the rest options
9) enjoy!
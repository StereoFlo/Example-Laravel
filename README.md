## An english version is contained below

#### О проекте
Реальный проект для людей знамающимися искуством recycle art. В качестве бэкэнда, использован фрейворк Laravel 5.5, фронтенд - jquery основной сайт, Vue.js админка (SPA).

#### Благодарности
@silaevd  - верстка + js программирование

#### Как установить систему

1. **git clone ...** сливаем
2. **cd engine** 
3. **php composer.phar update**
4. Настроить БД для нового проекта
5. Скопировать файл **.env**:

``` bash
cp .env.dist .env
```
6. Отредактировать его
7. запустить миграции **php artisan migrate:install** && **php artisan migrate:refresh --seed**
8. запустить php artisan key:generate
9. готово 


### English version


#### About the project
It's a real project for people interesting for the recycle art

#### Regards
@silaevd  - layout and javascript programming

#### How to install

1) **git clone ...** clone a repo
2) **cd engine** go to framework folder
3) **php composer.phar install** download a composer dependencies
4) Set up a database for project. Create a database with user and password...
5) Copy a file **.env** in a current folder and put the content is contained below (WARNING! This file is for local use only!):

``` bash
cp .env.dist .env
```

6) change setting values in a .env file
7) run migrations **php artisan migrate:install** && then do refresh for migrations with a sample data (--seed) **php artisan migrate:refresh --seed**
8) then run the command **php artisan key:generate** it makes an unique key for project
9) project are ready to use! log in into an admin section with credentials admin@recycle.lan:admin and set up the rest options
10) enjoy!

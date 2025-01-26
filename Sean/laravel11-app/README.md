<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## What I have done fore the moment
Laravel 11 is the framework that we will use to develop with PHP. In this README I will do a snapshot of all that I'm learning during my first experience with this technology.

### Installation
I have install all the resources that I need for use Laravel 11 in Linux:

1st [PHP](https://www.php.net/downloads) the program language.

2nd [composer](https://getcomposer.org/download/) the dependency manager for PHP.

3rt [MySQL](https://www.geeksforgeeks.org/how-to-install-mysql-on-linux/) the Database.

4th [Apache](https://ubuntu.com/server/docs/how-to-install-apache2) the Web Server.

5th [Laravell11](https://laravel.com/docs/11.x#sail-on-linux) the framework for PHP.

Fore this process, I have used this tutorial; [Installing Laravel 11: A Step-by-Step Guide](https://dev.to/jsandaruwan/-installing-laravel-11-a-step-by-step-guide-2mkj)

### MySQL database configuration and migration
I had to edit the `.env` file to configure the connection between the Laravel project and the database. Something like this:
```sh
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=test_laravel11
DB_USERNAME=root
DB_PASSWORD=your_root_password
```
Secondly, I migrate with the command:
```sh
php artisan migrate
```
After this, the tables that I have in the `laravel11-app/database/migrations/0001_01_01_000000_create_users_table.php` are now in the database:

In the Laravel project:
```php
Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
```
In the MySQL database:

![image](docs/img/sean_img/MySQL_table_example.png)

### Trying the web
I open the web server, in the terminal, inside my project, with the command `php artisan serve`.

![image](docs/img/sean_img/Run_server.png)

And in the browser I search for the localhost: `http://localhost:8000/` and, if works, it shows this:

![image](docs/img/sean_img/web_runing.png)

That is the page that is in the `Sean/laravel11-app/resources/views/welcome.blade.php`

In some cases, when you are trying to show the `whelcome` page, it shows this error *welcome not found*. 

![image](docs/img/sean_img/web_runing_error.png)


To solve this, I asked my friend *ChatGPT* and she told me that I had to clean my views and routes with the following commands:
 
```bash
php artisan view:clear 
php artisan cache:clear
php artisan config:clear 
php artisan route:clear
```

And as easy as that, it works!


### MVC & CRUD
Resource Controller with the command `php artisan make:controller [nameFolder/][nameController] -r -m`.
* `-r` => create a resource class.
* `-m` => create a model related to this class.






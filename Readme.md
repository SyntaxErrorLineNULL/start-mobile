# Symfony 5 web application **libraries**

## Getting started

###To get it working, follow these steps:

- Clone the repository from github
    ```git
    https://github.com/SyntaxErrorLineNULL/artvisio.git
  ```

### If you have Docker installed
### Init DataBase
````
  make init
````

+ run migrations

````bash
    php bin/console doctrine:migrations:migrate
    OR
    php bin/console doctrine:schema:create
````
    
if you don't want to work with an empty project, you can add data to the table

````
    php bin/console doctrine:fixtures:load
````

Start the built-in web server

You can use Nginx or Apache, but the built-in web server works great:
````bash
php -S 127.0.0.1:8000 -t public
        or
symfony server:start
````

##### Now check out the site at https://127.0.0.1:8000

### What has not been done yet
- [ ] not work docker container in use PHP-fpm, PHP-cli. Database is not connection for doctrine, with this config(PHP-fpm, cli, nginx).
- [ ] create autoload OpenApi documentation
Click loger
============================

REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 7.1

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=dbname',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```


INSTALLATION
------------

Install project dependencies.
Run such command in project root directory:
~~~
php composer install
~~~

Run migrations
~~~
php yii migrate
~~~

Create nginx configuration and set project root to path:
~~~
/PATH_TO_PROJECT/clicker/web/
~~~


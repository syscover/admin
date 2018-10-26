# Pulsar Admin App for Laravel

[![Total Downloads](https://poser.pugx.org/syscover/pulsar-admin/downloads)](https://packagist.org/packages/syscover/pulsar-admin)
[![Latest Stable Version](http://img.shields.io/github/release/syscover/pulsar-admin.svg)](https://packagist.org/packages/syscover/pulsar-admin)

Pulsar is an application that generates a control panel where you start creating custom solutions, provides the resources necessary for any web application.

---

## Installation

**1 - After install Laravel framework, execute on console:**
```
composer require syscover/pulsar-admin
```

Register service provider, on file config/app.php add to providers array
```
Syscover\Admin\AdminServiceProvider::class,
```

**2 - Execute publish command**
```
php artisan vendor:publish --provider="Syscover\Admin\AdminServiceProvider"
```

**3 - Register client and pulsar.auth middlewares on file app/Http/Kernel.php and add to routeMiddleware array**
```
...
'client'      => \Laravel\Passport\Http\Middleware\CheckClientCredentials::class,
'pulsar.auth' => \Syscover\Admin\Middleware\Authenticate::class
...
```

**4 - Execute optimize command load new classes**
```
composer dump-autoload
```

**5 - Config laravel queue, in file config/queue.php replace database connection by**
```
'database' => [
    'driver' => 'database',
    'table' => 'admin_job',
    'queue' => 'default',
    'retry_after' => 90,
],
```

**6 - And execute migrations and seed database**
```
php artisan queue:table
php artisan migrate
php artisan db:seed --class="AdminTableSeeder"
```

**7 - Execute command to load all updates**
```
php artisan migrate --path=vendor/syscover/pulsar-admin/src/database/migrations/updates
```

**8 - include this arrays in config/auth.php**

Set this default values, for laravel passport can create pulsar user
```
'defaults' => [
    'guard'     => 'admin',
    'passwords' => 'adminPasswordBroker',
],
```

Inside guards array
```
// Api guard get the auth from provider defined un default guard,
// and to define a default guard, this must to be defined like session driver
'admin' => [
    'driver'    => 'session',
    'provider'  => 'adminUser',
],

'api' => [
    'driver'    => 'passport',
    'provider'  => 'adminUser',
],
```

Inside providers array
```
'adminUser' => [
    'driver'    => 'eloquent',
    'model'     => Syscover\Admin\Models\User::class,
],
```

Inside passwords array
```
'adminPasswordBroker' => [
    'provider'  => 'adminUser',
    'table'     => 'admin_password_resets',
    'expire'    => 60,
],
```

**9 - Set base lang application and panel url in .env file**
```
ADMIN_BASE_LANG=en
ADMIN_PANEL_URL=http://panel.mydomain.com
```

**10 - Add graphQL routes to routes/graphql/schema.graphql file**
```
# Admin types
#import ./../../vendor/syscover/pulsar-admin/src/Syscover/Admin/GraphQL/inputs.graphql
#import ./../../vendor/syscover/pulsar-admin/src/Syscover/Admin/GraphQL/types.graphql

# Admin queries
#import ./../../vendor/syscover/pulsar-admin/src/Syscover/Admin/GraphQL/queries.graphql

# Admin mutations
#import ./../../vendor/syscover/pulsar-admin/src/Syscover/Admin/GraphQL/mutations.graphql
```

**11 - When the installation is complete you can access these data**
```
user: admin@pulsar.local
pasword: 123456
```










-- CHECK
**xx - Register cron command your server**

```
* * * * * php /path-to-your-project/artisan schedule:run >> /dev/null 2>&1

```

## Cron task
To implement the cron system must follow the following steps:


### set cron on our server

Para ello necesitaremos instanciar en nuestro servidor una única tarea cron que se encargará de revisar si tiene que disparar algún comando, normalmente con el comando /usr/bin/php y apuntando 
a la ruta absoluta del fichero artisan que se debe de encontrar en la raiz de nuestro proyecto web.
La opción -q es para evitar escritura por consola del cron

```
* * * * * /usr/bin/php -q /ruta/absoluta/a/nuestra/carpeta/raiz/artisan cron
``` 

Para editar nuestro fichero crontab para añadir la tarea, podemos hacerlo con el siguiente comando
```
# crontab -e
```

O si queremos editar el crontab de un usuario en concreto
```
# crontab -e -u usertoedit
```

### Nuestra primera tarea cron

Desde el apartado Tareas Cron podremos configurar las tareas necesarias que nuestro panel requiera ejecutar, nos encontraremos los siguientes campos:

Nombre: Descripción de la tarea cron.

Módulo: Módulo al que pertenece la tarea cron que vamos a sentenciar.

Expresión Cron: 
Periodicidad de cada tarea mediante una expresión que representará el tiempo de ejecución:

```
    *    *    *    *    *    *
    -    -    -    -    -    -
    |    |    |    |    |    |
    |    |    |    |    |    + Año [opcional]
    |    |    |    |    +----- día de la semana (0 - 7) (Sunday=0 or 7)
    |    |    |    +---------- mes (1 - 12)
    |    |    +--------------- día del mes (1 - 31)
    |    +-------------------- hora (0 - 23)
    +------------------------- minuto (0 - 59)

```

Activa: Indicamos si nuestra tarea queremos que está activa o no.

Key: Código de tarea a ejecutar, este código lo instanciamos nosotros mismos en el fichero src/config/cron.php que contiene un array de claves y fuciones

```
    return array(
    //Cron alarmas Vinipad Sales Force
    '01'       => function() { 
                            \Pulsar\Pulsar\Libraries\Cron::llamadaCron(); 
                        }
);
```
En este caso, instanciaríamos con 01 la key, si queremos que ejecute el método llamadaCron() de la clase estática Cron.
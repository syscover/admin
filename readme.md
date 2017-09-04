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

Register service provider, on file config/app.php add to providers array**
```
Syscover\Admin\AdminServiceProvider::class,
```

**2 - Execute publish command**
```
php artisan vendor:publish --provider="Syscover\Admin\AdminServiceProvider"
```

**3 - Execute optimize command load new classes**
```
composer dump-autoload
```

**4 - And execute migrations and seed database**
```
php artisan migrate
php artisan db:seed --class="AdminTableSeeder"
```

**5 - Execute command to load all updates**
```
php artisan migrate --path=database/migrations/updates
```

**6 - include this arrays in config/auth.php**

Set this default values, for JWT can create pulsar user
```
'defaults' => [
    'guard'     => 'pulsar',
    'passwords' => 'pulsarPasswordBroker',
],
```

Inside guards array
```
'pulsar' => [
    'driver'    => 'session',
    'provider'  => 'pulsarUser',
],
```

Inside providers array
```
'pulsarUser' => [
    'driver'    => 'eloquent',
    'model'     => Syscover\Admin\Models\User::class,
],
```

Inside passwords array
```
'pulsarPasswordBroker' => [
    'provider'  => 'pulsarUser',
    'table'     => 'admin_password_resets',
    'expire'    => 60,
],
```

**7 - When the installation is complete you can access these data**
```
url: http://www.your-domain.com/pulsar
user: admin@pulsar.local
pasword: 123456
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
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

```
'failed' => [
    'database' => env('DB_CONNECTION', 'mysql'),
    'table' => 'admin_failed_jobs',
],
```

after that set your QUEUE_CONNECTION variable environment with database value 

```
QUEUE_CONNECTION=database
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

**10 - Add graphQL routes to graphql/schema.graphql file**
```
# Core
#import ./../vendor/syscover/pulsar-core/src/Syscover/Core/GraphQL/scalars.graphql
#import ./../vendor/syscover/pulsar-core/src/Syscover/Core/GraphQL/inputs.graphql
#import ./../vendor/syscover/pulsar-core/src/Syscover/Core/GraphQL/types.graphql

# Admin types
#import ./../vendor/syscover/pulsar-admin/src/Syscover/Admin/GraphQL/inputs.graphql
#import ./../vendor/syscover/pulsar-admin/src/Syscover/Admin/GraphQL/types.graphql

type Query {
    # Core
    #import ./../vendor/syscover/pulsar-core/src/Syscover/Core/GraphQL/queries.graphql
    
    # Admin queries
    #import ./../vendor/syscover/pulsar-admin/src/Syscover/Admin/GraphQL/queries.graphql
}

type Mutation {
    # Core
    #import ./../vendor/syscover/pulsar-core/src/Syscover/Core/GraphQL/mutations.graphql
    
    # Admin mutations
    #import ./../vendor/syscover/pulsar-admin/src/Syscover/Admin/GraphQL/mutations.graphql
}
```

**11 - When the installation is complete you can access these data**
```
user: admin@pulsar.local
pasword: 123456
```

**12 - To run unit testing**
```
./vendor/bin/phpunit
```

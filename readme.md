# Forest Admin Schema

Forest admin schema is a Laravel Package which introspect the models schema.

# Installation 
1. Create packages/KevinLbr in your Laravel project and put this project in.
2. add in main composer.json, in  "KevinLbr\\ForestAdminSchema\\": "packages/KevinLbr/forest-admin-schema/app/"

```json
{
    "autoload": {
        "psr-4": {
            "App\\": "app/",
            "Database\\Factories\\": "database/factories/",
            "Database\\Seeders\\": "database/seeders/",
            "KevinLbr\\ForestAdminSchema\\": "packages/KevinLbr/forest-admin-schema/src/"
        }
    }
}
```

3. Add in `config/app.php` in **providers**
```php   
'providers' => [
    /*
    * Application Service Providers...
    */
    ...
    App\Providers\RouteServiceProvider::class,
    KevinLbr\ForestAdminSchema\Providers\SchemaProvider::class,
],
```

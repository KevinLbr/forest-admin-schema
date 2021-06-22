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
4. Execute `composer dump-autoload`

5. Execute `php artisan forest-admin-schema:scan`

### Time Tracking 
- Dimanche 19h - 21h : Initialisation du projet sur github, création du paquet, mise en place du DDD et du TDD.
- Mardi 7h30 - 9h30 : Finalisation du dev avec des repositories 'in memory'. Commencement des repositories Eloquent et Storage

# Forest Admin Schema
Ce projet est le resultat d'un test technique que m'a demandé Forest Admin

Forest admin schema is a Laravel Package which introspect the models schema.

# Installation
1. git clone this package in packages/KevinLbr folder.
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
    KevinLbr\ForestAdminSchema\Providers\SchemaServiceProvider::class,
],
```
4. Execute `composer dump-autoload`

5. Execute `php artisan forest-admin-schema:scan`

# Pour lancer les tests du paquet
- Aller dans son dossier
- lancer un `composer install`
- lancer `vendor/bin/phpunit`

# Methodes employées
- Ce paquet a été réalisé en TDD, afin d'écrire du code fiable rapidement.
- L'architecture choisie et une architecture hexagonale pour mettre en place du DDD. Sa flexibilité permet de pouvoir rapidement changer d'outils si besoin, et meme de framework. Pour en savoir plus : https://medium.com/shodo-io/architecture-hexagonale-d%C3%A9couplez-votre-logique-m%C3%A9tier-de-votre-code-technique-25d5bf82a95c
- Des principes de clean code (ex :SOLID) (https://fr.wikipedia.org/wiki/SOLID_(informatique)) ont été respectés.

# Améliorations possibles
- Ajouter des informations sur les attributs (ex : nullable, unique, default value, foreign key, ...)
- Scanner les models des tables, et ajouter leurs attributs, leurs constantes, leurs functions, ...
- Ajouter des parametres a la commande pour le nom du fichier, pour le path
- Ajouter des informations dans le terminal pendant le traitement de la function, comme une progress bar

### Time Tracking
- Dimanche 19h - 21h : Initialisation du projet sur github, création du paquet, mise en place du DDD et du TDD.
- Mardi 7h30 - 9h30 : Finalisation du dev avec des repositories 'in memory'. Commencement des repositories Eloquent et Storage
- Jeudi 7h30 - 9h30 : Recherche de paquets Laravel sur github qui utilisent doctrine et les façades Laravel dans les tests pour corriger mon probleme + mise en place de la solution sur mon paquet + avancement du ScanEloquentTest.php (renommé ScanDBTest)
- Vendredi 7h30 - 9h30 : Finalisation des tests avec DB, refactorisation du code

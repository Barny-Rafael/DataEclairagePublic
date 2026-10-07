# Framework Data Eclairage Public

Bienvenue sur notre dépôt Github de notre Framework MVC PHP 8.2 pour un site web ! Libre à vous de l'utiliser comme bon vous semble mais, avant ça, veuillez lire la suite de ce README.

Source : https://github.com/hadeli/MVC-Explication

## Arborescence du framework

```
App/
├── public/
│   ├── index.php            ← seul fichier accessible par le web
│   └── .htaccess            ← pour Apache ; php -S se replie sur index.php tout seul
├── autoload.php
├── .env                     ← à rajouter pour établir la connexion à votre basse de données
├── config/
│   └── routes.php           ← table des routes
├── src/
│   ├── Core/
│   │   ├── render.php
│   │   ├── db.php
│   │   └── env.php
│   ├── Controller/
|   |   ├── AccountController.php
│   │   ├── AuthController.php
│   │   ├── HomeController.php
|   |   ├── LegalController.php
|   |   ├── SitemapController.php
|   |   └── TermsController.php
│   └── Model/
│       ├── User.php
│       └── UserRepository.php
└── views/
    ├── partials/
    |   ├── footer.php
    |   └── header.php
    ├── account.php
    ├── delete.php
    ├── forgot.php
    ├── home.php
    ├── legal.php
    ├── login.php
    ├── register.php
    ├── reset.php
    ├── sitemap.php
    ├── terms.php
    ├── verification.php
    └── 404.php
```

## Comment ajouter une page

### Première étape :

Créez un controller dans le dossier Controller/, une view dans le dossier views/ et un model si communication avec la base de données nécessaire dans le dossier Model/.

### Deuxième étape :

Ajouter la route dans le fichier routes.php du dossier config/ comme ceci :
```php
//...
use App\Controller\TermsController;
use App\Controller\ExampleController;
//...

return [
    //...
    ['GET', '/terms', [TermsController::class, 'terms']],
    ['GET', '/example', [ExampleController::class, 'exampleForm']],  // Affiche la vue avec la fonction render
    ['POST', '/example', [ExampleController::class, 'exampleForm']], // S'occupe du formulaire avec la méthode POST
    //...
];
```

### Troisième étape :

Ajouter le controller dans le front-controller index.php du dossier public/ comme ceci :

```php
//...
use App\Controller\TermsController;
use App\Controller\ExampleController;
//...

$controleurs = [
    //...
    TermsController::class => fn() => new TermsController(),
    ExampleController::class => fn() => new ExampleController(),
    //...
];
```

## Example d'un .env

```env
DB_DSN=pgsqle:database.pgsql
DB_USER=
DB_PASSWORD=
```

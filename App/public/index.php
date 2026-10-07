<?php

use App\Model\UserRepository;
use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\LegalController;
use App\Controller\SitemapController;
use App\Controller\AccountController;
use App\Controller\TermsController;
use App\Model\LampadaireRepository;
use App\Controller\LampadaireController;

$racine = dirname(__DIR__);                    // on est dans public/, le projet est un cran au-dessus

require $racine . '/src/Core/pagination.php';
require $racine . '/autoload.php';
require $racine . '/src/Core/render.php';
require $racine . '/src/Core/db.php';
session_start();                               // une seule fois, pour tout le site

$chemin = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';   // "/login?x=1" -> "/login"
$chemin = rtrim($chemin, '/') ?: '/';                                // "/login/"    -> "/login"

$methode = $_SERVER['REQUEST_METHOD'];

$repository = new UserRepository($pdo);
$lampadaireRepository = new LampadaireRepository($pdo);
$controleurs = [
    HomeController::class => fn() => new HomeController(),
    AuthController::class => fn() => new AuthController($repository),
    LegalController::class => fn() => new LegalController(),
    SitemapController::class => fn() => new SitemapController(),
    AccountController::class => fn() => new AccountController(),
    TermsController::class => fn() => new TermsController(),
    LampadaireController::class => fn() => new LampadaireController($lampadaireRepository),
];

$routes = require $racine . '/config/routes.php';

foreach ($routes as [$routeMethode, $routeChemin, [$classe, $action]]) {
    if ($routeMethode === $methode && $routeChemin === $chemin) {
        $controleur = $controleurs[$classe]();     // la closure construit le contrôleur
        $controleur->$action();                    // appel d'une méthode dont le nom est dans une variable
        exit;
    }
}

http_response_code(404);            // aucune route n'a correspondu
$utilisateur = $_SESSION['utilisateur'] ?? null;
$titre = 'Page introuvable';
$description = 'La page demandée n\'existe pas.';
render('404', [
    'chemin' => $chemin,
    'titre' => $titre,
    'description' => $description,
    'utilisateur' => $utilisateur
]);

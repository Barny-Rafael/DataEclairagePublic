<?php

use App\Model\UserRepository;
use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\LegalController;
use App\Controller\SitemapController;
use App\Controller\AccountController;

$racine = dirname(__DIR__);                    // on est dans public/, le projet est un cran au-dessus

require $racine . '/autoload.php';
require $racine . '/src/Core/render.php';
require $racine . '/src/Core/db.php';
session_start();                               // une seule fois, pour tout le site

$chemin = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';   // "/login?x=1" -> "/login"
$chemin = rtrim($chemin, '/') ?: '/';                                // "/login/"    -> "/login"

$methode = $_SERVER['REQUEST_METHOD'];

$repository = new UserRepository($pdo);
$controleurs = [
    HomeController::class => fn() => new HomeController(),
    AuthController::class => fn() => new AuthController($repository),
    LegalController::class => fn() => new LegalController(),
    SitemapController::class => fn() => new SitemapController(),
    AccountController::class => fn() => new AccountController()
];

$routes = require $racine . '/config/routes.php';

foreach ($routes as [$routeMethode, $routeChemin, [$classe, $action]]) {
    if ($routeMethode === $methode && $routeChemin === $chemin) {
        $controleur = $controleurs[$classe]();     // la closure construit le contrôleur
        $controleur->$action();                    // appel d'une méthode dont le nom est dans une variable
        exit;
    }
}

$utilisateur = $_SESSION['utilisateur'] ?? null;
http_response_code(404);            // aucune route n'a correspondu
render('404', [
    'chemin' => $chemin,
    'utilisateur' => $utilisateur
]);
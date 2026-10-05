<?php

use App\Model\UserRepository;
use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\LegalController;
use App\Controller\SitemapController;

$racine = dirname(__DIR__);

require $racine . '/autoload.php';
require $racine . '/src/Core/render.php';
$pdo = require $racine . '/src/Core/db.php';session_start();

$chemin = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';
$chemin = rtrim($chemin, '/') ?: '/';

$methode = $_SERVER['REQUEST_METHOD'];

$repository = new UserRepository($pdo);
$controleurs = [
    HomeController::class => fn() => new HomeController(),
    AuthController::class => fn() => new AuthController($repository),
    LegalController::class => fn() => new LegalController(),
    SitemapController::class => fn() => new SitemapController()
];

$routes = require $racine . '/config/routes.php';

foreach ($routes as [$routeMethode, $routeChemin, $cible]) {
    if ($routeMethode === $methode && $routeChemin === $chemin) {

        if (is_array($cible)) {
            [$classe, $action] = $cible;
            $controleur = $controleurs[$classe]();
            $controleur->$action();
            exit;
        }

        if (is_string($cible)) {
            render($cible);
            exit;
        }
    }
}

// 404 si aucune route ne correspond
http_response_code(404);
render('404', ['chemin' => $chemin]);
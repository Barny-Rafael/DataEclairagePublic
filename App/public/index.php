<?php

use App\Model\UserRepository;
use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\LegalController;
use App\Controller\SitemapController;

$racine = dirname(__DIR__);

require $racine . '/autoload.php';
require $racine . '/src/Core/render.php';
$pdo = require $racine . '/src/Core/db.php';
session_start();

try {
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

            // route controller
            if (is_array($cible)) {
                [$classe, $action] = $cible;
                $controleur = $controleurs[$classe]();
                $controleur->$action();
                exit;
            }

            // route view
            if (is_string($cible)) {
                render($cible);
                exit;
            }
        }
    }

    // Si aucune route ne correspond -> Erreur 404
    http_response_code(404);
    render('404', ['chemin' => $chemin]);
    exit;

} catch (\Throwable $e) {
    // Si  403 (acces interdit)
    if ($e->getCode() === 403) {
        http_response_code(403);
        render('403', ['message' => $e->getMessage() ?: 'Accès interdit']);
        exit;
    }

    // Si Erreur 500 (Serveur)
    http_response_code(500);
    render('500', ['erreur' => $e->getMessage()]);
    exit;
}
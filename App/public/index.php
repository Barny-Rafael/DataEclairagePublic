<?php

use App\Core\Request;
use App\Model\UserRepository;
use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\LegalController;
use App\Controller\SitemapController;

$racine = dirname(__DIR__);                    // on est dans public/, le projet est un cran au-dessus

require $racine . '/autoload.php';
require $racine . '/includes/render.php';
require $racine . '/includes/db.php';
session_start();//une seule fois, pour tout le site

$request = Request::fromGlobals();
$response = null;

$repository = new UserRepository($pdo);
$controleurs = [
    HomeController::class => fn() => new HomeController(),
    AuthController::class => fn() => new AuthController($repository),
    LegalController::class => fn() => new LegalController(),
    SitemapController::class => fn() => new SitemapController()
];

$routes = require $racine . '/config/routes.php';

foreach ($routes as [$routeMethode, $routeChemin, [$classe, $action]]) {
    if ($routeMethode === $request-> method && $routeChemin === $request -> path) {
        $controleur = $controleurs[$classe]();     // la closure construit le contrôleur
        $response = $controleur -> $action($request);
		break;
    }
}

if ($response === null) {
	$response = render('404', ['chemin' => $request->path], 404);
}

$response->send();
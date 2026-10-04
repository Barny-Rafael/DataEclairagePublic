<?php

$racine = dirname(__DIR__);

require $racine . '/autoload.php';
require $racine . '/src/Core/render.php';
require $racine . '/src/Core/db.php';
session_start();                               // une seule fois, pour tout le site

$routes = require $racine . '/config/routes.php';

$chemin = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';   // "/login?x=1" -> "/login"
$chemin = rtrim($chemin, '/') ?: '/';                                // "/login/"    -> "/login"
var_dump($chemin); // Affiche le chemin pour le débogage    -- a enlever a la fin

if (!isset($routes[$chemin])) {
    http_response_code(404);
    render('404', ['titre' => 'Page non trouvée', 'chemin' => $chemin]);
    exit;

}

try {
    require $racine . '/src/Controller/' . $routes[$chemin] . '.php';
} catch (ForbiddenException $e) {
    http_response_code(403);
    render('403', ['titre' => 'Accès interdit']);
    exit;
} catch (Throwable $e) {
    http_response_code(500);
    render('500', ['titre' => 'Erreur interne']);
    exit;
}


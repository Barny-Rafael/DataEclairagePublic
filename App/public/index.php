<?php
$racine = dirname(__DIR__);                    // on est dans public/, le projet est un cran au-dessus

require $racine . '/autoload.php';
require $racine . '/src/Core/render.php';
require $racine . '/src/Core/db.php';
session_start();                               // une seule fois, pour tout le site

$routes = require $racine . '/config/routes.php';

$chemin = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?: '/';   // "/login?x=1" -> "/login"
$chemin = rtrim($chemin, '/') ?: '/';                                // "/login/"    -> "/login"
var_dump($chemin); // Affiche le chemin pour le débogage

if (!isset($routes[$chemin])) {
    // http_response_code(404);
    // render('404', ['chemin' => $chemin]);
    // exit;
}

require $racine . '/src/Controller/' . $routes[$chemin] . '.php';
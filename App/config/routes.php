<?php

use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\LegalController;
use App\Controller\SitemapController;

return [
    ['GET',  '/', [HomeController::class, 'index']],
    ['GET',  '/login', [AuthController::class, 'loginForm']],
    ['POST', '/login', [AuthController::class, 'login']],
    ['GET',  '/register', [AuthController::class, 'registerForm']],
    ['POST', '/register', [AuthController::class, 'register']],
    ['GET',  '/logout', [AuthController::class, 'logout']],
    ['GET',  '/forgot', [AuthController::class, 'forgotForm']],
    ['POST', '/forgot', [AuthController::class, 'forgot']],
    ['GET',  '/reset', [AuthController::class, 'resetForm']],
    ['POST', '/reset', [AuthController::class, 'reset']],
    ['GET',  '/legal', [LegalController::class, 'legal']],
    ['GET',  '/sitemap', [SitemapController::class, 'sitemap']],
];
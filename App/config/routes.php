<?php

use App\Controller\HomeController;
use App\Controller\AuthController;
use App\Controller\LegalController;
use App\Controller\SitemapController;
use App\Controller\AccountController;
use App\Controller\TermsController;

return [
    ['GET',  '/', [HomeController::class, 'index']],
    ['GET',  '/login', [AuthController::class, 'loginForm']],
    ['POST', '/login', [AuthController::class, 'login']],
    ['GET',  '/register', [AuthController::class, 'registerForm']],
    ['POST', '/register', [AuthController::class, 'register']],
    ['GET',  '/verification', [AuthController::class, 'verificationForm']],
    ['POST', '/verification', [AuthController::class, 'verification']],
    ['GET',  '/delete', [AuthController::class, 'deleteForm']],
    ['POST', '/delete', [AuthController::class, 'delete']],
    ['GET',  '/logout', [AuthController::class, 'logout']],
    ['GET', '/legal', [LegalController::class, 'legal']],
    ['GET', '/sitemap', [SitemapController::class, 'sitemap']],
    ['GET', '/account', [AccountController::class, 'account']],
    ['GET', '/terms', [TermsController::class, 'terms']]
];
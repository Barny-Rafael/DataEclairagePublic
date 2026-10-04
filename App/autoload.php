<?php
spl_autoload_register(function (string $classe): void {
    $prefixe = 'App\\';
    if (!str_starts_with($classe, $prefixe)) {
        return;                                   // pas à nous : on laisse la main
    }
    $relatif = substr($classe, strlen($prefixe)); // Model\UserRepository
    $fichier = '../src/' . str_replace('\\', '/', $relatif) . '.php';
    if (is_file($fichier)) {
        require $fichier;
    }
});
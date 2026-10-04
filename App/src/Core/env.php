<?php

function chargerEnv(string $chemin): void
{
    if (!is_file($chemin)) {
        throw new RuntimeException("Fichier de configuration introuvable : $chemin\n"
            . "Copiez .env.example vers .env puis adaptez les valeurs.");
    }
    foreach (file($chemin, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $ligne) {
        if (str_starts_with(trim($ligne), '#')) { // ignorer les commentaires
            continue;
        }
        [$cle, $valeur] = explode('=', $ligne, 2); // découper sur le premier "="
        $valeur = trim($valeur, "'\"");  // retirer les guillemets
        if (array_key_exists($cle, $_ENV) || getenv($cle) !== false) { // ne rien écraser si la variable existe déjà (getenv() ou $_ENV)...
            continue;
        }
        $_ENV[$cle] = $valeur;
        putenv("$cle=$valeur");
    }
}

function env(string $cle, ?string $defaut = null): ?string
{
    $valeur = $_ENV[$cle] ?? getenv($cle);   // le fichier .env, sinon l'environnement du système

    return $valeur === false ? $defaut : $valeur;
}
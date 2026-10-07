<?php
require_once __DIR__ . '/env.php';

chargerEnv('../.env');

$dsn = env('DB_DSN') ?? throw new RuntimeException('DB_DSN manquant dans .env');

$pdo = new PDO($dsn, env('DB_USER') ?: null, env('DB_PASSWORD') ?: null);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec('CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    reset_token_hash TEXT,
    reset_expires_at TIMESTAMP,
    delete_token_hash TEXT,
    delete_expires_at TIMESTAMP,
    created_at TIMESTAMP DEFAULT now(),
    updated_at TIMESTAMP DEFAULT now()
)');

$pdo->exec('CREATE TABLE IF NOT EXISTS lampadaires (
    id SERIAL PRIMARY KEY,
    reference TEXT NOT NULL UNIQUE,
    commune TEXT NOT NULL,
    adresse TEXT NOT NULL,
    type_lampe TEXT NOT NULL,
    puissance_w INTEGER NOT NULL,
    date_installation DATE NOT NULL,
    etat TEXT NOT NULL
)');

// Remplit la table avec 200 lampadaires de test, seulement si elle est vide
if ((int) $pdo->query('SELECT COUNT(*) FROM lampadaires')->fetchColumn() === 0) {
    $pdo->exec("INSERT INTO lampadaires (reference, commune, adresse, type_lampe, puissance_w, date_installation, etat)
        SELECT
            'LP-' || LPAD(i::text, 5, '0'),
            (ARRAY['Paris', 'Lyon', 'Marseille', 'Lille', 'Nantes'])[1 + i % 5],
            i || ' rue de l''Éclairage',
            (ARRAY['LED', 'Sodium haute pression', 'Iodure métallique'])[1 + i % 3],
            (ARRAY[35, 70, 100, 150])[1 + i % 4],
            DATE '2000-01-01' + i * 30,
            CASE WHEN i % 10 = 0 THEN 'En panne' ELSE 'Fonctionnel' END
        FROM generate_series(1, 200) AS i");
}

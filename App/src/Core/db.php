<?php
require_once __DIR__ . '/env.php';

chargerEnv('../.env');

$dsn = env('DB_DSN') ?? throw new RuntimeException('DB_DSN manquant dans .env');

// Un chemin SQLite relatif est résolu depuis la racine du projet, pas depuis le dossier courant.
if (str_starts_with($dsn, 'sqlite:') && !str_starts_with(substr($dsn, 7), '/')) {
    $dsn = 'sqlite:' . dirname(__DIR__) . '/' . substr($dsn, 7);
}

$pdo = new PDO($dsn, env('DB_USER') ?: null, env('DB_PASSWORD') ?: null);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$pdo->exec('CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,
    email TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL,
    reset_token_hash TEXT,
    reset_expires_at TIMESTAMP
)');

$pdo->exec('ALTER TABLE users
    ADD COLUMN IF NOT EXISTS reset_token_hash TEXT,
    ADD COLUMN IF NOT EXISTS reset_expires_at TIMESTAMP');
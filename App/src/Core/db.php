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
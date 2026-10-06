<?php
namespace App\Model;

use PDO;

final class UserRepository
{
    public function __construct(private readonly PDO $pdo) {}

    public function findByEmail(string $email): ?User    // null si absent
    {
        $stmt = $this->pdo->prepare('SELECT id, email, password FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $array = $stmt->fetch(PDO::FETCH_ASSOC);
        return $array ? new User($array['id'], $array['email'], $array['password']) : null;
    }
    public function emailExists(string $email): bool
    {
        $stmt = $this->pdo->prepare('SELECT id FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        if($stmt->fetch())
            return true;
        
        return false;
    }
    public function create(string $email, string $motDePasseClair): User
    {
        $stmt = $this->pdo->prepare('INSERT INTO users (email, password) VALUES (:email, :password)');
        $stmt->execute([
            'email' => $email,
            'password' => password_hash($motDePasseClair, PASSWORD_DEFAULT),
        ]);
        return new User($this->pdo->lastInsertId(), $email, password_hash($motDePasseClair, PASSWORD_DEFAULT));
    }

    public function deleteResetTokens(string $email): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE users SET reset_token_hash = NULL, reset_expires_at = NULL WHERE email = :email'
        );
        $stmt->execute(['email' => $email]);
    }
    public function createResetToken(string $email, string $tokenHash, string $expiresAt): void
    {
        $stmt = $this->pdo->prepare(
            'UPDATE users SET reset_token_hash = :hash, reset_expires_at = :expires WHERE email = :email'
        );
        $stmt->execute(['hash' => $tokenHash, 'expires' => $expiresAt, 'email' => $email]);
    }

    public function updatePassword(string $email, string $passwordHash): void
    {
        $stmt = $this->pdo->prepare('UPDATE users SET password = :password WHERE email = :email');
        $stmt->execute(['password' => $passwordHash, 'email' => $email]);
    }

    public function findEmailByToken(string $tokenHash): ?string
    {
        $stmt = $this->pdo->prepare(
            'SELECT email FROM users WHERE reset_token_hash = :hash AND reset_expires_at > :now'
        );
        $stmt->execute(['hash' => $tokenHash, 'now' => date('Y-m-d H:i:s')]);
        $email = $stmt->fetchColumn();

        return $email === false ? null : $email;
    }

    //private function hydrater(array $ligne): User     // une ligne SQL -> un objet, en un seul endroit
}
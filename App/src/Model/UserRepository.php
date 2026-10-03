<?php

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

    //private function hydrater(array $ligne): User     // une ligne SQL -> un objet, en un seul endroit
}
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

	public function deleteResetTokens(int $userId): void
	{
		$stmt = $this->pdo->prepare(
			'UPDATE users SET reset_token_hash = NULL, reset_expires_at = NULL WHERE id = :id'
		);
		$stmt->execute(['id' => $userId]);
	}
	public function createResetToken(int $userId, string $tokenHash, string $expiresAt): void
	{
		$stmt = $this->pdo->prepare(
			'UPDATE users SET reset_token_hash = :hash, reset_expires_at = :expires WHERE id = :id'
		);
		$stmt->execute(['hash' => $tokenHash, 'expires' => $expiresAt, 'id' => $userId]);
	}

    public function updatePassword(int $userId, string $passwordHash): void
    {
        $stmt = $this->pdo->prepare('UPDATE users SET password = :password WHERE id = :id');
        $stmt->execute(['password' => $passwordHash, 'id' => $userId]);
    }

	public function findUserIdByToken(string $tokenHash): ?int
	{
		$stmt = $this->pdo->prepare(
			'SELECT id FROM users WHERE reset_token_hash = :hash AND reset_expires_at > :now'
		);
		$stmt->execute(['hash' => $tokenHash, 'now' => date('Y-m-d H:i:s')]);
		$userId = $stmt->fetchColumn();

		return $userId === false ? null : (int) $userId;
	}

    //private function hydrater(array $ligne): User     // une ligne SQL -> un objet, en un seul endroit
}
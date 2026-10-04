<?php
namespace App\Model;

final class User
{
    public function __construct(
        public readonly int $id,
        public readonly string $email,
        public readonly string $passwordHash,
    ) {}

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->passwordHash);
    }
}
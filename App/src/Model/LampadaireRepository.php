<?php
namespace App\Model;

use PDO;

final class LampadaireRepository
{
    public function __construct(private readonly PDO $pdo) {}

    public function count(): int
    {
        return (int) $this->pdo->query('SELECT COUNT(*) FROM lampadaires')->fetchColumn();
    }

    public function findPage(int $limite, int $offset): array
    {
        $stmt = $this->pdo->prepare('SELECT * FROM lampadaires ORDER BY id LIMIT :limite OFFSET :offset');
        $stmt->bindValue('limite', $limite, PDO::PARAM_INT);
        $stmt->bindValue('offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
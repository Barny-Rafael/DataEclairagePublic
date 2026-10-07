<?php

namespace App\Controller;

use App\Model\LampadaireRepository;

final class LampadaireController
{
    public function __construct(private readonly LampadaireRepository $repository) {}

    public function liste(): void
    {
        $titre = 'Lampadaires';
        $utilisateur = $_SESSION['utilisateur'] ?? null;
        $description = 'Liste des lampadaires de l\'éclairage public.';

        $pagination = paginer($this->repository->count(), 10);
        $lampadaires = $this->repository->findPage($pagination['parPage'], $pagination['offset']);

        render('lampadaires', [
            'titre' => $titre,
            'utilisateur' => $utilisateur,
            'description' => $description,
            'lampadaires' => $lampadaires,
            'pagination' => $pagination
        ]);
    }
}
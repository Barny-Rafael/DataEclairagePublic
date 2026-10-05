<?php

namespace App\Controller;

final class LegalController
{
    public function legal(): void
    {
        render('legal', [
            'titre' => 'Mentions légales',
        ]);
    }
}
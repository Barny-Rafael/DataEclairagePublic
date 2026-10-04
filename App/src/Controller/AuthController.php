<?php

namespace App\Controller;

use App\Core\Request;
use App\Core\Response;
use App\Model\UserRepository;

final class AuthController
{
    public function __construct(private readonly UserRepository $repository) {}

	public function loginForm(Request $request): Response
	{
		return render('login',
			['titre' => 'Connexion',
			'erreur' => null,
			'email' => '']);
	}

    public function login(Request $request): Response
    {
        if($request->session('utilisateur') != null){
			return Response::redirect('/');
        }

		$email = trim($request->post('email', ''));
		$password = $request->post('password', '');

		$utilisateur = $this->repository->findByEmail($email);

        if ($utilisateur && $utilisateur->verifyPassword($password)) {
           session_regenerate_id(true);
		   $request->setSession('utilisateur', [
			   'id' => $utilisateur->id,
			   'email' => $utilisateur->email,
		   ]);
		   return Response::redirect('/');
        }

       return render('login', [
		   'titre' => 'Connexion',
	       'erreur' => 'Email ou mot de passe incorrect.',
	       'email' => $email
       ]);
    }

	public function registerForm(Request $request): Response
	{
		return render('register',
				['titre' => 'Inscription',
				'erreurs' => [], 'succes' => false,
				'email' => '']);
	}

    public function register(Request $request): Response
    {
		$erreurs = [];
		$succes = false;

	    $email = trim($request->post('email', ''));
	    $password = $request->post('password', '');
	    $confirmation = $request->post('confirmation', '');

        // Validation
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreurs[] = 'L\'adresse email est invalide.';
        }
        if (strlen($password) < 8) {
            $erreurs[] = 'Le mot de passe doit contenir au moins 8 caractères.';
        }
        if ($password !== $confirmation) {
            $erreurs[] = 'Les deux mots de passe ne correspondent pas.';
        }

        // Vérifie que l'email n'est pas déjà utilisé
        if (empty($erreurs)) {
            if ($this->repository->emailExists($email)) {
                $erreurs[] = 'Un compte existe déjà avec cet email.';
            }
        }

        // Insertion
        if (empty($erreurs)) {
            $this->repository->create($email, $password);
            $succes = true;
        }

		return render('register', [
			'titre' => 'Inscription',
			'erreurs' => $erreurs,
			'succes' => $succes,
			'email' => $email
		]);
    }



    public function logout(Request $request): Response
    {
        session_destroy();
        return Response::redirect('/');
    }
}
<?php
namespace App\Controller;
use App\Model\UserRepository;
final class AuthController
{
	public function __construct(private readonly UserRepository $repository) {}

	public function login(): void
	{
		$email = trim($_POST['email'] ?? '');
		$password = $_POST['password'] ?? '';
		$utilisateur = $this->repository->findByEmail($email);


		if ($utilisateur === null || !$utilisateur->verifyPassword($password)) {
			render('login', ['erreur' => 'Identifiants incorrects']);
			return;
		}

		session_regenerate_id(true);
		$_SESSION['user_id'] = $utilisateur->id; // au lieu de getId()
		header('Location: /');
		exit;
	}

	public function loginForm(): void // Affiche la vue
	{
		render('login');
	}

	public function register(): void
	{
		$email = trim($_POST['email'] ?? '');
		$password = $_POST['password'] ?? '';
		$confirmation = $_POST['confirmation'] ?? ''; // Ajoute ça

// Vérification de base
		if ($email === '' || $password === '' || $confirmation === '') {
			render('register', ['erreur' => 'Tous les champs sont obligatoires']);
			return;
		}

// Vérification de la confirmation
		if ($password !== $confirmation) {
			render('register', ['erreur' => 'Les mots de passe ne correspondent pas']);
			return;
		}

		//création
		$utilisateur = $this->repository->create($email, $password);

		//connexion automatique puis redirection
		session_regenerate_id(true);
		$_SESSION['user_id'] = $utilisateur->getId();$_SESSION['user_id'] = $utilisateur->getId();
		header('Location: /');
		exit;
	}

	public function registerForm(): void
	{
		render('register');
	}

	public function logout(): void
	{
		unset($_SESSION['user_id']);
		header('Location: /');
		exit;
	}






}
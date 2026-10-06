<?php

namespace App\Controller;

use App\Model\UserRepository;
use App\Model\User;

final class AuthController
{
    public function __construct(private readonly UserRepository $repository) {}

    public function loginForm(string $erreur = null, string $email = ''): void
    {
        render('login', [
            'titre'   => 'Connexion',
            'erreur' => $erreur,
            'email'   => $email
        ]);
    }

    public function login(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $utilisateur = $this->repository->findByEmail($email);

        if ($utilisateur && $utilisateur->verifyPassword($password)) {
            $_SESSION['utilisateur'] = [
                'id' => $utilisateur->id,
                'email' => $utilisateur->email
            ];
            header('Location: /');
            exit;
        }

        $erreur = 'Email ou mot de passe incorrect.';

        $this->loginForm($erreur, $email);
    }

    public function registerForm(array $erreurs = [], bool $succes = false, string $email = ''): void
    {
        render('register', [
            'titre'   => 'Inscription',
            'erreurs' => $erreurs,
            'succes'  => $succes,
            'email'   => $email
        ]);
    }

    public function register(): void
    {
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmation = $_POST['confirmation'] ?? '';
        $succes = false;
        $erreurs = [];

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

        $this->registerForm($erreurs, $succes, $email);
    }



    public function logout(): void
    {
        session_destroy();
        header('Location: /');
        exit;
    }

    public function resetform(?string $erreur = null, ?string $token = null): void
    {
		//Vérification du lien
	    if($token === null){
			$token = $_GET['token'] ?? '';

			if($this->repository->findEmailByToken(hash('sha256', $token)) === null){
				$erreur = "Lien invalide ou expiré";
				$token = '';
			}
	    }

        render('reset', [
            'titre'  => 'Nouveau mot de passe',
            'erreur' => $erreur,
            'token'  => $token,
        ]);
    }

    public function reset(): void
    {
        $token = trim($_POST['token'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmation = $_POST['password_confirmation'] ?? '';

        $email = $this->repository->findEmailByToken(hash('sha256', $token));

        if ($email === null) {
            $this->resetform('Lien invalide ou expiré.', '');
            return;
        }

        if(strlen($password) < 8){
            $this->resetForm('Le mot de passe doit contenir au moins 8 caractères.', $token);
            return;
        }

        if($password !== $confirmation){
            $this->resetform('Les deux mots de passe ne correspondent pas.', $token);
            return;
        }

        $this->repository->updatePassword($email, password_hash($password, PASSWORD_DEFAULT));
        $this->repository->deleteResetTokens($email);

        header('Location: /login');
        exit;
    }

    public function forgotForm(?string $erreur = null, string $message = '', string $email = ''): void
    {
	    render('forgot', [
		    'titre'   => 'Forgot password',
		    'erreur'  => $erreur,
		    'message' => $message,
		    'email'   => $email,
	    ]);
    }
    public function forgot(): void
    {
        $email = trim($_POST['email'] ?? '');
        $erreur = null;
	    $message = '';
        $succes = false;

        //Vérification de l'existence du mail dans le bdd
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $erreur = 'L\'adresse email est invalide.';
        } else {
            $user = $this->repository->findByEmail($email);

            if ($user) {
                $token = bin2hex(random_bytes(32));
                $tokenHash = hash('sha256', $token);
                $expiresAt = date('Y-m-d H:i:s', time() + 600);

                $this->repository->deleteResetTokens($user->email);
                $this->repository->createResetToken($user->email, $tokenHash, $expiresAt);
	            $link = 'http://localhost:8002/reset?token=' . $token;
	            $subject = 'Password reset';
	            $body    = "Click this link to choose a new password:\n\n$link\n\nThis is an automated message, please do not reply.";
	            $this->sendResetMail($user->email, $link);
            }

            $succes = true;

            $message = 'Si ce compte existe, un email a été envoyé.';

        }
	    $this->forgotForm($erreur, $message, $email);

    }

	private function sendResetMail(string $email,string $subject, string $body, string $link): void
	{
		error_log("Lien du reset pour $email : $link");
		$headers = "From: no-reply <data-eclairagepublic@alwaysdata.net>\r\n"
			. "Content-Type: text/plain; charset=UTF-8";

		mail($email, $subject, $body, $headers);
	}
}
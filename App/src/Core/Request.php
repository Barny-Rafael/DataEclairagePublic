<?php

namespace App\Core;

final class Request
{
	public function __construct(public readonly string $method,
	                            public readonly string $path,
	                            private array $get,
	                            private array $post,
	                            private array $session)
	{}

	public static function fromGlobals(): self
	{
		return new self(
			$_SERVER['REQUEST_METHOD'] ?? 'GET',
			parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/',
			$_GET,
			$_POST,
			$_SESSION ?? []
		);
	}
	public function get(string $cle, mixed $defaut = null): mixed
	{
		return $this->get[$cle] ?? $defaut;
	}

	public function post(string $cle, mixed $defaut = null): mixed
	{
		return $this->post[$cle] ?? $defaut;
	}

	public function session(string $cle, mixed $defaut = null): mixed
	{
		return $this->session[$cle] ?? $defaut;
	}

	public function setSession(string $cle, mixed $valeur): void
	{
		$this->session[$cle] = $valeur;
		$_SESSION[$cle] = $valeur;
	}

}
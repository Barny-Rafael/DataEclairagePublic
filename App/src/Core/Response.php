<?php

namespace App\Core;

final class Response
{
	public function __construct(
		public readonly int $status = 200,
		public readonly string $body = '',
		private array $headers = []
	){}

	public static function redirect(string $url): self
	{
		return new self(302, '', ['Location' => $url]);
	}

	public function send(): void
	{
		http_response_code($this->status);
		foreach ($this->headers as $header => $value) {
			header("$header: $value");
		}
		echo $this->body;
	}

}

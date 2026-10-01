<?php

class Database
{
	private static ?PDO $instance = null;

	public static function getInstance(): PDO
	{
		if (self::$instance === null) {

			$config = require __DIR__ . '/../config/config.php';

			$dsn = "pgsql:host={$config['db_host']};port=5432;dbname={$config['db_name']}";

			self::$instance = new PDO($dsn, $config['db_user'], $config['db_pass'], [
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			]);
		}

		return self::$instance;
	}
}
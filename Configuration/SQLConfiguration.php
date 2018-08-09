<?php

class SQLConfiguration {
	
	/**
	 * Configuração para PDOException
	 */
	const OPTIONS = [
		PDO::ATTR_EMULATE_PREPARES   => false,
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	];
}
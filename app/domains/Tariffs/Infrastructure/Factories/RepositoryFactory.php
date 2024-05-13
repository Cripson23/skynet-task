<?php

namespace app\domains\Tariffs\Infrastructure\Factories;

use Exception;
use PDOException;
use general\Logger;
use general\Config;
use general\Database\Database;
use app\domains\Tariffs\Infrastructure\Repositories\SqlTariffRepository;

/**
 * Фабрика для классов репозиториев
 */
class RepositoryFactory
{
	/**
	 * @throws Exception
	 */
	public static function createTariffRepository(): SqlTariffRepository
	{
		try {
			$config = Config::get('database');
			$database = new Database($config);
			$connection = $database->getConnection();
			return new SqlTariffRepository($connection);
		} catch (PDOException $e) {
			$errorMessage = 'Ошибка подключения к базе данных: ' . $e->getMessage();
			Logger::logError($errorMessage);
			throw new Exception($errorMessage);
		}
	}
}
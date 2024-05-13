<?php

namespace app\domains\Tariffs\Application\Factories;

use Exception;
use app\domains\Tariffs\Application\Services\TariffService;
use app\domains\Tariffs\Infrastructure\Factories\RepositoryFactory;

/**
 * Фабрика для сервисных классов
 */
class ServiceFactory
{
	/**
	 * @throws Exception
	 */
	public static function createTariffService(): TariffService
	{
		$repository = RepositoryFactory::createTariffRepository();
		return new TariffService($repository);
	}
}
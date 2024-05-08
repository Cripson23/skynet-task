<?php

namespace app\domains\Tariffs\Application\Services;

use app\domains\Tariffs\Application\DTO\TariffDTO;
use app\domains\Tariffs\Domain\Repositories\TariffRepositoryInterface;

/**
 * Сервис для работы с Тарифами
 */
class TariffService
{
	private TariffRepositoryInterface $tariffRepository;

	public function __construct(TariffRepositoryInterface $tariffRepository)
	{
		$this->tariffRepository = $tariffRepository;
	}

	/**
	 * Получение списка всех тарифов
	 *
	 * @return array
	 */
	public function getAllTariffs(): array
	{
		$tariffs = $this->tariffRepository->findAll();

		$tariffDTOs = [];

		foreach ($tariffs as $tariff) {
			$tariffDTOs[] = new TariffDTO($tariff);
		}

		return $tariffDTOs;
	}

	/**
	 * Получение информации о тарифе
	 *
	 * @param int $id
	 * @return TariffDTO|null
	 */
	public function getTariffDetails(int $id): ?TariffDTO
	{
		$tariff = $this->tariffRepository->findById($id);
		if (!$tariff) {
			return null;
		}

		return new TariffDTO($tariff);
	}
}
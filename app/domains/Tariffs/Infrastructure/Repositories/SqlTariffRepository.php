<?php

namespace app\domains\Tariffs\Infrastructure\Repositories;

use PDO;
use Exception;
use app\domains\Tariffs\Domain\Factories\TariffFactory;
use app\domains\Tariffs\Domain\Entities\Tariff;
use app\domains\Tariffs\Domain\Repositories\TariffRepositoryInterface;

/**
 * Реализация работы с данными тарифа с помощью SQL
 */
class SqlTariffRepository implements TariffRepositoryInterface
{
	public function __construct(private readonly PDO $connection) {
	}

	/**
	 * Поиск тарифа по id
	 *
	 * @throws Exception
	 */
	public function findById(int $id): ?Tariff
	{
		$stmt = $this->connection->prepare("SELECT * FROM tariffs WHERE id = :id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($data) {
			return TariffFactory::create(
				$data['id'],
				$data['name'],
				$data['price'],
				$data['duration_days'],
				$data['speed'],
				$data['type'],
				$data['created_at']
			);
		}

		return null;
	}

	/**
	 * Поиск всех тарифов
	 *
	 * @param array $filters
	 * @param string $sortField
	 * @param string $sortDirection
	 * @param int $page
	 * @param int $perPage
	 * @return array
	 * @throws Exception
	 */
	public function findAll(array $filters = [], string $sortField = 'created_at', string $sortDirection = 'DESC', int $page = 1, int $perPage = 10): array
	{
		$offset = ($page - 1) * $perPage;
		$sql = "SELECT * FROM tariffs WHERE 1 = 1";

		// Apply filters
		foreach ($filters as $key => $value) {
			$sql .= " AND {$key} = :{$key}";
		}
		$sql .= " ORDER BY {$sortField} {$sortDirection} LIMIT {$perPage} OFFSET {$offset}";

		$stmt = $this->connection->prepare($sql);

		// Bind values from filters
		foreach ($filters as $key => $value) {
			$stmt->bindValue(":{$key}", $value);
		}

		$stmt->execute();
		$tariffs = $stmt->fetchAll(PDO::FETCH_ASSOC);

		return array_map(function ($data) {
			return TariffFactory::create(
				$data['id'],
				$data['name'],
				$data['price'],
				$data['duration_days'],
				$data['speed'],
				$data['type'],
				$data['created_at']
			);
		}, $tariffs);
	}
}
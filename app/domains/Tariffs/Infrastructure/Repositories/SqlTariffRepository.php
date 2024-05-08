<?php

namespace app\domains\Tariffs\Infrastructure\Repositories;

use PDO;
use Exception;
use DateTimeImmutable;
use general\Config;
use general\Database\Database;
use app\domains\Tariffs\Domain\Entities\Tariff;
use app\domains\Tariffs\Domain\ValueObjects\Duration;
use app\domains\Tariffs\Domain\ValueObjects\Money;
use app\domains\Tariffs\Domain\ValueObjects\Speed;
use app\domains\Tariffs\Domain\ValueObjects\TariffType;
use app\domains\Tariffs\Domain\Repositories\TariffRepositoryInterface;

/**
 * Реализация работы с данными тарифа с помощью SQL
 */
class SqlTariffRepository implements TariffRepositoryInterface
{
	private PDO $connection;

	public function __construct() {
		$config = Config::get('database');
		$this->connection = (new Database($config))->getConnection();
	}

	/**
	 * @throws Exception
	 */
	public function findById(int $id): ?Tariff
	{
		$stmt = $this->connection->prepare("SELECT * FROM tariffs WHERE id = :id");
		$stmt->bindParam(':id', $id, PDO::PARAM_INT);
		$stmt->execute();

		$data = $stmt->fetch(PDO::FETCH_ASSOC);
		if ($data) {
			return new Tariff(
				$data['id'],
				$data['name'],
				(new Money($data['price'])),
				(new Duration($data['duration_days'])),
				(new Speed($data['speed'])),
				(new TariffType($data['type'])),
				(new DateTimeImmutable($data['created_at'])),
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
			return new Tariff(
				$data['id'],
				$data['name'],
				(new Money($data['price'])),
				(new Duration($data['duration_days'])),
				(new Speed($data['speed'])),
				(new TariffType($data['type'])),
				(new DateTimeImmutable($data['created_at'])),
			);
		}, $tariffs);
	}
}
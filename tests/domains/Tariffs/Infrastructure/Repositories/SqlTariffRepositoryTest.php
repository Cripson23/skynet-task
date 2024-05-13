<?php

namespace domains\Tariffs\Infrastructure\Repositories;

use PDO;
use PDOStatement;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use app\domains\Tariffs\Infrastructure\Repositories\SqlTariffRepository;
use app\domains\Tariffs\Domain\Entities\Tariff;

/**
 * Класс тестирования репозитория работы с данными тарифа через SQL
 */
class SqlTariffRepositoryTest extends TestCase
{
	private PDO|MockObject $pdoMock;
	private PDOStatement|MockObject $stmtMock;
	private SqlTariffRepository|MockObject $repository;

	/**
	 * @throws Exception
	 */
	protected function setUp(): void
	{
		$this->pdoMock = $this->createMock(PDO::class);
		$this->stmtMock = $this->createMock(PDOStatement::class);
		$this->repository = new SqlTariffRepository($this->pdoMock);
	}

	/**
	 * Тестирование получения данных о тарифе по ID когда он находится в БД и должен быть успешно найден
	 *
	 * @throws \Exception
	 */
	public function testFindByIdReturnsTariffWhenFound()
	{
		$tariffData = [
			'id' => 1,
			'name' => 'Тестовый',
			'price' => 100.44,
			'duration_days' => 30,
			'speed' => 100,
			'type' => 1,
			'created_at' => '2024-05-08 09:12:37'
		];

		// Проверка переданного параметра id
		$this->stmtMock->expects($this->once())
			->method('bindParam')
			->with($this->equalTo(':id'), $this->equalTo($tariffData['id']), $this->equalTo(PDO::PARAM_INT));

		$this->pdoMock->method('prepare')->willReturn($this->stmtMock);
		$this->stmtMock->method('execute')->willReturn(true);
		$this->stmtMock->method('fetch')->willReturn($tariffData);

		$tariff = $this->repository->findById($tariffData['id']);

		$this->assertNotNull($tariff);
		$this->assertSame($tariffData['name'], $tariff->getName());
		$this->assertSame($tariffData['price'], $tariff->getPrice()->getAmount());
		$this->assertSame($tariffData['duration_days'], $tariff->getDurationDays()->getDays());
		$this->assertSame($tariffData['speed'], $tariff->getSpeed()->getMbps());
		$this->assertSame($tariffData['type'], $tariff->getType()->getType());
		$this->assertSame($tariffData['created_at'], $tariff->getCreatedAt()->format('Y-m-d H:i:s'));
	}

	/**
	 * Тестирование получения данных о тарифе по ID когда его нет в БД
	 *
	 * @throws \Exception
	 */
	public function testFindByIdReturnsNullWhenNotFound()
	{
		$this->pdoMock->method('prepare')->willReturn($this->stmtMock);
		$this->stmtMock->method('execute')->willReturn(true);
		$this->stmtMock->method('fetch')->willReturn(false);

		$tariff = $this->repository->findById(999);

		$this->assertNull($tariff);
	}

	/**
	 * Тестирование получения списка всех тарифов
	 *
	 * @throws \Exception
	 */
	public function testFindAllReturnsArrayOfTariffs()
	{
		$tariffData = [
			[
				'id' => 1,
				'name' => 'Тестовый',
				'price' => 100.44,
				'duration_days' => 30,
				'speed' => 100,
				'type' => 1,
				'created_at' => '2024-05-08 09:12:37'
			],
			[
				'id' => 2,
				'name' => 'Тестовый 2',
				'price' => 400.56,
				'duration_days' => 60,
				'speed' => 200,
				'type' => 2,
				'created_at' => '2024-06-08 10:15:40'
			]
		];

		$this->pdoMock->method('prepare')->willReturn($this->stmtMock);
		$this->stmtMock->method('execute')->willReturn(true);
		$this->stmtMock->method('fetchAll')->willReturn($tariffData);

		$tariffs = $this->repository->findAll();

		$this->assertIsArray($tariffs);
		$this->assertCount(2, $tariffs);
		foreach ($tariffs as $tariff) {
			$this->assertInstanceOf(Tariff::class, $tariff);
		}
	}

}
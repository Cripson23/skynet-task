<?php

namespace domains\Tariffs\Application\Services;

use DateTimeImmutable;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use app\domains\Tariffs\Application\DTO\TariffDTO;
use app\domains\Tariffs\Domain\Entities\Tariff;
use app\domains\Tariffs\Domain\ValueObjects\DurationDays;
use app\domains\Tariffs\Domain\ValueObjects\Money;
use app\domains\Tariffs\Domain\ValueObjects\Speed;
use app\domains\Tariffs\Domain\ValueObjects\TariffType;
use app\domains\Tariffs\Domain\Repositories\TariffRepositoryInterface;
use app\domains\Tariffs\Application\Services\TariffService;

/**
 * Тестирование сервиса по работе с тарифами
 */
class TariffServiceTest extends TestCase
{
	private TariffService $tariffService;

	private TariffRepositoryInterface|MockObject $repositoryMock;

	/**
	 * @throws Exception
	 */
	protected function setUp(): void
	{
		// Создание мока репозитория
		$this->repositoryMock = $this->createMock(TariffRepositoryInterface::class);
		// Создание экземпляра TariffService с инжектированным моком репозитория
		$this->tariffService = new TariffService($this->repositoryMock);
	}

	/**
	 * Создание тестового тарифа
	 *
	 * @return Tariff
	 */
	protected function createTestTariff(): Tariff
	{
		return new Tariff(
			1,
			'Тестовый',
			new Money(100.44),
			new DurationDays(30),
			new Speed(100),
			new TariffType(1),
			new DateTimeImmutable()
		);
	}

	/**
	 * Проверка метода получения всех тарифов
	 *
	 * @return void
	 */
	public function testGetAllTariffsReturnsArrayOfTariffDTOs()
	{
		// Подготовка данных
		$tariff = $this->createTestTariff();

		$this->repositoryMock->method('findAll')->willReturn([$tariff]);

		// Вызов
		$result = $this->tariffService->getAllTariffs();

		// Проверки
		$this->assertIsArray($result);
		$this->assertCount(1, $result);
		$this->assertInstanceOf(TariffDTO::class, $result[0]);
	}

	/**
	 * Проверка метода получения тарифа по ID
	 *
	 * @return void
	 */
	public function testGetTariffDetailsReturnsTariffDTOOrNull()
	{
		// Подготовка данных
		$tariff = $this->createTestTariff();
		$this->repositoryMock->method('findById')
			->willReturnOnConsecutiveCalls($tariff, null);

		// Проверка существующего ID
		$result = $this->tariffService->getTariffDetails(1);
		$this->assertInstanceOf(TariffDTO::class, $result);

		// Проверка на отсутствующий ID
		$result = $this->tariffService->getTariffDetails(999);
		$this->assertNull($result);
	}
}
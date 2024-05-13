<?php

namespace domains\Tariffs\Application\DTO;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use app\domains\Tariffs\Application\DTO\TariffDTO;
use app\domains\Tariffs\Domain\Entities\Tariff;
use app\domains\Tariffs\Domain\ValueObjects\DurationDays;
use app\domains\Tariffs\Domain\ValueObjects\Money;
use app\domains\Tariffs\Domain\ValueObjects\Speed;
use app\domains\Tariffs\Domain\ValueObjects\TariffType;

/**
 * Тестирование DTO тарифов
 */
class TariffDTOTest extends TestCase
{
	/**
	 * Создание DTO для тарифов
	 *
	 * @return void
	 */
	public function testDTOCreation(): void
	{
		$tariff = new Tariff(
			1,
			'Тестовый',
			new Money(100.44),
			new DurationDays(30),
			new Speed(100),
			new TariffType(1),
			new DateTimeImmutable('2024-05-08 09:12:37')
		);

		$dto = new TariffDTO($tariff);

		$this->assertSame($tariff->getId(), $dto->id);
		$this->assertSame($tariff->getName(), $dto->name);
		$this->assertSame($tariff->getPrice()->getAmount(), $dto->price);
		$this->assertSame($tariff->getDurationDays()->getDays(), $dto->duration);
		$this->assertSame($tariff->getSpeed()->getMbps(), $dto->speed);
		$this->assertSame('Актуальный', $dto->type);
	}
}
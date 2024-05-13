<?php

namespace domains\Tariffs\Domain\Entities;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;
use app\domains\Tariffs\Domain\Entities\Tariff;
use app\domains\Tariffs\Domain\ValueObjects\DurationDays;
use app\domains\Tariffs\Domain\ValueObjects\Money;
use app\domains\Tariffs\Domain\ValueObjects\Speed;
use app\domains\Tariffs\Domain\ValueObjects\TariffType;

/**
 * Тестирование сущности тарифа
 */
class TariffTest extends TestCase
{
	/**
	 * Создание сущности тарифа
	 *
	 * @return void
	 */
	public function testTariffCreation(): void
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

		$this->assertSame(1, $tariff->getId());
		$this->assertSame('Тестовый', $tariff->getName());

		$this->assertEquals(new Money(100.44), $tariff->getPrice());
		$this->assertEquals(new DurationDays(30), $tariff->getDurationDays());
		$this->assertEquals(new Speed(100), $tariff->getSpeed());
		$this->assertEquals(1, $tariff->getType()->getType());
		$this->assertEquals(new DateTimeImmutable('2024-05-08 09:12:37'), $tariff->getCreatedAt());
	}
}
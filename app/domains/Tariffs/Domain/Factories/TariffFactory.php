<?php

namespace app\domains\Tariffs\Domain\Factories;

use Exception;
use DateTimeImmutable;
use app\domains\Tariffs\Domain\Entities\Tariff;
use app\domains\Tariffs\Domain\ValueObjects\DurationDays;
use app\domains\Tariffs\Domain\ValueObjects\Money;
use app\domains\Tariffs\Domain\ValueObjects\Speed;
use app\domains\Tariffs\Domain\ValueObjects\TariffType;

/**
 * Фабрика для сущности тарифа
 */
class TariffFactory
{
	/**
	 * @throws Exception
	 */
	public static function create(int $id, string $name, float $price, int $durationDays, int $speedMbps, int $type, string $createdAt): Tariff
	{
		return new Tariff(
			$id,
			$name,
			new Money($price),
			new DurationDays($durationDays),
			new Speed($speedMbps),
			new TariffType($type),
			new DateTimeImmutable($createdAt)
		);
	}
}
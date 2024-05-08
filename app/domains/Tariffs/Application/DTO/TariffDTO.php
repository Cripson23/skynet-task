<?php

namespace app\domains\Tariffs\Application\DTO;

use app\domains\Tariffs\Application\Enums\TariffTypeEnum;
use app\domains\Tariffs\Domain\Entities\Tariff;

/**
 * Объект транспортировки данных тарифа
 */
class TariffDTO
{
	public int $id;
	public string $name;
	public float $price;
	public int $duration;
	public int $speed;
	public string $type;
	public string $createdAt;

	/**
	 * @param Tariff $tariff
	 */
	public function __construct(Tariff $tariff)
	{
		$this->id = $tariff->getId();
		$this->name = $tariff->getName();
		$this->price = $tariff->getPrice()->getAmount();
		$this->duration = $tariff->getDuration()->getDays();
		$this->speed = $tariff->getSpeed()->getMbps();
		$this->type = TariffTypeEnum::from($tariff->getType()->getType())->text();
		$this->createdAt = $tariff->getCreatedAt()->format('H:i:s d.m.Y');
	}
}
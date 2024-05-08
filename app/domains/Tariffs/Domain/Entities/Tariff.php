<?php

namespace app\domains\Tariffs\Domain\Entities;

use DateTimeImmutable;
use app\domains\Tariffs\Domain\ValueObjects\Duration;
use app\domains\Tariffs\Domain\ValueObjects\Money;
use app\domains\Tariffs\Domain\ValueObjects\Speed;
use app\domains\Tariffs\Domain\ValueObjects\TariffType;

/**
 * Сущность тарифа
 */
class Tariff
{
	private int $id;
	private string $name;
	private Money $price;
	private Duration $duration;
	private Speed $speed;
	private TariffType $type;
	private DateTimeImmutable $createdAt;

	/**
	 * @param int $id
	 * @param string $name
	 * @param Money $price
	 * @param Duration $duration
	 * @param Speed $speed
	 * @param TariffType $type
	 * @param DateTimeImmutable $createdAt
	 */
	public function __construct(int $id, string $name, Money $price, Duration $duration, Speed $speed, TariffType $type, DateTimeImmutable $createdAt)
	{
		$this->id = $id;
		$this->name = $name;
		$this->price = $price;
		$this->duration = $duration;
		$this->speed = $speed;
		$this->type = $type;
		$this->createdAt = $createdAt;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}

	/**
	 * @return Money
	 */
	public function getPrice(): Money
	{
		return $this->price;
	}

	/**
	 * @return Duration
	 */
	public function getDuration(): Duration
	{
		return $this->duration;
	}

	/**
	 * @return Speed
	 */
	public function getSpeed(): Speed
	{
		return $this->speed;
	}

	/**
	 * @return TariffType
	 */
	public function getType(): TariffType
	{
		return $this->type;
	}

	/**
	 * @return DateTimeImmutable
	 */
	public function getCreatedAt(): DateTimeImmutable
	{
		return $this->createdAt;
	}
}
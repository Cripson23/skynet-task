<?php

namespace app\domains\Tariffs\Domain\ValueObjects;

/**
 * Стоимость
 */
class Money
{
	private float $amount;

	/**
	 * @param float $amount
	 */
	public function __construct(float $amount)
	{
		$this->amount = $amount;
	}

	/**
	 * @return float
	 */
	public function getAmount(): float
	{
		return $this->amount;
	}
}
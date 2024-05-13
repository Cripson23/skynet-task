<?php

namespace app\domains\Tariffs\Domain\ValueObjects;

/**
 * Срок действия
 */
class DurationDays
{
	private int $days;

	/**
	 * @param int $days
	 */
	public function __construct(int $days)
	{
		$this->days = $days;
	}

	/**
	 * @return int
	 */
	public function getDays(): int
	{
		return $this->days;
	}
}
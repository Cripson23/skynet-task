<?php

namespace app\domains\Tariffs\Domain\ValueObjects;

/**
 * Скорость
 */
class Speed
{
	private int $mbps;

	/**
	 * @param int $mbps
	 */
	public function __construct(int $mbps)
	{
		$this->mbps = $mbps;
	}

	/**
	 * @return int
	 */
	public function getMbps(): int
	{
		return $this->mbps;
	}
}
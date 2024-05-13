<?php

namespace app\domains\Tariffs\Domain\ValueObjects;

/**
 * Тип тарифа
 */
class TariffType
{
	private int $type;

	/**
	 * @param int $type
	 */
	public function __construct(int $type)
	{
		$this->type = $type;
	}

	/**
	 * @return int
	 */
	public function getType(): int
	{
		return $this->type;
	}
}
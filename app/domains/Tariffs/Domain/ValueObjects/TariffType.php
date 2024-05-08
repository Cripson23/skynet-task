<?php

namespace app\domains\Tariffs\Domain\ValueObjects;

/**
 * Тип тарифа
 */
class TariffType
{
	private string $type;

	/**
	 * @param string $type
	 */
	public function __construct(string $type)
	{
		$this->type = $type;
	}

	/**
	 * @return string
	 */
	public function getType(): string
	{
		return $this->type;
	}
}
<?php

namespace app\domains\Tariffs\Application\Enums;

/**
 * Описание типов тарифов
 */
enum TariffTypeEnum: int
{
	case ARCHIVAL = 0;
	case ACTUAL = 1;
	case SYSTEM = 2;

	public function text(): string
	{
		return match ($this) {
			self::ARCHIVAL => 'Архивный',
			self::ACTUAL => 'Актуальный',
			self::SYSTEM => 'Системный',
		};
	}
}

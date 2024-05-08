<?php

namespace app\domains\Tariffs\Domain\Repositories;

use app\domains\Tariffs\Domain\Entities\Tariff;

interface TariffRepositoryInterface
{
	public function findById(int $id): ?Tariff;
	public function findAll(
		array  $filters = [],
		string $sortField = 'created_at',
		string $sortDirection = 'DESC',
		int $page = 1,
		int $perPage = 10
	): array;
}
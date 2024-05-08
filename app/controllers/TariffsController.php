<?php

namespace app\controllers;

use general\Router;
use general\View;
use enums\HttpStatusCodes;
use app\domains\Tariffs\Application\Services\TariffService;
use app\domains\Tariffs\Infrastructure\Repositories\SqlTariffRepository;

class TariffsController extends BaseController
{
    private readonly TariffService $tariffService;

	public function __construct()
	{
        $this->tariffService = new TariffService(new SqlTariffRepository());
		parent::__construct();
	}

	/**
	 * Отображение страницы тарифов
	 *
	 * @return void
	 */
	public function index(): void
	{
		$tariffs = $this->tariffService->getAllTariffs();

		View::render('tariffs.index', ['title' => 'Тарифы', 'tariffs' => $tariffs]);
	}

	/**
	 * Отображение страницы с информацией о тарифе
	 *
	 * @return void
	 */
	public function view(): void
	{
		$tariffId = $this->getParams['id'] ?? null;
		if (empty($tariffId) || !is_numeric($tariffId)) {
			Router::redirectToError(HttpStatusCodes::NOT_FOUND->value);
		}

		$tariff = $this->tariffService->getTariffDetails($tariffId);

		if ($tariff === null) {
			Router::redirectToError(HttpStatusCodes::NOT_FOUND->value);
		}

		View::render('tariffs.view', ['title' => 'Тариф', 'tariff' => $tariff]);
	}
}
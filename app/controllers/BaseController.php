<?php

namespace app\controllers;

/**
 * Базовый класс контроллеров
 */
class BaseController
{
	protected ?string $previousUrl;

    protected array $session = [];
    protected array $cookies = [];
    protected array $getParams = [];
    protected array $postParams = [];

    public function __construct()
    {
		$this->previousUrl = $_SERVER['HTTP_REFERER'] ?? null;

        session_start(); // сессия начата до работы с $_SESSION

        $this->getParams = $this->sanitizeData($_GET);
        $this->postParams = $this->sanitizeData($_POST);
        $this->session = $this->sanitizeData($_SESSION); // Обработка $_SESSION по месту использования
        $this->cookies = $this->sanitizeData($_COOKIE);
    }

    /**
     * Обработка входных данных
     *
     * @param array $data
     * @return array
     */
    private function sanitizeData(array $data): array
    {
        $sanitizedData = [];
        foreach ($data as $key => $value) {
            if (is_array($value)) {
                $sanitizedData[$key] = $this->sanitizeData($value); // Рекурсивная очистка для многомерных массивов
            } else {
				$value = htmlspecialchars($value ?? '');
                // FILTER_SANITIZE_SPECIAL_CHARS для предотвращения XSS
                $sanitizedData[$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        return $sanitizedData;
    }

	/**
	 * Отправляем ответ в JSON
	 * @param array $response
	 * @return void
	 */
    protected function sendJsonResponse(array $response): void
    {
		$status = $response['status'] ?? null;

        if (empty($status)) {
            $status = $response['success'] ? 200 : 500;
        }

        header('Content-Type: application/json');
        header("HTTP/1.1 {$status}");

        echo json_encode($response);
		exit;
    }
}
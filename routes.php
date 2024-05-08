<?php

use app\controllers\TariffsController;

/**
 * Маршруты в формате: [uri, classController, classMethod, typeMethod]
 */
return [
	['/^\/?$/', TariffsController::class, 'index'],
	['/^view?$/', TariffsController::class, 'view'],
];
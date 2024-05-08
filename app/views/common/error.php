<?php
/**
 * @var int $errorCode
 * @var string $errorMessage
 */
?>

<link rel="stylesheet" href="/css/error.css">

<h1>Ошибка с кодом <?= $errorCode ?></h1>
<p><?= $errorMessage ?></p>
<a class="button" href="<?= $_SERVER['HTTP_REFERER'] ?? '/' ?>">Назад</a>
<?php

return [
	'database' => [
		'driver' => $_ENV['DB_DRIVER'],
		'host' => $_ENV['DB_HOST'],
		'name' => $_ENV['DB_NAME'],
		'user' => $_ENV['DB_USER'],
		'password' => $_ENV['DB_PASSWORD'],
		'charset' => $_ENV['DB_CHARSET'],
	],
];
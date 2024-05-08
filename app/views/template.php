<?php

/** @var $title */
/** @var $view */

?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<title><?= $title ?></title>

	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Asap+Condensed:wght@400;700&display=swap" rel="stylesheet">

	<link rel="icon" href="/img/favicon.ico" type="image/x-icon">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon">

	<link rel="stylesheet" href="/css/template.css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


</head>

<body>
<div class="container">
	<header class="header">
	</header>

	<main>
	  <?php include $view; ?>
	</main>
</div>

<footer class="footer">
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</body>
</html>
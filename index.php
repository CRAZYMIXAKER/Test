<?php
include_once('functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Test</title>
	<script src="./jquery-3.5.1.min.js"></script>
	<link rel="shortcut icon" href="./test.png" type="image/png" />
	<link rel="stylesheet" href="./main.css" />
</head>

<body>
	<?php if (!isset($_SESSION['User'])) : ?>
	<div class="main">
		<div class="main__title">
			<a href="#" class="main__title-in">Авторизация</a>
			<a href="#" class="main__title-up">Регистрация</a>
		</div>
		<div class="form">
			<div class="form__sign-in">
				<form class="form__sign" method="POST" action="./functions.php">
					<div class="form__item">
						<label class="form__item-label">Логин</label>
						<input type="text" class="form__item-input" name="login" minlength="6" required />
					</div>
					<div class="form__item">
						<label class="form__item-label">Пароль </label>
						<input type="text" class="form__item-input" name="password" minlength="6" required />
					</div>
					<button class="form__sign-button" name="button__sign-in">
						Вход
					</button>
				</form>
			</div>
			<div class="form__sign-up form__sign--closed">
				<form class="form__sign" method="POST" action="./functions.php">
					<div class="form__item">
						<label class="form__item-label">Имя</label>
						<input type="text" class="form__item-input" name="name" max="2" required />
					</div>
					<div class="form__item">
						<label class="form__item-label">Почта</label>
						<input type="text" class="form__item-input" name="email" required />
					</div>
					<div class="form__item">
						<label class="form__item-label">Логин</label>
						<input type="text" class="form__item-input" name="login" required />
					</div>
					<div class="form__item">
						<label class="form__item-label">Пароль</label>
						<input type="text" class="form__item-input" name="password" minlength="6" required />
					</div>
					<div class="form__item">
						<label class="form__item-label">Подтвердите пароль</label>
						<input type="text" class="form__item-input" name="confirm_password" minlength="6" equired />
					</div>
					<button class="form__sign-button" name="button__sign-up">
						Регистрация
					</button>
				</form>
			</div>
		</div>
	</div>
	<?php else : ?>
	<a href="logOut.php">Выход</a>
	<?php endif; ?>
	<script src="./scripts.js"></script>
</body>

</html>
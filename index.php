<?php
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

	<?php if (isset($_SESSION['Error'])) {
		echo $_SESSION['Error'];
		unset($_SESSION['Error']);
	} ?>
	<?php if (!isset($_SESSION['User'])) : ?>
	<div class="main">
		<div class="main__title">
			<a href="#" class="main__title-in">Авторизация</a>
			<a href="#" class="main__title-up">Регистрация</a>
		</div>
		<div class="form">
			<div class="form__sign-in">
				<form class="form__sign sign_in" method="POST">
					<div class="form__item">
						<label class="form__item-label">Логин</label>
						<input type="text" class="form__item-input" name="login_sign_in" pattern="^[A-Za-zА-Яа-я0-9Ёё\s]{6,}"
							minlength="6" required />
					</div>
					<div class="form__item">
						<label class="form__item-label">Пароль </label>
						<input type="password" class="form__item-input" name="password_sign_in" minlength="6"
							pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$" required />
						<?php if (isset($_SESSION['Error_Password'])) {
								echo $_SESSION['Error_Password'];
								unset($_SESSION['Error_Password']);
							} ?>
					</div>
					<button class="form__sign-button" name="button__sign-in">
						Вход
					</button>
					<p class="err"></p>
				</form>
			</div>
			<div class="form__sign-up form__sign--closed">
				<form class="form__sign sign_up" method="POST" action="./functions.php">
					<div class="form__item">
						<label class="form__item-label">Имя</label>
						<input type="text" class="form__item-input" name="name" pattern="^[A-Za-zА-Яа-я0-9Ёё\s]{1,2}" required />
					</div>
					<div class="form__item">
						<label class="form__item-label">Почта</label>
						<input type="email" class="form__item-input" name="email" placeholder="example@example.com" required />
						<?php if (isset($_SESSION['Error_Email'])) {
								echo $_SESSION['Error_Email'];
								unset($_SESSION['Error_Email']);
							} ?>
					</div>
					<div class=" form__item">
						<label class="form__item-label">Логин</label>
						<input type="text" class="form__item-input" name="login" pattern="^[A-Za-zА-Яа-я0-9Ёё\s]{6,}" required />
						<?php if (isset($_SESSION['Error_Login'])) {
								echo $_SESSION['Error_Login'];
								unset($_SESSION['Error_Login']);
							} ?>
					</div>
					<div class="form__item">
						<label class="form__item-label">Пароль</label>
						<input type="password" class="form__item-input" name="password"
							pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$" required />
					</div>
					<div class="form__item">
						<label class="form__item-label">Подтвердите пароль</label>
						<input type="password" class="form__item-input" name="confirm_password"
							pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$" equired />
						<?php if (isset($_SESSION['Error_Password'])) {
								echo $_SESSION['Error_Password'];
								unset($_SESSION['Error_Password']);
							} ?>
					</div>
					<button class="form__sign-button" name="button__sign-up">
						Регистрация
					</button>
				</form>
			</div>
		</div>
	</div>
	<?php else : ?>
	<h2>
		<? echo "Hello, " . $_SESSION['User']['name']?>
	</h2>
	<a href="logOut.php">Выход</a>
	<?php endif; ?>
	<script src="./scripts.js"></script>
	<script>
	let formSignIn = document.querySelector('.sign_in');
	let formSignUp = document.querySelector('.sign_up');
	let errorBox = document.querySelector('.err');

	formSignIn.addEventListener('submit', function(e) {
		e.preventDefault();

		let formData = new FormData(formSignIn);

		fetch('functions.php', {
				method: 'POST',
				body: formData
			})
			.then(responce => responce.json())
			.then(data => {
				if (data.res) {
					form.innerHTML = 'Your app is done!';
				} else {
					errorBox.innerHTML = data.error;
				}
			})
	});

	formSignUp.addEventListener('submit', function(e) {
		e.preventDefault();

		let formData = new FormData(formSignUp);

		fetch('functions.php', {
				method: 'POST',
				body: formData
			})
			.then(responce => responce.json())
			.then(data => {
				if (data.res) {
					form.innerHTML = 'Your app is done!';
				} else {
					errorBox.innerHTML = data.error;
				}
			})
	});
	</script>
</body>

</html>
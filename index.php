<?php include_once('./crud.php');
session_start();
?>
<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Test</title>
	<script src="./jquery-3.5.1.min.js"></script>
	<link rel="shortcut icon" href="./img/test.png" type="image/png" />
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
					</div>
					<button class="form__sign-button" name="button__sign-in">
						Вход
					</button>
					<p class="err error"></p>
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
						<p class="errEmail error"></p>
					</div>
					<div class=" form__item">
						<label class="form__item-label">Логин</label>
						<input type="text" class="form__item-input" name="login" pattern="^[A-Za-zА-Яа-я0-9Ёё\s]{6,}" required />
						<p class="errLogin error"></p>
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
						<p class="errPassword error"></p>
					</div>
					<button class="form__sign-button" name="button__sign-up">
						Регистрация
					</button>
					<p class="err error"></p>
				</form>
			</div>
		</div>
	</div>
	<?php else : ?>
	<h2>
		<? echo "Hello, " . $_SESSION['User']['name'];?>
	</h2>
	<?php if ($_SESSION['User']['access'] == 1) : ?>
	<h2>
		<?php echo "Ваш уровень доступа = " . "1"; ?>
	</h2>
	<div>
		<table class="Table">
			<thead>
				<tr>
					<th></th>
					<th>Имя</th>
					<th>Почта</th>
					<th>Логин</th>
					<th>Уровень Доступа</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
						$crud = new CRUD();
						$xpath = $crud->xpath;
						$countUsers = $xpath->query("/users/user")->length;
						for ($i = 0; $i < $countUsers; $i++) :
						?>
				<tr>
					<td><a href="http://dp/MapHouse.php?EditFlat=' . $rowFlat['IDFlat'] . '"
							title="Изменить данные пользователя"><img src="./img/Edit.png"></a></td>
					<td>
						<? echo $xpath->query("/users/user")[$i]->getAttribute('name')?>
					</td>
					<td>
						<? echo $xpath->query("/users/user")[$i]->getAttribute('email')?>
					</td>
					<td>
						<a href="/index.php?login=asdadsa">
							<? echo $xpath->query("/users/user")[$i]->getAttribute('login')?>
						</a>
					</td>
					<td>
						<? if($xpath->query("/users/user")[$i]->getAttribute('access')==1) : echo " Админ"; else : echo "Пользователь" ; endif;?>
					</td>
					<td><a title=" Удалить пользователя"
							href="http://dp/EditFlat.php?DeleteFlat=' . $rowFlat['IDFlat'] . '&NameFlat=' . $rowFlat['IDFlat'] . '"><img
								src="./img/Delete.png"></a>
					</td>
				</tr>
				<?php endfor; ?>
			</tbody>
		</table>
	</div>
	<!-- else : echo "Ваш уровень доступа = " . "0" -->
	<?php else : ?>
	<h2>
		<?php echo "Ваш уровень доступа = " . "0"; ?>
	</h2>
	<?php endif; ?>
	<a href="logOut.php">Выход</a>
	<?php endif; ?>

	<script src="./scripts.js"></script>

	<script>
	let formSignIn = document.querySelector('.sign_in');
	let formSignUp = document.querySelector('.sign_up');
	let errorBox = document.querySelector('.err');
	let errorBoxLogin = document.querySelector('.errLogin');
	let errorBoxEmail = document.querySelector('.errEmail');
	let errorBoxPassword = document.querySelector('.errPassword');

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
					location.href = location.href;
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
					location.reload()
				} else {
					errorBox.innerHTML = data.error;
					errorBoxLogin.innerHTML = data.errorLogin;
					errorBoxEmail.innerHTML = data.errorEmail;
					errorBoxPassword.innerHTML = data.errorPassword;
				}
			})
	});
	</script>
</body>

</html>
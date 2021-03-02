<?php session_start();

if (isset($_POST['button__sign-in'])) {
	if (!empty(trim($_POST['login'])) && !empty(trim($_POST['password']))) {
		$login = $_POST['login'];
		$password = $_POST['password'];

		$dom = new DomDocument("1.0");
		$dom->load("db.xml");
		$xpath = new DomXPath($dom);
		$xml = simplexml_load_file("db.xml");

		$checkUser = $xpath->query("/users/user[@login = '$login' and @password = '$password']");

		if ($checkUser->length == 1) {
			$result = $xpath->query("/users/user[@login='$login']");

			foreach ($result as $node) {
				$_SESSION['User'] = [
					"name" => $node->getAttribute('name'),
					"email" => $node->getAttribute('email'),
					"login" => $node->getAttribute('login')
				];
			}

			$_SESSION['Message'] = "Вы успешно авторизовались!";
			header('Location:index.php');
		} else {
			$_SESSION['Error'] = "Неправильный логин или пароль";
			header("Location: index.php");
		}
	} else {
		$_SESSION['Error'] = "Поля не должны быть пустыми или заполнены пробелами";
		header('Location:index.php');
	}
} elseif (isset($_POST['button__sign-up'])) {
	if (!empty(trim($_POST['name'])) && !empty(trim($_POST['email'])) && !empty(trim($_POST['login'])) && !empty(trim($_POST['password'])) && !empty(trim($_POST['confirm_password']))) {
		if ($_POST['password'] == $_POST['confirm_password']) {
			$login = $_POST['login'];

			$dom = new DomDocument("1.0");
			$dom->load("db.xml");
			$xpath = new DomXPath($dom);
			$xml = simplexml_load_file("db.xml");

			$checkLogin = $xpath->query("/users/user[@login = '$login']");

			if ($checkLogin->length == 0) {
				$add = $xml->addchild('user');
				$add->addAttribute('name', $_POST['name']);
				$add->addAttribute('email', $_POST['email']);
				$add->addAttribute('login', $_POST['login']);
				$add->addAttribute('password', $_POST['password']);
				$xml->saveXML('db.xml');

				$_SESSION['User'] = [
					"name" => $_POST['name'],
					"email" => $_POST['email'],
					"login" => $_POST['login']
				];

				$_SESSION['Message'] = "Вы успешно зарегистрировались!";
				header('Location:index.php');
			} else {
				$_SESSION['Error'] = "Пользователь, с таким логином уже существует, выберите пожалуйста другой";
				header('Location:index.php');
			}
		} else {
			$_SESSION['Error'] = "Пароли, должны быть одинаковыми";
			header('Location:index.php');
		}
	} else {
		$_SESSION['Error'] = "Поля не должны быть пустыми или заполнены пробелами";
		header('Location:index.php');
	}
}

				// foreach ($xml->item as $key => $val) {
				// 	echo $val->user->name . "<br />";
				// }

					// 			// $result = $xpath->query('/users/user[name = "Joe"]');
	// 			$T = $sxml->addchild('user');
	// 			$T->addchild('name', 'Constantine');
	// 			$T->addchild('email', 'Constanta');
	// 			$T->addchild('login', 'Constantine');
	// 			$T->addchild('password', 'Constanta');
	// 			// echo $sxml->asXML();
	// 			// print_r($sxml);
	// 			print_r($resultLogin->length, $resultPassword->length);
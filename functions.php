<?php session_start();
include_once("crud.php");
$salt = "sheu2o5n21p59m0";
$xml = simplexml_load_file("db.xml");

function workWithXPATH()
{
	$dom = new DomDocument("1.0");
	$dom->load("db.xml");
	$xpath = new DomXPath($dom);
	return $xpath;
}

$responce = [
	'res' => false,
	'error' => '',
	'errorLogin' => '',
	'errorEmail' => '',
	'errorPassword' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['login_sign_in']) || isset($_POST['name'])) {
		if (isset($_POST['login_sign_in']) && isset($_POST['password_sign_in'])) {
			if (!empty(trim($_POST['login_sign_in'])) && !empty(trim($_POST['password_sign_in']))) {
				$xpath = workWithXPATH();
				$login = trim($_POST['login_sign_in']);
				$password = trim($_POST['password_sign_in']);

				$checkPassword = md5(md5($password) . $salt);
				$checkUser = $xpath->query("/users/user[@login = '$login' and @password = '$checkPassword']");
				if ($checkUser->length == 1) {
					$crudRead = new CRUD($login, $xpath);
					$crudRead->readUser();
					$responce['res'] = true;
				} else {
					$responce['error'] = 'Неправильный логин или пароль';
				}
			} else {
				$responce['error'] = 'Поля не должны быть пустыми или заполнены пробелами';
			}
		} elseif (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
			if (!empty(trim($_POST['name'])) && !empty(trim($_POST['email'])) && !empty(trim($_POST['login'])) && !empty(trim($_POST['password'])) && !empty(trim($_POST['confirm_password']))) {
				if ($_POST['password'] == $_POST['confirm_password']) {

					$xpath = workWithXPATH();

					$login = trim($_POST['login']);

					$checkLogin = $xpath->query("/users/user[@login = '$login']");
					if ($checkLogin->length == 0) {
						$email = $_POST['email'];
						$checkEmail = $xpath->query("/users/user[@email = '$email']");

						if ($checkEmail->length == 0) {
							$crudAdd = new CRUD($login, $xpath);
							$crudAdd->createUser();
							$responce['res'] = true;
						} else {
							$responce['errorEmail'] = 'Пользователь, с такой почтой уже существует, выберите пожалуйста другую почту';
						}
					} else {
						$responce['errorLogin'] = 'Пользователь, с таким логином уже существует, выберите пожалуйста другой логин';
					}
				} else {
					$responce['errorPassword'] = 'Пароли, должны быть одинаковыми';
				}
			} else {
				$responce['error'] = 'Поля не должны быть пустыми или заполнены пробелами';
			}
		}
	}
}

echo json_encode($responce);
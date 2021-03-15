<?php session_start();
include_once("./crud.php");

$workWithXML = new CRUD();
$xpath = $workWithXML->xpath;
$salt = $workWithXML->salt;

$responce = [
	'res' => false,
	'error' => '',
	'errorLogin' => '',
	'errorEmail' => '',
	'errorPassword' => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['login']) && isset($_POST['password']) && isset($_POST['confirm_password'])) {
		if (!empty(trim($_POST['name'])) && !empty(trim($_POST['email'])) && !empty(trim($_POST['login'])) && !empty(trim($_POST['password'])) && !empty(trim($_POST['confirm_password']))) {
			if ($_POST['password'] == $_POST['confirm_password']) {
				$login = trim($_POST['login']);
				$checkLogin = $xpath->query("/users/user[@login = '$login']");
				if ($checkLogin->length == 0) {
					$email = $_POST['email'];
					$checkEmail = $xpath->query("/users/user[@email = '$email']");
					if ($checkEmail->length == 0) {
						$crudAdd = new CRUD();
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
	} elseif (isset($_POST['editName']) && isset($_POST['editEmail']) && isset($_POST['editLogin'])) {
		if (!empty(trim($_POST['editName'])) && !empty(trim($_POST['editEmail'])) && !empty(trim($_POST['editLogin']))) {
			$crudUpdate = new CRUD();
			$crudUpdate->updateUser($_POST['editName'], $_POST['editEmail'], $_POST['editLogin'], $_POST['editLoginMain']);
			$responce['res'] = true;
		} else {
			$responce['error'] = 'Поля не должны быть пусfxxfxcbтыми или заполнены пробелами';
		}
	}
}

echo json_encode($responce);
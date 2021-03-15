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
	if (isset($_POST['login_sign_in']) || isset($_POST['name']) || isset($_POST['editName'])) {
		if (isset($_POST['login_sign_in']) && isset($_POST['password_sign_in'])) {
			if (!empty(trim($_POST['login_sign_in'])) && !empty(trim($_POST['password_sign_in']))) {
				$login = trim($_POST['login_sign_in']);
				$password = trim($_POST['password_sign_in']);
				$checkPassword = md5(md5($password) . $salt);
				$checkUser = $xpath->query("/users/user[@login = '$login' and @password = '$checkPassword']");
				if ($checkUser->length == 1) {
					$crudRead = new CRUD();
					$crudRead->readUser($login);
					$responce['res'] = true;
				} else {
					$responce['error'] = 'Неправильный логин или пароль';
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
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
	if (isset($_GET['deleteLogin'])) {
		if ($_SESSION['User']['login'] === $_GET['deleteLogin']) {
			$_SESSION['Error'] = 'Вы не можете себя удалить';
		} else {
			$crudDelete = new CRUD();
			$crudDelete->deleteUser($_GET['deleteLogin']);
			$responce['res'] = true;
		}
		header("Location: users.php?success=1");
	}
}

echo json_encode($responce);
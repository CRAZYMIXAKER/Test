<?php session_start();
include_once("./crud.php");
// include_once('messages.php');
// include_once('arr.php');

// $workWithXML = new CRUD();
// $xpath = $workWithXML->xpath;
// $salt = $workWithXML->salt;

// $responce = [
// 	'res' => false,
// 	'error' => '',
// 	'errorLogin' => '',
// 	'errorEmail' => '',
// 	'errorPassword' => ''
// ];

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
// 	$fields = extractFields($_POST, ['login_sign_in', 'password_sign_in']);
// 	$validateErrors = messagesValidateSignIn($fields);

// 	if (empty($validateErrors)) {
// 		$crudDelete = new CRUD();
// 		$crudDelete->deleteUser($_GET['deleteLogin']);
// 		$responce['res'] = true;
// 	} else {
// 		$_SESSION['Error'] = 'Вы не можете себя удалить';
// 	}
// }

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

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
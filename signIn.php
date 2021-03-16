<?php session_start();
include_once("./crud.php");
include_once('messages.php');
include_once('arr.php');

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
	$fields = extractFields($_POST, ['login_sign_in', 'password_sign_in']);
	$validateErrors = messagesValidateSignIn($fields);

	if (empty($validateErrors)) {
		$crudRead = new CRUD();
		$crudRead->readUser($fields['login_sign_in']);
		$responce['res'] = true;
	} else {
		if (isset($validateErrors['Error'])) {
			$responce['error'] = $validateErrors['Error'];
		}
		if (isset($validateErrors['Login'])) {
			$responce['errorLogin'] = $validateErrors['Login'];
		}
		if (isset($validateErrors['Password'])) {
			$responce['errorPassword'] = $validateErrors['Password'];
		}
	}

	// } elseif (isset($_POST['editName']) && isset($_POST['editEmail']) && isset($_POST['editLogin'])) {
	// 	if (!empty(trim($_POST['editName'])) && !empty(trim($_POST['editEmail'])) && !empty(trim($_POST['editLogin']))) {
	// 		$crudUpdate = new CRUD();
	// 		$crudUpdate->updateUser($_POST['editName'], $_POST['editEmail'], $_POST['editLogin'], $_POST['editLoginMain']);
	// 		$responce['res'] = true;
	// 	} else {
	// 		$responce['error'] = 'Поля не должны быть пусfxxfxcbтыми или заполнены пробелами';
	// 	}

	// } elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
	// 	if (isset($_GET['deleteLogin'])) {
	// 		if ($_SESSION['User']['login'] === $_GET['deleteLogin']) {
	// 			$_SESSION['Error'] = 'Вы не можете себя удалить';
	// 		} else {
	// 			$crudDelete = new CRUD();
	// 			$crudDelete->deleteUser($_GET['deleteLogin']);
	// 			$responce['res'] = true;
	// 		}
	// 		header("Location: users.php?success=1");
	// 	}
}

echo json_encode($responce);



// include_once('model/messages.php');
// include_once('core/arr.php');

// if($_SERVER['REQUEST_METHOD'] === 'POST'){
// 	$fields = extractFields($_POST, ['name', 'text']);
// 	$validateErrors = messagesValidate($fields);

// 	if(empty($validateErrors)){
// 		messagesAdd($fields);
// 		header('Location: index.php');
// 		exit();
// 	}
// }
// else{
// 	$fields = ['name' => '', 'text' => ''];
// 	$validateErrors = [];
// }

// include("views/v_add.php");
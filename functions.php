<?php session_start();

if (isset($_POST['button__sign-in'])) {
	if (!empty(trim($_POST['login'])) && !empty(trim($_POST['password']))) {
		$login = $_POST['login'];
		$password = $_POST['password'];
		$sql = "SQL";

		$dom = new DomDocument("1.0");
		$dom->load("db.xml");
		$xpath = new DomXPath($dom);
		$xml = simplexml_load_file("db.xml");

		$checkUser = $xpath->query("/users/user[login = '$login' and password = '$password']");


		//XML выборка нескольких записей
		foreach ($xml->item as $key => $val) {
			echo $val->user->name . "<br />";
		}

		// $query = $xpath->query("/users/user[login = '$login' and password = '$password']");
		// print_r($result);
		$Q = $xpath->query("//user/name");
		print_r($Q);

		print_r($xml->user[0]->name);
		// echo $query->name;
		// 		print_r($query);
		// print_r($result);


		if ($checkUser->length == 1) {
			$_SESSION['User'] = [
				"name" => "NAME",
				"email" => "EMALI@gmail.com",
				"login" => $login
			];

			$_SESSION['Message'] = "Вы успешно авторизовались!";
			header('Location:index.php');
		} else {
			$_SESSION['Error'] = "Неправильный логин или пароль";
			header("Location: index.php");
		}
	} else {
		echo $_SESSION['Error'] = "Поля не должны быть пустыми или заполнены пробелами";
	}
} elseif (isset($_POST['button__sign-up'])) {

	// 			// foreach ($result as $node) {
	// 			// 	echo $node->tagName, "(ID = ", $node->getAttribute('id'), ")\n";
	// 			// }

	// 			// $result = $xpath->query('/users/user[name = "Joe"]');
	// 			$T = $sxml->addchild('user');
	// 			$T->addchild('name', 'Constantine');
	// 			$T->addchild('email', 'Constanta');
	// 			$T->addchild('login', 'Constantine');
	// 			$T->addchild('password', 'Constanta');
	// 			// echo $sxml->asXML();
	// 			// print_r($sxml);
	// 			print_r($resultLogin->length, $resultPassword->length);

	// 			$sxml->saveXML('db.xml');

}
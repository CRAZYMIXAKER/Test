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
		echo $_SESSION['Error'] = "Поля не должны быть пустыми или заполнены пробелами";
	}
} elseif (isset($_POST['button__sign-up'])) {

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




		// //XML выборка нескольких записей
		// foreach ($xml->item as $key => $val) {
		// 	echo $val->user->name . "<br />";
		// }

		// $query = $xpath->query("//user[login = '$login' and password = '$password']/name");
		// print_r($query);

		// echo 2;

		// $T = $xml->addchild('user');
		// $T->addAttribute('name', 'Test');
		// $T->addAttribute('email', 'TestT@gmail.com');
		// $T->addAttribute('login', 'T');
		// $T->addAttribute('password', 'T');

		// $xml->saveXML('db.xml');
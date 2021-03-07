<?php

class CRUD
{
	public $salt = "sheu2o5n21p59m0";
	public $login;
	public $xpath;
	public $xml;

	public function __construct()
	{
		$this->xpath = $this->workWithXPATH();
		$this->xml = simplexml_load_file("db.xml");
	}

	public function createUser()
	{
		$add = $this->xml->addchild('user');
		$add->addAttribute('name', $_POST['name']);
		$add->addAttribute('email', $_POST['email']);
		$add->addAttribute('login', $_POST['login']);
		$add->addAttribute('password', md5(md5($_POST['password']) . $this->salt));
		$add->addAttribute('access', 0);
		$this->xml->saveXML('db.xml');

		$_SESSION['User'] = [
			"name" => $_POST['name'],
			"email" => $_POST['email'],
			"login" => $_POST['login'],
			"access" => 0
		];

		return $_SESSION['User'];
	}

	public function readUser($login)
	{
		$this->login = $login;
		$result = $this->xpath->query("/users/user[@login='$this->login']");
		foreach ($result as $node) {
			$_SESSION['User'] = [
				"name" => $node->getAttribute('name'),
				"email" => $node->getAttribute('email'),
				"login" => $node->getAttribute('login'),
				"access" => $node->getAttribute('access')
			];
			return $_SESSION['User'];
		}
	}

	public function updateUser()
	{
	}

	public function deleteUser()
	{
	}

	public function allUsers()
	{
	}

	public function workWithXPATH()
	{
		$dom = new DomDocument("1.0");
		$dom->load("db.xml");
		$xpath = new DomXPath($dom);
		return $xpath;
	}
}
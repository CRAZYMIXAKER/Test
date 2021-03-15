<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	if (isset($_POST['name'])) {
		print_r($_POST['name']);
	}
}
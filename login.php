<?php
 	session_start();

 	include('lib/safemysql.class.php');

 	$db = new SafeMySQL([
		'host' => '127.0.0.1',
		'user' => 'root',
		'pass' => '',
		'db' => 'profile'
	]);
 	$user = [];
	$user = $db->getRow("SELECT * FROM user WHERE login = ?s AND password = ?s", $_POST['login'], sha1($_POST['password']));
	if ($user) {
		$_SESSION['name'] = "<p>Привет - " . $user['name'] ."</p>";

		header("Location: login.html.php");
	}else{
		$_SESSION['back'] = '<p>Такого пользователя нету</p>';
		header("Location: login.html.php");
	}
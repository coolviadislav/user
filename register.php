<?php
 	session_start();

 	include('lib/safemysql.class.php');

 	$db = new SafeMySQL([
		'host' => '127.0.0.1',
		'user' => 'root',
		'pass' => '',
		'db' => 'profile'
	]);
//Проверка на логин 
	$user = [];
	$user = $db->getOne("SELECT * FROM user WHERE login = ?s ", $_POST['login']);
	if ($user) {
		$_SESSION['back'] = '<p>Такой логин уже занят</p>';
		header("Location: register.html.php");
	}else{ 
		    $db->query(
		   		"INSERT INTO user(login,password,name) VALUES (?s, ?s, ?s)", 
		   		$_POST['login'],
		   		sha1($_POST['password']),
		   		$_POST['name']
		    );	
			$_SESSION['back'] = '<p>Успещно зарегестрированны</p>';
			header("Location: register.html.php");
		}

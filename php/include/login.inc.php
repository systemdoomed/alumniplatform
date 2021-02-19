<?php

if (isset($_POST["submit"])) {
	$mail = $_POST["inputmail"];
	$pwd = $_POST["inputpwd"];

	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';

	if (emptyInputLogin($mail,$pwd) !== false) {

		header("location: ../login.php?error=emptyinput");
		exit();
	}
	loginUser($conn,$mail,$pwd);
}
else {
	header("location: ../login.php");
	exit();
}
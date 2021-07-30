<?php

require 'dbh.inc.php';
require 'session.inc.php';

if (isset($_POST["submit"])) {
	$firstname = $_POST["inputfirstname"];
	$lastname = $_POST["inputlastname"];
	$mail = $_POST["inputmail"];
	$isSendMail = isset($_POST["inputisSendMail"]);
    $isDataPrivacy = isset($_POST["acceptConditions"]);
	$pwd1 = $_POST["inputpwd1"];
	$pwd2 = $_POST["inputpwd2"];
	$course = $_POST["inputcourse"];
	$gradyear = $_POST["inputgradyear"];
	$school = $_POST["inputschool"];
	$gender = $_POST["inputgender"];
	$title = $_POST["inputtitle"];
	$birthname = $_POST["inputbirthname"];

	
	if(isset($_POST["inputisSupportingMember"])){
		$isSupportingMember = 1;
	}
	else{
		$isSupportingMember = 0;
	}

	if(isset($_POST["inputisSendMail"])){
		$isSendMail = 1;
	}
	else{
		$isSendMail = 0;
	}
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';

	if ($title == "Auswählen...") {
		$title = '';
	}
	

	if ($course == "Auswählen..." || $gender == "Auswählen..." || $school == "Auswählen...") {
		header("location: ../signup.php?error=nochoice");
		exit();
	}

	if (emptyInputSignup($firstname,$lastname,$mail,$course,$gradyear,$pwd1,$pwd2) !== false) {

		header("location: ../signup.php?error=emptyinput");
		exit();
	}
	if (invalidEmail($mail) !== false) {

		header("location: ../signup.php?error=invalidemail");
		exit();
	}
	if (checkMail($conn,$mail) !== false) {

		header("location: ../signup.php?error=usedemail");
		exit();
	}
	if (pwdMatch($pwd1,$pwd2) !== false) {

		header("location: ../signup.php?error=nopwdmatch");
		exit();
	}

	if (userExists($conn,$firstname,$lastname,$course,$gradyear,$mail) !== false) {

		header("location: ../signup.php?error=userexists");
		exit();
	}
    
    if(isset($_POST["acceptConditions"])){
        //voll
        createUser($conn, $firstname, $lastname,$mail,$isSendMail, $pwd1, $course, $gradyear, $school,$gender, $title,  $isSupportingMember,$birthname);
        header("location: ../signup.php");
        exit();
    }
    else
    {
        //leer
        header("location: ../signup.php?error=noDataPrivacy");
        exit();
    }
    
	

	
}
else {
	header("location: ../signup.php");
	exit();
}

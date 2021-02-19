<?php

if (isset($_POST["submit"])) {
	$firstname = $_POST["inputfirstname"];
	$lastname = $_POST["inputlastname"];
	$mail = $_POST["inputmail"];
	$isSendMail = isset($_POST["inputisSendMail"]);
	$pwd1 = $_POST["inputpwd1"];
	$pwd2 = $_POST["inputpwd2"];
	$matrikel = $_POST["inputmatrikel"];
	$course = $_POST["inputcourse"];
	$gradyear = $_POST["inputgradyear"];
	$school = $_POST["inputschool"];
	$phone = $_POST["inputphone"];
	$gender = $_POST["inputgender"];
	$address = $_POST["inputaddress"];
	$city = $_POST["inputcity"];
	$company = $_POST["inputcompany"];
	$position = $_POST["inputposition"];
	$title = $_POST["inputtitle"];
	$twitter = $_POST["inputtwitter"];
	$insta = $_POST["inputinsta"];
	$facebook = $_POST["inputfacebook"];
	$xing = $_POST["inputxing"];
	$linkedin = $_POST["inputlinkedin"];
	
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
	if (pwdMatch($pwd1,$pwd2) !== false) {

		header("location: ../signup.php?error=nopwdmatch");
		exit();
	}

	if (userExists($conn,$firstname,$lastname,$course,$gradyear,$mail) !== false) {

		header("location: ../signup.php?error=userexists");
		exit();
	}
	

	createUser($conn, $firstname, $lastname,$mail,$isSendMail, $pwd1, $matrikel, $course, $gradyear, $school, $phone,$gender, $address, $city, $company , $position, $title, $twitter, $insta, $facebook, $xing, $linkedin, $isSupportingMember);

}
else {
	header("location: ../signup.php");
	exit();
}
<?php

require 'dbh.inc.php';
require 'session.inc.php';

if (isset($_POST["submit"])) {
	$firstname = $_POST["inputfirstname"];
	$lastname = $_POST["inputlastname"];
	$mail = $_POST["inputmail"];
	$isSendMail = isset($_POST["inputisSendMail"]);
    $isDataPrivacy = isset($_POST["acceptConditions"]);
	$course = $_POST["inputcourse"];
	$gradyear = $_POST["inputgradyear"];
	$school = $_POST["inputschool"];
	$gender = $_POST["inputgender"];
	$title = $_POST["inputtitle"];
    $matrikel = $_POST["inputmatrikel"];
    $address = $_POST["inputaddress"];
    $city = $_POST["inputcity"];
    $phone = $_POST["inputphone"];
    $isExternalLinks = isset($_POST["inputisExternalLinks"]);
	
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
    if(isset($_POST["inputisExternalLinks"])){
        $isExternalLinks = 1;
    }
    else{
        $isExternalLinks = 0;
    }
	require_once 'dbh.inc.php';
	require_once 'functions2.inc.php';

	if ($title == "Auswählen...") {
		$title = '';
	}
	

	if ($course == "Auswählen..." || $gender == "Auswählen..." || $school == "Auswählen...") {
		header("location: ../saveData.php?error=nochoice&vorname=".$firstname."&nachname=".$lastname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."&matrikel=".$matrikel."&address=".$address."&city=".$city."&phone=".$phone."");
		exit();
	}

	if (emptyInputSignup($firstname,$lastname,$mail,$course,$gradyear) !== false) {

		header("location: ../saveData.php?error=emptyinput&vorname=".$firstname."&nachname=".$lastname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."&matrikel=".$matrikel."&address=".$address."&city=".$city."&phone=".$phone."");
		exit();
	}
	if (invalidEmail($mail) !== false) {

		header("location: ../saveData.php?error=invalidemail&vorname=".$firstname."&nachname=".$lastname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."&matrikel=".$matrikel."&address=".$address."&city=".$city."&phone=".$phone."");
		exit();
	}
	if (checkMail($conn,$mail) !== false) {

		header("location: ../saveData.php?error=usedemail&vorname=".$firstname."&nachname=".$lastname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."&matrikel=".$matrikel."&address=".$address."&city=".$city."&phone=".$phone."");
		exit();
	}
	if (userExists($conn,$firstname,$lastname,$course,$gradyear,$mail) !== false) {

		header("location: ../saveData.php?error=userexists&vorname=".$firstname."&nachname=".$lastname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."&matrikel=".$matrikel."&address=".$address."&city=".$city."&phone=".$phone."");
		exit();
	}
    if(isset($_POST["acceptConditions"])){
        //voll
        createUser($conn, $firstname, $lastname,$mail,$isSendMail, $course, $gradyear, $school,$gender, $title,  $isSupportingMember,$isExternalLinks,$matrikel,$address,$city,$phone);
        header("location: ../saveData.php");
        exit();
    }
    else
    {
        //leer
        header("location: ../saveData.php?error=noDataPrivacy&vorname=".$firstname."&nachname=".$lastname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."&matrikel=".$matrikel."&address=".$address."&city=".$city."&phone=".$phone."");
        exit();
    }
    
	

	
}
else {
	header("location: ../saveData.php");
	exit();
}

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
	require_once 'functions.inc.php';

	if ($title == "Auswählen...") {
		$title = '';
	}
	

	if ($course == "Auswählen..." || $gender == "Auswählen..." || $school == "Auswählen...") {
		header("location: ../signup.php?error=nochoice&vorname=".$firstname."&nachname=".$lastname."&geburtsname=".$birthname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."");
		exit();
	}

	if (emptyInputSignup($firstname,$lastname,$mail,$course,$gradyear,$pwd1,$pwd2) !== false) {

		header("location: ../signup.php?error=emptyinput&vorname=".$firstname."&nachname=".$lastname."&geburtsname=".$birthname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."");
		exit();
	}
	if (invalidEmail($mail) !== false) {

		header("location: ../signup.php?error=invalidemail&vorname=".$firstname."&nachname=".$lastname."&geburtsname=".$birthname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."");
		exit();
	}
	if (checkMail($conn,$mail) !== false) {

		header("location: ../signup.php?error=usedemail&vorname=".$firstname."&nachname=".$lastname."&geburtsname=".$birthname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."");
		exit();
	}
	if (pwdMatch($pwd1,$pwd2) !== false) {

		header("location: ../signup.php?error=nopwdmatch&vorname=".$firstname."&nachname=".$lastname."&geburtsname=".$birthname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."");
		exit();
	}

	if (userExists($conn,$firstname,$lastname,$course,$gradyear,$mail) !== false) {

		header("location: ../signup.php?error=userexists&vorname=".$firstname."&nachname=".$lastname."&geburtsname=".$birthname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."");
		exit();
	}
    
    if(isset($_POST["acceptConditions"])){
        //voll
        createUser($conn, $firstname, $lastname,$mail,$isSendMail, $pwd1, $course, $gradyear, $school,$gender, $title,  $isSupportingMember,$birthname,$isExternalLinks);
        header("location: ../signup.php");
        exit();
    }
    else
    {
        //leer
        header("location: ../signup.php?error=noDataPrivacy&vorname=".$firstname."&nachname=".$lastname."&geburtsname=".$birthname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."");
        exit();
    }
    
	

	
}
else {
	header("location: ../signup.php");
	exit();
}

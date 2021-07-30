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
	$company2 = $_POST["inputCompany2"];
	$furtherinformation = $_POST["inputfurtherinformation"];
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

	if(isset($_POST["inputisSameCompany"])){
		$isSameCompany = 1;
	}
	else{
		$isSameCompany = 0;
	}

	if(isset($_POST["inputisDifferentCompany"])){
		$isDifferentCompany = 1;
	}
	else{
		$isDifferentCompany = 0;
	}

	if(isset($_POST["inputisFreelancer"])){
		$isFreelancer = 1;
	}
	else{
		$isFreelancer = 0;
	}

	if(isset($_POST["inputisFederal"])){
		$isFederal = 1;
	}
	else{
		$isFederal = 0;
	}

	if(isset($_POST["inputisFurtherEducation"])){
		$isFurtherEducation = 1;
	}
	else{
		$isFurtherEducation = 0;
	}

	if(isset($_POST["inputisForeignCountry"])){
		$isForeignCountry = 1;
	}
	else{
		$isForeignCountry = 0;
	}

	if(isset($_POST["inputisWorkSeeking"])){
		$isWorkSeeking = 1;
	}
	else{
		$isWorkSeeking = 0;
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
        createUser($conn, $firstname, $lastname,$mail,$isSendMail, $pwd1, $matrikel, $course, $gradyear, $school, $phone,$gender, $address, $city, $company , $position, $title, $twitter, $insta, $facebook, $xing, $linkedin, $isSupportingMember,$company2,$furtherinformation,$isSameCompany,$isDifferentCompany,$isFreelancer,$isFederal,$isFurtherEducation,$isForeignCountry,$isWorkSeeking,$birthname);
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

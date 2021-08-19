<?php
	require_once 'dbh.inc.php';
	require_once 'functions.inc.php';
	require_once 'session.inc.php';
	session_start();
if (isset($_POST["submit"])) {
	$firstname = $_POST["inputfirstname"];
	$lastname = $_POST["inputlastname"];
	$isSendMail = isset($_POST["inputisSendMail"]);
	$pwd1 = $_POST["inputpwd1"];
	$pwd2 = $_POST["inputpwd2"];
	$matrikel = $_POST["inputmatrikel"];
	$phone = $_POST["inputphone"];
	$gender = $_POST["inputgender"];
	$address = $_POST["inputaddress"];
	$city = $_POST["inputcity"];
    $mail = $_POST["inputmail"];
	$company = $_POST["inputcompany"];
	$position = $_POST["inputposition"];
	$title = $_POST["inputtitle"];
	$twitter = $_POST["inputtwitter"];
	$insta = $_POST["inputinsta"];
	$facebook = $_POST["inputfacebook"];
	$xing = $_POST["inputxing"];
	$linkedin = $_POST["inputlinkedin"];
	$others = $_POST["inputother"];
    $birthname = $_POST["inputbirthname"];
    
	if(isset($_SESSION['nid']))
    {
      $nid=$_SESSION['nid']['nid'];
      $state=getState($nid, $conn);
	}
	else{
		header("location: ../profile.php?error=nologin"+ $_SESSION['nid']['nid']);
		exit();
	}

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


	if ($title == "Auswählen...") {
		$title = '';
	}

	if ($gender == "Auswählen...") {
		header("location: ../profile.php?error=nochoice");
		exit();
	}

	if (emptyInputSignup($firstname,$lastname,$mail,"sampletext","sampletext","sampletext","sampletext") !== false) {

		header("location: ../profile.php?error=emptyinput");
		exit();
	}

	if (pwdMatch($pwd1,$pwd2) !== false)
    {

		header("location: ../profile.php?error=nopwdmatch");
		exit();
	}


	updateUser($conn, $nid,$firstname, $lastname,$isSendMail, $pwd1, $matrikel, $phone,$gender, $address, $city, $company , $position, $title, $twitter, $insta, $facebook, $xing, $linkedin, $isSupportingMember,$state,$others,$birthname,$isExternalLinks);

}
else {
	header("location: ../profile.php");
	exit();
}

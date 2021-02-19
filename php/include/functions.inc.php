<?php

function emptyInputSignup($firstname,$lastname,$mail,$course,$gradyear,$pwd1,$pwd2){
	
	$result;
	
	if (empty($firstname) || empty($lastname)|| empty($mail)|| empty($course)|| empty($gradyear)|| empty($pwd1)|| empty($pwd2)) {
		$result = true;
	}
	
	else {
		$result = false;
	}
	
	return $result;
}

function invalidEmail($mail){
	
	$result;
	
	if (!filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		$result = true;
	}
	
	else {
		$result = false;
	} 
	
	return $result;
}

function pwdMatch($pwd1,$pwd2){
	
	$result;
	
	if ($pwd1 !== $pwd2) {
		$result = true;
	}
	
	else {
		$result = false;
	}
	
	return $result;
}


function userExists($conn,$firstname,$lastname,$course,$gradyear,$mail){
	
	$sql = "SELECT * FROM Nutzer where firstname = ? AND lastname = ? AND course = ? AND gradyear = ? AND mail = ?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../signup.php?error=userexists");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"sssss",$firstname,$lastname,$course,$gradyear,$mail);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
			return $row;
	}
	else{
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);

}

function getNid($conn,$firstname,$lastname,$course,$gradyear,$mail){
	
	$sql = "SELECT NID FROM Nutzer where firstname = ? AND lastname = ? AND course = ? AND gradyear = ? AND mail = ?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../signup.php?error=userexists");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"sssss",$firstname,$lastname,$course,$gradyear,$mail);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
			return $row;
	}
	else{
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);

}


function insertPwd($conn,$nid,$pwd){

	$sql = "INSERT INTO Anmeldung (NID,PWD) VALUES(?,?);";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../signup.php?error=stmtfailedpwd");
		exit();
	}

	$hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

	mysqli_stmt_bind_param($stmt,"is",$nid,$hashedPwd);
	mysqli_stmt_execute($stmt);

	
	mysqli_stmt_close($stmt);
}

function insertLinks($conn,$nid,$twitter,$insta, $xing, $linkedin){

	$sql = "INSERT INTO ExternalLinks (NID,Twitter,Instagram,Xing,Linkedin) VALUES(?,?,?,?,?);";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../signup.php?error=stmtfailedextLinks");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"issss",$nid,$twitter,$insta, $xing, $linkedin);
	mysqli_stmt_execute($stmt);

	
	mysqli_stmt_close($stmt);
	
}


function createUser($conn, $firstname, $lastname,$mail,$isSendMail, $pwd1, $matrikel, $course, $gradyear, $school, $phone,$gender, $address, $city, $company , $position, $title, $twitter, $insta, $facebook, $xing, $linkedin, $isSupportingMember){
	
	$state = 1;

	$sql = "INSERT INTO Nutzer (firstname,lastname,course,school,gradyear,mail,state,isSendMail,matrikel,address,city,phone,company,position,gender,isSupportingMember,title) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../signup.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"ssssssiisssssssis",$firstname,$lastname,$course,$school,$gradyear,$mail,$state,$isSendMail,$matrikel,$address,$city,$phone,$company,$position,$gender,$isSupportingMember,$title);
	mysqli_stmt_execute($stmt);

	if(mysqli_stmt_affected_rows($stmt) > 0){

		$nid = mysqli_insert_id($conn);

	}
		
	mysqli_stmt_close($stmt);

	insertPwd($conn,$nid,$pwd1);
	insertLinks($conn,$nid,$twitter,$insta,$xing,$linkedin);
	

	header("location: ../signup.php?error=none");
	exit();

}


// ------------------------- LOGIN -------------------------

function emptyInputLogin($mail,$pwd){
	
	$result;
	
	if (empty($mail)||empty($pwd)) {
		$result = true;
	}
	
	else {
		$result = false;
	}
	
	return $result;
}

function getNidFromMail($conn,$mail){
	
	$sql = "SELECT NID FROM Nutzer where mail = ?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../signup.php?error=userexists");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"s",$mail);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
			return $row;
	}
	else{
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);

}



function loginCheck($conn,$mail){
	
	$sql = "SELECT * FROM Nutzer where mail = ?;";

	$stmt = mysqli_stmt_init($conn);

	mysqli_stmt_bind_param($stmt,"s",$mail);
	mysqli_stmt_execute($stmt);

	$resultData = mysqli_stmt_get_result($stmt);

	if ($row = mysqli_fetch_assoc($resultData)) {
			return $row;
	}
	else{
		$result = false;
		return $result;
	}
	mysqli_stmt_close($stmt);

}


function loginUser($conn,$mail,$pwd){
	
	$logincheck = loginCheck($conn,$mail); 

	if ($logincheck === false) {
		header("location: ../login.php?error=nomail");
		exit();
	}

	$pwdHashed = checkHash($conn,$mail);

}
















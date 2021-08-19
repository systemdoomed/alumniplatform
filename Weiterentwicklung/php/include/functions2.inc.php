<?php

function emptyInputSignup($firstname,$lastname,$mail,$course,$gradyear){
	
	$result;
	
	if (empty($firstname) || empty($lastname)|| empty($mail)|| empty($course)|| empty($gradyear)) {
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

function userExists($conn,$firstname,$lastname,$course,$gradyear,$mail){
	
	$sql = "SELECT * FROM Nutzer where firstname = ? AND lastname = ? AND course = ? AND gradyear = ? AND mail = ?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../saveData?error=userexists");
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

function checkMail($conn,$mail){
	
	$sql = "SELECT * FROM Nutzer where mail = ?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../saveData.php?error=usedmail");
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

function getNid($conn,$firstname,$lastname,$course,$gradyear,$mail){
	
	$sql = "SELECT nid FROM Nutzer where firstname = ? AND lastname = ? AND course = ? AND gradyear = ? AND mail = ?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../saveData.php?error=userexists");
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


function createUser($conn, $firstname, $lastname,$mail,$isSendMail, $course, $gradyear, $school,$gender, $title, $isSupportingMember,$isExternalLinks,$matrikel,$address,$city,$phone)
{
	
	$state = 0;
	$sql = "INSERT INTO Nutzer (firstname,lastname,course,school,gradyear,mail,state,isSendMail,gender,isSupportingMember,title,isExternalLinks,matrikel,address,city,phone) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../saveData.php?error=stmtfailed&vorname=".$firstname."&nachname=".$lastname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."&matrikel=".$matrikel."&address=".$address."&city=".$city."&phone=".$phone."");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"ssssssiisisissss",$firstname,$lastname,$course,$school,$gradyear,$mail,$state,$isSendMail,$gender,$isSupportingMember,$title,$isExternalLinks,$matrikel,$address,$city,$phone);
	mysqli_stmt_execute($stmt);

	if(mysqli_stmt_affected_rows($stmt) > 0)
    {
		$nid = mysqli_insert_id($conn);
	}
		
	mysqli_stmt_close($stmt);
    
	header("location: ../saveData.php?error=none");
	exit();

}



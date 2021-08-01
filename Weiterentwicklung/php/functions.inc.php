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

function checkMail($conn,$mail){
	
	$sql = "SELECT * FROM Nutzer where mail = ?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../signup.php?error=usedmail");
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

	$sql = "INSERT INTO Anmeldung (nid,password) VALUES(?,?);";

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

function insertLinks($conn,$nid,$twitter,$insta, $facebook, $xing, $linkedin,$others){

	$sql = "INSERT INTO ExternalLinks (nid,twitter,instagram,facebook,xing,linkedin,others) VALUES(?,?,?,?,?,?,?);";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../signup.php?error=stmtfailedextLinks");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"issssss",$nid,$twitter,$insta,$facebook,$xing,$linkedin,$others);
	mysqli_stmt_execute($stmt);

	
	mysqli_stmt_close($stmt);
	
}

function insertStatistic($conn, $course, $gradyear,$company2,$furtherinformation,$isSameCompany,$isDifferentCompany,$isFreelancer,$isFederal,$isFurtherEducation,$isForeignCountry,$isWorkSeeking){

	$sql = "INSERT INTO Registrierungsbefragung (gradyear,course,isSameCompany,isDifferentCompany,Company,isFreelancer,isFederal,isFurtherEducation,isForeignCountry,isWorkSeeking,furtherinformation) VALUES(?,?,?,?,?,?,?,?,?,?,?);";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../signup.php?error=stmtfailedstats");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"ssiisiiiiis",$gradyear,$course,$isSameCompany,$isDifferentCompany,$company2,$isFreelancer,$isFederal,$isFurtherEducation,$isForeignCountry,$isWorkSeeking,$furtherinformation);
	mysqli_stmt_execute($stmt);

	
	mysqli_stmt_close($stmt);
	
}

function createUser($conn, $firstname, $lastname,$mail,$isSendMail, $pwd1, $course, $gradyear, $school,$gender, $title, $isSupportingMember,$birthname,$isExternalLinks){
	
	$state = 1;

	$sql = "INSERT INTO Nutzer (firstname,lastname,course,school,gradyear,mail,state,isSendMail,gender,isSupportingMember,title,birthname,isExternalLinks) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?);";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../signup.php?error=stmtfailed&vorname=".$firstname."&nachname=".$lastname."&geburtsname=".$birthname."&mail=".$mail."&jahr=".$gradyear."&course=".$course."&gender=".$gender."&school=".$school."&title=".$title."");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"ssssssiisissi",$firstname,$lastname,$course,$school,$gradyear,$mail,$state,$isSendMail,$gender,$isSupportingMember,$title,$birthname,$isExternalLinks);
	mysqli_stmt_execute($stmt);

	if(mysqli_stmt_affected_rows($stmt) > 0){

		$nid = mysqli_insert_id($conn);

	}
		
	mysqli_stmt_close($stmt);

	insertPwd($conn,$nid,$pwd1);
	insertLinks($conn,$nid,"","","","","","");

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



function checkHash($conn,$nid){
	
	$sql = "SELECT password FROM Anmeldung where nid = ?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../login.php?error=pwdnotfound");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"i",$nid);
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


function getNidFromMail($conn,$mail){
	
	$sql = "SELECT nid FROM Nutzer where mail = ?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../login.php?error=mailnotfound");
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

function loginUser($conn,$mail,$pwd){
	
	$nid = getNidFromMail($conn,$mail);

	if ($nid === false) {
			header("location: ../login.php?error=mailnotfound");
			exit();
	}
	else {
		$pwdHashed = checkHash($conn,$nid["nid"]);
		$checkPwd = password_verify($pwd, $pwdHashed["password"]);

		if ($checkPwd === false) {
			header("location: ../login.php?error=wronglogin");
			exit();
		}
		else if ($checkPwd === true) {
			session_start();
			$_SESSION["nid"] = $nid;
			header("location: ../index.php");
			exit();
		}
	}


	
}


// ------------------------- PROFIL UPDATE -------------------------




function updateUser($conn, $nid,$firstname, $lastname,$isSendMail, $pwd1, $matrikel, $phone,$gender, $address, $city, $company , $position, $title, $twitter, $insta, $facebook, $xing, $linkedin, $isSupportingMember,$state,$others){

	$hashedPwd = password_hash($pwd1, PASSWORD_DEFAULT);

	$sql = "UPDATE Nutzer SET firstname = ?, lastname = ?, isSendMail = ?, matrikel = ?, phone = ?, gender = ?, address = ?, city = ?, company = ?, position = ?, title = ?, isSupportingMember = ?, state = ? where nid = ? ;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../profile.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"ssissssssssiiisssssi",$firstname,$lastname,$isSendMail,$matrikel,$phone,$gender,$address,$city,$company,$position,$title,$isSupportingMember,$state,$nid);
	mysqli_stmt_execute($stmt);
		
	mysqli_stmt_close($stmt);

	updatePwd($conn,$hashedPwd,$nid);
	updateLinks($conn,$twitter,$instagram,$xing,$linkedIn,$others,$nid);


	header("location: ../profile.php?error=none");
	exit();

}

function updatePwd($conn,$hashedPwd,$nid){
	
	$sql = "UPDATE Anmeldung SET password = ? where nid = ? ; ";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../profile.php?error=stmtfailedpwd");
		exit();
	}
	mysqli_stmt_bind_param($stmt,"si",$hashedPwd,$nid);
	mysqli_stmt_execute($stmt);

	mysqli_stmt_close($stmt);

}
function updateLinks($conn,$twitter,$instagram,$xing,$linkedIn,$others,$nid){
	
	$sql = "UPDATE ExternalLinks SET twitter = ?, instagram = ?, xing = ?, linkedIn = ?, others = ? where nid = ?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../profile.php?error=stmtfailedlinks");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"sssssi",$twitter,$instagram,$xing,$linkedIn,$others,$nid);
	mysqli_stmt_execute($stmt);

	mysqli_stmt_close($stmt);

}


/*
function updateUser($conn, $nid,$firstname, $lastname,$isSendMail, $pwd1, $matrikel, $phone,$gender, $address, $city, $company , $position, $title, $twitter, $insta, $facebook, $xing, $linkedin, $isSupportingMember,$state,$others){

	$hashedPwd = password_hash($pwd1, PASSWORD_DEFAULT);

	$sql = "UPDATE Nutzer SET firstname = ?, lastname = ?, isSendMail = ?, matrikel = ?, phone = ?, gender = ?, address = ?, city = ?, company = ?, position = ?, title = ?, isSupportingMember = ?, state = ? where nid = ? ; UPDATE Anmeldung SET password = ? where nid = ? ; UPDATE ExternalLinks SET twitter = ?, instagram = ?, xing = ?, linkedIn = ?, others = ? where nid = ?;";

	$stmt = mysqli_stmt_init($conn);

	if (!mysqli_stmt_prepare($stmt,$sql)) {
		header("location: ../profile.php?error=stmtfailed");
		exit();
	}

	mysqli_stmt_bind_param($stmt,"ssissssssssiiisisssssi",$firstname,$lastname,$isSendMail,$matrikel,$phone,$gender,$address,$city,$company,$position,$title,$isSupportingMember,$state,$nid,$hashedPwd,$nid,$twitter,$instagram,$xing,$linkedIn,$others,$nid);
	mysqli_stmt_execute($stmt);
		
	mysqli_stmt_close($stmt);


	header("location: ../profile.php?error=none");
	exit();

}
*/










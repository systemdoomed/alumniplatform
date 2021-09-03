<?php
require_once 'dbh.inc.php';
require_once 'functions.inc.php';
require_once 'session.inc.php';
session_start();
if (isset($_POST["submit"]))
{
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
    
    $upload_folder = '../uploads/profilbilder/'; //Das Upload-Verzeichnis
    $filename = pathinfo($_FILES['uploaddatei']['name'], PATHINFO_FILENAME);
    $extension = strtolower(pathinfo($_FILES['uploaddatei']['name'], PATHINFO_EXTENSION));
    $allowed_extensions = array('png', 'jpg', 'jpeg', 'gif');
    $filename = pathinfo($_FILES['uploaddatei']['name'], PATHINFO_FILENAME);
    if($filename!="")
    {
        if(!in_array($extension, $allowed_extensions))
        {
            header("location: ../profile.php?error=novalidData");
            exit();
        }
        $max_size = 3000*1024; //1500 KB
        if($_FILES['uploaddatei']['size'] > $max_size)
        {
            header("location: ../profile.php?error=tobigData");
            exit();
        }
        if(function_exists('exif_imagetype'))
        {
            //exif_imagetype erfordert die exif-Erweiterung
            $allowed_types = array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF);
            $detected_type = exif_imagetype($_FILES['uploaddatei']['tmp_name']);
            if(!in_array($detected_type, $allowed_types))
            {
                header("location: ../profile.php?error=noPicture");
                exit();
            }
        }
        $new_path = $upload_folder.'PB'.$_SESSION['nid']['nid'].'.'.$extension;
        require 'functions3.inc.php';
        
        if(pbexists($conn,$_SESSION['nid']['nid'])==1)
        { //Falls Datei existiert, ersetze diese
        $oldpath=$upload_folder.getpbname($conn,$_SESSION['nid']['nid']);
            echo $oldpath;
         unlink($oldpath);
        }
        move_uploaded_file($_FILES['uploaddatei']['tmp_name'], $new_path);
        $filename='PB'.$_SESSION['nid']['nid'].'.'.$extension;
        
        insertPicture($conn,$filename,$_SESSION['nid']['nid']);
        updateUser($conn, $nid,$firstname, $lastname,$isSendMail, $pwd1, $matrikel, $phone,$gender, $address, $city, $company , $position, $title, $twitter, $insta, $facebook, $xing, $linkedin, $isSupportingMember,$state,$others,$birthname,$isExternalLinks);
    }
    else
    {
        updateUser($conn, $nid,$firstname, $lastname,$isSendMail, $pwd1, $matrikel, $phone,$gender, $address, $city, $company , $position, $title, $twitter, $insta, $facebook, $xing, $linkedin, $isSupportingMember,$state,$others,$birthname,$isExternalLinks);
    }
}
elseif (isset($_POST["delete"]))
{
    require 'functions3.inc.php';
    $path='../uploads/profilbilder/'.getpbname($conn,$_SESSION['nid']['nid']);
    unlink($path);
    deletePicture($conn,$_SESSION['nid']['nid']);
    header("location: ../profile.php?error=none");
    exit();
}
else {
    header("location: ../profile.php");
    exit();
}

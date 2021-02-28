<?php
include_once '../header.php'
?>
<?php
    $firstname = $_POST["searchfirstname"];
    $lastname = $_POST["searchlastname"];
    require 'dbh.inc.php';
    require 'session.inc.php';
    $company = $_POST["searchcompany"];
    $position = $_POST["searchposition"];
/*    echo $firstname;
    echo $lastname;
    echo $gradyear;
    echo $course;
    echo $company;
    echo $position;
*/
    $sessionnid=$_SESSION['nid']['nid'];
    $status=getState($sessionnid,$conn);
    if($status==2)
    {
        $gradyear=getGradyear($sessionnid,$conn);
        $course=getCourse($sessionid,$conn);
    }else
    {
        $gradyear = $_POST["searchgradyear"];
        $course = $_POST["searchcourse"];
    }
    if($gradyear!=""){
   
    $a="WHERE firstname LIKE '%".$firstname."%' AND lastname LIKE '%".$lastname."%' AND gradyear='".$gradyear."' AND course LIKE '%".$course."%' AND company LIKE '%".$company."%' AND position LIKE '%".$position."%'";
    }else{
        $a="WHERE firstname LIKE '%".$firstname."%' AND lastname LIKE '%".$lastname."%' AND course LIKE '%".$course."%' AND company LIKE '%".$company."%' AND position LIKE '%".$position."%'";
    }
//    echo $a;
    header('location: ../contacts.php?parameter=search&parameter2='.$a);
    
    exit();
    
    ?>
<?php
include_once '../footer.php'
?>

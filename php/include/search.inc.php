<?php
    $firstname = $_POST["searchfirstname"];
    $lastname = $_POST["searchlastname"];
    $gradyear = $_POST["searchgradyear"];
    $course = $_POST["searchcourse"];
    $company = $_POST["searchcompany"];
    $position = $_POST["searchposition"];
    
/*    echo $firstname;
    echo $lastname;
    echo $gradyear;
    echo $course;
    echo $company;
    echo $position;
*/
    if($gradyear!=""){
   
    $a="WHERE firstname LIKE '%".$firstname."%' AND lastname LIKE '%".$lastname."%' AND gradyear='".$gradyear."' AND course LIKE '%".$course."%' AND company LIKE '%".$company."%' AND position LIKE '%".$position."%'";
    }else{
        $a="WHERE firstname LIKE '%".$firstname."%' AND lastname LIKE '%".$lastname."%' AND course LIKE '%".$course."%' AND company LIKE '%".$company."%' AND position LIKE '%".$position."%'";
    }
//    echo $a;
    header('location: ../contacts.php?parameter=search&parameter2='.$a);
    exit();
    
    ?>

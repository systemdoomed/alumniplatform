<?php
include_once '../header.php'
?>
<?php
    $firstname = $_POST["searchfirstname"];
    $lastname = $_POST["searchlastname"];
    $company = $_POST["searchcompany"];
    $position = $_POST["searchposition"];
    $gradyear = $_POST["searchgradyear"];
    $course = $_POST["searchcourse"];
    header('location: ../contacts.php?parameter=search&parameter2='.$firstname.'&parameter3='.$lastname.'&parameter4='.$company.'&parameter5='.$position.'&parameter6='.$gradyear.'&parameter7='.$course);
    exit();
    
    ?>
<?php
include_once '../footer.php'
?>

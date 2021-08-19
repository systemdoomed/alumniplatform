<?php
include_once '../header.php'
?>
<?php
    $date = $_POST["searchdate"];
    $time = $_POST["searchtime"];
    $text = $_POST["searchlogtext"];
    $changedby = $_POST["searchchangedby"];
    $changedData = $_POST["searchData"];
    header('location: ../logs.php?parameter=search&parameter2='.$date.'&parameter3='.$time.'&parameter4='.$text.'&parameter5='.$changedby.'&parameter6='.$changedData);
    exit();
    
    ?>
<?php
include_once '../footer.php'
?>

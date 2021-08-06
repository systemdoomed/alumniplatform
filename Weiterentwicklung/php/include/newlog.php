<?php
function newlog($conn,$nid,$text,$dataset)
{
    $sql = "INSERT INTO Logs (date, time, logtext, changedby, changedData) VALUES(?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    date_default_timezone_set("Europe/Berlin");
    $timestamp = time();
    $datum = date("Y-m-d", $timestamp);
    $row = getName($nid,$conn);
    $row2 = getName($dataset,$conn);
    $firstnamedataset = $row2["firstname"];
    $lastnamedataset = $row2["lastname"];
    $firstnamechange = $row["firstname"];
    $lastnamechange = $row["lastname"];
    $changer = $nid.": ".$firstnamechange." ".$lastnamechange;
    $changed = $dataset.": ".$firstnamedataset." ".$lastnamedataset;
    $uhrzeit =  date("H:i:s", $timestamp);
    mysqli_stmt_bind_param($stmt,"sssss",$datum,$uhrzeit,$text,$changer,$changed);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return;
}
function getName($nid,$conn)
{
    $sql = "SELECT firstname,lastname FROM Nutzer WHERE nid=?";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$nid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);
    return $row;
}
?>

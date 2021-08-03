<?php
function getprofiledata($nid,$conn)
{
    $sql = "SELECT N.title, N.firstname, N.lastname, N.gender, N.matrikel, N.phone, N.address, N.city, N.mail, N.company, N.position, N.birthname, E.twitter, E.instagram, E.facebook, E.xing, E.linkedin, E.others  FROM Nutzer N INNER JOIN ExternalLinks E ON N.nid=E.nid WHERE N.nid=?";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$nid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);
    return $row;
    mysqli_stmt_close($stmt);
}
?>

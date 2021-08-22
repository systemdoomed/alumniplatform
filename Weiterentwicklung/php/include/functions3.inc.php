<?php
function isAdmin($nid,$conn)
    {
        $sql = "SELECT state FROM Nutzer WHERE nid=?";
        $stmt = mysqli_stmt_init($conn);
        $result = mysqli_query($conn, $sql);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"i",$nid);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_assoc($resultData);
        return implode($row);
        mysqli_stmt_close($stmt);
    }
?>

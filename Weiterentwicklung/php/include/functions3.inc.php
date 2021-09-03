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
        if(isset($row))
            {
                return implode($row);
            }
        else
            {
                return 0;
            }
        mysqli_stmt_close($stmt);
    }
function insertPicture($conn, $filename,$nid)
{
    $exists=pbexists($conn,$nid);
    
    if($exists==0)
        {
            $sql = "INSERT INTO Profilbild (nid,filename) VALUES(?,?);";

            $stmt = mysqli_stmt_init($conn);

            if (!mysqli_stmt_prepare($stmt,$sql)) {
                header("location: ../profile.php?error=stmtfailed");
                exit();
            }

            mysqli_stmt_bind_param($stmt,"is",$nid,$filename);
            mysqli_stmt_execute($stmt);
                
            mysqli_stmt_close($stmt);
            
            header("location: ../profile.php?error=none");
            exit();
        }
    elseif($exists==1)
    {
        $sql = "UPDATE Profilbild SET filename = ? where nid = ?;";

        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt,$sql)) {
            header("location: ../profile.php?error=stmtfailed");
            exit();
        }

        mysqli_stmt_bind_param($stmt,"si",$filename,$nid);
        mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);
    }

}

function pbexists($conn,$nid)
{
    $sql = "SELECT nid FROM Profilbild where nid = ?;";

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt,$sql);

    mysqli_stmt_bind_param($stmt,"i",$nid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $count=mysqli_num_rows($resultData);
    
    if($count>0)
        {
            return 1;
        }
    else
        {
            return 0;
        }
    
    mysqli_stmt_close($stmt);
}
function getpbname($conn,$nid)
{
    $sql = "SELECT filename FROM Profilbild where nid = ?;";

    $stmt = mysqli_stmt_init($conn);

    mysqli_stmt_prepare($stmt,$sql);

    mysqli_stmt_bind_param($stmt,"i",$nid);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);
    return $row["filename"];
    
    
    mysqli_stmt_close($stmt);
}
function deletePicture($conn,$nid)
{
    $sql = "DELETE FROM Profilbild WHERE NID=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$nid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}
function getStaff($conn)
{
    $sql = "SELECT N.title, N.firstname, N.lastname , N.nid, P.filename FROM Nutzer N LEFT OUTER JOIN Profilbild P ON N.nid = P. nid WHERE (N.course = 'BA' OR N.course = 'FV') AND N.nid != 1;";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    return $resultData;
    mysqli_stmt_close($stmt);
}
function getunverifiedCourseMates($conn,$course,$gradyear)
{
    $sql = "SELECT N.title, N.firstname, N.lastname , N.nid, P.filename FROM Nutzer N LEFT OUTER JOIN Profilbild P ON N.nid = P. nid WHERE N.course = ? AND N.gradyear = ? AND N.state = 1 ORDER BY N.lastname ASC, N.firstname ASC;";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"ss",$course,$gradyear);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    return $resultData;
    mysqli_stmt_close($stmt);
}
function getverifiedCourseMates($conn,$course,$gradyear)
{
    $sql = "SELECT N.title, N.firstname, N.lastname , N.nid, P.filename, N.state FROM Nutzer N LEFT OUTER JOIN Profilbild P ON N.nid = P. nid WHERE N.course = ? AND N.gradyear = ? AND N.state != 1 ORDER BY N.state DESC, lastname ASC, firstname ASC;";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"ss",$course,$gradyear);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    return $resultData;
    mysqli_stmt_close($stmt);
}
function getunverifiedaccounts($conn)
{
    $sql = "SELECT N.title, N.firstname, N.lastname , N.nid, P.filename FROM Nutzer N LEFT OUTER JOIN Profilbild P ON N.nid = P. nid WHERE N.state = 1 ORDER BY N.lastname ASC, N.firstname ASC;";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    return $resultData;
    mysqli_stmt_close($stmt);
}
?>

    <?PHP
function getgroups($conn)
{
    $sql = "SELECT course, gradyear FROM Nutzer GROUP BY course, gradyear";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    //$row = mysqli_fetch_assoc($resultData);
    return $resultData;
    mysqli_stmt_close($stmt);
}
function createevent($conn,$title,$startdate,$starttime,$enddate,$endtime,$street,$city,$link,$description,$creator)
{
    $sql = "INSERT INTO Event (title,startdate,starttime,enddate,endtime,street,city,link,description,creator) VALUES(?,?,?,?,?,?,?,?,?,?);";

    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../events.php?mode=create&error=stmtfailed&title=".$title."&startdate=".$startdate."&starttime=".$starttime."&enddate=".$enddate."&endtime=".$endtime."&street=".$street."&city=".$city."&link=".$link);
        exit();
    }

    mysqli_stmt_bind_param($stmt,"sssssssssi",$title,$startdate,$starttime,$enddate,$endtime,$street,$city,$link,$description,$creator);
    mysqli_stmt_execute($stmt);

    if(mysqli_stmt_affected_rows($stmt) > 0){
        $eid = mysqli_insert_id($conn);
    }
   
    return $eid;
}
function getEvents($conn,$sessionnid)
{
    //require 'session.inc.php';
    $state=getState($sessionnid,$conn);
    if($state==3)
        {
            $sql = "SELECT startdate,starttime,title,eid FROM Event WHERE enddate >= CURDATE() ORDER BY startdate ASC, starttime ASC";
            $stmt = mysqli_stmt_init($conn);
            $result = mysqli_query($conn, $sql);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
        }
    elseif ($state==2)
        {
            $course=getCourse($sessionnid,$conn);
            $gradyear=getGradyear($sessionnid,$conn);
            $sql = "SELECT e.startdate,e.starttime,e.title,e.eid FROM Event e INNER JOIN Eventgroups g ON e.eid = g.eid WHERE enddate >= CURDATE() AND g.course = ? AND g.gradyear= ?  ORDER BY startdate ASC, starttime ASC";
            $stmt = mysqli_stmt_init($conn);
            $result = mysqli_query($conn, $sql);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"si",$course,$gradyear);
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
        }
    else
        {
            echo 'Keine Zugangsberechtigung';
        }
    return $resultData;
}
function checkaccess($conn,$sessionnid,$eid)
{
    $state=getState($sessionnid,$conn);
    $permission=0;
    if($state==3)
        {
            $permission = 1;
        }
    elseif($state==2)
    {
        $course=getCourse($sessionnid,$conn);
        $gradyear=getGradyear($sessionnid,$conn);
        $sql = "SELECT eid FROM Eventgroups WHERE eid = ? AND course = ? AND gradyear = ?";
        $stmt = mysqli_stmt_init($conn);
        $result = mysqli_query($conn, $sql);
        mysqli_stmt_prepare($stmt,$sql);
        mysqli_stmt_bind_param($stmt,"isi", $eid, $course, $gradyear);
        mysqli_stmt_execute($stmt);
        $resultData = mysqli_stmt_get_result($stmt);
        if(mysqli_num_rows($resultData)>0)
            {
                $permission=1;
            }
        mysqli_stmt_close($stmt);
    }
    return $permission;
}
function getEventDetails($conn,$eid)
{
    $sql = "SELECT title, startdate, starttime, enddate, endtime, street, city, link, description, creator FROM Event WHERE eid = ?";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i", $eid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);
    return $row;
    mysqli_stmt_close($stmt);
}
function getCreatorData($conn,$nid)
{
    $sql = "SELECT title, firstname, lastname FROM Nutzer WHERE nid = ?";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i", $nid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);
    return $row;
    mysqli_stmt_close($stmt);
}
function gethistoricEvents($conn,$sessionnid)
{
    //require 'session.inc.php';
    $state=getState($sessionnid,$conn);
    if($state==3)
        {
            $sql = "SELECT startdate,starttime,title,eid FROM Event WHERE enddate < CURDATE() ORDER BY startdate ASC, starttime ASC";
            $stmt = mysqli_stmt_init($conn);
            $result = mysqli_query($conn, $sql);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
        }
    elseif ($state==2)
        {
            $course=getCourse($sessionnid,$conn);
            $gradyear=getGradyear($sessionnid,$conn);
            $sql = "SELECT e.startdate,e.starttime,e.title,e.eid FROM Event e INNER JOIN Eventgroups g ON e.eid = g.eid WHERE enddate < CURDATE() AND g.course = ? AND g.gradyear= ?  ORDER BY startdate ASC, starttime ASC";
            $stmt = mysqli_stmt_init($conn);
            $result = mysqli_query($conn, $sql);
            mysqli_stmt_prepare($stmt,$sql);
            mysqli_stmt_bind_param($stmt,"si",$course,$gradyear);
            mysqli_stmt_execute($stmt);
            $resultData = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
        }
    else
        {
            echo 'Keine Zugangsberechtigung';
        }
    return $resultData;
}
function getinvitedGroups($conn,$eid)
{
    $sql = "SELECT course, gradyear FROM Eventgroups WHERE eid = ? ORDER BY gradyear DESC, course DESC";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$eid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    return $resultData;
    mysqli_stmt_close($stmt);
}
function setState($conn,$state,$eid,$nid)
{
    $sql = "INSERT INTO Eventresponse (eid,nid,status) VALUES(?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../events.php?mode=displaydetails&eid=".$eid."&error=stmtfailed");
        exit();
    }
    if($state=="accept")
        {
            $state=1;
        }elseif($state=="decline")
    {
        $state=0;
    }
    mysqli_stmt_bind_param($stmt,"iii",$eid,$nid,$state);
    mysqli_stmt_execute($stmt);
    return 0;
}
function updateState($conn,$state,$eid,$nid)
{
    $sql = "UPDATE Eventresponse SET status = ? WHERE eid = ? AND nid = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../events.php?mode=displaydetails&eid=".$eid."&error=stmtfailed");
        exit();
    }
    if($state=="accept")
        {
            $state=1;
        }elseif($state=="decline")
    {
        $state=0;
    }
    mysqli_stmt_bind_param($stmt,"iii",$state,$eid,$nid);
    mysqli_stmt_execute($stmt);
    return 0;
}
function statusexists($conn,$eid,$nid)
{
    $sql = "SELECT eid FROM Eventresponse WHERE eid = ? AND nid = ?";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"ii", $eid, $nid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $exists=0;
    if(mysqli_num_rows($resultData)>0)
        {
            $exists=1;
        }
    return $exists;
    mysqli_stmt_close($stmt);
}
function getcurrentstate($conn,$eid,$nid)
{
    $sql = "SELECT status FROM Eventresponse WHERE eid = ? AND nid = ?";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"ii", $eid, $nid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);
    return $row["status"];
    mysqli_stmt_close($stmt);
}
function iscreator($conn,$eid,$nid)
{
    $sql = "SELECT creator FROM Event WHERE eid = ?";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i", $eid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);
    if($row["creator"]==$nid)
        {
            $iscreator=1;
        }
    else
        {
            $iscreator=0;
        }
    return $iscreator;
    mysqli_stmt_close($stmt);
}
function getResponses($conn,$eid)
{
    $sql = "SELECT n.firstname, n.lastname, n.course, n.gradyear, e.status, n.title FROM Eventresponse e INNER JOIN Nutzer n on e.nid = n.nid WHERE e.eid = ? ORDER BY n.course ASC, n.gradyear DESC, lastname ASC";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i", $eid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    return $resultData;
    mysqli_stmt_close($stmt);
}
function getacceptnumber($conn,$eid)
{
    $sql = "SELECT count(eid) AS anzahl FROM Eventresponse WHERE eid = ? AND status = 1;";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i", $eid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);
    return $row["anzahl"];
    mysqli_stmt_close($stmt);
}
function getdeclinenumber($conn,$eid)
{
    $sql = "SELECT count(eid) AS anzahl FROM Eventresponse WHERE eid = ? AND status = 0;";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i", $eid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($resultData);
    return $row["anzahl"];
    mysqli_stmt_close($stmt);
}
function getchangableEvents($conn,$nid)
{
    $sql = "SELECT startdate,starttime,title,eid FROM Event WHERE enddate >= CURDATE() AND creator= ? ORDER BY startdate ASC, starttime ASC";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i", $nid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    return $resultData;
    mysqli_stmt_close($stmt);
}
function updateEvents($conn,$eid,$title,$startdate,$starttime,$enddate,$endtime,$street,$city,$link,$description)
{
    $sql = "UPDATE Event SET title = ?, startdate = ?, starttime = ?, enddate = ?, endtime = ?, street = ?, city = ?, link = ?, description = ? WHERE eid = ?;";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt,$sql)) {
        header("location: ../events.php?mode=changeevent&eid=".$eid."&error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt,"sssssssssi",$title,$startdate,$starttime,$enddate,$endtime,$street,$city,$link,$description,$eid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    return 0;
}
function getSelectedGroups($conn,$eid)
{
    $sql = "SELECT course, gradyear FROM Eventgroups WHERE eid = ?;";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i", $eid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    return $resultData;
    mysqli_stmt_close($stmt);
}
function getUnselectedGroups($conn,$eid)
{
    $sql = "SELECT course, gradyear FROM Nutzer WHERE (course, gradyear) not in (SELECT course, gradyear FROM Eventgroups WHERE eid=?) GROUP BY course, gradyear;";
    $stmt = mysqli_stmt_init($conn);
    $result = mysqli_query($conn, $sql);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i", $eid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    return $resultData;
    mysqli_stmt_close($stmt);
}
?>

<?php
include_once '../header.php'
?>
<?php
if (isset($_POST["submit"]))
{
    if(isset($_GET["mode"]))
    {
        if($_GET["mode"]=="create")
        {
            $title = $_POST["inputtitle"];
            $startdate = $_POST["inputstartdate"];
            $starttime = $_POST["inputstarttime"];
            $enddate = $_POST["inputenddate"];
            $endtime = $_POST["inputendtime"];
            $street = $_POST["inputstreet"];
            $city = $_POST["inputcity"];
            $link = $_POST["inputlink"];
            $description = $_POST["inputdescription"];
            require 'eventfunctions.inc.php';
            require 'dbh.inc.php';
            if(empty($title)||empty($startdate)||empty($starttime)||empty($enddate)||empty($endtime)||(empty($street)&&empty($city)&&empty($link))||empty($description))
            {
                header("location: ../events.php?mode=create&error=noinput&title=".$title."&startdate=".$startdate."&starttime=".$starttime."&enddate=".$enddate."&endtime=".$endtime."&street=".$street."&city=".$city."&link=".$link);
                exit();
            }
            elseif((!empty($city)&&empty($street))||(!empty($street)&&empty($city)))
            {
                header("location: ../events.php?mode=create&error=noinput&title=".$title."&startdate=".$startdate."&starttime=".$starttime."&enddate=".$enddate."&endtime=".$endtime."&street=".$street."&city=".$city."&link=".$link);
                exit();
            }
            if(strtotime('now') > strtotime($enddate))
            {
                header("location: ../events.php?mode=create&error=endbeforetoday&title=".$title."&startdate=".$startdate."&starttime=".$starttime."&enddate=".$enddate."&endtime=".$endtime."&street=".$street."&city=".$city."&link=".$link);
                exit();
            }
            if(strtotime($enddate) < strtotime($startdate))
            {
                header("location: ../events.php?mode=create&error=endbeforestartdate&title=".$title."&startdate=".$startdate."&starttime=".$starttime."&enddate=".$enddate."&endtime=".$endtime."&street=".$street."&city=".$city."&link=".$link);
                exit();
            }
            if ((strtotime($enddate) == strtotime($startdate)) && (date($endtime) <= date($starttime)))
            {
                header("location: ../events.php?mode=create&error=endbeforestarttime&title=".$title."&startdate=".$startdate."&starttime=".$starttime."&enddate=".$enddate."&endtime=".$endtime."&street=".$street."&city=".$city."&link=".$link);
                exit();
            }
            $amount=$_GET["amount"];
            $counter=1;
            $selected=0;
            while($counter<=$amount)
            {
                if(isset($_POST['group'.$counter]))
                {
                    $selected=1;
                }
                $counter=$counter+1;
            }
            if($selected==0)
            {
                header("location: ../events.php?mode=create&error=nogroupselected&title=".$title."&startdate=".$startdate."&starttime=".$starttime."&enddate=".$enddate."&endtime=".$endtime."&street=".$street."&city=".$city."&link=".$link);
                exit();
            }
            else
            {
                $eid=createevent($conn,$title,$startdate,$starttime,$enddate,$endtime,$street,$city,$link,$description,$_SESSION['nid']['nid']);
                $counter=1;
                $sql = "INSERT INTO Eventgroups (eid,course,gradyear) VALUES(?,?,?);";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt,$sql))
                {
                    header("location: ../events.php?mode=create&error=stmtfailed&title=".$title."&startdate=".$startdate."&starttime=".$starttime."&enddate=".$enddate."&endtime=".$endtime."&street=".$street."&city=".$city."&link=".$link);
                    exit();
                }
                while($counter<=$amount)
                {
                    if(isset($_POST['group'.$counter]))
                    {
                        $pos=stripos($_POST['group'.$counter],';');
                        $length=strlen($_POST['group'.$counter]);
                        $course=substr($_POST['group'.$counter],0,$pos);
                        $year=substr($_POST['group'.$counter],$pos+1,$length);
                        mysqli_stmt_bind_param($stmt,"iss",$eid,$course,$year);
                        mysqli_stmt_execute($stmt);
                    }
                    $counter=$counter+1;
                }
                mysqli_stmt_close($stmt);
                
                //////////**************************** Hier kann ein versenden der Benachrichtigung über ein neues Event erfolgen*********************\\\\
                
                header("location: ../events.php?mode=create&error=noerror");
                exit();
            }
        }
    }
}
if(isset($_GET["mode"]))
{
    require 'session.inc.php';
    if(($_GET["mode"])=="displaydetailsnew")
    {
        $sessionnid=$_SESSION['nid']['nid'];
        $state=getState($sessionnid,$conn);
        if(($state==3)||($state==2))
        {
            require 'eventfunctions.inc.php';
            setState($conn,$_GET["state"],$_GET["eid"],$sessionnid);
        }
        else
        {
            echo 'Kein Zugriff';
        }
        header("location: ../events.php?mode=displaydetails&eid=".$_GET["eid"]."&error=noerror");
        exit();
    }
    elseif(($_GET["mode"])=="displaydetailschange")
    {
        $sessionnid=$_SESSION['nid']['nid'];
        $state=getState($sessionnid,$conn);
        if(($state==3)||($state==2))
        {
            require 'eventfunctions.inc.php';
            updateState($conn,$_GET["state"],$_GET["eid"],$sessionnid);
        }
        else
        {
            echo 'Kein Zugriff';
        }
        header("location: ../events.php?mode=displaydetails&eid=".$_GET["eid"]."&error=noerror");
        exit();
    }
    elseif(($_GET["mode"])=="changeevent")
    {
        $title = $_POST["inputtitle"];
        $startdate = $_POST["inputstartdate"];
        $starttime = $_POST["inputstarttime"];
        $enddate = $_POST["inputenddate"];
        $endtime = $_POST["inputendtime"];
        $street = $_POST["inputstreet"];
        $city = $_POST["inputcity"];
        $link = $_POST["inputlink"];
        $description = $_POST["inputdescription"];
        require 'eventfunctions.inc.php';
        require 'dbh.inc.php';
        if(empty($title)||empty($startdate)||empty($starttime)||empty($enddate)||empty($endtime)||empty($description)||(empty($street)&&empty($city)&&empty($link)))
        {
            header("location: ../events.php?mode=changeevent&eid=".$_GET["eid"]."&error=noinput");
            exit();
        }
        elseif((!empty($city)&&empty($street))||(!empty($street)&&empty($city)))
        {
            header("location: ../events.php?mode=changeevent&eid=".$_GET["eid"]."&error=noinput");
            exit();
        }
        if(strtotime('now') > strtotime($enddate))
        {
            header("location: ../events.php?mode=changeevent&eid=".$_GET["eid"]."&error=endbeforetoday");
            exit();
        }
        if(strtotime($enddate) < strtotime($startdate))
        {
            header("location: ../events.php?mode=changeevent&eid=".$_GET["eid"]."&error=endbeforestartdate");
            exit();
        }
        if ((strtotime($enddate) == strtotime($startdate)) && (date($endtime) <= date($starttime)))
        {
            header("location: ../events.php?mode=changeevent&eid=".$_GET["eid"]."&error=endbeforestarttime");
            exit();
        }
        if(getState($_SESSION['nid']['nid'],$conn)==3)
            {
                updateEvents($conn,$_GET["eid"],$title,$startdate,$starttime,$enddate,$endtime,$street,$city,$link,$description);
            }
        
        $amount=$_GET["amount"];
        $counter=1;
        $selected=0;
        while($counter<=$amount)
        {
            if(isset($_POST['group'.$counter]))
            {
                $selected=1;
            }
            $counter=$counter+1;
        }
        if($selected==0)
        {
            header("location: ../events.php?mode=changeevent&eid=".$_GET["eid"]."&error=noerror");
            exit();
        }
        else
        {
            $sql = "INSERT INTO Eventgroups (eid,course,gradyear) VALUES(?,?,?);";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt,$sql))
            {
                header("location: ../events.php?mode=changeevent&error=stmtfailed&eid=".$_GET["eid"]);
                exit();
            }
            $counter=1;
            $eid=$_GET["eid"];
            while($counter<=$amount)
            {
                if(isset($_POST['group'.$counter]))
                {
                    $pos=stripos($_POST['group'.$counter],';');
                    $length=strlen($_POST['group'.$counter]);
                    $course=substr($_POST['group'.$counter],0,$pos);
                    $year=substr($_POST['group'.$counter],$pos+1,$length);
                    mysqli_stmt_bind_param($stmt,"iss",$eid,$course,$year);
                    mysqli_stmt_execute($stmt);
                }
                $counter=$counter+1;
            }
            header("location: ../events.php?mode=changeevent&eid=".$_GET["eid"]."&error=noerror");
            exit();
            mysqli_stmt_close($stmt);
            }
        
    }
    else
    {
        echo 'Ungültiger Modus';
    }
}
?>
<?php
include_once '../footer.php'
?>

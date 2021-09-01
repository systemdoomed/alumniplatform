<?php
include_once 'header.php'
?>
<html lang="de" dir="ltr">
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/styling.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark justify-content-end">

<ul class="navbar-nav">
<?php
if(isset($_SESSION['nid']))
{
    require 'include/session.inc.php';
    require 'include/dbh.inc.php';
    $sessionnid=$_SESSION['nid']['nid'];
    $status=getState($sessionnid,$conn);
    if($status==3)
    {
        if(isset($_GET["mode"]))
        {
            $mode = $_GET["mode"];
            if($mode == "displaylist")
            {
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=create'>Event anlegen</a></li>";
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=changelist'>Event ändern</a></li>";
            }
            elseif($mode == "change")
            {
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=create'>Event anlegen</a></li>";
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=displaylist'>Events anzeigen</a></li>";
            }
            elseif($mode == "create")
            {
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=displaylist'>Events anzeigen</a></li>";
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=changelist'>Event ändern</a></li>";
            }
            elseif($mode == "displaydetails")
            {
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=create'>Event anlegen</a></li>";
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=changelist'>Event ändern</a></li>";
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=displaylist'>Events anzeigen</a></li>";
            }
            elseif($mode == "changelist")
            {
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=create'>Event anlegen</a></li>";
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=displaylist'>Events anzeigen</a></li>";
            }
            elseif($mode == "changeevent")
            {
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=create'>Event anlegen</a></li>";
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=displaylist'>Events anzeigen</a></li>";
                echo "<li class='nav-item'><a class='nav-link' href='events.php?mode=changelist'>Event ändern</a></li>";
            }
            else
            {
                echo "Fehlerhafter Modus";
            }
        }
        else
        {
            echo "Unbekannter Bearbeitungsmodus";
        }
    }
    echo '</ul>';
    echo '</nav>';
    if (isset($_GET["error"]))
    {
        if ($_GET["error"] == "noinput")
        {
            echo '<p class="bg-dark text-center text-light">Sie haben eines/ einige der benötigten Felder nicht ausgefüllt!</p>';
        }elseif ($_GET["error"] == "endbeforetoday")
        {
            echo '<p class="bg-dark text-center text-light">Das angegebene Enddatum liegt vor dem heutigen Tag!</p>';
        }elseif ($_GET["error"] == "endbeforestartdate")
        {
            echo '<p class="bg-dark text-center text-light">Das angegebene Enddatum liegt vor dem angegebenen Startdatum!</p>';
        }elseif ($_GET["error"] == "endbeforestarttime")
        {
            echo '<p class="bg-dark text-center text-light">Die Enduhrzeit liegt vor der Startuhrzeit!</p>';
        }
        elseif ($_GET["error"] == "nogroupselected")
        {
            echo '<p class="bg-dark text-center text-light">Es wurde keine Interessengruppe für das Event ausgewählt!</p>';
        }
        elseif ($_GET["error"] == "stmtfailed")
        {
            echo '<p class="bg-dark text-center text-light">Es ist ein interner Fehler bei der Verarbeitung der Daten aufgetreten, bitte probieren sie es erneut.</p>';
        }
        if ($_GET["error"] == "noerror")
        {
            echo '<p class="bg-dark text-center text-light">Der Vorgang wurde erfolgreich durchgeführt</p>';
        }
        
    }
    ?>
    <div class="jumbotron seamless gradient-2">
    <?PHP
    if(isset($_GET["mode"]))
    {
        $mode = $_GET["mode"];
        if($mode == "create")
        {
            if($status == 3)
            {
                require 'include/eventfunctions.inc.php';
                $groups=getGroups($conn);
                $amount = mysqli_num_rows($groups);
                echo '<form action="include/events.inc.php?amount='.$amount.'&mode=create" method="post">';
                echo 'Event erstellen';
                echo '<br>';
                echo '<br>';
                echo '<div class="form-row">';
                echo '<div class="form-group col-xl-3">';
                echo '<label for="inputtitle" class="text-dark">Bezeichnung des Events</label>';
                echo '</div>';
                echo '<div class="form-group col-xl-3">';
                if(!isset($_GET["title"]))
                {
                    echo '<input type="text" name="inputtitle" class="form-control" id="inputtitle" placeholder="Bezeichnung des Events">';
                }
                else
                {
                    echo '<input type="text" name="inputtitle" class="form-control" id="inputtitle" placeholder="Bezeichnung des Events" value="'.$_GET["title"].'">';
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="form-row">';
                echo '<div class="form-group col-xl-3">';
                echo '<label for="inputstartdate" class="text-dark">Beginn des Events</label>';
                echo '</div>';
                echo '<div class="form-group col-xl-3">';
                if(isset($_GET["startdate"]))
                {
                    echo '<input type="date" name="inputstartdate" class="form-control" id="inputstartdate" value="'. $_GET["startdate"].'">';
                }
                else
                {
                    echo '<input type="date" name="inputstartdate" class="form-control" id="inputstartdate">';
                }
                echo '</div>';
                echo '<div class="form-group col-xl-3">';
                if(isset($_GET["startdate"]))
                {
                    echo '<input type="time" name="inputstarttime" class="form-control" id="inputstarttimes" value="'.$_GET["starttime"].'">';
                }
                else
                {
                    echo '<input type="time" name="inputstarttime" class="form-control" id="inputstarttimes">';
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="form-row">';
                echo '<div class="form-group col-xl-3">';
                echo '<label for="inputenddate" class="text-dark">Ende des Events</label>';
                echo '</div>';
                echo '<div class="form-group col-xl-3">';
                if(isset($_GET["enddate"]))
                {
                    echo '<input type="date" name="inputenddate" class="form-control" id="inputenddate" value="'.$_GET["enddate"].'">';
                }
                else
                {
                    echo '<input type="date" name="inputenddate" class="form-control" id="inputenddate">';
                }
                echo '</div>';
                echo '<div class="form-group col-xl-3">';
                if(isset($_GET["endtime"]))
                {
                    echo '<input type="time" name="inputendtime" class="form-control" id="inputendtime" value="'.$_GET["endtime"].'">';
                }
                else
                {
                    echo '<input type="time" name="inputendtime" class="form-control" id="inputendtime">';
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="form-row">';
                echo '<div class="form-group col-xl-3">';
                echo '<label for="inputstreet" class="text-dark">Ort der Veranstaltung</label>';
                echo '</div>';
                echo '<div class="form-group col-xl-3">';
                if(isset($_GET["street"]))
                {
                    echo '<input type="text" name="inputstreet" class="form-control" id="inputstreet" placeholder="Straße und Hausnummer" value="'.$_GET["street"].'">';
                }
                else
                {
                    echo '<input type="text" name="inputstreet" class="form-control" id="inputstreet" placeholder="Straße und Hausnummer">';
                }
                echo '</div>';
                echo '<div class="form-group col-xl-3">';
                if(isset($_GET["city"]))
                {
                    echo '<input type="text" name="inputcity" class="form-control" id="inputcity" placeholder="Postleitzahl und Ort" value="'.$_GET["city"].'">';
                }
                else
                {
                    echo '<input type="text" name="inputcity" class="form-control" id="inputcity" placeholder="Postleitzahl und Ort">';
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="form-row">';
                echo '<div class="form-group col-xl-3">';
                echo '<label for="inputlink" class="text-dark">Link zur Veranstaltung</label>';
                echo '</div>';
                echo '<div class="form-group col-xl-3">';
                if(isset($_GET["link"]))
                {
                    echo '<input type="url" name="inputlink" class="form-control" id="inputlink" placeholder="URL zur Veranstaltung" value="'.$_GET["link"].'">';
                }
                else
                {
                    echo '<input type="url" name="inputlink" class="form-control" id="inputlink" placeholder="URL zur Veranstaltung">';
                }
                echo '</div>';
                echo '</div>';
                echo '<div class="form-row">';
                echo '<div class="form-group col-xl-3">';
                echo '<label for="inputdescription" class="text-dark">Beschreibung des Events</label>';
                echo '</div>';
                echo '<div class="form-group col-xl-1">';
                echo '<textarea name="inputdescription" cols="80" rows="10"></textarea>';
                echo '</div>';
                echo '</div>';
                // Finden der Interessengruppen
                echo '<table  class=" table table-hover table-dark table-bordered text-center">';
                echo '<thead>';
                echo '<tr class="">';
                echo '<th class="th">'.'Personengruppe auswählen'.'</th>';
                echo '<th class="th">'.'Studienrichtung'.'</th>';
                echo '<th class="th">'.'Abschlussjahr'.'</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                $i = 1;
                while ($i<=$amount)
                {
                    echo '<tr>';
                    $row = mysqli_fetch_assoc($groups);
                    echo '<td><input type="checkbox" name="group'.$i.'" value="'.$row["course"].';'.$row["gradyear"].'" id="check1"></td>';
                    echo '<td>'.$row["course"].'<td>';
                    echo '<td>'.$row["gradyear"].'<td>';
                    echo '</tr>';
                    $i = $i + 1;
                }
                echo '</tbody>';
                echo '</table>';
                echo '<button type="submit" name= "submit" class="btn btn-primary">Anlegen</button>';
                echo '</form>';
            }
            else
            {
                echo "Das erstellen von Events ist nicht zulässig";
            }
        }
        elseif($mode == "displaylist")
        {
            if(($state==2)||($state==3))
                {
            include 'include/eventfunctions.inc.php';
            echo '<h1>Übersicht der Events</h1>';
            echo '<br>';
            echo '<h3>Aktuelle Events</h3>';
            echo '<br>';
            echo '<table  class="table table-hover table-dark table-bordered text-center">';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Startdatum</th>';
            echo '<th>Startuhrzeit</th>';
            echo '<th>Kurzbeschreibung</th>';
            echo '<th>Details anzeigen</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            $result=getEvents($conn,$sessionnid);
            $amount=mysqli_num_rows($result);
            $counter=1;
            while($counter<=$amount)
            {
                echo '<tr>';
                $row=mysqli_fetch_assoc($result);
                echo '<td>'.$row["startdate"].'</td>';
                echo '<td>'.$row["starttime"].'</td>';
                echo '<td>'.$row["title"].'</td>';
                echo '<td>.<a href="events.php?mode=displaydetails&eid='.$row["eid"].'"> <button class="btn btn-info">Details anzeigen</button></a>.</td>';
                $counter=$counter+1;
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
            echo "<br>";
            echo '<h3>abgelaufene Events</h3>';echo '<br>';
            echo '<table class="table table-hover table-dark table-bordered text-center">';
            echo '<tr>';
            echo '<th>Startdatum</th>';
            echo '<th>Startuhrzeit</th>';
            echo '<th>Kurzbeschreibung</th>';
            echo '<th>Details anzeigen</th>';
            $result=gethistoricEvents($conn,$sessionnid);
            $amount=mysqli_num_rows($result);
            $counter=1;
            while($counter<=$amount)
            {
                echo '<tr>';
                $row=mysqli_fetch_assoc($result);
                echo '<td>'.$row["startdate"].'</td>';
                echo '<td>'.$row["starttime"].'</td>';
                echo '<td>'.$row["title"].'</td>';
                echo '<td>.<a href="events.php?mode=displaydetails&eid='.$row["eid"].'"> <button class="btn btn-info">Details anzeigen</button></a>.</td>';
                $counter=$counter+1;
                echo '</tr>';
            }
            echo '</tr>';
            echo '</table>';
                    }
            else
                {
                    echo 'Keine Zugriffsberechtigung';
                }
        }
        elseif($mode == "displaydetails")
        {
            $eid=$_GET["eid"];
            require 'include/eventfunctions.inc.php';
            require 'include/dbh.inc.php';
            $sessionnid=$_SESSION['nid']['nid'];
            $isaccess=checkaccess($conn,$sessionnid,$eid);
            if($isaccess==0)
            {
                echo "Kein Zugriff gewährt";
            }
            else
            {
                $eventData=getEventDetails($conn,$eid);
                echo '<div class="form-row">';
                echo '<div class="form-group col-md-3">';
                
                //
                echo '<label for="inputtitle" class="text-dark"><h5>Bezeichnung des Events</h5></label>';
                echo '</div>';
                echo '<div class="form-group col-md-3">';
                echo '<label name="inputtitle" class="" id="inputtitle"><strong>'.$eventData["title"].'</strong></label>';
                echo '</div>';
                echo '</div>';
                
                //
                
                echo '<div class="form-row">';
                echo '<div class="form-group col-md-3">';
                echo '<label for="inputtitle" class="text-dark"><h5>Verantwortliche Person</h5></label>';
                echo '</div>';
                echo '<div class="form-group col-md-3">';
                $creator=getCreatorData($conn,$eventData["creator"]);
                echo '<label name="inputtitle" class="" id="inputtitle">'.$creator["firstname"].' '.$creator["lastname"].' ('.$creator["title"].')'.'</label>';
                echo '</div>';
                echo '</div>';
                
                //
                
                echo '<div class="form-row">';
                echo '<div class="form-group col-md-3">';
                echo '<label for="inputstartdate" class="text-dark"><h5>Beginn des Events</h5></label>';
                echo '</div>';
                
                echo '<div class="form-group col-md-3">';
                echo '<label name="inputstartdate" class="" id="inputstartdate">'. $eventData["startdate"].' ('.$eventData["starttime"].')'.'</label>';
                echo '</div>';
                echo '</div>';

                //
                
                echo '<div class="form-row">';
                echo '<div class="form-group col-md-3">';
                echo '<label for="inputstartdate" class="text-dark"><h5>Ende des Events</h5></label>';
                echo '</div>';
                echo '<div class="form-group col-md-3">';
                echo '<label name="inputstarttime" class="" id="inputstarttimes">'. $eventData["enddate"].'  ('.$eventData["endtime"].')'.'</label>';
                echo '</div>';
                echo '</div>';
                
                //
                
                echo '<div class="form-row">';
                echo '<div class="form-group col-md-3">';
                echo '<label for="inputstartdate" class="text-dark"><h5>Ort der Veranstaltung</h5></label>';
                echo '</div>';
                echo '<div class="form-group col-md-3">';
                echo '<labelname="inputstartdate" class="" id="inputstartdate">'. $eventData["street"].' ('.$eventData["city"].')'.'</label>';
                echo '</div>';
                echo '</div>';
                
                //
                
                echo '<div class="form-row">';
                echo '<div class="form-group col-md-3">';
                echo '<label for="inputstartdate" class="text-dark"><h5>Link zur Veranstaltung</h5></label>';
                echo '</div>';
                echo '<div class="form-group col-md-3">';
                echo '<label name="inputstartdate" class="" id="inputstartdate">'. $eventData["link"].'</label>';
                echo '</div>';
                echo '</div>';
                
                //
                
                echo '<div class="form-row">';
                echo '<div class="form-group col-md-3">';
                echo '<label for="inputdescription" class="text-dark"><h5>Beschreibung des Events</h5></label>';
                echo '</div>';
                echo '<div class="form-group col-md-9">';
                echo '<label class="lead"  name="inputdescription">'.$eventData["description"].'</label>';
                /*
                echo '<textarea cols="90" rows="40" name="inputdescription" readonly>'.$eventData["description"].'</textarea>';*/
                echo '</div>';
                echo '</div>';
                $data=getinvitedGroups($conn,$eid);
                $amount=mysqli_num_rows($data);
                
                //
                
                echo '<br>';
                echo '<h4>Eingeladene Gruppen</h4>';
                echo '<br>';
                echo '<table class="table table-hover table-dark table-bordered text-center">';
                echo '<tr>';
                echo '<th>Studienrichtung</th>';
                echo '<th>Abschlussjahr</th>';
                echo '</tr>';
                echo '<tr>';
                $i = 1;
                while ($i<=$amount)
                {
                    echo '<tr>';
                    $row = mysqli_fetch_assoc($data);
                    echo '<td>'.$row["course"].'</td>';
                    echo '<td>'.$row["gradyear"].'</td>';
                    echo '</tr>';
                    $i = $i + 1;
                }
                echo '</tr>';
                echo '</table>';
                
                //
                
                echo '<div class="form-row">';
                echo '<div class="form-group col-md-6">';
                $exists=statusexists($conn,$eid,$sessionnid);
                if($exists==0)
                {
                    echo '<br>';
                    echo '<h5>Möchten Sie an der Veranstaltung teilnehmen?</h5>';
                    echo '<br>';
                    echo '<td><a href="include/events.inc.php?mode=displaydetailsnew&state=accept&eid='.$eid.'"><button type="button" class="btn btn-success btn-lg">zusagen</button></a></td>';
                    echo '<td><a href="include/events.inc.php?mode=displaydetailsnew&state=decline&eid='.$eid.'"><button type="button" class="btn btn-danger btn-lg">absagen</button></a></td>';
                }
                else
                {
                    $state=getcurrentstate($conn,$eid,$sessionnid);
                    if($state==0)
                    {
                        echo '<br>';
                        echo '<h5>Möchten Sie doch an der Veranstaltung teilnehmen?</h5>';
                        echo '<td><a href="include/events.inc.php?mode=displaydetailschange&state=accept&eid='.$eid.'"><buttontype="button" class="btn btn-success btn-lg">zusagen</button></a></td>';
                    }
                    else
                    {
                        echo '<br>';
                        echo '<h5>Möchten Sie nicht mehr an der Veranstaltung teilnehmen?</h5>';
                        echo '<td><a href="include/events.inc.php?mode=displaydetailschange&state=decline&eid='.$eid.'"><buttontype="button" class="btn btn-danger btn-lg">absagen</button></a></td>';
                    }
                }
                echo '</div>';
                
                echo '<div class="form-group col-md-6">';
                $acceptnumber=getacceptnumber($conn,$eid);
                $declinenumber=getdeclinenumber($conn,$eid);
                echo '<br>';
                echo '<h5>Zusagen: '.$acceptnumber.'</h5>';
                echo '<h5>Absagen: '.$declinenumber.'</h5>';
                
                echo '</div>';
                echo '</div>';
            }
            
            //
            
            
            $iscreator=iscreator($conn,$eid,$sessionnid);
            if($iscreator==1)
            {
                $responses=getResponses($conn,$eid);
                $amount=mysqli_num_rows($responses);
                $counter=1;
                echo '<br>';
                echo '<br>';
                echo '<h4>Teilnehmer</h4>';
                echo '<br>';
                echo '<table  class="table table-hover table-dark table-bordered text-center">';
                echo '<thead>';
                echo '<tr>';
                echo '<th class="th">Seminargruppe</th>';
                echo '<th class="th">Abschlussjahr</th>';
                //echo '<th class="th">Akademischer Titel</th>';
                echo '<th class="th">Vorname</th>';
                echo '<th class="th">Nachname</th>';
                echo '<th class="th">Status</th>';
                echo '</tr>';
                echo '</thead>';
                while ($counter<=$amount)
                {
                    $row = mysqli_fetch_assoc($responses);
                    echo '<td>'.$row["course"].'</td>';
                    echo '<td>'.$row["gradyear"].'</td>';
                    //echo '<td>'.$row["title"].'</td>';
                    echo '<td>'.$row["firstname"].'</td>';
                    echo '<td>'.$row["lastname"].'</td>';
                    if($row["status"]==0)
                    {
                        $status="ist nicht dabei";
                    }
                    else
                    {
                        $status="ist dabei";
                    }
                    echo '<td>'.$status.'</td>';
                    echo '</tr>';
                    $counter=$counter+1;
                }
                echo '</table>';
                
            }
        }
        elseif($mode == "changelist")
        {
            if($status == 3)
            {
                echo "<h4>Event ändern</h4>";
                include 'include/eventfunctions.inc.php';
                echo '<br>';
                echo "<h5>Übersicht der Events</h5>";
                echo '<br>';
                echo '<table  class="table table-hover table-dark table-bordered text-center">';
                echo '<tr>';
                echo '<th>Startdatum</th>';
                echo '<th>Startuhrzeit</th>';
                echo '<th>Kurzbeschreibung</th>';
                echo '<th>Details anzeigen</th>';
                $result=getchangableEvents($conn,$sessionnid);
                $amount=mysqli_num_rows($result);
                $counter=1;
                while($counter<=$amount)
                {
                    echo '<tr>';
                    $row=mysqli_fetch_assoc($result);
                    echo '<td>'.$row["startdate"].'</td>';
                    echo '<td>'.$row["starttime"].'</td>';
                    echo '<td>'.$row["title"].'</td>';
                    echo '<td>.<a href="events.php?mode=changeevent&eid='.$row["eid"].'"> <button class="btn btn-info">Event ändern</button></a>.</td>';
                    $counter=$counter+1;
                    echo '</tr>';
                }
                echo '</tr>';
                echo '</table>';
                echo "<br>";
            }
            else
            {
                echo "Das ändern von Events ist nicht zulässig";
            }
        }
        elseif($mode == "changeevent")
        {
            require 'include/eventfunctions.inc.php';
            $eid=$_GET["eid"];
            $iscreator=iscreator($conn,$eid,$sessionnid);
            if($iscreator==0)
                {
                    echo 'Bearbeitung des Events unzulässig';
                }
            else
                {
                    $groups=getunselectedGroups($conn,$eid);
                    $amount=mysqli_num_rows($groups);
                    echo '<form action="include/events.inc.php?mode=changeevent&eid='.$eid.'&amount='.$amount.'" method="post">';
                    $eventData=getEventDetails($conn,$eid);
                    echo '<div class="form-row">';
                    echo '<div class="form-group col-xl-3">';
                    echo '<label for="inputtitle" class="text-dark">Bezeichnung des Events</label>';
                    echo '</div>';
                    echo '<div class="form-group col-xl-3">';
                    echo '<input type="text" name="inputtitle" class="form-control" id="inputtitle" value="'.$eventData["title"].'">';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="form-row">';
                    echo '<div class="form-group col-xl-3">';
                    echo '<label for="inputperson" class="text-dark">Verantwortliche Person</label>';
                    echo '</div>';
                    echo '<div class="form-group col-xl-3">';
                    $creator=getCreatorData($conn,$eventData["creator"]);
                    echo '<input type="text" name="inputcreator" class="form-control" id="inputtitle" value="'.$creator["title"].' '.$creator["firstname"].' '.$creator["lastname"].'" readonly>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="form-row">';
                    echo '<div class="form-group col-xl-3">';
                    echo '<label for="inputstartdate" class="text-dark">Beginn des Events</label>';
                    echo '</div>';
                    echo '<div class="form-group col-xl-3">';
                    echo '<input type="date" name="inputstartdate" class="form-control" id="inputstartdate" value="'. $eventData["startdate"].'">';
                    echo '</div>';
                    echo '<div class="form-group col-xl-3">';
                    echo '<input type="time" name="inputstarttime" class="form-control" id="inputstarttimes" value="'.$eventData["starttime"].'">';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="form-row">';
                    echo '<div class="form-group col-xl-3">';
                    echo '<label for="inputstartdate" class="text-dark">Ende des Events</label>';
                    echo '</div>';
                    echo '<div class="form-group col-xl-3">';
                    echo '<input type="date" name="inputenddate" class="form-control" id="inputstartdate" value="'. $eventData["enddate"].'">';
                    echo '</div>';
                    echo '<div class="form-group col-xl-3">';
                    echo '<input type="time" name="inputendtime" class="form-control" id="inputstarttimes" value="'.$eventData["endtime"].'">';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="form-row">';
                    echo '<div class="form-group col-xl-3">';
                    echo '<label for="inputstartdate" class="text-dark">Ort der Veranstaltung</label>';
                    echo '</div>';
                    echo '<div class="form-group col-xl-3">';
                    echo '<input type="text" name="inputstreet" class="form-control" id="inputstartdate" value="'. $eventData["street"].'">';
                    echo '</div>';
                    echo '<div class="form-group col-xl-3">';
                    echo '<input type="text" name="inputcity" class="form-control" id="inputstarttimes" value="'.$eventData["city"].'">';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="form-row">';
                    echo '<div class="form-group col-xl-3">';
                    echo '<label for="inputstartdate" class="text-dark">Link zur Veranstaltung</label>';
                    echo '</div>';
                    echo '<div class="form-group col-xl-3">';
                    echo '<input type="text" name="inputlink" class="form-control" id="inputstartdate" value="'. $eventData["link"].'">';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="form-row">';
                    echo '<div class="form-group col-xl-3">';
                    echo '<label for="inputdescription" class="text-dark">Beschreibung des Events</label>';
                    echo '</div>';
                    echo '<div class="form-group col-xl-1">';
                    echo '<textarea name="inputdescription" cols="70" rows="10" ">'.$eventData["description"].'</textarea>';
                    echo '</div>';
                    echo '</div>';
                    echo '<br>';
                    echo '<h4>Bereits eingeladene Gruppen</h4>';
                    echo '<br>';
                    echo '<table  class=" table table-hover table-dark table-bordered text-center">';
                    echo '<thead>';
                    echo '<tr class="">';
                    echo '<th class="th">'.'Studienrichtung'.'</th>';
                    echo '<th class="th">'.'Abschlussjahr'.'</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    $result=getSelectedGroups($conn,$eid);
                    $amount=mysqli_num_rows($result);
                    $i = 1;
                    while ($i<=$amount)
                    {
                        echo '<tr>';
                        $row = mysqli_fetch_assoc($result);
                        echo '<td>'.$row["course"].'</td>';
                        echo '<td>'.$row["gradyear"].'</td>';
                        echo '</tr>';
                        $i = $i + 1;
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '<br>';
                    echo 'Möchten Sie weitere Gruppen einladen?';
                    echo '<br>';
                    
                    echo '<table class="table table-hover table-dark table-bordered text-center">';
                    echo '<thead>';
                    echo '<tr class="">';
                    echo '<th class="th">'.'Personengruppe auswählen'.'</th>';
                    echo '<th class="th">'.'Studienrichtung'.'</th>';
                    echo '<th class="th">'.'Abschlussjahr'.'</th>';
                    echo '</tr>';
                    echo '</thead>';
                    echo '<tbody>';
                    $groups=getunselectedGroups($conn,$eid);
                    $amount=mysqli_num_rows($groups);
                    $i = 1;
                    while ($i<=$amount)
                    {
                        echo '<tr>';
                        $row = mysqli_fetch_assoc($groups);
                        echo '<td><input type="checkbox" name="group'.$i.'" value="'.$row["course"].';'.$row["gradyear"].'" id="check1"></td>';
                        echo '<td>'.$row["course"].'</td>';
                        echo '<td>'.$row["gradyear"].'</td>';
                        echo '</tr>';
                        $i = $i + 1;
                    }
                    echo '</tbody>';
                    echo '</table>';
                    echo '<button type="submit" name= "submit" class="btn btn-primary">Änderungen absenden</button>';
                    echo '</form>';
                }
        }
        else
        {
            echo "Unzulässiger Modus";
        }
    }
    
}
else
{
    echo "Bitte Loggen Sie sich zunächst ein";
}
?>

</div>
<?php
include_once 'footer.php'
?>


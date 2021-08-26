<?php
include_once 'header.php'
?>
<div class="jumbotron seamless gradient-2">
<?php
if(isset($_SESSION['nid']))
{
    $sessionnid=$_SESSION['nid']['nid'];
    require 'include/dbh.inc.php';
    require 'include/session.inc.php';
    $status=getState($sessionnid,$conn);
    if($status==3)
    {
        echo '<p class="text-right">Eingeloggt als: '.getMail($sessionnid,$conn).'</p>';
        echo '<h3>Suche</h3>';
        echo '<table>';
        echo '<tr>';
        echo '<form action="include/searchlog.inc.php" method="post">';
        echo '<div class="form-group col-md-3">';
        echo '<td><label for="searchdate" class="text-dark">Datum</label>';
        echo '<input type="text" name="searchdate" class="form-control" id="searchdate" placeholder="dd.mm.yyyy"></input></td>';
        echo '</div>';
        echo '<div class="form-group col-md-3">';
        echo '<td><label for="searchtime" class="text-dark">Uhrzeit</label>';
        echo '<input type="text" name="searchtime" class="form-control" id="searchtime" placeholder="hh:mm:ss"></input></td>';
        echo '</div>';
        echo '<div class="form-group col-md-3">';
        echo '<td><label for="searchlogtext" class="text-dark">Beschreibung</label>';
        echo '<input type="text" name="searchlogtext" class="form-control" id="searchlogtext" placeholder="Beschreibung"></input></td>';
        echo '</div>';
        echo '<div class="form-group col-md-3">';
        echo '<td><label for="searchchandgedby" class="text-dark">Änderung durch</label>';
        echo '<input type="text" name="searchchangedby" class="form-control" id="searchchangedby" placeholder="Nummer/Name"></input></td>';
        echo '</div>';
        echo '<div class="form-group col-md-3">';
        echo '<td><label for="searchchangedData" class="text-dark">Betroffene Daten</label>';
        echo '<input type="text" name="searchData" class="form-control" id="searchData" placeholder="Nummer/Name"></input></td>';
        echo '</div>';
        echo '<div class="form-group col-md-3">';
        echo '<tr>';
        echo '<td><a href="include/searchlog.inc.php"> <button class="btn btn-primary"> Suchen </button></a></td>';
        echo '</div>';
        echo '</form>';
        echo '<div class="form-group col-md-3">';
        echo '<td><a href="logs.php"> <button class="btn btn-secondary"> Suche zurücksetzen </button></a></td>';
        echo '</div>';
        echo '</tr>';
        echo '</table>';
        if (mysqli_connect_errno())
        {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
        else
        {
            $stmt = mysqli_stmt_init($conn);
            $selektor="";
            if(isset($_GET["parameter"]))
            {
                $selektor=$_GET["parameter"];
            }
            $rumpf="SELECT date, time, logtext, changedby, changedData FROM Logs";
            $orderby="ORDER BY date desc, time desc;";
            if($selektor=="search")
            {
                $date="%".$_GET["parameter2"]."%";
                $time="%".$_GET["parameter3"]."%";
                $text="%".$_GET["parameter4"]."%";
                $changedby="%".$_GET["parameter5"]."%";
                $changedData="%".$_GET["parameter6"]."%";
                $where="WHERE cast(date As varchar(20) ) LIKE ? AND cast(time As varchar(20) ) LIKE ? AND logtext LIKE ? AND changedby LIKE ? AND changedData LIKE ?";
                $abfrage=$rumpf." ".$where." ".$orderby;
                mysqli_stmt_prepare($stmt,$abfrage);
                mysqli_stmt_bind_param($stmt,"sssss",$date,$time,$text,$changedby,$changedData);
            }
            else
            {
                $abfrage=$rumpf." ".$orderby;
                mysqli_stmt_prepare($stmt,$abfrage);
            }
            mysqli_stmt_execute($stmt);
            if ($result = mysqli_stmt_get_result($stmt))
            {
                $count = mysqli_num_rows($result);
                echo '<table width="100%" height="45%" class="table-hover table-dark table-bordered table-responsive"  >';
                echo '<thead>';
                echo '<tr class="">';
                echo '<th class="th">'.'Datum'.'</th>';
                echo '<th class="th">'.'Uhrzeit'.'</th>';
                echo '<th class="th">'.'Beschreibung'.'</th>';
                echo '<th class="th">'.'verändert durch'.'</th>';
                echo '<th class="th">'.'veränderter Datensatz'.'</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                for ($i = 0; $i < $count; $i++)
                {
                    echo '<tr class="">';
                    $row = mysqli_fetch_array($result);
                    for ($j = 0; $j < 5; $j++)
                    {
                                    echo "<td class='td text-center'>{$row[$j]}</td>";
                    }
                    echo '</tr>';
                }
                echo '</tbody>';
                echo '</table>';
                mysqli_free_result($result);
            }
        }
    }
    else
    {
        echo "<h4>Zugriff nur für Administratoren</h4>";
    }
}
else
{
    echo "<h4>Bitte loggen Sie sich ein.</h4>";
}
?>

<?php
include_once 'footer.php'
?>


<?php
include_once '../header.php'
?>
<?php
if(isset($_SESSION['nid']))
{
    require 'session.inc.php';
    if((getState($_SESSION['nid']['nid'],$conn)==2)||(getState($_SESSION['nid']['nid'],$conn)==3))
    {
        $nid=$_GET["parameter"];
        if(getState($_SESSION['nid']['nid'],$conn)==2)
            {
                if((getGradyear($_SESSION['nid']['nid'],$conn))!=(getGradyear($nid,$conn))||(getcourse($_SESSION['nid']['nid'],$conn))!=(getcourse($nid,$conn)))
                    {
                        echo 'Keine Berechtigung zum Verifizieren';
                    }
                else
                    {
                        $vname=$_GET["parameter2"];
                        $nname=$_GET["parameter3"];
                        require 'dbh.inc.php';
                        include 'newlog.php';
                        $sql = "UPDATE Nutzer SET state=2 WHERE nid=?";
                        $stmt = mysqli_stmt_init($conn);
                        mysqli_stmt_prepare($stmt,$sql);
                        mysqli_stmt_bind_param($stmt,"i",$nid);
                        mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);
                        newlog($conn,$_SESSION['nid']['nid'],"Verifikation",$nid);
                        echo '<label class="label" for="Ausgabe"><h4>Der Nutzer wurde erfolgreich verifiziert</h4></label>';
                        echo '<br></br>';
                        if(getState($_SESSION['nid']['nid'],$conn)==2)
                        {
                            echo '<a href="../contactcards.php"><button type="button" class="btn btn-primary">Zurück zur Kontaktseite</button></a>';
                        }
                    }
            }
        else
            {
                $vname=$_GET["parameter2"];
                $nname=$_GET["parameter3"];
                require 'dbh.inc.php';
                include 'newlog.php';
                $sql = "UPDATE Nutzer SET state=2 WHERE nid=?";
                $stmt = mysqli_stmt_init($conn);
                mysqli_stmt_prepare($stmt,$sql);
                mysqli_stmt_bind_param($stmt,"i",$nid);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                newlog($conn,$_SESSION['nid']['nid'],"Verifikation",$nid);
                echo '<label class="label" for="Ausgabe"><h4>Der Nutzer wurde erfolgreich verifiziert</h4></label>';
                echo '<br></br>';
                if(getState($_SESSION['nid']['nid'],$conn)==2)
                {
                    echo '<a href="../contactcards.php"><button type="button" class="btn btn-primary">Zurück zur Kontaktseite</button></a>';
                }
                elseif(getState($_SESSION['nid']['nid'],$conn)==3)
                {
                    echo '<a href="../contacts.php"><button type="button" class="btn btn-primary">Zurück zur Kontaktseite</button></a>';
                }
            }
    }
}
else
{
    echo "<h4>Bitte melden Sie sich zuerst an.</h4>";
}
?>
<?php
include_once '../footer.php'
?>
<?php



?>

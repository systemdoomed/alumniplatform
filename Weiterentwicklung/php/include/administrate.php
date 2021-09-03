<?php
include_once '../header.php'
?>
<?php
    if(isset($_SESSION['nid']))
    {
        require 'session.inc.php';
        if(getState($_SESSION['nid']['nid'],$conn)==3)
            {
    $nid=$_GET["parameter"];
    $vname=$_GET["parameter2"];
    $nname=$_GET["parameter3"];
    require 'dbh.inc.php';
    include 'newlog.php';
    $sql = "UPDATE Nutzer SET state=3 WHERE nid=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$nid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    newlog($conn,$_SESSION['nid']['nid'],"zum Administrator machen",$nid);
    echo '<label class="label" for="Ausgabe">Dem Nutzer wurde erfolgreich die Rolle Administrator zugeweisen</label>';
    echo '<br><br/>';
    echo '<a href="../contacts.php"><button>Zurück zur Kontaktseite</button></a>';
    }
        else
            {
                echo 'Keine Zugriffsberechtigung';
            }
            }
    else
    {
        echo "Bitte melden Sie sich erst an";
    }
?>
<?php
include_once '../footer.php'
?>
<?php



?>

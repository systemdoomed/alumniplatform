<?php
include_once '../header.php'
?>
<?php
    if(isset($_SESSION['nid']))
    {
    $nid=$_GET["parameter"];
    $vname=$_GET["parameter2"];
    $nname=$_GET["parameter3"];
    require 'dbh.inc.php';
    $sql = "DELETE FROM Nutzer WHERE NID=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$nid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    $sql = "DELETE FROM Anmeldung WHERE NID=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$nid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo '<label class="label" for="Ausgabe">Der Nutzer wurde erfolgreich gelöscht</label>';
    echo '<br></br>';
    echo '<a href="../contacts.php"><button>Zurück zur Kontaktseite</button></a>';
        }else
    {
        echo "Bitte melden Sie sich zuerst an";
    }
?>
<?php
include_once '../footer.php'
?>
<?php



?>

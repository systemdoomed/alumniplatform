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
    $sql = "UPDATE Nutzer SET state=2 WHERE nid=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$nid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo '<label class="label" for="Ausgabe"><h4>Der Nutzer wurde erfolgreich verifiziert</h4></label>';
    echo '<br></br>';
    echo '<a href="../contacts.php"><button type="button" class="btn btn-primary">Zurück zur Kontaktseite</button></a>';
    }else{
        echo "<h4>Bitte melden Sie sich zuerst an.</h4>";
    }
    ?>
<?php
include_once '../footer.php'
?>
<?php



?>

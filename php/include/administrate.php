<?php
include_once '../header.php'
?>
<?php
    $nid=$_GET["parameter"];
    $vname=$_GET["parameter2"];
    $nname=$_GET["parameter3"];
    require 'dbh.inc.php';
    $sql = "UPDATE Nutzer SET state=3 WHERE nid=?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt,$sql);
    mysqli_stmt_bind_param($stmt,"i",$nid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    echo '<label class="label" for="Ausgabe">Dem Nutzer wurde erfolgreich die Rolle Administrator zugeweisen</label>';
    echo '<br><br/>';
    echo '<a href="../contacts.php"><button>Zurück zur Kontaktseite</button></a>';
?>
<?php
include_once '../footer.php'
?>
<?php



?>

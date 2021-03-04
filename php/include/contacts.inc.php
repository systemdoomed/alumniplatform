<?php
include_once '../header.php'
?>
<?php
if(isset($_SESSION['nid']))
{
    if(isset($_GET["parameter"]))
    {
        $nid=$_GET["parameter"];
        if(isset($_GET["parameter2"]))
            {
                $selektor=$_GET["parameter2"];
                $vname=$_GET["parameter3"];
                $nname=$_GET["parameter4"];
                if($selektor=="verify")
                    {
                        echo '<label class="label" for="Ausgabe"><h4>Möchten Sie den Nutzer '.$vname.' '.$nname.' wirklich verifizieren?</h4></label>';
                        echo '<br></br>';
                        echo '<a href="verify.php?parameter='.$nid.'&parameter2='.$vname.'&parameter3='.$nname.'"><button type="button" class="btn btn-success">ja</button></a>';
                        echo '<a href="../contacts.php"><button type="button" class="btn btn-secondary">nein </button></a>';
                    }elseif($selektor=="delete"){
                        echo '<label class="label" for="Ausgabe"><h4>Möchten Sie den Nutzer '.$vname.' '.$nname.' wirklich löschen?</h4></label>';
                        echo '<br></br>';
                        echo '<a href="delete.php?parameter='.$nid.'&parameter2='.$vname.'&parameter3='.$nname.'"><buttontype="button" class="btn btn-danger">ja </button></a>';
                        echo '<a href="../contacts.php"><button type="button" class="btn btn-secondary">nein </button></a>';
                    } elseif($selektor=="adminstrieren"){
                        echo '<label class="label" for="Ausgabe"><h4>Möchten Sie den Nutzer '.$vname.' '.$nname.' wirklich zum Adminstrator machen?</h4></label>';
                        echo '<br></br>';
                        echo '<a href="administrate.php?parameter='.$nid.'&parameter2='.$vname.'&parameter3='.$nname.'"><button type="button" class="btn btn-danger">ja </button></a>';
                        echo '<a href="../contacts.php"><button type="button" class="btn btn-secondary">nein </button></a>';
                    }
            }
    }
}
    else
    {
        echo "Bitte loggen Sie sich zuerst ein";
    }
?>
<?php
include_once '../footer.php'
?>
<?php



?>

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
                        echo '<label class="label" for="Ausgabe">Möchten Sie den Nutzer '.$vname.' '.$nname.' wirklich verifizieren?</label>';
                        echo '<br></br>';
                        echo '<a href="verify.php?parameter='.$nid.'&parameter2='.$vname.'&parameter3='.$nname.'"><button>ja</button></a>';
                        echo '<a href="../contacts.php"><button>nein </button></a>';
                    }elseif($selektor=="delete"){
                        echo '<label class="label" for="Ausgabe">Möchten Sie den Nutzer '.$vname.' '.$nname.' wirklich löschen?</label>';
                        echo '<br></br>';
                        echo '<a href="delete.php?parameter='.$nid.'&parameter2='.$vname.'&parameter3='.$nname.'"><button>ja </button></a>';
                        echo '<a href="../contacts.php"><button>nein </button></a>';
                    } elseif($selektor=="adminstrieren"){
                        echo '<label class="label" for="Ausgabe">Möchten Sie den Nutzer '.$vname.' '.$nname.' wirklich zum Adminstrator machen?</label>';
                        echo '<br></br>';
                        echo '<a href="administrate.php?parameter='.$nid.'&parameter2='.$vname.'&parameter3='.$nname.'"><button>ja </button></a>';
                        echo '<a href="../contacts.php"><button>nein </button></a>';
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

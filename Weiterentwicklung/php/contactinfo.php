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

<?php
echo '<ul class="navbar-nav">';
echo "<li class='nav-item'><a class='nav-link' href='contactcards.php'>Zurück zum Kachellayout auswählen</a></li>";
echo '</ul>';
echo '</nav>';
echo '<div class="jumbotron seamless gradient-1">';
echo '<h2 class="text-light">Profil anzeigen</h2>';
echo '<br>';
echo '<form action="include/profile.inc.php" method="post" enctype="multipart/form-data">';
require 'include/dbh.inc.php';
require 'include/profiledata.inc.php';
echo '<div class="form-row">';
require 'include/session.inc.php';
if(isset($_SESSION['nid']['nid']))
{
    if((getState($_SESSION['nid']['nid'],$conn)==0)||(getState($_SESSION['nid']['nid'],$conn)==1))
    {
        header("location: index.php");
        exit();
    }
    else
        {
            if(getState($_SESSION['nid']['nid'],$conn)==2)
                {
                    if((getCourse($_SESSION['nid']['nid'],$conn)!=getCourse($_GET["nid"],$conn))||getGradyear($_SESSION['nid']['nid'],$conn)!=getGradyear($_GET["nid"],$conn))
                        {
                            header("location: index.php");
                            exit();
                        }
                }
        }
}
else
{
    header("location: index.php");
    exit();
}
$nid=$_GET["nid"];
$data = getprofiledata($nid,$conn);
$title=$data["title"];
$gender=$data["gender"];
echo '<div class="form-group col-xl-2">';
echo '<label for="inputmatrikel" class="text-light">Matrikelnummer</label>';
echo '<input type="text" name="inputmatrikel" class="form-control" id="inputmatrikel" value="'.$data["matrikel"].'" readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputgender" class="text-light">Geschlecht</label>';
echo '<input type="text" name="inputgender" class="form-control" id="inputgender" value="'.$data["gender"].'" readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputtitle" class="text-light">Akademischer Titel</label>';
echo '<input type="text" name="inputtitle" class="form-control" id="inputgender" value="'.$data["title"].'" readonly>';
echo '</div>';
echo '</div>';
echo '<div class="form-row">';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputfirstname" class="text-light">Vorname</label>';
echo '<input type="text" name="inputfirstname" class="form-control" id="inputfirstname" value="'.$data["firstname"].'"readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputlastname" class="text-light">Nachname</label>';
echo '<input type="text" name="inputlastname" class="form-control" id="inputlastname" value="'.$data["lastname"].'"readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputbirthname" class="text-light">Geburtsname</label>';
echo '<input type="text" name="inputbirthname" class="form-control" id="inputbirthname" value="'.$data["birthname"].'"readonly>';
echo '</div>';
echo '</div>';
echo '<div class="form-row">';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputmail" class="text-light">Mail-Adresse</label>';
echo '<input type="email" name="inputmail" class="form-control" id="inputmail" value="'.$data["mail"].'"readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputcompany" class="text-light">Aktuelle Firma</label>';
echo '<input type="text" name="inputcompany" class="form-control" id="inputcompany" value="'.$data["company"].'" readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputposition" class="text-light">Position</label>';
echo '<input type="text" name="inputposition" class="form-control" id="inputposition" value="'.$data["position"].'" readonly>';
echo '</div>';
echo '</div>';
echo '<div class="form-row">';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputphone" class="text-light">Telefonnummer</label>';
echo '<input type="tel" name="inputphone" class="form-control" id="inputphone" value="'.$data["phone"].'" readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputaddress" class="text-light">Strasse und Hausnummer</label>';
echo '<input type="text" name="inputaddress" class="form-control" id="inputaddress" value="'.$data["address"].'" readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputcity" class="text-light">Postleitzahl & Stadt</label>';
echo '<input type="text" name="inputcity" class="form-control" id="inputcity" value="'.$data["city"].'" readonly>';
echo '</div>';
echo '</div>';
echo '<div class="form-row">';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputschool" class="text-light">Hochschule</label>';
echo '<input type="text" name="inputschool" class="form-control" id="inputschool" value="'.$data["school"].'" readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputcourse" class="text-light">Studienrichtung</label>';
echo '<input type="text" name="inputcourse" class="form-control" id="inputcourse" value="'.$data["course"].'" readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputgradyear" class="text-light">Abschlussjahr</label>';
echo '<input type="text" name="inputgradyear" class="form-control" id="inputgradyear" value="'.$data["gradyear"].'" readonly>';
echo '</div>';
echo '</div>';
echo '<div class="form-row">';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputtwitter" class="text-light">Twitter</label>';
echo '<input type="text" name="inputtwitter" class="form-control" id="inputtwitter" value="'.$data["twitter"].'" readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputinsta" class="text-light">Instagram</label>';
echo '<input type="text" name="inputinsta" class="form-control" id="inputinsta" value="'.$data["instagram"].'" readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputfacebook" class="text-light">Facebook</label>';
echo '<input type="text" name="inputfacebook" class="form-control" id="inputfacebook" value="'.$data["facebook"].'" readonly>';
echo '</div>';
echo '</div>';
echo '<div class="form-row">';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputxing" class="text-light">Xing</label>';
echo '<input type="text" name="inputxing" class="form-control" id="inputxing" value="'.$data["xing"].'" readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputlinkedin" class="text-light">LinkedIn</label>';
echo '<input type="text" name="inputlinkedin" class="form-control" id="inputlinkedin" value="'.$data["linkedin"].'" readonly>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputother" class="text-light">Sonstiges</label>';
echo '<input type="text" name="inputother" class="form-control" id="inputother" value="'.$data["others"].'" readonly>';
echo '</div>';
echo '</div>';
?>

<?php
include_once 'footer.php'
?>

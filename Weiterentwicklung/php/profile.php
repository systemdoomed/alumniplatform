<?php
include_once 'header.php'
?>
<div class=" jumbotron jumbotron-image seamless gradient-1">
<?php

if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput") {
        echo '<p class="bg-dark text-center text-light">Sie haben eines der benötigten Felder nicht ausgefüllt!</p>';
    }
    else if ($_GET["error"] == "nopwdmatch") {
        echo '<p class="bg-dark text-center text-light">Bitte tragen sie das gleiche Passwort zweimal ein!</p>';
    }
    else if ($_GET["error"] == "stmtfailed") {
        echo '<p class="bg-dark text-center text-light">Es ist ein interner Fehler bei der Verarbeitung der Daten aufgetreten, bitte probieren sie es erneut.</p>';
    }
    else if ($_GET["error"] == "nochoice") {
        echo '<p class="bg-dark text-center text-light">Sie haben bei einem oder mehr der Auswahlfelder keine Auswahl getroffen!</p>';
    }
    else if ($_GET["error"] == "none") {
        echo '<p class="bg-dark text-center text-light">Sie haben erfolgreich ihr Profil aktualisiert!</p>';
    }
}



echo '<h2 class="text-light">Profil bearbeiten</h2>';
echo '<br>';
echo '<form action="include/profile.inc.php" method="post">';
require 'include/dbh.inc.php';
require 'include/profiledata.inc.php';
echo '<div class="form-row">';
$sessionnid = $_SESSION['nid']['nid'];
$data = getprofiledata($sessionnid,$conn);
$title=$data["title"];
$gender=$data["gender"];
echo '<div class="form-group col-xl-1">';
echo '<label for="inputmatrikel" class="text-light">Matrikelnummer</label>';
echo '<input type="text" name="inputmatrikel" class="form-control" id="inputmatrikel" placeholder="Matrikelnummer" value="'.$data["matrikel"].'">';
echo '</div>';
echo '<div class="form-group col-xl-1">';
echo '<label for="inputgender" class="text-light">Geschlecht</label>';
echo '<select id="inputgender" name="inputgender" class="form-control">';
if($gender=="Auswählen..." || $gender=="")
{
    echo'<option selected>Auswählen...</option>';
}
else
{
    if(isset($_GET["gender"])){
        echo'<option >Auswählen...</option>';
    }
    else{
        echo'<option selected >Auswählen...</option>';
    }
    
}
if($gender=='m')
{
    echo'<option selected>m</option>';
}
else
{
    echo'<option>m</option>';
}
if($gender=='w')
{
    echo'<option selected>w</option>';
}
else
{
    echo'<option>w</option>';
}
if($gender=='d')
{
    echo'<option selected>d</option>';
}
else
{
    echo'<option>d</option>';
}
echo '</select>';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputtitle" class="text-light">Akademischer Titel</label>';
echo '<select id="inputtitle" name="inputtitle" class="form-control">';
if($title=="Auswählen..." || $title=="")
{
    echo'<option selected>Auswählen...</option>';
}
else
{
    if(isset($_GET["title"])){
        echo'<option >Auswählen...</option>';
    }
    else{
        echo'<option selected >Auswählen...</option>';
    }
    
}
if($title=="Bachelor")
{
    echo'<option selected>Bachelor</option>';
}
else
{
    echo'<option>Bachelor</option>';
}
if($title=="Master")
{
    echo'<option selected>Master</option>';
}
else
{
    echo'<option>Master</option>';
}
if($title=="Diplom")
{
    echo'<option selected>Diplom</option>';
}
else
{
    echo'<option>Diplom</option>';
}
if($title=="Doktor")
{
    echo'<option selected>Doktor</option>';
}
else
{
    echo'<option>Doktor</option>';
}
if($title=="Professor")
{
    echo'<option selected>Professor</option>';
}
else
{
    echo'<option>Professor</option>';
}
echo '</select>';
echo '</div>';
echo '</div>';
echo '<div class="form-row">';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputfirstname" class="text-light">Vorname</label>';
echo '<input type="text" name="inputfirstname" class="form-control" id="inputfirstname" placeholder="Vorname" value="'.$data["firstname"].'">';
echo '</div>';

echo '<div class="form-group col-xl-2">';
echo '<label for="inputlastname" class="text-light">Nachname</label>';
echo '<input type="text" name="inputlastname" class="form-control" id="inputlastname" placeholder="Nachname" value="'.$data["lastname"].'">';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputmatrikel" class="text-light">Geburtsname</label>';
echo '<input type="text" name="birthname" class="form-control" id="inputbirthname" placeholder="Geburtsname" value="'.$data["birthname"].'">';
echo '</div>';
echo '</div>';
echo '<div class="form-row">';
echo '<div class="form-group col-xl-1">';
echo '<label for="inputmail" class="text-light">Mail-Adresse</label>';
echo '<input type="email" name="inputmail" class="form-control" id="inputmail" placeholder="Email" value="'.$data["mail"].'">';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputpwd1"class="text-light">Passwort*</label>';
echo '<input type="password" name="inputpwd1" class="form-control" id="inputpwd1" placeholder="Passwort">';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputpwd2"class="text-light">Passwort wiederholen*</label>';
echo '<input type="password" name="inputpwd2" class="form-control" id="inputpwd2" placeholder="Passwort">';
echo '</div>';
echo '</div>';
echo '<div class="form-row">';
echo '<div class="form-group col-xl-1">';
echo '<label for="inputphone">Telefonnummer</label>';
echo '<input type="tel" name="inputphone" class="form-control" id="inputphone" placeholder="Telefonnummer" value="'.$data["phone"].'">';
echo '</div>';
echo '<div class="form-group col-xl-2">';
echo '<label for="inputaddress">Strasse und Hausnummer</label>';
echo '<input type="text" name="inputaddress" class="form-control" id="inputaddress" placeholder="z.B. Schönauer Straße 113a" value="'.$data["address"].'">';
?>




</div>
<div class="form-group col-xl-2">
<label for="inputcity">Postleitzahl & Stadt</label>
<input type="text" name="inputcity" class="form-control" id="inputcity" placeholder="z.B. 04316 Leipzig">
</div>
<div class="form-group col-xl-2">
<label for="inputcompany">Aktuelle Firma</label>
<input type="text" name="inputcompany" class="form-control" id="inputcompany" placeholder="Firmenname">
</div>
<div class="form-group col-xl-1">
<label for="inputposition">Position</label>
<input type="text" name="inputposition" class="form-control" id="inputposition" placeholder="Position">
</div>

</div>
<br>
<div class="form-row">
<div class="form-group col-xl-1">
<label for="inputtwitter">Twitter</label>
<input type="text" name="inputtwitter" class="form-control" id="inputtwitter" placeholder="Nutzername">
</div>
<div class="form-group col-xl-1">
<label for="inputinsta">Instagram</label>
<input type="text" name="inputinsta" class="form-control" id="inputinsta" placeholder="Nutzername">
</div>
<div class="form-group col-xl-2">
<label for="inputfacebook">Facebook</label>
<input type="text" name="inputfacebook" class="form-control" id="inputfacebook" placeholder="Facebook-Profil (URL)">
</div>
<div class="form-group col-xl-2">
<label for="inputxing">Xing</label>
<input type="text" name="inputxing" class="form-control" id="inputxing" placeholder="Xing-Profil (URL)">
</div>
<div class="form-group col-xl-2">
<label for="inputlinkedin">LinkedIn</label>
<input type="text" name="inputlinkedin" class="form-control" id="inputlinkedin" placeholder="LinkedIn-Profil (URL)">
</div>
<div class="form-group col-xl-2">
<label for="inputother">Sonstiges</label>
<input type="text" name="inputother" class="form-control" id="inputother" placeholder="Sonstiges (URL)">
</div>
</div>
<br>
<div class="form-row">
<div class="form-group col-xl-6">
<input type="checkbox" id="isSupportingMember" name="inputisSupportingMember" value="valueisSupportingMember">
<label for="inputisSupportingMember">Interesse an Mitgliedschaft im Förderverein der Staatlichen Studienakademie Leipzig e.V.</label>

</div>
</div>
<div class="form-row">
<div class="form-group col-xl-6">
<input type="checkbox" id="isSendMail" name="inputisSendMail" value="valueisSendMail">
<label for="inputisSendMail">Die Berufsakademie darf mich über meine Mail-Adresse kontaktieren.</label>
</div>
</div>


<button type="submit" name= "submit"class="btn btn-primary">Profilinfo aktualisieren</button>
</form>

</div>


<?php
include_once 'footer.php'
?>

<?php
include_once 'header.php';
?>

<div class=" jumbotron jumbotron-image seamless gradient-1">
<?php
if (isset($_GET["error"]))
{
    if ($_GET["error"] == "emptyinput")
    {
        echo '<p class="bg-dark text-center text-light">Sie haben eines der benötigten Felder nicht ausgefüllt!</p>';
    }
    else if ($_GET["error"] == "invalidemail")
    {
        echo '<p class="bg-dark text-center text-light">Bitte wählen sie eine gültige Mail-Adresse!</p>';
    }
    else if ($_GET["error"] == "usedemail")
    {
        echo '<p class="bg-dark text-center text-light">Die eingegebene Mail-Adresse ist bereits vergeben!</p>';
    }
    else if ($_GET["error"] == "nopwdmatch")
    {
        echo '<p class="bg-dark text-center text-light">Bitte tragen sie das gleiche Passwort zweimal ein!</p>';
    }
    else if ($_GET["error"] == "userexists")
    {
        echo '<p class="bg-dark text-center text-light">Es ist bereits ein Nutzer mit diesen Nutzerdaten in der Datenbank verzeichnet! Bitte nutzen sie unsere Login-Oberfläche.</p>';
    }
    else if ($_GET["error"] == "stmtfailed")
    {
        echo '<p class="bg-dark text-center text-light">Es ist ein interner Fehler bei der Verarbeitung der Daten aufgetreten, bitte probieren sie es erneut.</p>';
    }
    else if ($_GET["error"] == "nochoice")
    {
        echo '<p class="bg-dark text-center text-light">Sie haben bei einem oder mehr der Auswahlfelder keine Auswahl getroffen!</p>';
    }
    else if ($_GET["error"] == "noDataPrivacy")
    {
        echo '<p class="bg-dark text-center text-light">Sie haben die Datenschutzerklärung noch nicht akzeptiert</p>';
    }
    else if ($_GET["error"] == "none")
    {
        echo '<p class="bg-dark text-center text-light">Sie haben sich erfolgreich registriert!</p>';
    }
}
?>
<h2 class="text-light">Registrieren</h2>
<br>
<p class="text-light">Alle notwendigen Felder sind mit einem Sternchen (*) gekennzeichnet.</p>
<form action="include/signup.inc.php" method="post">
<div class="form-row">
<div class="form-group col-xl-2">
<label for="inputtitle" class="text-light">Akademischer Titel
</label>
<select id="inputtitle" name="inputtitle" class="form-control">
<?php
$title=$_GET["title"];
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
?>
</select>
</div>
<div class="form-group col-xl-2">
<label for="inputfirstname" class="text-light">Vorname*</label>
<?PHP
if(isset($_GET["vorname"])){
    echo'<input type="text" name="inputfirstname" class="form-control" id="inputfirstname" placeholder="Vorname" value="'.$_GET["vorname"].'">';
}
else
{
    echo'<input type="text" name="inputfirstname" class="form-control" id="inputfirstname" placeholder="Vorname">';
}
?>

</div>
<div class="form-group col-xl-2">
<label for="inputlastname" class="text-light">Nachname*</label>
<?PHP
if(isset($_GET["nachname"])){
    echo'<input type="text" name="inputlastname" class="form-control" id="inputlastname" placeholder="Nachname" value="'.$_GET["nachname"].'">';
}
else
{
    echo'<input type="text" name="inputlastname" class="form-control" id="inputlastname" placeholder="Nachname">';
}
?>
</div>
<div class="form-group col-xl-2">
<label for="birthname" class="text-light">Geburtsname</label>
<?PHP
if(isset($_GET["geburtsname"])){
    echo'<input type="text" name="inputbirthname" class="form-control" id="inputbirthname" placeholder="Geburtsname" value="'.$_GET["geburtsname"].'">';
}
else
{
    echo'<input type="text" name="inputbirthname" class="form-control" id="inputbirthname" placeholder="Geburtsname">';
}
?>

</div>
</div>
<div class="form-row">
<div class="form-group col-xl-2">
<label for="inputmail" class="text-light">Mail-Adresse*</label>
<?PHP
if(isset($_GET["mail"])){
    echo'<input type="email" name="inputmail" class="form-control" id="inputmail" placeholder="Mail-Adresse" value="'.$_GET["mail"].'">';
}
else
{
    echo'<input type="email" name="inputmail" class="form-control" id="inputmail" placeholder="Mail-Adresse">';
}
?>

</div>
<div class="form-group col-xl-2">
<label for="inputcourse"class="text-light">Studienrichtung*</label>
<select id="inputcourse" name="inputcourse" class="form-control">




<?php
$course=$_GET["course"];
if($course=="Auswählen..." || $title=="")
{
    echo'<option selected>Auswählen...</option>';
}
else
{
    if(isset($_GET["course"])){
        echo'<option >Auswählen...</option>';
    }
    else{
        echo'<option selected >Auswählen...</option>';
    }
    
}
if($course=="BA")
{
    echo'<option selected>BA</option>';
}
else
{
    echo'<option>BA</option>';
}
if($course=="BW")
{
    echo'<option selected>BW</option>';
}
else
{
    echo'<option>BW</option>';
}
if($course=="CN")
{
    echo'<option selected>CN</option>';
}
else
{
    echo'<option>CN</option>';
}
if($course=="CS")
{
    echo'<option selected>CS</option>';
}
else
{
    echo'<option>CS</option>';
}
if($course=="FV")
{
    echo'<option selected>FV</option>';
}
else
{
    echo'<option>FV</option>';
}
if($course=="IS")
{
    echo'<option selected>IS</option>';
}
else
{
    echo'<option>IS</option>';
}
if($course=="IT")
{
    echo'<option selected>IT</option>';
}
else
{
    echo'<option>IT</option>';
}
if($course=="IW")
{
    echo'<option selected>IW</option>';
}
else
{
    echo'<option>IW</option>';
}
if($course=="SE")
{
    echo'<option selected>SE</option>';
}
else
{
    echo'<option>SE</option>';
}
if($course=="SP")
{
    echo'<option selected>SP</option>';
}
else
{
    echo'<option>SP</option>';
}
if($course=="SW")
{
    echo'<option selected>SW</option>';
}
else
{
    echo'<option>SW</option>';
}
if($course=="TM")
{
    echo'<option selected>TM</option>';
}
else
{
    echo'<option>TM</option>';
}
?>
</select>
</div>
<div class="form-group col-xl-2">
<label for="inputgender" class="text-light">Geschlecht*</label>
<select id="inputgender" name="inputgender" class="form-control">

<?php
$gender=$_GET["gender"];
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
?>

</select>

</div>
<div class="form-group col-xl-2">
<label for="inputschool"class="text-light">Hochschule*</label>
<select id="inputschool" name="inputschool" class="form-control">
<?php
$school=$_GET["school"];
if($school=="Auswählen..." || $school=="")
{
    echo'<option selected>Auswählen...</option>';
}
else
{
    if(isset($_GET["school"])){
        echo'<option >Auswählen...</option>';
    }
    else{
        echo'<option selected >Auswählen...</option>';
    }
    
}
if($school=='BA Leipzig')
{
    echo'<option selected>BA Leipzig</option>';
}
else
{
    echo'<option>BA Leipzig</option>';
}
?>
</select>
</div>
</div>
<div class="form-row">
<div class="form-group col-xl-2">
<label for="inputgradyear"class="text-light">Abschlussjahr*</label>
<?PHP
if(isset($_GET["jahr"])){
    echo'<input type="text" name="inputgradyear" class="form-control" id="inputgradyear" placeholder="Abschlussjahr" value="'.$_GET["jahr"].'">';
}
else
{
    echo'<input type="text" name="inputgradyear" class="form-control" id="inputgradyear" placeholder="Abschlussjahr">';
}
?>
</div>
<div class="form-group col-xl-2">
<label for="inputpwd1"class="text-light">Passwort*</label>
<input type="password" name="inputpwd1" class="form-control" id="inputpwd1" placeholder="Passwort">
</div>
<div class="form-group col-xl-2">
<label for="inputpwd2"class="text-light">Passwort wiederholen*</label>
<input type="password" name="inputpwd2" class="form-control" id="inputpwd2" placeholder="Passwort">
</div>
</div>
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
<div class="form-row">
<div class="form-group col-xl-6">
<input type="checkbox" id="acceptConditions" name="acceptConditions" value="acceptConditions">
<label for="acceptConditions">Ich akzeptiere die <a href="https://www.ba-leipzig.de/datenschutzerklaerung"> Datenschutzerklärung </a>der Staatlichen Studienakademie Leipzig</label>
</div>
</div>
<div class="form-row">
<div class="form-group col-xl-6">
<input type="checkbox" id="isExternalLinks" name="inputisExternalLinks" value="valueisExternalLinks">
<label for="inputisExternalLinks">Die Berufsakademie darf mich über meine angegebenen Kanäle kontaktieren.</label>
</div>
</div>
<button type="submit" name= "submit"class="btn btn-primary">Registrieren</button>
</form>



</div>





<?php
include_once 'footer.php'
?>
<?php
/*
 
 <img class="card-img-top" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MjB8fHByb2ZpbGV8ZW58MHx8MHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60" alt="Profil">
 
 <a class="navbar-brand" href="#"><img class="img-fluid" src="img/logo_ba1.png" alt="Alumni-BA"></a>
 
 <img src="img/stock_people.jpg" class="rounded" alt="Studenten">
 */
?>

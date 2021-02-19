<?php
include_once 'header.php';
?>

<div class=" jumbotron jumbotron-image seamless gradient-1">
	<?php

	if (isset($_GET["error"])) {
		if ($_GET["error"] == "emptyinput") {
			echo '<p class="bg-dark text-center text-light">Sie haben eines der benötigten Felder nicht ausgefüllt!</p>';
		}
		else if ($_GET["error"] == "invalidemail") {
			echo '<p class="bg-dark text-center text-light">Bitte wählen sie eine gültige Mail-Adresse!</p>';
		}
		else if ($_GET["error"] == "nopwdmatch") {
			echo '<p class="bg-dark text-center text-light">Bitte tragen sie das gleiche Passwort zweimal ein!</p>';
		}
		else if ($_GET["error"] == "userexists") {
			echo '<p class="bg-dark text-center text-light">Es ist bereits ein Nutzer mit diesen Nutzerdaten in der Datenbank verzeichnet! Bitte nutzen sie unsere Login-Oberfläche.</p>';
		}
		else if ($_GET["error"] == "stmtfailed") {
			echo '<p class="bg-dark text-center text-light">Es ist ein interner Fehler bei der Verarbeitung der Daten aufgetreten, bitte probieren sie es erneut.</p>';
		}
		else if ($_GET["error"] == "nochoice") {
			echo '<p class="bg-dark text-center text-light">Sie haben bei einem oder mehr der Auswahlfelder keine Auswahl getroffen!</p>';
		}
		else if ($_GET["error"] == "none") {
			echo '<p class="bg-dark text-center text-light">Sie haben sich erfolgreich registriert!</p>';
		}
	}

	?>t
	<h2 class="text-light">Registrieren</h2>
	
	<form action="include/signup.inc.php" method="post">
		<div class="form-row">
			    <div class="form-group col-md-3">
			      <label for="inputfirstname" class="text-light">Vorname</label>
			      <input type="text" name="inputfirstname" class="form-control" id="inputfirstname" placeholder="Vorname">
			    </div>
			    <div class="form-group col-md-3">
			      <label for="inputlastname" class="text-light">Nachname</label>
			      <input type="text" name="inputlastname" class="form-control" id="inputlastname" placeholder="Nachname">
			    </div>
			</div>
			<div class="form-row">
			    <div class="form-group col-md-3">
			      <label for="inputmail" class="text-light">Mail-Adresse</label>
			      <input type="email" name="inputmail" class="form-control" id="inputmail" placeholder="Mail-Adresse">
			    </div>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="inputisSendMail" class="text-light">Die Berufsakademie darf mich über meine Mail-Adresse kontaktieren.</label>
			      <input type="checkbox" id="isSendMail" name="inputisSendMail" value="valueisSendMail">			      
			    </div>
			</div>
			  <div class="form-row">
			    <div class="form-group col-md-3">
			      <label for="inputpwd1"class="text-light">Passwort</label>
			      <input type="password" name="inputpwd1" class="form-control" id="inputpwd1" placeholder="Passwort">
			    </div>
			    <div class="form-group col-md-3">
			      <label for="inputpwd2"class="text-light">Passwort wiederholen</label>
			      <input type="password" name="inputpwd2" class="form-control" id="inputpwd2" placeholder="Passwort">
			    </div>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-3">
			      <label for="inputmatrikel"class="text-light">Matrikelnummer</label>
			      <input type="text" name="inputmatrikel" class="form-control" id="inputmatrikel" placeholder="ehemalige Matrikelnummer">
			    </div>
			    <div class="form-group col-md-3">
			      <label for="inputcourse"class="text-light">Studienrichtung</label>
			      <select id="inputcourse" name="inputcourse" class="form-control">
			        <option selected>Auswählen...</option>
			        <option>BW</option>
			        <option>CN</option>
			        <option>CS</option>
			        <option>IT</option>
			        <option>IW</option>
			        <option>SE</option>
			        <option>SP</option>
			        <option>SW</option>
			        <option>TM</option>
			      </select>
			    </div>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-3">
			      <label for="inputgradyear"class="text-light">Abschlussjahr</label>
			      <input type="text" name="inputgradyear" class="form-control" id="inputgradyear" placeholder="Abschlussjahr">
			    </div>
			    <div class="form-group col-md-3">
			      <label for="inputschool"class="text-light">Hochschule</label>
			      <select id="inputschool" name="inputschool" class="form-control">
			        <option selected>Auswählen...</option>
			        <option>BA Leipzig</option>
			      </select>
			    </div>
			  </div>
			  <div class="form-row">
				  <div class="form-group col-md-3">
				    <label for="inputphone">Telefonnummer</label>
				    <input type="tel" name="inputphone" class="form-control" id="inputphone" placeholder="Telefonnummer">
				  </div>
				  <div class="form-group col-md-3">
			      <label for="inputgender">Geschlecht</label>
			      <select id="inputgender" name="inputgender" class="form-control">
			        <option selected>Auswählen...</option>
			        <option>m</option>
			        <option>w</option>
			        <option>d</option>
			      </select>
			    </div>
			  </div>
			  <div class="form-row">
				  <div class="form-group col-md-3">
				    <label for="inputaddress">Strasse</label>
				    <input type="text" name="inputaddress" class="form-control" id="inputaddress" placeholder="z.B. Schönauer Straße 113a">
				  </div>
					<div class="form-group col-md-3">
				    <label for="inputcity">Stadt</label>
				    <input type="text" name="inputcity" class="form-control" id="inputcity" placeholder="z.B. Leipzig">
			      </div>
			  </div>
			  <div class="form-row">
				  <div class="form-group col-md-3">
				    <label for="inputcompany">Aktuelle Firma</label>
				    <input type="text" name="inputcompany" class="form-control" id="inputcompany" placeholder="Firmenname">
				  </div>
					<div class="form-group col-md-3">
				    <label for="inputposition">Position</label>
				    <input type="text" name="inputposition" class="form-control" id="inputposition" placeholder="Position">
			      </div>
			  </div>
			  <div class="form-row">
				  <div class="form-group col-md-3">
			      <label for="inputtitle">Akademischer Titel</label>
			      <select id="inputtitle" name="inputtitle" class="form-control">
			        <option selected>Auswählen...</option>
			        <option>Bachelor</option>
			        <option>Master</option>
			        <option>Diplom</option>
			        <option>Doktor</option>
			        <option>Professor</option>
			      </select>
			    </div>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-2">
			      <label for="inputtwitter">Twitter</label>
			      <input type="text" name="inputtwitter" class="form-control" id="inputtwitter" placeholder="Twitter-Nutzername">
			    </div>
			    <div class="form-group col-md-2">
			      <label for="inputinsta">Instagram</label>
			      <input type="text" name="inputinsta" class="form-control" id="inputinsta" placeholder="Instagram-Nutzername">
			    </div>
			    <div class="form-group col-md-2">
			      <label for="inputfacebook">Facebook</label>
			      <input type="text" name="inputfacebook" class="form-control" id="inputfacebook" placeholder="Facebook-Profil">
			    </div>			    
			</div>
			<div class="form-row">
			    <div class="form-group col-md-2">
			      <label for="inputxing">Xing</label>
			      <input type="text" name="inputxing" class="form-control" id="inputxing" placeholder="Xing-Profil">
			    </div>
			    <div class="form-group col-md-2">
			      <label for="inputlinkedin">LinkedIn</label>
			      <input type="text" name="inputlinkedin" class="form-control" id="inputlinkedin" placeholder="LinkedIn-Profil">
			    </div>
			    
			</div>
			<div class="form-row">
			    <div class="form-group col-md-6">
			    	<label for="inputisSupportingMember">Interesse an Mitgliedschaft im Förderverein der Staatlichen Studienakademie Leipzig e.V.</label>
			      <input type="checkbox" id="isSupportingMember" name="inputisSupportingMember" value="valueisSupportingMember">
			      
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
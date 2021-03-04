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

	?>
	<h2 class="text-light">Profil bearbeiten</h2>
	<br>
	<form action="include/profile.inc.php" method="post">
		<div class="form-row">
			    <div class="form-group col-xl-2">
			      <label for="inputfirstname" class="text-light">Vorname</label>
			      <input type="text" name="inputfirstname" class="form-control" id="inputfirstname" placeholder="Vorname">
			    </div>
			    <div class="form-group col-xl-2">
			      <label for="inputlastname" class="text-light">Nachname</label>
			      <input type="text" name="inputlastname" class="form-control" id="inputlastname" placeholder="Nachname">
			    </div>
			   
			    <div class="form-group col-xl-1">
			      <label for="inputgender" class="text-light">Geschlecht</label>
			      <select id="inputgender" name="inputgender" class="form-control">
			        <option selected>Auswählen...</option>
			        <option>m</option>
			        <option>w</option>
			        <option>d</option>
			      </select>
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

			  <br>
			  <div class="form-row">
			    <div class="form-group col-xl-1">
			      <label for="inputmatrikel">Matrikelnummer</label>
			      <input type="text" name="inputmatrikel" class="form-control" id="inputmatrikel" placeholder="Matrikelnummer">
			    </div>
			    <div class="form-group col-xl-1">
				    <label for="inputphone">Telefonnummer</label>
				    <input type="tel" name="inputphone" class="form-control" id="inputphone" placeholder="Telefonnummer">
				  </div>
				<div class="form-group col-xl-2">
				    <label for="inputaddress">Strasse und Hausnummer</label>
				    <input type="text" name="inputaddress" class="form-control" id="inputaddress" placeholder="z.B. Schönauer Straße 113a">
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
			      	<div class="form-group col-xl-1">
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
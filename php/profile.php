<?php
include_once 'header_alt.php'
?>

<div class=" jumbotron jumbotron-image seamless gradient-1">
	<h2 class="text-light">Profil bearbeiten</h2>
	<form action="include/signup.inc.php" method="post">
		<div class="form-row">
			    <div class="form-group col-md-3">
			      <label for="inputname1" class="text-light">Vorname</label>
			      <input type="text" class="form-control" id="inputfirstname" placeholder="Vorname">
			    </div>
			    <div class="form-group col-md-3">
			      <label for="inputname2" class="text-light">Nachname</label>
			      <input type="text" class="form-control" id="inputlastname" placeholder="Nachname">
			    </div>
			</div>
			<div class="form-row">
			    <div class="form-group col-md-3">
			      <label for="inputmail" class="text-light">Mail-Adresse</label>
			      <input type="email" class="form-control" id="inputmail" placeholder="Mail-Adresse">
			    </div>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-3">
			      <label for="inputpwd1"class="text-light">Passwort</label>
			      <input type="password" class="form-control" id="inputpwd1" placeholder="Passwort">
			    </div>
			    <div class="form-group col-md-3">
			      <label for="inputpwd2"class="text-light">Passwort wiederholen</label>
			      <input type="password" class="form-control" id="inputpwd2" placeholder="Passwort">
			    </div>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-3">
			      <label for="inputmatrikel"class="text-light">Matrikelnummer</label>
			      <input type="text" class="form-control" id="inputmatrikel" placeholder="ehemalige Matrikelnummer">
			    </div>
			    <div class="form-group col-md-3">
			      <label for="inputsemgroup"class="text-light">Seminargruppe</label>
			      <select id="inputsemgroup" class="form-control">
			        <option selected>Auswählen...</option>
			        <option>CS18-2</option>
			      </select>
			    </div>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-3">
			      <label for="inputgradyear"class="text-light">Abschlussjahr</label>
			      <input type="text" class="form-control" id="inputgradyear" placeholder="Abschlussjahr">
			    </div>
			    <div class="form-group col-md-3">
			      <label for="inputschool"class="text-light">Hochschule</label>
			      <select id="inputschool" class="form-control">
			        <option selected>Auswählen...</option>
			        <option>BA Leipzig</option>
			      </select>
			    </div>
			  </div>
			  <div class="form-row">
				  <div class="form-group col-md-3">
				    <label for="inputphone">Telefonnummer</label>
				    <input type="text" class="form-control" id="inputphone" placeholder="Telefonnummer">
				  </div>
			  </div>
			  <div class="form-row">
				  <div class="form-group col-md-6">
				    <label for="inputAddress">Adresse</label>
				    <input type="text" class="form-control" id="inputaddress" placeholder="z.B. Schönauer Straße 113a">
				  </div>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-6">
			      <label for="inputCity">Stadt</label>
			      <input type="text" class="form-control" id="inputCity">
			    </div>
			    <div class="form-group col-md-4">
			      <label for="inputstate">Bundesland</label>
			      <select id="inputstate" class="form-control">
			        <option selected>Auswählen...</option>
			        <option>Sachsen</option>
			      </select>
			    </div>
			    <div class="form-group col-md-2">
			      <label for="inputZip">Postleitzahl</label>
			      <input type="text" class="form-control" id="inputplz">
			    </div>
			  </div>
			  <div class="form-row">
			    <div class="form-group col-md-3">
			      <label for="inputtwitter">Twitter</label>
			      <input type="text" class="form-control" id="inputtwitter" placeholder="Twitter-Nutzername">
			    </div>
			    <div class="form-group col-md-3">
			      <label for="inputinsta">Instagram</label>
			      <input type="text" class="form-control" id="inputinsta" placeholder="Instagram-Nutzername">
			    </div>
			    <div class="form-group col-md-3">
			      <label for="inputxing">Xing</label>
			      <input type="text" class="form-control" id="inputxing" placeholder="Xing-Profil">
			    </div>
			    <div class="form-group col-md-3">
			      <label for="inputlinkedin">LinkedIn</label>
			      <input type="text" class="form-control" id="inputlinkedin" placeholder="LinkedIn-Profil">
			    </div>
			</div>
			  <button type="submit" class="btn btn-primary">Bearbeitung Speichern</button>
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
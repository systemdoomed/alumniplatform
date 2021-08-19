<?php
include_once 'header.php'
?>
<div class=" jumbotron jumbotron-image seamless gradient-1">
	<?php

	if (isset($_GET["error"])) {
		if ($_GET["error"] == "emptyinput") {
			echo '<p class=" text-center text-light">Sie haben eines der benötigten Felder nicht ausgefüllt!</p>';
		}
		else if ($_GET["error"] == "mailnotfound") {
			echo '<p class=" text-center text-light">Bitte geben sie eine registrierte Mail-Adresse ein! Sollten sie noch keine besitzen, können sie sich mit unserem Formular registrieren.</p>';
		}
		else if ($_GET["error"] == "wronglogin") {
			echo '<p class=" text-center text-light">Passwort oder Mail-Adresse sind nicht korrekt.</p>';
		}

		else if ($_GET["error"] == "none") {
			echo '<p class=" text-center text-light">Sie haben sich erfolgreich angemeldet!</p>';
		}
	}

	?>
	<h2 class="text-light">Anmeldung</h2>
	<form action="include/login.inc.php" method="post">
			<div class="form-row">
				<div class="form-group col-md-3">
			      <label for="inputmail" class="text-light">Mail-Adresse</label>
			      <input type="email" name="loginmail" class="form-control" id="inputmail" placeholder="Mail-Adresse">
			    </div>
			</div>
			<div class="form-row">
			    
			    <div class="form-group col-md-3">
			      <label for="inputpwd"class="text-light">Passwort</label>
			      <input type="password" name="loginpwd" class="form-control" id="inputpwd" placeholder="Passwort">
			    </div>
			 </div>
			  
			
			  <button type="submit" name= "submit" class="btn btn-primary">Einloggen</button>
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
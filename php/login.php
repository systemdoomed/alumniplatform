<?php
include_once 'header.php'
?>
<div class=" jumbotron jumbotron-image seamless gradient-1">
	<h2 class="text-light">Anmeldung</h2>
	<form action="include/signup.inc.php" method="post">
			<div class="form-row">
				<div class="form-group col-md-3">
			      <label for="inputmail" class="text-light">Mail-Adresse</label>
			      <input type="email" name="inputmail" class="form-control" id="inputmail" placeholder="Mail-Adresse">
			    </div>
			</div>
			<div class="form-row">
			    
			    <div class="form-group col-md-3">
			      <label for="inputpwd"class="text-light">Passwort</label>
			      <input type="password" name="inputpwd" class="form-control" id="inputpwd" placeholder="Passwort">
			    </div>
			 </div>
			  
			
			  <button type="submit" class="btn btn-primary">Einloggen</button>
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
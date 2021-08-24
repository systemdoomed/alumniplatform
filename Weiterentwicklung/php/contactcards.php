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
echo "<li class='nav-item'><a class='nav-link' href='contacts.php'>Listenlayout auswählen</a></li>";
echo '</ul>';
echo '</nav>';
?>
		<div class="jumbotron seamless gradient-1">
			<h1 class="text-light">Kontakte</h1>
			<br>
			<div class="card-columns">
			  <div class="card">
			  	<div class="embed-responsive embed-responsive-1by1">
			  		<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MjB8fHByb2ZpbGV8ZW58MHx8MHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60" alt="Profilbild">
			  	</div>
			    <div class="card-body text-center">
			    	<h4 class="card-title">Maria Musterfrau</h4>
			      <p class="card-text"></p>
			      <a href="#" class="btn btn-primary stretched-link">Kontakt ansehen</a>
			    </div>
			  </div>	
			  <div class="card">
			  	<div class="embed-responsive embed-responsive-1by1">
				  	<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="https://images.unsplash.com/photo-1531427186611-ecfd6d936c79?ixid=MXwxMjA3fDB8MHxzZWFyY2h8MTF8fHByb2ZpbGV8ZW58MHx8MHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60" alt="Profilbild">
				</div>
			    <div class="card-body text-center">
			    	<h4 class="card-title">Max Mustermann</h4>
			      <p class="card-text"></p>
			      <a href="#" class="btn btn-primary stretched-link">Kontakt ansehen</a>
			    </div>
				
			  </div>
			  <div class="card">
			  	<div class="embed-responsive embed-responsive-1by1">
				  	<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="https://images.unsplash.com/photo-1557862921-37829c790f19?ixid=MXwxMjA3fDB8MHxzZWFyY2h8NXx8bWFufGVufDB8fDB8&ixlib=rb-1.2.1&auto=format&fit=crop&w=400&q=60" alt="Profilbild">
				</div>
			    <div class="card-body text-center">
			    	<h4 class="card-title">Martin Mustermensch</h4>
			      <p class="card-text"></p>
			      <a href="#" class="btn btn-primary stretched-link">Kontakt ansehen</a>
			    </div>

			  </div>
			</div>
		</div>



		<div class="jumbotron seamless" style="background: #f7f7f7">
			<h1 class="text-dark">Neue Nutzer</h1>
			<br>
			<div class="card-columns">
			  <div class="card bg-dark">
			  	<div class="embed-responsive embed-responsive-1by1">
			  		<img class="card-img-top embed-responsive-item" style="object-fit: cover" src="https://images.unsplash.com/photo-1590756252677-8b92843273bf?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1234&q=80" alt="Profilbild">
			  	</div>
			    <div class="card-body text-center">
			    	<h4 class="card-title text-light">Klaus Peter Müller</h4>
			      <p class="card-text"></p>
			      <a href="#" class="btn btn-primary">Kontakt ansehen</a><br><br>
			      <a href="#" class="btn btn-success">Nutzer verifizieren</a>
			    </div>
			  </div>	
			  
			  
			</div>
		</div>
		

<?php
include_once 'footer.php'
?>
<?php
/*

*/
?>

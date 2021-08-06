
<?php

	session_start();

?>

<html lang="de" dir="ltr">
	<head>
		<meta charset="utf-8">
		<title> Alumni-BA</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/styling.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	</head>
	<body>
		<nav class="navbar navbar-expand-md bg-dark navbar-dark justify-content-end">			
				
				<ul class="navbar-nav">
					
					<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
					
					<?php
                        require 'include/dbh.inc.php';
						if (isset($_SESSION["nid"])) {
							echo "<li class='nav-item'><a class='nav-link' href='profile.php'>Mein Profil</a></li>";
							echo "<li class='nav-item'><a class='nav-link' href='contacts.php'>Kontakte</a></li>";
                            echo "<li class='nav-item'><a class='nav-link' href='logs.php'>Übersicht der Logs</a></li>";
                            echo "<li class='nav-item'><a class='nav-link' href='include/logout.inc.php'>Logout</a></li>";
                            
						}
						else {

							echo "<li class='nav-item'><a class='nav-link' href='login.php'>Login</a></li>";
							echo "<li class='nav-item'><a class='nav-link' href='signup.php'>Registrieren</a></li>";
						}

					?>

				</ul>

		</nav>

<?php
$serverName = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "AlumniDatenbank";

$conn = mysqli_connect($serverName,$dbUsername,$dbPassword,$dbName);

if (!$conn){

	die("Verbindung fehlgeschlagen: " . mysqli_connect_error());

}
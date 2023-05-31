<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "koffee";

$con = new mysqli($servername, $username, $password, $dbname);
if ($con->connect_error) {
    die("Conexiunea la baza de date a eșuat: " . $con->connect_error);
}
?>



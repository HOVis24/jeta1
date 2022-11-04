<?php 
$db = 'jeta'; //EVdW8x2a6w
$con = new mysqli('localhost', 'root', '', $db);
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
}
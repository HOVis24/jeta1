<?php 
$db = 'sql12541627'; //EVdW8x2a6w
$con = new mysqli('sql12.freemysqlhosting.net', 'sql12541627', 'IjwJjiTPmQ', $db);
if ($con->connect_error) {
	die("Connection failed: " . $con->connect_error);
}
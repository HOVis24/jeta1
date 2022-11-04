<?php 
require_once('connection.php');
$error = "";
session_start();
$GET['url'] = basename($_SERVER['PHP_SELF']);
if (isset($_POST['username'])) { 
    $error = "";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $read = "SELECT * FROM `users` WHERE username='$username' AND password='$password'";
    $result = $con->query($read);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $_SESSION['attemps'] = 0;
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['middle_name'] = $row['middle_name'];
        $_SESSION['user_type'] = $row['user_type'];
        $_SESSION['id'] = $row['id'];
        $_SESSION['store'] = $row['store'];
        $_SESSION["logged_in"] = true;
        echo "success";
    }
    else
    {
        $_SESSION['attemps'] || 0;
        $_SESSION['attemps'] += 1;
        echo $_SESSION['attemps'];

    }
}
?>
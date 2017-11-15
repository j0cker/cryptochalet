<?php
include ''.dirname(__FILE__).'/config.php';
$servername = $db_server;
$username = $db_user;
$password = $db_passwd;
$mydb = $db_name;
// Create connection
$conn = new mysqli($servername, $username, $password, $mydb);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: ".$conn->connect_error);
} 
?>
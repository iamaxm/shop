<?php
$servername = "localhost";
$username = "root";
$password = "";
$db = "shop";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);
$conn->set_charset("utf8");
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>
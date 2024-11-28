<?php
$servername = "sql311.infinityfree.com";
$username = "if0_36250050";
$password = "5s6LSR3wqtV9O";
$db = "if0_36250050_emake";
// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
// echo "Connected successfully";
?>
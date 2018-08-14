<?php
  include ('./config/db-config.php');

  // Create connection
  $conn = new mysqli($servername, $username, $password, $dbname);
  // Check connection
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  } else {
    debugToConsole("Connected successfully");
  }
?>

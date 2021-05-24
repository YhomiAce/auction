<?php

// localhost
$servername = "localhost";
$dbName = "auction";
$username = "root";
$password = "";

// Heroku
// $servername = "us-cdbr-east-03.cleardb.com";
// $dbName = "heroku_df64604803a0ec2";
// $username = "b86eaf985e6460";
// $password = "78602352";

  try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbName", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
  } catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
  }
?>
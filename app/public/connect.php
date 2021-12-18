<?php 
  require 'config.php';

  $dsn = "mysql:host=$host;dbname=$db;charset=UTF8";

  try {
    $conn = new PDO($dsn, $user, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    if ($conn) {
      echo "Connected to the $db database successfully! <br/>";
    }
  } catch (PDOException $e) {
      echo $e->getMessage();
  }
?>

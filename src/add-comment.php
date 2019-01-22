<?php
  include('../config.php');
  session_start();
  $servername = $DB_HOST;
  $username = $DB_USER;
  $password = $DB_PASS;
  $dbname = $DB_NAME;

  # Establishing connection with database
  try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
  }

  $insertComment = $conn->prepare("INSERT INTO Comment (Username, Audioname, Comment, AtMoment) VALUES (?,?,?,?)");

  if($_POST){
    $comment = $_POST['comment'];
    $atMoment = $_POST['time'];
    $username = $_SESSION['login_user'];
    $audioname = $_POST['audioname'];
    $insertComment->execute([$username, $audioname, $comment, $atMoment]);
    header("Location: view-audio.php?audio=".$audioname."&atMoment=".$atMoment);
  }
?>

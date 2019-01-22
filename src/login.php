<?php
include('../config.php');
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
  echo "&";
  //$insertUser = $conn->prepare("INSERT INTO User (Username, Email, Password) VALUES (?,?,?)");
  //$selectEmail = $conn->prepare("SELECT Email FROM User WHERE Email=?");
  $selectUsername = $conn->prepare("SELECT Username FROM User WHERE Username=?");
  $selectPasswordHash = $conn->prepare("SELECT Password FROM User WHERE Username=?");

  if($_POST){
    if(isset($_POST['username']) && isset($_POST['password'])){
      $password = $_POST['password'];
      $username = $_POST['username'];
      echo "^";

      $selectUsername->execute([$username]);
      $selectPasswordHash->execute([$username]);
      $usernameInDB = $selectUsername->fetch();
      $passwordInDB = $selectPasswordHash->fetch();
      $isUsernameInDB = count($usernameInDB);
      $isPasswordInDB = count($passwordInDB);
      echo $usernameInDB;
      echo "**";
      if($isUsernameInDB > 0 || $isPasswordInDB > 0){
        if(password_verify($password, $passwordInDB['Password'])){
          session_start();
          $_SESSION['login_user']= $username;

          header("Location: index.php?valid-login=1");
        } else {
          header("Location: login-form.php?valid-login=0");
        }
      } else {
        header("Location: login-form.php?valid-login=0");
      }
    }
  }
?>

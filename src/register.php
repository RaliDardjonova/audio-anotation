<?php
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname = "Proekt";

  # Establishing connection with database
  try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
  }

  $insertUser = $conn->prepare("INSERT INTO User (Username, Email, Password) VALUES (?,?,?)");
  $selectEmail = $conn->prepare("SELECT Email FROM User WHERE Email=?");
  $selectUsername = $conn->prepare("SELECT Username FROM User WHERE Username=?");

  if($_POST){
    if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password'])){
      $password = $_POST['password'];
      $password_hash = password_hash($password, PASSWORD_DEFAULT);
      $username = $_POST['username'];
      $email = $_POST['email'];
      $selectUsername->execute([$username]);
      $selectEmail->execute([$email]);
      $usernameInDB = count($selectUsername->fetchAll());
      $emailInDB = count($selectEmail->fetchAll());

      if($usernameInDB > 0 || $emailInDB > 0){
        header("Location: register-form.php?repeat=1");
        exit;
      } else {
        $insertUser->execute([$username, $email, $password_hash]);
        header("Location: index.php?valid-registration=1");
      }
    }
  }
?>

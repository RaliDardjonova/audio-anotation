<?php
  session_start();
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

  $insertAudio = $conn->prepare("INSERT INTO Audio (Username, Audioname, ReadableAudioname, Description) VALUES (?,?,?,?)");

  if(isset($_POST['submit'])){
    $file_name = $_FILES['audio_file']['name'];

    if($_FILES['audio_file']['type']=='audio/mpeg' ||
    $_FILES['audio_file']['type']=='audio/mpeg3' ||
    $_FILES['audio_file']['type']=='audio/x-mpeg3' ||
    $_FILES['audio_file']['type']=='audio/mp3' ||
    $_FILES['audio_file']['type']=='audio/x-wav' ||
    $_FILES['audio_file']['type']=='audio/wav'){
      $ext = pathinfo($_FILES['audio_file']['name'], PATHINFO_EXTENSION);
      $new_file_name = uniqid($_SESSION['login_user'],true);
      $new_file_name = $new_file_name.".".$ext;

       // Where the file is going to be placed
      $target_path = "../Audios/".$new_file_name;

      if(move_uploaded_file($_FILES['audio_file']['tmp_name'], $target_path)) {
        $username = $_SESSION['login_user'];
        $readable = $_POST['readable'];
        $description = $_POST['description'];

        $insertAudio->execute([$username, $new_file_name, $readable, $description]);
        header("Location: upload-form.php?valid-upload=1");
      }
    }
  }
?>

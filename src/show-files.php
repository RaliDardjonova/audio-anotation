<?php
    session_start();
    $servername = "127.0.0.1";
    $username = "root";
    $password = "";
    $dbname = "Proekt";
?>

<html>
  <head>
  <link href="../css/styles.css" rel="stylesheet"/>
  <link href="../css/table-audios.css" rel="stylesheet"/>
  <meta charset="utf-8">
  </head>
  <body>

    <div class="registration-header">

      <?php if($_SESSION['login_user']){
       ?>

      <form action="index.php" method="post">
          <input type="hidden" name="exit" value="exit" />
           <button class="header-btn btn" name"exit">Изход</button>
      </form>

      <form action="upload-form.php">
           <button class="header-btn btn">Качи звуков файл</button>
      </form>

      <form action="show-files.php">
           <button class="header-btn btn">Виж всички звукозаписи</button>
      </form>
    <?php }
    else { ?>
      <form action="register-form.php">
           <button class="header-btn btn" type="submit">Регистрация</button>
      </form>
      <form action="login-form.php">
			     <button class="header-btn btn">Вход</button>
      </form>
    <?php } ?>
		</div>
    <br>
    <br>
<?php
  # Establishing connection with database
  try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Connected successfully";
  }
  catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
  }

  # Prepared queries
  $select = $conn->prepare("SELECT * FROM Audio");

  $select->execute();
  $audios = $select->fetchAll();
  ?> <table class="audios">
    <th class="audios">Име на звукозапис</th>
    <th class="audios">Качено от</th>
    <th class="audios"></th><?php
  foreach ($audios as $audio) {
    ?>
    <tr class="audios">
        <td class="audios"> <span>  <?php echo $audio['ReadableAudioname'] ?></span> </td>
        <td class="audios"> <span> <?php echo $audio['Username'] ?> </span> </td>
        <td class="audios">
          <form class="audios" method="get" action="view-audio.php">
            <input type='hidden' value="<?php echo $audio['Audioname']?>" name="audio" >
            <input type="submit" class="button_product" value="Виж звукозаписа">
          </form>
      </td>
    </tr>
    <?php
  }
  ?>
  </table>
  <?php
?>

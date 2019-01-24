<?php
    include('../config.php');
    session_start();
    $servername = $DB_HOST;
    $username = $DB_USER;
    $password = $DB_PASS;
    $dbname = $DB_NAME;
    try {
      $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e){
      echo "Connection failed: " . $e->getMessage();
    }
?>

<html>
  <head>
  <link href="../css/styles.css" rel="stylesheet"/>
  <link href="../css/comment-styles.css" rel="stylesheet" />
  <link href="../css/audio-display.css" rel="stylesheet"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.6/mediaelement-and-player.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="../js/show-audio.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.6/mediaelementplayer.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mediaelement/4.2.6/mejs-controls.svg" />

  <meta charset="utf-8">
  </head>
  <body onload="startAudio()">

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

    <?php
      if($_GET['audio']){
        $audioname = $_GET['audio'];
        if($_GET['atMoment']){
          $startFrom = $_GET['atMoment'];
        } else {
          $startFrom = 0;
        }
        $audioInfo = $conn->prepare("SELECT * FROM  Audio WHERE Audioname = ?");
        $audioInfo->execute([$audioname]);
        $currentAudioInfo = $audioInfo->fetch();
        $audioUsername = $currentAudioInfo['Username'];
        $audioReadable = $currentAudioInfo['ReadableAudioname'];
        $audioDescription = $currentAudioInfo['Description'];
    ?>
    <div class="show-audio">
        <div id="audio-section">
          <div class="cont">
            <h3> <?php echo $audioReadable; ?> </h3>
            <div class="user"> <?php echo $audioUsername; ?> </div>

          </div>
          <div class="audio">
            <audio  id="player" class="mejs__player" controls="controls"  >
              <source src="../Audios/<?php echo $audioname;?>" type="audio/wav">
              <source src="../Audios/<?php echo $audioname;?>" type="audio/mpeg">
            </audio>
          </div>
          <br>
          <div class="description">Описание:<br> <?php echo $audioDescription; ?> </div>
          <br>
          <br>
          <?php if($_SESSION['login_user']){ ?>
          <div>
            <form id="add-comment">
              <input id="audioname" type="hidden" name="audioname" value="<?php echo $audioname; ?>" />
              <input id="time" name="time" type="hidden" value="1" />
              <input class="input-comment" name="comment" placeholder="Напиши коментар"required/>
              <input id="comment-button" type="submit" value="Изпрати"/>
            </form>
          </div>
        <?php }?>
        </div>
    <?php    }
    ?>


    <div id="comment-section">
      <h3 id="comments"> Коментари </h3>
      <form class="export" action="export.php" method="post">

        <input type="hidden" name="audioname" value="<?php echo $audioname; ?>" />
        <input class="export-button" type="submit" name="export" value="Export"/>
        <select name="time" id="select-time" class="select-time" required>
          <option value="all" autofocus>всички</option>
          <option value="month">1 месец</option>
          <option value="week">1 седмица</option>
          <option value="today">1 ден</option>
          <option value="hour">1 час</option>
          <option value="minute">1 минута</option>
        </select>
      </form>

      <br>
      <br>
      <br>

      <div id="fetch-comments">
        <?php
          $selectComments = $conn->prepare("SELECT * FROM  Comment WHERE Audioname = ?");

          $selectComments->execute([$audioname]);
          $comments = $selectComments->fetchAll();

        foreach($comments as $comment){
          ?>
          <div class="comment-row">
              <span class="user"> <?php echo $comment['Username']; ?> </span>
              <span class="atMoment" onclick="MoveMoment(<?php echo $comment['AtMoment']; ?>)"> <?php echo gmdate("i:s", $comment['AtMoment']); ?> </span>
              <span class="createdAt">  <?php echo $comment['CreatedAt']; ?></span>
              <p class="comment">  <?php echo $comment['Comment']; ?> </p>
            </div>

          <?php
        }
        ?>
      </div>

    </div>
  </div>
    <script>


      new MediaElementPlayer('player', {
          features: ['playpause', 'current', 'progress', 'duration', 'volume', 'replay', 'tracks'],
          alwaysShowControls: true,
          audioVolume: 'horizontal',
          audioWidth: 500,
          audioHeight: 120
      });

      function startAudio(){
        document.getElementById("player").play();
        document.getElementById("player").currentTime = <?php echo $startFrom; ?>;
      }

      function MoveMoment(time){
        document.getElementById("player").currentTime = time;
      }
    </script>
  </body>
</html>

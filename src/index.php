<?php
    session_start();
?>

<html>
  <head>
  <link href="../css/styles.css" rel="stylesheet"/>
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

    <div class="isExit">
      <?php
        if(isset($_POST['exit'])){
          $_SESSION = array();
          header("Location: index.php?exit=1");
        }
      ?>
    </div>

    <div class="isValidLogin">
      <?php
        if(isset($_GET['valid-login']) && $_GET['valid-login']==1){
          echo "Успешно влизане,".$_SESSION['login_user']."!";
        }
      ?>
    </div>

    <div class="isValidRegistration">
      <?php
        if(isset($_GET['valid-registration']) && $_GET['valid-registration']==1){
          echo "Успешна регистрация! Вече може да влезете в акаунта си :)";
        }
      ?>
    </div>

    <div class="exited">
      <?php
        if(isset($_GET['exit']) && $_GET['exit']==1){
          echo "До скоро виждане!";
        }
      ?>
    </div>
  </body>
</html>

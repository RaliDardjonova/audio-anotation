<?php
    session_start();
?>

<html>
  <head>
    <link href="../css/styles.css" rel="stylesheet"/>
    <link href="../css/login-styles.css" rel="stylesheet"/>
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
    <div class="box container">
      <div class="registration">Качване на файл</div>
        <form class="form-login" name="audio_form" id="audio_form" action="upload.php" method="post" enctype="multipart/form-data">

          <div class="form-login upload-item login-item">
            <label>Избери звукозапис</label>
            <input name="audio_file" id="audio_file" type="file" required/>
          </div>
          <div class="inline"></div>

          <div class="login-item">
            <div class="upload-item">
              <label>Задайте публично име на звукозаписа:</label>
              <input name="readable" id="readable" type="text" maxlength="1023" required/>
            </div>
          </div>

          <div class="upload-item login-item">
            <label>Дoбавете описание по желание:</label>
            <textarea id="description" name="description" maxlength="1025">
            </textarea>
          </div>

          <div class="reg-item login-item">
            <input type="submit" name="submit" id="submit" value="Качване"/>
          </div>
        </form>
      </div>

    <div class="uploaded">
      <?php
        if(isset($_GET['valid-upload']) && $_GET['valid-upload']==1){
          echo "Качването на звукозапис беше успешно!";
        }
      ?>
    </div>
  </body>
</html>

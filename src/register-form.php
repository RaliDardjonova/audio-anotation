<!doctype html>
<html>
  <head>
  	<title> Login page </title>
  	<meta charset="utf-8">
    <link href="../css/login-styles.css" rel="stylesheet"/>
    <link href="../css/styles.css" rel="stylesheet"/>
    <script type="text/javascript" src="../js/login-validation.js"></script>
  </head>
  <body>
    <div class="box">
    <div class="registration-header">
      <form action="register-form.php">
           <button class="header-btn btn" type="submit">Регистрация</button>
      </form>
      <form action="login-form.php">
			     <button class="header-btn btn">Вход</button>
      </form>
		</div>
    <div class="box">
   <div class="container">
    <div class="registration">Регистрация</div>
		<div class="login-item">
		  <form action="register.php" method="post" class="form-login">
			<div class="reg-field">
			  <input id="email" name="email" type="email" class="reg-input" placeholder="E-mail" required>
			</div>

      <div class="reg-field">
        <input
          id="username"
          name="username"
          pattern="^[A-Za-z0-9_]{3,30}$"
          required="required"
          size="20"
          spellcheck="false"
          title="between 3 and 10 symbols - letters, numbres and _"
          type="text"
          placeholder="Потребителско име"
          value=""
          required>
      </div>
      <div class="inline" id="errorUsername"></div>

      <div>
        <div class="reg-field">
          <input
            id="password"
            name="password"
            pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])([a-zA-Z0-9]+){6,}$"
            required="required"
            size="30"
            spellcheck="false"
            title="Your password"
            type="password"
            value=""
            placeholder="Парола">
        </div>
        <div class="inline" id="errorPassword"></div>
      </div>

      <div>
        <div class="reg-field">
          <input
            id="confirmPassword"
            name="confirmPassword"
            pattern="^(?=.*[0-9])(?=.*[A-Z])(?=.*[a-z])([a-zA-Z0-9]+){6,}$"
            required="required"
            size="30"
            spellcheck="false"
            title="Confirm password"
            type="password"
            value=""
            placeholder="Потвърдете паролата">
        </div>
        <div class="inline" id="errorConfirmPassword"></div>
      </div>

			<div class="reg-field">
			  <input type="submit" value="Регистрация">
			</div>
		  </form>
      <div class="isInvalidRegistration">
        <?php
          if(isset($_GET['repeat']) && $_GET['repeat']==1){
            echo "Заето потребителско име или имейл. Моля изберете други!";
          }
        ?>
      </div>
		</div>
	 </div>
 </div>
</div>
  </body>
</html>

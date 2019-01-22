<?php
//install.php - can called once, initiating database, creating configuration file of doesnt exists, etc.
//Optional:: ConfigPanel.php -> Configures/changes settings of app
//Required: config.php, db_sql.txt
//required: help.php (can be part of documentation)...
//or config.ini -> със същите настройки;

//class Config {
  $SITE_FN = 81350; //can be used bellow
  $SITE_CREATOR = "Ralitsa Dardjonova";
  $SITE_ADMIN_EMAIL = "r.dardjonova@gmai.com";
  $SITE_INFO = "This project was created during ...year, on Web Technologies, Sofia University, FMI, lead by:
Name of Instructor, assistant: Name-Of-Assistant";

  $SITE_URL="/";
  $DB_HOST="127.0.0.1";
  $ROOT_FOLDER="/var/www/html/Proekt";
  $DB_USER="root";
  $DB_PASS="";
  $DB_NAME="Proekt";
  $SITE_DESCRIPTION="What is ready, and what can be improved for future";
  $PROJECT_REQ="...(from documentation)";
//}
?>

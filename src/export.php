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

    if (isset($_POST["export"]) && isset($_POST["time"]) && isset($_POST["audioname"])) {
      $filename = "Export_excel.xls";
      $audioname = $_POST['audioname'];
      $time = $_POST['time'];

      if($time == "all"){
        $sqltime = "";
      } else {
        if($time == "today"){
          $sqltime = "AND CreatedAt BETWEEN SUBDATE(NOW(), INTERVAL 1 DAY) AND NOW()";
        } else {
          if($time == "month"){
            $sqltime = "AND CreatedAt BETWEEN SUBDATE(NOW(), INTERVAL 1 MONTH) AND NOW()";
          } else {
            if($time == "week"){
              $sqltime = "AND CreatedAt BETWEEN SUBDATE(NOW(), INTERVAL 1 WEEK) AND NOW()";
            } else {
              if($time == "hour"){
                $sqltime = "AND CreatedAt BETWEEN SUBDATE(NOW(), INTERVAL 1 HOUR) AND NOW()";
              } else {
                if($time == "minute"){
                  $sqltime = "AND CreatedAt BETWEEN SUBDATE(NOW(), INTERVAL 1 MINUTE) AND NOW()";
                }
              }
            }
          }
        }
      }
      //echo $audioname;
    $selectComments = $conn->prepare("SELECT * FROM  Comment WHERE Audioname = ? ".$sqltime);

    $selectComments->execute([$audioname]);
    $comments = $selectComments->fetchAll();

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $isPrintHeader = false;
    if (! empty($comments)) {
        foreach ($comments as $comment) {
           if (! $isPrintHeader) {
             $keys = array('Username', 'Comment', 'At Moment', 'Created At');
                echo implode("\t", $keys) . "\n";
                $isPrintHeader = true;
            }
            $values = array($comment['Username'],$comment['Comment'],$comment['AtMoment'], $comment['CreatedAt']);
            echo implode("\t", $values) . "\n";
        }
    }
    //exit();
  }
?>

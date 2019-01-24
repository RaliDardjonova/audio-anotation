
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
  //echo "123";
  if($_POST['audioname'] && $_POST['time']){
  $audioname = $_POST['audioname'];
  $time = $_POST['time'];
  //echo $audioname;
      //$str = "";
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

    $selectComments = $conn->prepare("SELECT * FROM  Comment WHERE Audioname = ? ".$sqltime);

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
/*
  $str = $str."<div class=\"comment-row\">";
  $str = $str."<span class=\"user\">".$comment['Username']."</span>";
  $str = $str."<span class=\"atMoment\" onclick=\"MoveMoment(".$comment['AtMoment'].")\">".gmdate("i:s", $comment['AtMoment'])."</span>";
  $str = $str."<span class=\"createdAt\">".$comment['CreatedAt']."</span>";
  $str = $str."<p class=\"comment\">".$comment['Comment']."</p>";
  $str = $str."</div>";*/
  }
}
  //echo $str;
 ?>

<?php
    ini_set('display_errors', 1);
    require "../api.php";

    session_start();
    if(isset($_SESSION["user"]))
    {
      echo "Hello, ";
      echo $_SESSION["user"];
    } else {
      header("Location: ../index.php");
    }
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
      $file = "opts.cfg";

      $object = new Competition();
      $objects->setTime($file);

    }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
  </head>
  <body>

    <?php
      if(file_exists("opts.cfg"))
      {
        $cfg = file_get_contents("opts.cfg");
        $arr = preg_split("/T/", $cfg);
        echo "<h2>Current Competition Time Setting: </h2>";
        echo "Start Date: ".$arr[0]."<br>";
        echo "Start Time: ".$arr[1]."<br>";
        echo "End Date: ".$arr[2]."<br>";
        echo "End Time: ".$arr[3]."<br>";
        echo "Duration: ".$arr[4]."min<br>";
      }
    ?>
    <form action="" method="POST">
      Date and Time: <input type="datetime-local" name="start_date">
      Duration: <input type="number" name="duration" min="30" max="3600">
      <input type="submit" name="" value="SUBMIT">
    </form>
  </body>
</html>

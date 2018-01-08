<?php
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
      $time_start = new DateTime($_POST["start_date"]);
      $duration = $_POST["duration"];

      $time_end = $time_start;

      $time_end->add(new DateInterval('PT'.$duration.'M'));

      $time_start = $time_start->format('Y-m-d\TH:i');
      $time_end = $time_end->format('Y-m-d\TH:i');

      $content = $time_start."\T".$time_end."\T".strval($duration);

      file_put_contents($file, $content);

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
        echo "Duration: ".$arr[4]."<br>";
      }
    ?>
    <form action="" method="POST">
      Date and Time: <input type="datetime-local" name="start_date">
      Duration: <input type="number" name="duration" min="30" max="3600">
      <input type="submit" name="" value="SUBMIT">
    </form>
  </body>
</html>

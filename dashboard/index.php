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
      $time = new DateTime($_POST["start_date"]);
      $duration = $_POST["duration"];

      $time->add(new DateInterval('PT'.$duration.'M'));

      $time = $time->format('Y-m-d\TH:i');

      file_put_contents($file, $time);

    }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
  </head>
  <body>
    <form action="" method="POST">
      Date and Time: <input type="datetime-local" name="start_date">
      Duration: <input type="number" name="duration" min="30" max="3600">
      <input type="submit" name="" value="SUBMIT">
    </form>
  </body>
</html>

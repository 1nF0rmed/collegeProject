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
      echo $_POST["start_date"];
      echo "<br/>";
      echo $_POST["duration"];
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
    </form>
  </body>
</html>

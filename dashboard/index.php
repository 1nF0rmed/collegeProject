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
      if($_POST["logout"]=="0")
      {
        unset($_SESSION["user"]);
         session_destroy();
         header("Location: ../");
      }
      $file = "opts.cfg";

      $object = new Competition();
      $object->setTime($file);

    }

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Dashboard</title>
    <script src="../jquery-3.2.1.min.js"></script>
    <script src="../jquery-ui.min.js"></script>
  </head>
  <body>

    <?php
      if(file_exists("opts.cfg"))
      {
        $object = new Competition("opts.cfg");

        $cfg = file_get_contents("opts.cfg");
        $arr = preg_split("/T/", $cfg);
        echo "<h2>Current Competition Time Setting: </h2>";
        echo "Start Date: ".$object->getStartDate()."<br>";
        echo "Start Time: ".$object->getStartTime()."<br>";
        echo "End Date: ".$object->getEndDate()."<br>";
        echo "End Time: ".$object->getEndTime()."<br>";
        echo "Duration: ".$object->getDuration()."min<br>";
      }
    ?>
    <form action="" method="POST">
      Date and Time: <input id="datetimepicker" type="datetime-local" name="start_date">
      Duration: <input type="number" name="duration" min="30" max="3600">
      <input type="hidden" name="logout" value="1">
      <input type="submit" name="" value="SUBMIT">
    </form>
  <form action="" method="POST">
    <input type="hidden" name="logout" value="0">
    <input type="submit" value="LOGOUT">
</form>
<script>
  $(document).ready(function(){
    $("datetimepicker").datepicker({ dateFormat: 'yy-mm-dd'});
  });
</script>
  </body>
</html>

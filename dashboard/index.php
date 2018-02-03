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

      $object = new Competition($file);
      $object->setTime();

    }

?>

<!DOCTYPE html>
<html>
  <head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">  
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <meta charset="utf-8">
    <title>Dashboard</title>
    <script src="../jquery-3.2.1.min.js"></script>
    <script src="../jquery-ui.min.js"></script>
  </head>
  <body>
    <div class="col s6 offset-s3 z-depth-1" style="max-width:100%;margin-top:10px">
		  <a href="questions.php"><input type="button" value="QUESTIONS PAGE" class="waves-effect waves-light btn"></a>  
	  </div>
    <?php
      if(file_exists("opts.cfg"))
      {
        $object = new Competition("opts.cfg");

        $cfg = file_get_contents("opts.cfg");
        $arr = preg_split("/T/", $cfg);
        echo "<h4>Current Competition Time Setting: </h4>";
        echo "<b>Start Date:</b> ".$object->getStartDate()."<br>";
        echo "<b>Start Time:</b> ".$object->getStartTime()."<br>";
        echo "<b>End Date:</b> ".$object->getEndDate()."<br>";
        echo "<b>End Time:</b> ".$object->getEndTime()."<br>";
        echo "<b>Duration:</b> ".$object->getDuration()."min<br><br><br>";
      }
    ?>
    <form action="" method="POST">
      Date and Time: <input id="datetimepicker" type="datetime-local" name="start_date">
      Duration: <input type="number" name="duration" min="30" max="3600">
      <input type="hidden" name="logout" value="1">
      <input type="submit" name="" value="SUBMIT" class="waves-effect waves-light btn">
    </form>
  <form action="" method="POST">
    <input type="hidden" name="logout" value="0" class="waves-effect waves-light btn">
    <input type="submit" value="LOGOUT" class="waves-effect waves-light btn">
</form>
<script>
  $(document).ready(function(){
    $("datetimepicker").datepicker({ dateFormat: 'yy-mm-dd'});
  });
</script>
  </body>
</html>

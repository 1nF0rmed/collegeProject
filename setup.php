<?php
  require "config.php";

  # $query = file_get_contents("createDB.sql");
  # $con = mysqli_connect($HOST, $USER, $PASS) or die("Unable to connect");

  # $resp = mysqli_query($con, $query) or die("Unable to send query");

  $con = mysqli_connect($HOST, $USER, $PASS, $DB);
  $query = file_get_contents("createTables.sql");

  $resp = mysqli_query($con, $query) or die("Unable to send query 2");
  $query = "INSERT INTO login VALUES('admin', '3a021f41041cc1e3fd256be83bba3f6206076227f4c45153d92a85b9bcc09d77')";
  $resp = mysqli_query($con, $query) or die("Unable to send query 3");
  mysqli_close($con);
 ?>

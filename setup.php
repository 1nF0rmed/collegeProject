<?php
  require "config.php";

  #$query = file_get_contents("createDB.sql");
  #$con = mysqli_connect($HOST, $USER, $PASS) or die("Unable to connect");

  #$resp = mysqli_query($con, $query) or die("Unable to send query");

  $con = mysqli_connect($HOST, $USER, $PASS, $DB);
  #$query = file_get_contents("createTables.sql");

  #$resp = mysqli_query($con, $query) or die("Unable to send query 2");
  $query = "INSERT INTO login VALUES('366CS15203', 'a58c42389cb82c3c42f7740a4df0951c82c1d4e5a2844d2611c73937abfff2b5')";
  $resp = mysqli_query($con, $query) or die("Unable to send query 3");
  mysqli_close($con);
 ?>

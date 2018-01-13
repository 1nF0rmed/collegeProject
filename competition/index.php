<?php
    require "../api.php";

    session_start();
    if(isset($_SESSION["user"]))
    {
      echo "Hello, ";
      echo $_SESSION["user"];
    } else {
      header("Location: http://localhost/");
    }

    $object = new Competition();
    $interval = $object->getTTS("../dashboard/opts.cfg");

    echo "<br>".$interval->format("%R%a days %H hours %i minutes %S seconds ");

?>

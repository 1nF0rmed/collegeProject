<?php
    session_start();
    if(isset($_SESSION["user"]))
    {
      echo "Hello, ";
      echo $_SESSION["user"];
    } else {
      header("Location: http://localhost/");
    }

?>

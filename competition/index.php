<?php
    require "../api.php";

    session_start();
    if(isset($_SESSION["user"]))
    {
      echo "Hello, ";
      echo $_SESSION["user"];
    } else {
      header("Location: ../");
    }

    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        if($_POST["logout"])
        {
           session_destroy();
        }
    }

    $object = new Competition();
    $interval = $object->getTTS("../dashboard/opts.cfg");

    $pass = $interval->format("%R%a:%H:%i");

    echo $pass;

?>

<form action="" method="POST">
    <input type="hidden" name="logout" value="0">
    <input type="submit" value="LOGOUT">
</form>

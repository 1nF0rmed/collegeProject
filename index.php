<?php
    require 'api.php';
    require 'config.php';
    session_start();
    if(isset($_SESSION["user"]))
    {
      if($_SESSION["user"]=="admin")
      {
        header("Location: ./dashboard/index.php");
      } else {

        header("Location: ./competition/index.php");
      }

    } # testing script   
    if($_SERVER["REQUEST_METHOD"]=="POST")
    { echo "POSTING";
      $conn = mysqli_connect($HOST, $USER, $PASS, $DB) or die("Na...");

        $user=$_POST['user'];
        $pass=$_POST['pass'];
        $object=new Accounts();
        $resp = $object->verifyData($user, $pass, $conn, $ALGO, $SALT);

        if($resp==1)
        {
          $_SESSION["user"] = $user;
          if($user=="admin")
          {
            header("Location: http://localhost/dashboard");
          } else {
            header("Location: http://localhost/competition/");
          }

        }
        else {
          echo "Wrong Password";
        }
    }

?>

<html>
  <head>
    <title>login page</title>
  </head>
  <body bgcolor="pink">
    <form action="." method="POST">
      Username:<input type="text" name="user"/> <br/>
      Password:<input type="password" name="pass"/> <br/>
    <input type="submit" value="LOGIN"/>
    </form>
  </body>
</html>

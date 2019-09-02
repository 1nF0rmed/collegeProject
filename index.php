<?php
    ini_set('display_errors', 1);
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

    } 
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
            header("Location: ./dashboard");
          } else {
            header("Location: ./competition/");
          }

        }
        else {
          echo "Wrong Password";
        }
    }

?>

<html>
  <head>
    	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">	
  	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">
    <title>login page</title>
	<style>
		.container {
			display: flex;
			align-items: center;
			justify-content: center;
		}
	</style>
  </head>
  <body>
  <div class="container">
   <div class="row">
   <div class="col s6 offset-s3 z-depth-1" id="panell" style="max-width:100%;margin-top:100px">
    	<h5>Login</h5>
	<form action="." method="POST">
      <input type="text" name="user" placeholder="Username" for="username" />
      <input type="password" name="pass" placeholder="Password" for="password"/> <br/>
    <input type="submit" class="waves-effect waves-light btn" value="LOGIN"/>
    </form>
  </div>
 </div>
</div>
  </body>
</html>

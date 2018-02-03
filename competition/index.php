<html>
	<head>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/css/materialize.min.css" rel="stylesheet" />
		
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.1/js/materialize.min.js"></script>
		<script src="../jquery-3.2.1.min.js"></script>
		<title>User's page</title>
	</head>
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
        if($_POST["logout"]=="0")
        {
          unset($_SESSION["user"]);
           session_destroy();
           header("Location: ../");
        }
    }
/*
    $object = new Competition("../dashboard/opts.cfg");
    $interval = $object->getTTS();

    $pass = $interval->format("%R");
    if( $pass=="-" )
    {
      echo "<br><h3>Competition started already/ended.</h3>";
    } else {
      echo "<br>".$interval->format("%a days: %H hours: %i minutes left");
    }

*/
?>
	<span id="time"></span>
	<form action="" method="POST">
    		<input type="hidden" name="logout" value="0">
    		<input type="submit" value="LOGOUT" class="waves-effect waves-light btn">
	</form>

	<script>
		$(document).ready(function(){
			setInterval(function(){
				$("#time").load("checkTime.php");
				if($("#time").text() == "0")
				{
					window.location.replace("question.php");
				}
			}, 500);
			
		});
	</script>
	
	</body>

</html>

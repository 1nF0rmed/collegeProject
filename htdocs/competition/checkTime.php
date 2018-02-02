<?php
	include "../api.php";

	$object = new Competition("../dashboard/opts.cfg");
    	$interval = $object->getTTS();

    	$pass = $interval->format("%R");
    	if( $pass=="-" )
    	{
      		echo "0";
    	} else {
      		echo "<br><h3>".$interval->format("%a days: %H hours: %i minutes : %s seconds left")."</h3>";
    	}


?>

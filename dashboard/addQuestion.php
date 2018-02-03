<?php
    require "../config.php";
    require "../api.php";
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $con = mysqli_connect($HOST, $USER, $PASS, $DB) or die("Na...");
        $title = $_POST["title"];

        $desc = addslashes($_POST["description"]);

        $params = addslashes(json_encode($_POST["parameters"]));

        $tests = array();
        $test1 = $_POST["testcase1"];
        $test2 = $_POST["testcase2"];
        $test3 = $_POST["testcase3"];
        $test4 = $_POST["testcase4"];
        $test5 = $_POST["testcase5"];
        array_push($tests, $test1, $test2, $test3, $test4, $test5);
        $tests = addslashes(json_encode($tests));
        //echo $tests;
        $output = addslashes(json_encode($_POST["output"]));
        //echo $output;

        $query = "INSERT INTO questions VALUES('{$title}', '{$desc}', '{$params}', '{$tests}', '{$output}', NULL);";
        //echo "\n".$query;
        $resp = mysqli_query($con, $query) or die(mysqli_error($con));

        //echo $resp;

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">

        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>
	    <style>
		    input{
                max-width: 100%;
                width: 20em;  height: 18em;
		    }
	    </style>
	    <script src="https://cdnjs.cloudflare.com/ajax/libs/showdown/1.8.6/showdown.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <script src="../jquery-3.2.1.min.js"></script>
        <title>Document</title>
    </head>
    <body>
        <a href="setupQuestions.php"><input type="button" value="ADD QUESTION" class="waves-effect waves-light btn"></a>
        <a href="questions.php"><input type="button" value="Questions PAGE" class="waves-effect waves-light btn"></a>
    </body>
    </html>
    <?php

    }
?>
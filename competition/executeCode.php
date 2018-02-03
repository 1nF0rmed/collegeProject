<?php
	if($_SERVER['REQUEST_METHOD']=='POST')
             	{
                        $code = $_POST['code'];
                        $temp = tempnam("/tmp", "code");
                        $file = fopen($temp, "w");
                        fwrite($file, $code);
                        //exec("ls", $out);
                        //echo implode('|', $out);
                        $output = exec("python ".$temp);
                        unlink($temp);
                        fclose($file);
                        //echo implode('|',$output);
                        echo $output;
		}
?>

<?php

    class Accounts {
        var $query;

        function sayHi()
        {
          echo "Hello";
        }

        function verifyData($user, $pass, $con, $ALGO, $SALT)
        {
            $user = mysqli_real_escape_string($con, stripslashes($user));
            $pass = mysqli_real_escape_string($con, stripslashes($pass));
            $hash = hash($ALGO, $SALT.$pass);
            $this->query = "SELECT * FROM login WHERE user='{$user}' AND pass='{$hash}'";
            $resp = mysqli_query($con, $this->query) or die("Unable to send query");
            $count = mysqli_num_rows($resp);
            if($count>0)
            {
                return 1;
            } else {
                return -1;
            }
        }

        function getTotal($user)
        {
            $user = mysql_real_escape_string(stripslashes($user));
            $this->query = "SELECT total FROM marks WHERE user='{$user}'";
            $resp = mysqli_query($conn, $this->query) or die("Unable to send query");
            if( mysqli_num_rows($resp)>0 ) {
                $total = mysqli_fetch_assoc($rep)["total"];
                return $total;
            }
            return -1;
        }

        function getTime($user)
        {
            $user = mysql_real_escape_string(stripslashes($user));
            $this->query = "SELECT ttl_time FROM marks WHERE user='{$user}'";
            $resp = mysqli_query($conn, $this->query) or die("Unable to send query");
            if( mysqli_num_rows($resp)>0 ) {
                $time_ = mysqli_fetch_assoc($rep)["ttl_time"];
                return $time_;
            }
            return -1;
        }

        function getUsers()
        {
            $users = [];
            $this->query = "SELECT user FROM login";
            $resp = mysqli_query($conn, $this->query) or die("Unable to send query");
            if( mysqli_num_rows($resp)>0 ) {
                while($row = mysqli_fetch_assoc($resp)) {
                    array_push($users, $row["user"]);
                }

                return $users;
            }
            return -1;
        }
    }

  class Competition
    {
      var $file;

      function __construct($name)
      {
          $this->file = $name;
      }
      function setTime()
      {
        $time_start = new DateTime($_POST["start_date"]);
        $duration = $_POST["duration"];

        $time_end = new DateTime($_POST["start_date"]);

        $time_end->add(new DateInterval('PT'.$duration.'M'));

        $time_start = $time_start->format('Y-m-d\TH:i');
        $time_end = $time_end->format('Y-m-d\TH:i');

        $content = $time_start."T".$time_end."T".strval($duration);

        file_put_contents($this->file, $content);
      }

      function getStartDate()
      {
        $cfg = file_get_contents($this->file);
        $arr = preg_split("/T/", $cfg);
        return $arr[0];
      }

      function getStartTime()
      {
        $cfg = file_get_contents($this->file);
        $arr = preg_split("/T/", $cfg);
        return $arr[1];
      }

      function getEndDate()
      {
        $cfg = file_get_contents($this->file);
        $arr = preg_split("/T/", $cfg); 
        return $arr[2];
      }

      function getEndTime()
      {
        $cfg = file_get_contents($this->thifile);
        $arr = preg_split("/T/", $cfg);
        return $arr[3];
      }

      function getDuration()
      {
        $cfg = file_get_contents($this->file);
        $arr = preg_split("/T/", $cfg);
        return $arr[4];
      }
      function getTTS()
      {
          $object = new Competition();
          $startTime = new DateTime($object->getStartDate($file).$object->getStartTime($this->file));
          #$endTime = new DateTime($object->getEndDate($file).$object->getEndTime($file));
          $curTime = new DateTime(date('m/d/Y h:i:s ', time()));

          $interval = $curTime->diff($startTime);

          return $interval;
      }
    }

?>

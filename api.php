<?php
    require "config.php";

    $conn = mysqli_connect($HOST, $USER, $PASS, $DB);

    class Accounts {

        var $hash;
        var $query;

        function verifyData($user, $pass)
        {
            $user = mysql_real_escape_string(stripslashes($user));
            $pass = mysql_real_escape_string(stripslashes($pass));
            $this->hash = hash($ALGO, $SALT.$pass);
            $this->query = "SELECT * FROM login WHERE user='{$user}' AND pass='{$hash}'";
            $resp = mysqli_query($conn, $this->query) or die("Unable to send query");
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

    class Classifier {

    }
?>

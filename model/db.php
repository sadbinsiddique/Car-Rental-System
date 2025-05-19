<?php

    $host = "localhost";
    $dbname = "webtech";
    $dbuser = "root";
    $dbpass = "";

    function getConnection(){
        //global $host;
        global $dbname;
        global $dbuser;
        global $dbpass;

        $con = mysqli_connect($GLOBALS['host'], $dbuser, $dbpass, $dbname);
        return $con;
    }

?>
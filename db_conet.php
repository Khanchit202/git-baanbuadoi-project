<?php
    $db_name = "buadoi";
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $port = 3306;

    try{

        $db_con = new PDO("mysql:host={$db_host};dbname={$db_name};port={$port}",$db_user,$db_pass);
        $db_con->exec("set names utf8");
        

    }catch(PDOException $e){
        echo $e->getMessage();
    }


?>
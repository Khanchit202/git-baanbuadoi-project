<?php
    function connect_db($type="client"){
        if($type=="client"){
            $db_name = "buadoi_db";
            $db_host = "localhost";
            $db_user = "root";
            $db_pass = "";
            $db_port = "3306";
        }else if($type=="server"){
            $db_name = "";
            $db_host = "";
            $db_user = "";
            $db_pass = "";
            $db_port = "";
        }
 
        try {// การเชื่อมต่อแบบ PDO ให้ set โดยห้ามเว้นวรรคจากนี้
            $db_con = new PDO("mysql:host={$db_host}; dbname={$db_name}; port={$db_port}",$db_user,$db_pass);
            $db_con -> exec("set names utf8");
        } catch (PDOException $e) {
            echo $e -> getMessage();
        }

        return $db_con;
    }
?>
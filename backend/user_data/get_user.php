<?php
    // include("../../db_config.php");
    // $db_con = connect_db("client");

    $db_name = "buadoi_db";
    $db_host = "localhost";
    $db_user = "root";
    $db_pass = "";
    $db_port = "3306";

    $db_con = new PDO("mysql:host={$db_host}; dbname={$db_name}; port={$db_port}",$db_user,$db_pass);
    $db_con -> exec("set names utf8");

    $response = array();
    if($_SERVER['REQUEST_METHOD'] == "POST") {
        $sql = "SELECT * FROM users";
        $result = $db_con -> query($sql);
        
        $data = array();

        while ($row = $result -> fetch()) {
            $data[] = $row;
        }

        $response['data'] = $data;
        print_r($data);

    }
    echo json_encode($response);
?>
?>

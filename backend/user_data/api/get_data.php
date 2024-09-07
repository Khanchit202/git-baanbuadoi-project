// getUserData.php
<?php
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

if($_SERVER['REQUEST_METHOD'] == "POST"){

    $sql = "SELECT * FROM users";
    $result = $db_con->query($sql);

    $data = array();
    while($row = $result->fetch()){
        $data[] = $row;

    }
    $response['data'] = $data;
}

echo json_encode($response);
?>

<?php
include("../../../db_config.php");
$response = array();



if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $level = $_POST['level'];
    $userID = $_POST['id'];

    $sql = "UPDATE users SET  userLevelID=? WHERE userID=?";
    $stmt = $db_con->prepare($sql);
    
    $stmt->bindParam(1, $level);
    $stmt->bindParam(2, $userID);

    $result = $stmt->execute();
    if($result){
        $response['status'] = 'ok';
    } else {
        $response['status'] = 'error';
    }
} else {
    $response['status'] = 'no-request';
}

echo json_encode($response);
?>

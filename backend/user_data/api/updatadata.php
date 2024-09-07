<?php

include("../../../db_config.php");
$response = array();

if($_SERVER['REQUEST_METHOD'] == "POST"){
    
    $name = $_POST['name'];
    $fname =$_POST['fname'];
    $lname = $_POST['lname'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $userid = $_POST['id'];
    

    $sql = "UPDATE users SET userName=?,userFName=?,userLName=?,userTel=?,userEmail=? WHERE userID=?";

    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(1,$name);
    $stmt->bindParam(2,$fname);
    $stmt->bindParam(3,$lname);
    $stmt->bindParam(4,$tel);
    $stmt->bindParam(5,$email);
    $stmt->bindParam(6,$userid);

    $result = $stmt->execute();
    if($result){
        $response['status'] = 'ok';

    }else{
        $response['status'] = 'error';

    }

}else{
    $response['status'] = 'no-request';
}

    echo json_encode($response);//เข้ารหัสแบบjson
?>
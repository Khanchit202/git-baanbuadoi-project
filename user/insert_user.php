<?php
    include("../db_conet.php");
    $response = array();
 
if($_SERVER['REQUEST_METHOD'] == "POST"){

    $username = $_POST['username'];
    $pass =$_POST['pass'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $locations = $_POST['location'];

    $sql = "INSERT INTO user (userName,userPass,userFName,userLName,userAge,userGender,userTel,userEmail,userLocation) VALUES(:username,:pass,:fname,:lname,:email,:tel,:age,:gender,:locations)";
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(":username",$username);
    $stmt->bindParam(":pass",$pass);
    $stmt->bindParam(":fname",$fname);
    $stmt->bindParam(":lname",$lname);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":tel",$tel);
    $stmt->bindParam(":age",$age);
    $stmt->bindParam(":gender",$gender);
    $stmt->bindParam(":locations",$locations);
    $result = $stmt->execute();
    if($result){
        $response['status'] = 'ok';
        echo "<script>alert('เพิ่มข้อมูลสำเร็จ');</script>";
    }else{
        $response['status'] = 'error';
        echo "<script>alert('เกิดข้อผิดพลาดในการเพิ่มข้อมูล');</script>";
    }

}
    echo json_encode($response);
?>
<?php
header('Content-Type: application/json'); // เพิ่มบรรทัดนี้เพื่อบอกว่าเนื้อหาที่ส่งกลับเป็น JSON
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();



// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $serviceName = $_POST['serviceName'];
    $serviceDetail = $_POST['serviceDetail'];
    $servicePrice = $_POST['servicePrice'];
    $serviceTotal = $_POST['serviceTotal'];
    $serviceTime = $_POST['serviceTime'];
    $serviceStd = $_POST['serviceStd'];

    // จัดการกับไฟล์รูปภาพ
    $target_dir = "../../../img/service/";
    $new_filename = "service" . uniqid() . "." . pathinfo($_FILES["serviceImg"]["name"], PATHINFO_EXTENSION);
    $target_file = $target_dir . $new_filename;
    if (!move_uploaded_file($_FILES["serviceImg"]["tmp_name"], $target_file)) {
        echo json_encode(["success" => false, "message" => "Failed to upload image."]);
        exit;
    }

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO service_product (serviceName, serviceDetail, servicePrice, serviceTotal,serviceTime, stdID, servicePic)
    VALUES (:serviceName, :serviceDetail, :servicePrice, :serviceTotal,:serviceTime, :serviceStd,  :servicePic)";
    
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(':serviceName', $serviceName);
    $stmt->bindParam(':serviceDetail', $serviceDetail);
    $stmt->bindParam(':servicePrice', $servicePrice);
    $stmt->bindParam(':serviceTotal', $serviceTotal);
    $stmt->bindParam(':serviceTime', $serviceTime);
    $stmt->bindParam(':serviceStd', $serviceStd);
    $stmt->bindParam(':servicePic', $new_filename);

    if($stmt->execute()){
        $response['status'] = 'ok';
    }else{
        $response['status'] = 'error';
        $response['message'] = 'Failed to insert data.';
    }

    echo json_encode($response);
}
?>

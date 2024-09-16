<?php
// เชื่อมต่อกับฐานข้อมูล
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

// รับข้อมูลจากฟอร์ม
$serviceID = $_POST['serviceID'];
$serviceName = $_POST['serviceName'];
$serviceDetail = $_POST['serviceDetail'];
$servicePrice = $_POST['servicePrice'];
$serviceTotal = $_POST['serviceTotal'];
$serviceTime = $_POST['serviceTime'];
$serviceStd = $_POST['serviceStd'];

// ดึงชื่อไฟล์รูปภาพเก่าจากฐานข้อมูล
$stmt = $db_con->prepare("SELECT servicePic FROM service_product WHERE serviceID = :serviceID");
$stmt->bindParam(':serviceID', $serviceID);
$stmt->execute();
$oldImage = $stmt->fetchColumn();

// จัดการการอัปโหลดไฟล์ภาพ
$target_dir = "../../../img/service/";
$new_filename = "service" . uniqid() . "." . pathinfo($_FILES["serviceImg"]["name"], PATHINFO_EXTENSION);
$target_file = $target_dir . $new_filename;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// ตรวจสอบว่าเป็นไฟล์ภาพหรือไม่
$check = getimagesize($_FILES["serviceImg"]["tmp_name"]);
if($check !== false) {
    // ลบไฟล์รูปภาพเก่า
    if (file_exists($target_dir . $oldImage)) {
        unlink($target_dir . $oldImage);
    }

    // อัปโหลดไฟล์รูปภาพใหม่
    if (move_uploaded_file($_FILES["serviceImg"]["tmp_name"], $target_file)) {
        $serviceImg = $new_filename;
    } else {
        header('Content-Type: application/json');
        echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.']);
        exit();
    }
} else {
    header('Content-Type: application/json');
    echo json_encode(['status' => 'error', 'message' => 'File is not an image.']);
    exit();
}

// อัปเดตข้อมูลในฐานข้อมูล
try {
    $stmt = $db_con->prepare("UPDATE service_product SET serviceName = :serviceName, serviceDetail = :serviceDetail, servicePrice = :servicePrice, serviceTotal = :serviceTotal, serviceTime = :serviceTime, stdID = :serviceStd, servicePic = :serviceImg WHERE serviceID = :serviceID");
    $stmt->bindParam(':serviceID', $serviceID);
    $stmt->bindParam(':serviceName', $serviceName);
    $stmt->bindParam(':serviceDetail', $serviceDetail);
    $stmt->bindParam(':servicePrice', $servicePrice);
    $stmt->bindParam(':serviceTotal', $serviceTotal);
    $stmt->bindParam(':serviceTime', $serviceTime);
    $stmt->bindParam(':serviceStd', $serviceStd);
    $stmt->bindParam(':serviceImg', $serviceImg);
    $stmt->execute();

    echo json_encode(['status' => 'success', 'message' => 'แก้ไขข้อมูลบริการเรียบร้อย']);
} catch (PDOException $e) {
   
    echo json_encode(['status' => 'error', 'message' => 'Error updating service data: ' . $e->getMessage()]);
}
?>

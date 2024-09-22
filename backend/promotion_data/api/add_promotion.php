<?php
header('Content-Type: application/json'); // เพิ่มบรรทัดนี้เพื่อบอกว่าเนื้อหาที่ส่งกลับเป็น JSON

include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $addpmtTitle = $_POST['addpmtTitle'];
    $addpmtDetail = $_POST['addpmtDetail'];
    $addpmtCode = $_POST['addpmtCode'];
    $addpmtDiscont = $_POST['addpmtDiscont'];
    $addpmtUnit = $_POST['addpmtUnit'];
    $addpmtDate = $_POST['addpmtDate'];
    $addpmtStartDate = $_POST['addpmtStartDate'];
    $addpmtEndDate = $_POST['addpmtEndDate'];
    $userId = $_POST['adduserId']; // แก้ไขจาก userID เป็น userId

    // จัดการกับไฟล์รูปภาพ
    $target_dir = "../../../img/promotion_pic/";
    $new_filename = "promotion" . uniqid() . "." . pathinfo($_FILES["addpmtImg"]["name"], PATHINFO_EXTENSION);
    $target_file = $target_dir . $new_filename;
    if (!move_uploaded_file($_FILES["addpmtImg"]["tmp_name"], $target_file)) {
        echo json_encode(["success" => false, "message" => "Failed to upload image."]);
        exit;
    }

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO promotions (pmtTitle, pmtDetail, pmtCode, pmtDiscont, pmtUnit,pmtDate,pmtStartDate,pmtEndDate,userId, pmtPic)
    VALUES (:pmtTitle, :pmtDetail, :pmtCode, :pmtDiscont, :pmtUnit, :pmtDate,:pmtStartDate,:pmtEndDate,:userId,:pmtPic)";
    
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(':pmtTitle', $addpmtTitle); // แก้ไขจาก $newTitle เป็น $addpmtTitle
    $stmt->bindParam(':pmtDetail', $addpmtDetail);
    $stmt->bindParam(':pmtCode', $addpmtCode); // แก้ไขจาก $newType เป็น $addpmtCode
    $stmt->bindParam(':pmtDiscont', $addpmtDiscont); // แก้ไขจาก $newDate เป็น $addpmtDate
    $stmt->bindParam(':pmtUnit', $addpmtUnit);
    $stmt->bindParam(':pmtDate', $addpmtDate);
    $stmt->bindParam(':pmtStartDate', $addpmtStartDate);
    $stmt->bindParam(':pmtEndDate', $addpmtEndDate);
    $stmt->bindParam(':userId', $userId);
    $stmt->bindParam(':pmtPic', $new_filename);

    if($stmt->execute()){
        $response['status'] = 'ok';
    }else{
        $response['status'] = 'error';
        $response['message'] = 'Failed to insert data.';
    }

    echo json_encode($response);
}
?>

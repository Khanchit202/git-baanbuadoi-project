<?php
// เชื่อมต่อกับฐานข้อมูล
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

// รับข้อมูลจากฟอร์ม
$newID = $_POST['newID'];
$newTitle = $_POST['newTitle'];
$newDetail = $_POST['newDetail'];
$newType = $_POST['newType'];
$newTime = $_POST['newTime'];
$userID = $_POST['userID'];

// ดึงชื่อไฟล์รูปภาพเก่าจากฐานข้อมูล
$stmt = $db_con->prepare("SELECT newPic FROM news WHERE newID = :newID");
$stmt->bindParam(':newID', $newID);
$stmt->execute();
$oldImage = $stmt->fetchColumn();

// จัดการการอัปโหลดไฟล์ภาพ
$target_dir = "../../../img/news_pic/";
$new_filename = "new" . uniqid() . "." . pathinfo($_FILES["newImg"]["name"], PATHINFO_EXTENSION);
$target_file = $target_dir . $new_filename;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// ตรวจสอบว่าเป็นไฟล์ภาพหรือไม่
$check = getimagesize($_FILES["newImg"]["tmp_name"]);
if($check !== false) {
    // ลบไฟล์รูปภาพเก่า
    if (file_exists($target_dir . $oldImage)) {
        unlink($target_dir . $oldImage);
    }

    // อัปโหลดไฟล์รูปภาพใหม่
    if (move_uploaded_file($_FILES["newImg"]["tmp_name"], $target_file)) {
        $newImg = $new_filename;
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Sorry, there was an error uploading your file.']);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'File is not an image.']);
    exit();
}

// อัปเดตข้อมูลในฐานข้อมูล
try {
    $stmt = $db_con->prepare("UPDATE news SET newTitle = :newTitle, newDetail = :newDetail, newType = :newType, newDate = :newTime, user_userID = :userID, newPic = :newImg WHERE newID = :newID");
    $stmt->bindParam(':newID', $newID);
    $stmt->bindParam(':newTitle', $newTitle);
    $stmt->bindParam(':newDetail', $newDetail);
    $stmt->bindParam(':newType', $newType);
    $stmt->bindParam(':newTime', $newTime);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':newImg', $newImg);
    $stmt->execute();

    echo json_encode(['status' => 'success', 'message' => 'แก้ไขข้อมูลเรียบร้อย']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error updating data: ' . $e->getMessage()]);
}
?>

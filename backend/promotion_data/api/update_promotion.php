<?php
header('Content-Type: application/json'); // เพิ่มบรรทัดนี้เพื่อบอกว่าเนื้อหาที่ส่งกลับเป็น JSON

include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

// รับข้อมูลจากฟอร์ม
$pmtID = $_POST['pmtID'];
$pmtTitle = $_POST['pmtTitle'];
$pmtDetail = $_POST['pmtDetail'];
$pmtCode = $_POST['pmtCode'];
$pmtDiscont = $_POST['pmtDiscont'];
$pmtUnit = $_POST['pmtUnit'];
$pmtDate = $_POST['pmtDate'];
$pmtStartDate = $_POST['pmtStartDate'];
$pmtEndDate = $_POST['pmtEndDate'];
$userID = $_POST['userID'];

// ดึงชื่อไฟล์รูปภาพเก่าจากฐานข้อมูล
$stmt = $db_con->prepare("SELECT pmtPic FROM promotions WHERE pmtID = :pmtID");
$stmt->bindParam(':pmtID', $pmtID);
$stmt->execute();
$oldImage = $stmt->fetchColumn();

// จัดการการอัปโหลดไฟล์ภาพ
$target_dir = "../../../img/promotion_pic/";
$new_filename = "pmt" . uniqid() . "." . pathinfo($_FILES["pmtImg"]["name"], PATHINFO_EXTENSION);
$target_file = $target_dir . $new_filename;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// ตรวจสอบว่าเป็นไฟล์ภาพหรือไม่
$check = getimagesize($_FILES["pmtImg"]["tmp_name"]);
if($check !== false) {
    // ลบไฟล์รูปภาพเก่า
    if (file_exists($target_dir . $oldImage)) {
        unlink($target_dir . $oldImage);
    }

    // อัปโหลดไฟล์รูปภาพใหม่
    if (move_uploaded_file($_FILES["pmtImg"]["tmp_name"], $target_file)) {
        $pmtImg = $new_filename;
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
    $stmt = $db_con->prepare("UPDATE promotions SET pmtTitle = :pmtTitle, pmtDetail = :pmtDetail, pmtCode = :pmtCode, pmtDiscont = :pmtDiscont, pmtUnit = :pmtUnit, pmtDate = :pmtDate, pmtStartDate = :pmtStartDate, pmtEndDate = :pmtEndDate, userID = :userID, pmtPic = :pmtImg WHERE pmtID = :pmtID");
    $stmt->bindParam(':pmtID', $pmtID);
    $stmt->bindParam(':pmtTitle', $pmtTitle);
    $stmt->bindParam(':pmtDetail', $pmtDetail);
    $stmt->bindParam(':pmtCode', $pmtCode);
    $stmt->bindParam(':pmtDiscont', $pmtDiscont);
    $stmt->bindParam(':pmtUnit', $pmtUnit);
    $stmt->bindParam(':pmtDate', $pmtDate);
    $stmt->bindParam(':pmtStartDate', $pmtStartDate);
    $stmt->bindParam(':pmtEndDate', $pmtEndDate);
    $stmt->bindParam(':userID', $userID);
    $stmt->bindParam(':pmtImg', $pmtImg);
    $stmt->execute();

    echo json_encode(['status' => 'success', 'message' => 'แก้ไขข้อมูลเรียบร้อย']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error updating data: ' . $e->getMessage()]);
}
?>

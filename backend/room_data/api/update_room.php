<?php
// เชื่อมต่อกับฐานข้อมูล
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

// รับข้อมูลจากฟอร์ม
$roomID = $_POST['roomID'];
$roomName = $_POST['roomName'];
$roomDetail = $_POST['roomDetail'];
$roomBed = $_POST['roomBed'];
$roomBath = $_POST['roomBath'];
$roomLo = $_POST['roomLo'];
$roomMax = $_POST['roomMax'];
$roomMin = $_POST['roomMin'];
$roomPrice = $_POST['roomPrice'];
$roomStd = $_POST['roomStd'];

// ดึงชื่อไฟล์รูปภาพเก่าจากฐานข้อมูล
$stmt = $db_con->prepare("SELECT roomPic FROM room_product WHERE roomID = :roomID");
$stmt->bindParam(':roomID', $roomID);
$stmt->execute();
$oldImage = $stmt->fetchColumn();

// จัดการการอัปโหลดไฟล์ภาพ
$target_dir = "../../../img/room_pic/";
$new_filename = "room" . uniqid() . "." . pathinfo($_FILES["roomImg"]["name"], PATHINFO_EXTENSION);
$target_file = $target_dir . $new_filename;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// ตรวจสอบว่าเป็นไฟล์ภาพหรือไม่
$check = getimagesize($_FILES["roomImg"]["tmp_name"]);
if($check !== false) {
    // ลบไฟล์รูปภาพเก่า
    if (file_exists($target_dir . $oldImage)) {
        unlink($target_dir . $oldImage);
    }

    // อัปโหลดไฟล์รูปภาพใหม่
    if (move_uploaded_file($_FILES["roomImg"]["tmp_name"], $target_file)) {
        $roomImg = $new_filename;
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
    $stmt = $db_con->prepare("UPDATE room_product SET roomName = :roomName, roomDetail = :roomDetail, roomBed = :roomBed, roomBath = :roomBath, roomLocation = :roomLo, roomMax = :roomMax, roomMin = :roomMin, roomPrice = :roomPrice, stdID = :roomStd, roomPic = :roomImg WHERE roomID = :roomID");
    $stmt->bindParam(':roomID', $roomID);
    $stmt->bindParam(':roomName', $roomName);
    $stmt->bindParam(':roomDetail', $roomDetail);
    $stmt->bindParam(':roomBed', $roomBed);
    $stmt->bindParam(':roomBath', $roomBath);
    $stmt->bindParam(':roomLo', $roomLo);
    $stmt->bindParam(':roomMax', $roomMax);
    $stmt->bindParam(':roomMin', $roomMin);
    $stmt->bindParam(':roomPrice', $roomPrice);
    $stmt->bindParam(':roomStd', $roomStd);
    $stmt->bindParam(':roomImg', $roomImg);
    $stmt->execute();

    echo json_encode(['status' => 'success', 'message' => 'แก้ไขข้อมูลห้องพักเรียบร้อย']);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error updating room data: ' . $e->getMessage()]);
}
?>

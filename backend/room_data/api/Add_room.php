<?php
header('Content-Type: application/json'); // เพิ่มบรรทัดนี้เพื่อบอกว่าเนื้อหาที่ส่งกลับเป็น JSON
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();



// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomName = $_POST['roomName'];
    $roomDetail = $_POST['roomDetail'];
    $roomBed = $_POST['roomBed'];
    $roomBath = $_POST['roomBath'];
    $roomLo = $_POST['roomLo'];
    $roomMax = $_POST['roomMax'];
    $roomMin = $_POST['roomMin'];
    $roomPrice = $_POST['roomPrice'];
    $roomStd = $_POST['roomStd'];

    // จัดการกับไฟล์รูปภาพ
    $target_dir = "../../../img/room_pic/";
    $new_filename = "room" . uniqid() . "." . pathinfo($_FILES["roomImage"]["name"], PATHINFO_EXTENSION);
    $target_file = $target_dir . $new_filename;
    if (!move_uploaded_file($_FILES["roomImage"]["tmp_name"], $target_file)) {
        echo json_encode(["success" => false, "message" => "Failed to upload image."]);
        exit;
    }

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO room_product (roomName, roomDetail, roomBed, roomBath,roomLocation, roomMax, roomMin, roomPrice, stdID, roomPic)
    VALUES (:roomName, :roomDetail, :roomBed, :roomBath,:roomLo, :roomMax, :roomMin, :roomPrice, :roomStd, :roomPic)";
    
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(':roomName', $roomName);
    $stmt->bindParam(':roomDetail', $roomDetail);
    $stmt->bindParam(':roomBed', $roomBed);
    $stmt->bindParam(':roomBath', $roomBath);
    $stmt->bindParam(':roomLo', $roomLo);
    $stmt->bindParam(':roomMax', $roomMax);
    $stmt->bindParam(':roomMin', $roomMin);
    $stmt->bindParam(':roomPrice', $roomPrice);
    $stmt->bindParam(':roomStd', $roomStd);
    $stmt->bindParam(':roomPic', $new_filename);

    if($stmt->execute()){
        $response['status'] = 'ok';
    }else{
        $response['status'] = 'error';
        $response['message'] = 'Failed to insert data.';
    }

    echo json_encode($response);
}
?>

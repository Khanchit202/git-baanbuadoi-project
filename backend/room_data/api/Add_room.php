<?php
header('Content-Type: application/json'); // เพิ่มบรรทัดนี้เพื่อบอกว่าเนื้อหาที่ส่งกลับเป็น JSON
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

// ตรวจสอบการเชื่อมต่อ
if ($db_con->connect_error) {
    die(json_encode(["success" => false, "message" => "Connection failed: " . $db_con->connect_error]));
}

// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roomName = $_POST['roomName'];
    $roomDetail = $_POST['roomDetail'];
    $roomBed = $_POST['roomBed'];
    $roomBath = $_POST['roomBath'];
    $roomMax = $_POST['roomMax'];
    $roomMin = $_POST['roomMin'];
    $roomPrice = $_POST['roomPrice'];
    $roomStd = $_POST['roomStd'];

    // จัดการกับไฟล์รูปภาพ
    $target_dir = "../../../img/room_pic/";
    $target_file = $target_dir . basename($_FILES["roomImage"]["name"]);
    move_uploaded_file($_FILES["roomImage"]["tmp_name"], $target_file);

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO room_product (roomName, roomDetail, roomBed, roomBath, roomMax, roomMin, roomPrice, stdID, roomPic)
    VALUES ('$roomName', '$roomDetail', '$roomBed', '$roomBath', '$roomMax', '$roomMin', '$roomPrice', '$roomStd', '$target_file')";

    if ($db_con->query($sql) === TRUE) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "message" => "Error: " . $sql . "<br>" . $db_con->error]);
    }

    $db_con->close();
}
?>

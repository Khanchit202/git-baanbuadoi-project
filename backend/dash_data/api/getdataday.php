<?php
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

// ตรวจสอบการเชื่อมต่อ
if ($db_con->connect_error) {
    die("Connection failed: " . $db_con->connect_error);
}

// ดึงวันที่ปัจจุบัน
$current_date = date('Y-m-d');

// สร้าง SQL query เพื่อดึงข้อมูลและนับจำนวน โดยกรองตามวันที่ปัจจุบัน
$sql = "SELECT roomID, COUNT(*) as room_count, serviceID, COUNT(*) as service_count 
        FROM booking_payment 
        WHERE DATE(booking_date) = '$current_date' 
        GROUP BY roomID, serviceID";
$result = $db_con->query($sql);

$data = array();
$labels = array();
$room_counts = array();
$service_counts = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $labels[] = "Room " . $row["roomID"] . " - Service " . $row["serviceID"];
        $room_counts[] = $row["room_count"];
        $service_counts[] = $row["service_count"];
    }
}

$data['labels'] = $labels;
$data['room_counts'] = $room_counts;
$data['service_counts'] = $service_counts;

echo json_encode($data);

$db_con->close();
?>

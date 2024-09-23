<?php
include ("../db_config.php");
$db_con = connect_db();

$serId = $_POST['serviceId'];
$bookingDate = $_POST['bookingDate'];
$bookingTime = $_POST['bookingTime'];

// รวมวันที่และเวลาสำหรับการจอง
$datetime = $bookingDate . " " . $bookingTime;

// แปลงวันที่เป็น timestamp
$bookingTimestamp = strtotime($datetime);
$currentTimestamp = strtotime(date("Y-m-d H:i:s"));

if ($bookingTimestamp < $currentTimestamp) {
    echo "oldday";
} else {
    // ตรวจสอบว่ามีการจองในวันที่และเวลานี้หรือไม่
    $query = $db_con->prepare("
        SELECT * FROM booking
        WHERE serviceID = :serviceId
        AND bookCancel != 1
        AND bookDateStart = :bookingDateTime
    ");

    $query->bindParam(':serviceId', $serId);
    $query->bindParam(':bookingDateTime', $datetime); // ใช้ $datetime ที่รวมวันที่และเวลา
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo "booked";
    } else {
        echo "available";
    }
}
?>

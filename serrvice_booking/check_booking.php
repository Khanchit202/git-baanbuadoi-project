<?php
include ("../db_config.php");
$db_con = connect_db();

$roomId = $_POST['roomId'];
$bookingDate = $_POST['bookingDate'];

$bookingTimestamp = strtotime($bookingDate);
$currentTimestamp = strtotime(date("Y-m-d"));

// ตรวจสอบหากวันที่ที่รับมาผ่านมาแล้ว
if ($bookingTimestamp < $currentTimestamp) {
    echo "oldday";
} else {
    // ตรวจสอบข้อมูลการจอง
    $query = $db_con->prepare("
        SELECT * FROM booking
        WHERE roomID = :roomId 
        AND bookCancel != 1
        AND DATE(bookDateStart) = :bookingDate
    ");

    $query->bindParam(':roomId', $roomId);
    $query->bindValue(':bookingDate', $bookingDate);
    $query->execute();
    $result = $query->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        echo "booked";
    } else {
        echo "available";
    }
}
?>

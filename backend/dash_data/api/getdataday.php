<?php
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

// ตรวจสอบการเชื่อมต่อ
if ($db_con->connect_error) {
    die("Connection failed: " . $db_con->connect_error);
}

// ดึงวันที่ปัจจุบัน
$dates = date('Y-m-d'); // กำหนดวันที่ปัจจุบันและเวลา 14:00:00
$bookingdaygaf = $db_con->query("SELECT roomID FROM booking_payment WHERE payDate = '$dates'");
$bookingdaygafArray = $bookingdaygaf->fetchAll(PDO::FETCH_ASSOC);
$numberOfbookingdaygafArray = count($bookingdaygafArray);

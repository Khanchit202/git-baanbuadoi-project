<?php
// เชื่อมต่อกับฐานข้อมูล
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

// รับข้อมูลจากฟอร์ม
$payID = $_POST['payID'];
$payStatus = $_POST['status'];

// อัปเดตข้อมูลในฐานข้อมูล
try {
    $stmt = $db_con->prepare("UPDATE booking_payment SET payStatus = :payStatus WHERE payID = :payID");
    $stmt->bindParam(':payID', $payID);
    $stmt->bindParam(':payStatus', $payStatus);
    $stmt->execute();

    $response['status'] = 'success';
    $response['message'] = 'อัปเดตสถานะการชำระเงินเรียบร้อย';
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = 'Error updating payment status: ' . $e->getMessage();
}

echo json_encode($response);
?>

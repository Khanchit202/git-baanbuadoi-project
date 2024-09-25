<?php
// เชื่อมต่อกับฐานข้อมูล
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

// รับข้อมูลจากฟอร์ม
$payID = $_POST['payID'];
$payStatus = $_POST['paystatus'];
$billStatus = $_POST['billstatus'];

// เริ่มต้นการทำธุรกรรม
$db_con->beginTransaction();

try {
    // อัปเดต payStatus ในตาราง booking_payment
    $stmt = $db_con->prepare("UPDATE booking_payment SET payStatus = :payStatus WHERE payID = :payID");
    $stmt->bindParam(':payID', $payID);
    $stmt->bindParam(':payStatus', $payStatus);
    $stmt->execute();

    // อัปเดต billStatus ในตาราง booking_bill
    $stmt = $db_con->prepare("UPDATE booking_bill SET billStatus = :billStatus WHERE payID = :payID");
    $stmt->bindParam(':payID', $payID);
    $stmt->bindParam(':billStatus', $billStatus);
    $stmt->execute();

    // ยืนยันการทำธุรกรรม
    $db_con->commit();

    $response['status'] = 'success';
    $response['message'] = 'อัปเดตสถานะการชำระเงินและบิลเรียบร้อย';
} catch (PDOException $e) {
    // ยกเลิกการทำธุรกรรมหากเกิดข้อผิดพลาด
    $db_con->rollBack();
    $response['status'] = 'error';
    $response['message'] = 'Error updating payment and bill status: ' . $e->getMessage();
}

echo json_encode($response);
?>

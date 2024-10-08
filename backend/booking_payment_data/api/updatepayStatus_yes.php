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

$queryLastBill = $db_con->prepare("
    SELECT p.*,  u.userEmail, u.userName
    FROM booking_payment p
    INNER JOIN users u ON p.userID = u.userID 
    WHERE p.payID = :payID
");

$queryLastBill->bindParam(':payID', $payID);
$queryLastBill->execute();
$lastBill = $queryLastBill->fetch(PDO::FETCH_ASSOC);

function formatThaiDate($dateString) {
    // แปลงสตริงวันที่เป็นออบเจ็กต์ DateTime
    $date = new DateTime($dateString);
    
    // กำหนดรูปแบบเดือนที่คุณต้องการ
    $thaiMonth = [
        '01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม',
        '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน',
        '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน',
        '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'
    ];
    
    // ดึงวันที่ ปี เดือน และเวลา
    $day = $date->format('d');
    $month = $date->format('m');
    $year = $date->format('Y') + 543;
    $time = $date->format('H:i');
    
    // สร้างวันที่ในรูปแบบไทยพร้อมเวลา
    return "{$day} {$thaiMonth[$month]} {$year} เวลา {$time} น.";
}
if ($lastBill) {
    $to = $lastBill['userEmail'];
    $subject = "การจองสำเร็จ";
    $message = "เรียนคุณ: " . $lastBill['userName'] . "\n" .
               "การชำระเงินของคุณถูกตรวจสอบแล้ว! รายละเอียดการจองของคุณ: \n\n" .
               "ผลการตรวจสอบ: การชำระเงินถูกต้อง \n\n" .
               "ตรวจสอบสถานะ" . "\n" .
               "ไปยังหน้าเว็บไซต์: https://baabbuadoi.com" . "\n\n" .
               "ขอบพระคุณที่ใช้บริการ" . "\n" .
               "สอบถามเพิ่ม: 0958053137" . "\n" .
               "หรือ Email: Khanchit202@gmail.com\n\n";

    $message = wordwrap($message, 150);

    mail($to, $subject, $message);
        
    }

echo json_encode($response);
?>

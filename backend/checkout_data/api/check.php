<?php
session_start();
include("../../../db_config.php");
$db_con = connect_db("client");

if (isset($_POST['billID'])) {
    $billID = $_POST['billID'];
    $currentTime = date("Y-m-d H:i:s");

    $query = $db_con->prepare("UPDATE checking SET checkStatus = 2, checkDate = :checkDate WHERE billID = :billID");
    $query->bindParam(':billID', $billID);
    $query->bindParam(':checkDate', $currentTime);

    if ($query->execute()) {
        echo "success";
    } else {
        echo "error";
    }


    $queryLastBill = $db_con->prepare("
        SELECT bb.*,  u.userEmail, u.userName, r.roomName
        FROM booking_bill bb 
        INNER JOIN users u ON bb.userID = u.userID
        INNER JOIN room_product r ON bb.roomID = r.roomID
        WHERE bb.billID = :billID
    ");

$queryLastBill->bindParam(':billID', $billID);
$queryLastBill->execute();
$lastBill = $queryLastBill->fetch(PDO::FETCH_ASSOC);

$currentDateTime = date('Y-m-d H:i:s');


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
    $subject = "มีการเช็คเอาท์";
    $message = "เรียนคุณ: " . $lastBill['userName'] . "\n" .
               "การจองชื่อ: ".$lastBill['roomName']." ของคุณ \n\n" .
               "สถานะ: เช็คเอาท์ \n" .
               "เมื่อ ". formatThaiDate($currentDateTime) ."" . "\n\n" .
               "โปรดไปยังหน้าเว็บไซต์ เพื่อรีวิว" . " \n\n" .
               "ไปยังหน้าเว็บไซต์: https://baanbuadoi.com/index.php" . "\n\n" .
               "ขอบพระคุณที่ใช้บริการ" . "\n" .
               "สอบถามเพิ่ม: 0958053137" . "\n" .
               "หรือ Email: Khanchit202@gmail.com\n\n";

    $message = wordwrap($message, 150);

    mail($to, $subject, $message);
        
    }

}
?>

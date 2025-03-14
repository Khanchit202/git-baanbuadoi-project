<?php
include ("../db_config.php");
session_start();

try {
    $db_con = connect_db();

    $serviceId = $_POST['serviceId'];
    $customerName = $_POST['name'];
    $customerPhone = $_POST['phone'];
    $bookingDate = $_POST['date'];
    $bookingPrice = $_POST['price'];
    $bookingDetail = $_POST['detail'];
    $bookingTime = $_POST['time'];

    $datetime = $bookingDate . " " . $bookingTime;

    $pay = $_POST['pay'];
    // $bookingPro = isset($_POST['promotion']) ? $_POST['promotion'] : '00000';
        // $roomId = "00015";
        // $customerName = "ครรชิต บางพระ";
        // $customerPhone = "000000";
        // $bookingDate = "2024-09-09";
        // $bookingPrice = 999;
        // $bookingDetail ="ไม่มี";
        $bookingPro = 00001;
        $userId = $_SESSION['userID'];
        $roomId = 00007;
        $now = date('Y-m-d H:i:s');
   
    $dateStart = new DateTime($bookingDate);
    $dateEnd = $dateStart->add(new DateInterval('P1D'));
    $bookingDateEnd = $dateEnd->format('Y-m-d') . ' 11:00:00';

    $query = $db_con->prepare("
        INSERT INTO booking (bookName, bookTel, bookDateStart, bookDateEnd, bookPrice, bookDetail, bookDate, bookConfirm, bookStatus, bookCancel, userID, pmtID, roomID, serviceID, bookType) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $query->bindParam(1, $customerName);
    $query->bindParam(2, $customerPhone);
    $query->bindValue(3, $datetime);
    $query->bindParam(4, $bookingDateEnd);
    $query->bindParam(5, $bookingPrice);
    $query->bindParam(6, $bookingDetail);
    $query->bindValue(7, $now);
    $query->bindValue(8, 1);
    $query->bindValue(9, 1);
    $query->bindValue(10, 0);
    $query->bindParam(11, $userId);
    $query->bindParam(12, $bookingPro);
    $query->bindParam(13, $roomId);
    $query->bindParam(14, $serviceId);
    $query->bindValue(15, 2);
    $query->execute();
    
    $lastInsertId = $db_con->lastInsertId();

    $queryPayment = $db_con->prepare("
        INSERT INTO booking_payment (bookID, userID, serviceID, payType, payStatus) 
        VALUES (?, ?, ?, ?, ?)
    ");

    $queryPayment->bindParam(1, $lastInsertId);
    $queryPayment->bindParam(2, $userId);
    $queryPayment->bindParam(3, $serviceId);
    $queryPayment->bindParam(4, $pay);
    $queryPayment->bindValue(5, 0);
    $queryPayment->execute();

    $lastPayId = $db_con->lastInsertId();


    $queryBill = $db_con->prepare("
        INSERT INTO booking_bill (bookID, userID, serviceID, payID) 
        VALUES (?, ?, ?, ?)
    ");

    $queryBill->bindParam(1, $lastInsertId);
    $queryBill->bindParam(2, $userId);
    $queryBill->bindParam(3, $serviceId);
    $queryBill->bindParam(4, $lastPayId);
    $queryBill->execute();


       // ดึงข้อมูลล่าสุดจาก booking_bill
       $queryLastBill = $db_con->prepare("
       SELECT bb.*, u.userEmail, r.serviceName , b.bookDateStart, b.bookDateEnd
       FROM booking_bill bb 
       INNER JOIN users u ON bb.userID = u.userID 
       INNER JOIN service_product r ON bb.serviceID = r.serviceID 
       INNER JOIN booking b ON bb.bookID = b.bookID
       WHERE bb.billID = (SELECT MAX(billID) FROM booking_bill WHERE userID = ?)
   ");
   
   $queryLastBill->bindParam(1, $userId);
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
       $message = "เรียนคุณ: " . $customerName . "\n" .
                  "การจองของคุณสำเร็จ! รายละเอียดการจองของคุณ: \n\n" .
                  "ชื่อรายการ: " .  $lastBill['serviceName'] . "\n" .
                  "วันที่เริ่ม: " . formatThaiDate($lastBill['bookDateStart']) . "\n" .
                  "วันที่สิ้นสุด: " . formatThaiDate($lastBill['bookDateEnd']) . "\n" .
                  "ราคา: " . $price . "\tบาท\n" .
                  "รายละเอียด: " . $bookingDetail . "\n\n" .
                  "โปรดดำเนินการชำระเงิน" . "\n" .
                  "ไปยังหน้าเว็บไซต์: https://baanbuadoi.com/index.php" . "\n\n" .
                  "ขอบพระคุณที่ใช้บริการ" . "\n" .
                  "สอบถามเพิ่ม: 0958053137" . "\n" .
                  "หรือ Email: Khanchit202@gmail.com\n\n";
   
       $message = wordwrap($message, 70);
   
       mail($to, $subject, $message);
           
       }
   

    echo json_encode(['status' => 'success', 'payID' => $lastPayId]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

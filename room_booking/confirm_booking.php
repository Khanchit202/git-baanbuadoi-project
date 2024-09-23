<?php
include ("../db_config.php");
session_start();

try {
    $db_con = connect_db();

    $roomId = $_POST['roomId'];
    $customerName = $_POST['name'];
    $customerPhone = $_POST['phone'];
    $bookingDate = $_POST['date'];
    $bookingPrice = $_POST['price'];
    $bookingDetail = $_POST['detail'];
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
        $serviceId = 00001;
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
    $query->bindValue(3, $bookingDate . ' 14:00:00');
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
    $query->bindValue(15, 1);
    $query->execute();
    
    $lastInsertId = $db_con->lastInsertId();

    $queryPayment = $db_con->prepare("
        INSERT INTO booking_payment (bookID, userID, roomID, payType, payStatus) 
        VALUES (?, ?, ?, ?, ?)
    ");

    $queryPayment->bindParam(1, $lastInsertId);
    $queryPayment->bindParam(2, $userId);
    $queryPayment->bindParam(3, $roomId);
    $queryPayment->bindParam(4, $pay);
    $queryPayment->bindValue(5, 0);
    $queryPayment->execute();

    $lastPayId = $db_con->lastInsertId();


    $queryBill = $db_con->prepare("
        INSERT INTO booking_bill (bookID, userID, roomID, payID) 
        VALUES (?, ?, ?, ?)
    ");

    $queryBill->bindParam(1, $lastInsertId);
    $queryBill->bindParam(2, $userId);
    $queryBill->bindParam(3, $roomId);
    $queryBill->bindParam(4, $lastPayId);
    $queryBill->execute();

    echo json_encode(['status' => 'success', 'payID' => $lastPayId]);
} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
}

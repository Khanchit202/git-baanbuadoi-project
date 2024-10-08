<?php
include ("../../db_config.php");

if (isset($_GET['payId'])) {
    $payId = (string) $_GET['payId'];
} else if (isset($_POST['payId'])) {
    $payId = (string) $_POST['payId'];
} else {
    $payId = null;
}

try {
    $db_con = connect_db();

    $name = $_POST['qrname'];
    $date = $_POST['qrdate'];
    $bank = $_POST['qrbank'];
    $price = $_POST['qrprice'];

    // จัดการการอัปโหลดไฟล์ภาพ
    $target_dir = "../../backend/booking_payment_data/api/slip/";
    $new_filename = "qrpay" . uniqid() . "." . pathinfo($_FILES["payment_receipt"]["name"], PATHINFO_EXTENSION);
    $target_file = $target_dir . $new_filename;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    if (move_uploaded_file($_FILES["payment_receipt"]["tmp_name"], $target_file)) {
        // ไฟล์ถูกอัปโหลดสำเร็จ
        $receiptPath = $new_filename;
    } else {
        throw new Exception('เกิดข้อผิดพลาดในการย้ายไฟล์ที่อัปโหลด.');
    }

    $sql = "UPDATE booking_payment
            SET payNameAc = ?, payDate = ?, payManey = ?, payBank = ?, payStatus = ?, payPic = ?
            WHERE payID = ?";

    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(1, $name);
    $stmt->bindValue(2, $date . ' 12:00:00');
    $stmt->bindParam(3, $price);
    $stmt->bindParam(4, $bank);
    $stmt->bindValue(5, 1);
    $stmt->bindParam(6, $receiptPath);
    $stmt->bindParam(7, $payId);
    $stmt->execute();

    echo "success";
} catch (PDOException $e) {
    echo "error: " . $e->getMessage();
} catch (Exception $e) {
    echo "error: " . $e->getMessage();
}
?>

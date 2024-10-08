<?php
header('Content-Type: application/json'); // แจ้งว่าเนื้อหาที่ส่งกลับเป็น JSON
include("../../../db_config.php");
$db_con = connect_db("client");

$response = array();

// ตรวจสอบว่ามีข้อมูลที่ต้องการหรือไม่
if (isset($_POST['rvsScore'], $_POST['rvsDetail'], $_POST['serviceID'], $_POST['checkID'], $_POST['userID'], $_POST['billID'], $_POST['rvsDate'])) {
    

    $rvsScore = $_POST['rvsScore'];
    $rvsDetail = $_POST['rvsDetail'];
    $serviceID = $_POST['serviceID'];
    $checkID = $_POST['checkID'];
    $userID = $_POST['userID'];
    $billID = $_POST['billID'];
    $rvsDate = $_POST['rvsDate'];

    // ตรวจสอบว่าค่ารายการที่รับมาถูกต้อง
    if (!empty($rvsScore) && !empty($rvsDetail)) {
        try {
            // เตรียมคำสั่ง SQL สำหรับบันทึกรีวิว
            $sql = "INSERT INTO reviws_service (rvsDetail, rvsScore, rvsDate, serviceID, checkID, userID, billID) VALUES (:rvsDetail, :rvsScore, :rvsDate, :serviceID, :checkID, :userID, :billID)";
            $stmt = $db_con->prepare($sql);
            $stmt->bindParam(':rvsDetail', $rvsDetail);
            $stmt->bindParam(':rvsScore', $rvsScore);
            $stmt->bindParam(':rvsDate', $rvsDate);
            $stmt->bindParam(':serviceID', $serviceID);
            $stmt->bindParam(':checkID', $checkID);
            $stmt->bindParam(':userID', $userID);
            $stmt->bindParam(':billID', $billID);

            // Execute the statement and check if it was successful
            if ($stmt->execute()) {
                // ถ้าบันทึกสำเร็จ
                $response['status'] = 'success';
                $response['message'] = 'รีวิวของคุณถูกส่งเรียบร้อยแล้ว!';
            } else {
                // ถ้าการบันทึกล้มเหลว
                $response['status'] = 'error';
                $response['message'] = 'ไม่สามารถบันทึกข้อมูลได้';
            }
        } catch (PDOException $e) {
            // ถ้ามีข้อผิดพลาดในการบันทึก
            $response['status'] = 'error';
            $response['message'] = 'เกิดข้อผิดพลาดในการบันทึกรีวิว: ' . $e->getMessage();
        }
    } else {
        // ถ้าค่ารายการไม่ถูกต้อง
        $response['status'] = 'error';
        $response['message'] = 'กรุณากรอกคะแนนและความคิดเห็นให้ครบถ้วน';
    }
} else {
    // ถ้าข้อมูลไม่ถูกส่งมา
    $response['status'] = 'error';
    $response['message'] = 'ข้อมูลไม่ถูกส่งมา';
}

// ส่งการตอบกลับกลับไปยังผู้ใช้
echo json_encode($response);
?>


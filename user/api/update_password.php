<?php
session_start();
include("../../db_config.php");
$db_con = connect_db("client"); // เชื่อมต่อฐานข้อมูล
$response = array();

header('Content-Type: application/json'); // เพิ่มบรรทัดนี้เพื่อระบุว่าเนื้อหาที่ส่งกลับเป็น JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userID = $_POST['userID'];
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];

    // ตรวจสอบรหัสผ่านปัจจุบัน
    $sql = "SELECT userPass FROM users WHERE userID = :userID";
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(':userID', $userID);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (password_verify($currentPassword, $user['userPass'])) {
        // อัปเดตรหัสผ่านใหม่
        $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET userPass = :newPassword WHERE userID = :userID";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(':newPassword', $newPasswordHash);
        $stmt->bindParam(':userID', $userID);
        if ($stmt->execute()) {
            echo json_encode(['message' => 'รหัสผ่านถูกเปลี่ยนเรียบร้อยแล้ว']);
        } else {
            echo json_encode(['message' => 'เกิดข้อผิดพลาดในการเปลี่ยนรหัสผ่าน']);
        }
    } else {
        echo json_encode(['message' => 'รหัสผ่านปัจจุบันไม่ถูกต้อง']);
    }
}
?>

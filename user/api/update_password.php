<?php
session_start();
include("../../db_config.php");
$db_con = connect_db("client");
$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $currentPassword = $_POST['currentPassword'];
    $newPassword = $_POST['newPassword'];
    $userId = $_SESSION['userId']; // สมมติว่ามีการเก็บ userId ใน session

    // ตรวจสอบรหัสผ่านปัจจุบัน
    $sql = "SELECT userPass FROM users WHERE userId = ?";
    $stmt = $db_con->prepare($sql);
    $stmt->bind_param("userId", $userId);
    $stmt->execute();
    $stmt->bind_result($hashedPassword);
    $stmt->fetch();
    $stmt->close();

    if (password_verify($currentPassword, $hashedPassword)) {
        // อัปเดตรหัสผ่านใหม่
        $newHashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $sql = "UPDATE users SET userPass = ? WHERE userId = ?";
        $stmt = $db_con->prepare($sql);
        $stmt->bind_param("si", $newHashedPassword, $userId);
        if ($stmt->execute()) {
            echo json_encode(array("status" => "success", "message" => "รหัสผ่านถูกอัปเดตเรียบร้อยแล้ว"));
        } else {
            echo json_encode(array("status" => "error", "message" => "เกิดข้อผิดพลาดในการอัปเดตรหัสผ่าน"));
        }
        $stmt->close();
    } else {
        echo json_encode(array("status" => "error", "message" => "รหัสผ่านปัจจุบันไม่ถูกต้อง"));
    }
}
?>

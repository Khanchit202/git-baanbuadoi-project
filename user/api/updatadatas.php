<?php
session_start();
include("../../db_config.php");
$db_con = connect_db("client");

$response = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];
    $userId = $_POST['userId']; // รับค่า userId จาก POST

    try {
        $sql = "UPDATE users SET userName = :username, userFName = :fname, userLName = :lname, userTel = :tel, userEmail = :email WHERE userID = :userId";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
        $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
        $stmt->bindParam(':tel', $tel, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'ข้อมูลถูกอัปเดตเรียบร้อยแล้ว';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'เกิดข้อผิดพลาดในการอัปเดตข้อมูล';
        }
    } catch (PDOException $e) {
        $response['status'] = 'error';
        $response['message'] = 'เกิดข้อผิดพลาด: ' . $e->getMessage();
    }

    echo json_encode($response);
}
?>

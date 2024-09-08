<?php
include("../../db_config.php");
$db_con = connect_db("client");
$response = array();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // รับค่าจากฟอร์ม
    $username = $_POST['username'];
    $password = $_POST['password'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $tel = $_POST['tel'];
    $email = $_POST['email'];

    // เชื่อมต่อฐานข้อมูล
    try {
        // เตรียมและดำเนินการคำสั่ง SQL
        $sql = "UPDATE users SET userPass = :password, userFName = :fname, userLName = :lname, userTel = :tel, userEmail = :email WHERE userName = :username";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':tel', $tel);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $response['status'] = 'success';
        
    } catch (PDOException $e) {
        $response['status'] = 'error';
        $response['message'] = 'Error: ' . $e->getMessage();
    }

    // ปิดการเชื่อมต่อ
    $db_con = null;
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

// ส่งการตอบกลับในรูปแบบ JSON
header('Content-Type: application/json');
echo json_encode($response);
?>

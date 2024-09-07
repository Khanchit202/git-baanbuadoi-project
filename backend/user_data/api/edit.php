<?php

include("../../../db_config.php");

try {
    // เชื่อมต่อกับฐานข้อมูล
    $db_con = connect_db("client");
    $db_con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $response = array();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        $userPass = password_hash('123456', PASSWORD_DEFAULT); // ใช้ password_hash เพื่อความปลอดภัย
        $userID = $_POST['userID'];

        $sql = "UPDATE users SET userPass = :userPass WHERE userID = :userID";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(':userPass', $userPass);
        $stmt->bindParam(':userID', $userID);

        $result = $stmt->execute();
        if ($result) {
            $response['status'] = 'ok';
        } else {
            $response['status'] = 'error';
        }
    } else {
        $response['status'] = 'no-request';
    }
} catch (PDOException $e) {
    $response['status'] = 'error';
    $response['message'] = "Error: " . $e->getMessage();
}

echo json_encode($response); // เข้ารหัสแบบ JSON
?>

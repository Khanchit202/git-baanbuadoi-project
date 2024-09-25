<?php
include("../db_config.php");
$db_con = connect_db("client");

if (isset($_POST['username'])) {
    $username = $_POST['username'];

    $query = $db_con->prepare("SELECT COUNT(*) FROM users WHERE userName = :username");
    $query->bindParam(':username', $username, PDO::PARAM_STR);
    $query->execute();

    $count = $query->fetchColumn();

    // ส่งกลับค่าที่เป็น JSON (ถ้าไม่ซ้ำ == true, ถ้าซ้ำ == false)
    if ($count > 0) {
        echo json_encode(['available' => false]);
    } else {
        echo json_encode(['available' => true]);
    }
}
?>

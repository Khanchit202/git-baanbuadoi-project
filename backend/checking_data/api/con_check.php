<?php
session_start();
include("../../../db_config.php");
$db_con = connect_db();

// รับข้อมูลจาก AJAX
$data = json_decode(file_get_contents("php://input"), true);
$password = $data['password'];

$userId = $_SESSION['userId'];
$query = $pdo->prepare("SELECT userPass FROM users WHERE userID = :userId");
$query->bindParam(':userId', $userId);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result && password_verify($password, $result['userPass'])) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>

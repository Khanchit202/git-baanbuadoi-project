<?php
session_start();
include("../../../db_config.php");
$db_con = connect_db("client");

if (isset($_POST['checkin']) && isset($_POST['billID'])) {
    $billID = $_POST['billID'];
    $userId = $_SESSION['userId'];
    $currentTime = date("Y-m-d H:i:s");

    $query = $pdo->prepare("INSERT INTO checking (billID, userID, checkStatus, checkDate) VALUES (:billID, :userID, 1, :checkDate)");
    $query->bindParam(':billID', $billID);
    $query->bindParam(':userID', $userId);
    $query->bindParam(':checkDate', $currentTime);

    if ($query->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
?>

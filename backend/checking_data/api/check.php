<?php
session_start();
include("../../../db_config.php");
$db_con = connect_db("client");

if (isset($_POST['billID'])) {
    $billID = $_POST['billID'];
    // $userId = $_SESSION['userId'];
    $userId = 00003;
    $currentTime = date("Y-m-d H:i:s");

    $query = $db_con->prepare("INSERT INTO checking (billID, user_userID, checkStatus, checkDate) VALUES (:billID, :userID, 1, :checkDate)");
    $query->bindParam(':billID', $billID);
    $query->bindParam(':userID', $userId);
    $query->bindParam(':checkDate', $currentTime);

    if ($query->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
?>

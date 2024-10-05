<?php
session_start();
include("../../../db_config.php");
$db_con = connect_db("client");

if (isset($_POST['billID'])) {
    $billID = $_POST['billID'];
    $currentTime = date("Y-m-d H:i:s");

    $query = $db_con->prepare("UPDATE checking SET checkStatus = 2, checkDate = :checkDate WHERE billID = :billID");
    $query->bindParam(':billID', $billID);
    $query->bindParam(':checkDate', $currentTime);

    if ($query->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}
?>

<?php
include ("../../db_config.php");

if (isset($_GET['payId'])) {
        $payId = $_GET['payId'];
    } elseif (isset($_POST['payId'])) {
        $payId = $_POST['payId'];
    } else {
        $payId = null;
    }

try{
    $db_con = connect_db();

    



    $name = $_POST['qrname'];
    $date = $_POST['qrdate'];
    $bank= $_POST['qrbank'];
    $price = $_POST['qrprice'];

    $sql = "UPDATE booking_payment
    SET payNameAc = ?, payDate = ?, payManey = ?, payBank = ?, payStatus = ?
    WHERE payID = ?";

    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(1, $name);
    $stmt->bindValue(2, $date . ' 12:00:00');
    $stmt->bindParam(3, $price);
    $stmt->bindParam(4, $bank);
    $stmt->bindValue(5, 1);
    $stmt->bindParam(6, $payId);
    $stmt->execute();


    echo "success";
}catch (PDOException $e) {
    echo "error: " . $e->getMessage();
}
?>
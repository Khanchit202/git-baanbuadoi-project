<?php
include ("../db_config.php");
$db_con = connect_db();

$roomId = $_POST['roomId'];
$bookingDate = $_POST['bookingDate'];

$query = $db_con->prepare("
    SELECT * FROM booking
    WHERE roomID = :roomId 
    AND bookCancel != 1
    AND :bookingDate = DATE(bookDateStart)
");

$query->bindParam(':roomId', $roomId);
$query->bindParam(':bookingDate', $bookingDate);
$query->execute();
$result = $query->fetch(PDO::FETCH_ASSOC);

if ($result) {
    echo "booked";
    
} else {
    echo "available";
    
}
?>

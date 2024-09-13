<?php
include ("../db_config.php");
$db_con = connect_db();
$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);
        $sql = "SELECT * FROM booking_bill WHERE billID = :id";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $data = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        $response['data'] = $data;

    } else {
        $response['error'] = 'No ID provided';
    }
} else {
    $response['error'] = 'Invalid request method';
}

echo json_encode($response);
?>

<?php
    include("../../../db_config.php");
    $db_con = connect_db("client");
    $response = array();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['payID']) && !empty($_POST['payID'])) {
            $id = intval($_POST['payID']);
            $sql = "DELETE FROM booking_payment WHERE payID = ?";

            $stmt = $db_con->prepare($sql);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $result = $stmt->execute();

            if ($result) {
                $response['status'] = 'ok';
            } else {
                $response['status'] = 'error';
            }
        } else {
            $response['status'] = 'error';
            $response['message'] = 'Invalid user ID';
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid request method';
    }

    echo json_encode($response);
?>

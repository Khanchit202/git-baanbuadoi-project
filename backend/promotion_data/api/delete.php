<?php
    include("../../../db_config.php");
    $db_con = connect_db("client");
    $response = array();

    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST['pmtID']) && !empty($_POST['pmtID'])) {
            $id = intval($_POST['pmtID']);
            $sql = "DELETE FROM promotions WHERE pmtID = ?";

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

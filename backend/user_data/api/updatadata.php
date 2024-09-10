<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $level = $_POST['level'];
    $userID = $_POST['id'];

    if (!empty($level) && !empty($userID)) {
        $sql = "UPDATE users SET userLavelID = ? WHERE userID = ?";
        $stmt = $db_con->prepare($sql);

        if ($stmt) {
            $stmt->bindParam(1, $level, PDO::PARAM_INT);
            $stmt->bindParam(2, $userID, PDO::PARAM_INT);

            $result = $stmt->execute();
            if ($result) {
                $response['status'] = 'success';
                
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Failed to update user level.';
            }
        } else {
            $response['status'] = 'error';
            
        }
    } else {
        $response['status'] = 'error';
        $response['message'] = 'Invalid input.';
    }
} else {
    $response['status'] = 'no-request';
    $response['message'] = 'Invalid request method.';
}

echo json_encode($response);
?>

<?php
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['serviceID']) && !empty($_POST['serviceID'])) {
        $id = intval($_POST['serviceID']);

        // ดึงชื่อไฟล์รูปภาพจากฐานข้อมูล
        $sql_select = "SELECT servicePic FROM service_product WHERE serviceID = ?";
        $stmt_select = $db_con->prepare($sql_select);
        $stmt_select->bindParam(1, $id, PDO::PARAM_INT);
        $stmt_select->execute();
        $row = $stmt_select->fetch(PDO::FETCH_ASSOC);
        $servicePic = $row['servicePic'];

        // ลบไฟล์รูปภาพจากเซิร์ฟเวอร์
        $target_file = "../../../img/service/" . $servicePic;
        if (file_exists($target_file)) {
            unlink($target_file);
        }

        // ลบข้อมูลจากฐานข้อมูล
        $sql_delete = "DELETE FROM service_product WHERE serviceID = ?";
        $stmt_delete = $db_con->prepare($sql_delete);
        $stmt_delete->bindParam(1, $id, PDO::PARAM_INT);
        $result = $stmt_delete->execute();

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

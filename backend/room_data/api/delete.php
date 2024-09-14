<?php
include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST['roomID']) && !empty($_POST['roomID'])) {
        $id = intval($_POST['roomID']);

        // ดึงชื่อไฟล์รูปภาพจากฐานข้อมูล
        $sql_select = "SELECT roomPic FROM room_product WHERE roomID = ?";
        $stmt_select = $db_con->prepare($sql_select);
        $stmt_select->bindParam(1, $id, PDO::PARAM_INT);
        $stmt_select->execute();
        $row = $stmt_select->fetch(PDO::FETCH_ASSOC);
        $roomPic = $row['roomPic'];

        // ลบไฟล์รูปภาพจากเซิร์ฟเวอร์
        $target_file = "../../../img/room_pic/" . $roomPic;
        if (file_exists($target_file)) {
            unlink($target_file);
        }

        // ลบข้อมูลจากฐานข้อมูล
        $sql_delete = "DELETE FROM room_product WHERE roomID = ?";
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
        $response['message'] = 'Invalid room ID';
    }
} else {
    $response['status'] = 'error';
    $response['message'] = 'Invalid request method';
}

echo json_encode($response);
?>

<?php
session_start();
include("../../db_config.php");
$db_con = connect_db("client");

$response = array();



if (isset($_FILES['userImg']['name'])) {
    $filename = $_FILES['userImg']['name']; // ชื่อไฟล์ที่รับมาจากฟอร์ม
    $filename = substr(str_shuffle("abcdefgsikjlmnopqrstuvwsyz0123456789"), 0, 10) . "_" . $filename; // ชื่อไฟล์ใหม่
    $tmp_file = $_FILES['userImg']['tmp_name'];
    copy($tmp_file, "../../img/profile/$filename"); // copy

    try {
        // ตรวจสอบว่า userLavelID มีอยู่ในตาราง user_lavel หรือไม่
        $userID = $_SESSION['userID']; // สมมติว่าคุณมีค่า userLavelID ใน session
        $stmt = $db_con->prepare("SELECT COUNT(*) FROM users WHERE userID = :userID");
        $stmt->bindParam(':userID', $userID, PDO::PARAM_INT);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count == 0) {
            throw new Exception("userLavelID ไม่ถูกต้อง");
        }

        $stmt = $db_con->prepare("INSERT INTO users (userImg, userID) VALUES (:userImg, :userID)");
        $stmt->bindParam(':userImg', $filename);
        $stmt->bindParam(':userID', $userLavelID, PDO::PARAM_INT);

        if ($stmt->execute()) {
            $response['status'] = 'success';
            $response['message'] = 'อัปโหลดรูปภาพเรียบร้อยแล้ว';
        } else {
            $response['status'] = 'error';
            $response['message'] = 'เกิดข้อผิดพลาดในการอัปโหลดรูปภาพ';
        }
    } catch (PDOException $e) {
        $response['status'] = 'error';
        $response['message'] = 'เกิดข้อผิดพลาด: ' . $e->getMessage();
    } catch (Exception $e) {
        $response['status'] = 'error';
        $response['message'] = $e->getMessage();
    }

    echo json_encode($response);
} else {
    $response['status'] = 'error';
    $response['message'] = 'No file uploaded.';
    echo json_encode($response);
}

$db_con = null;
?>

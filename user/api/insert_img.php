<?php
session_start();
include("../../db_config.php");
$db_con = connect_db("client"); // เชื่อมต่อฐานข้อมูล
$response = array(); // เชื่อมต่อฐานข้อมูล

header('Content-Type: application/json'); // ระบุว่าเนื้อหาที่ส่งกลับเป็น JSON

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userImg'])) {
    $userID = $_SESSION['userID'];
    $img = $_FILES['userImg'];
    $imgName = $img['name'];
    $imgTmpName = $img['tmp_name'];
    $imgSize = $img['size'];
    $imgError = $img['error'];
    $imgType = $img['type'];

    $imgExt = explode('.', $imgName);
    $imgActualExt = strtolower(end($imgExt));

    $allowed = array('jpg', 'jpeg', 'png');

    if (in_array($imgActualExt, $allowed)) {
        if ($imgError === 0) {
            if ($imgSize < 1000000) { // จำกัดขนาดไฟล์ที่ 1MB
                $imgNewName = "profile" . $userID . "." . $imgActualExt;
                $imgDestination = '../../img/profile/' . $imgNewName;
                move_uploaded_file($imgTmpName, $imgDestination);

                // อัปเดตฐานข้อมูล
                $sql = "UPDATE users SET userImg = :userImg WHERE userID = :userID";
                $stmt = $db_con->prepare($sql);
                $stmt->bindParam(':userImg', $imgNewName);
                $stmt->bindParam(':userID', $userID);
                if ($stmt->execute()) {
                    $_SESSION['userImg'] = $imgNewName;
                    echo json_encode(['success' => true, 'message' => 'รูปภาพถูกอัปโหลดเรียบร้อยแล้ว']);
                } else {
                    echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการอัปเดตรูปภาพ']);
                }
            } else {
                echo json_encode(['success' => false, 'message' => 'ไฟล์มีขนาดใหญ่เกินไป']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'เกิดข้อผิดพลาดในการอัปโหลดไฟล์']);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'ไม่สามารถอัปโหลดไฟล์ประเภทนี้ได้']);
    }
}
?>

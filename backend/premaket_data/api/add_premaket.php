<?php
header('Content-Type: application/json'); // เพิ่มบรรทัดนี้เพื่อบอกว่าเนื้อหาที่ส่งกลับเป็น JSON

include("../../../db_config.php");
$db_con = connect_db("client");
$response = array();

// ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $newName = $_POST['newName'];
    $newDetail = $_POST['newDetail'];
    $newStd = $_POST['newStd'];
    $newTime = $_POST['newTime'];
    $user_userID = $_POST['userId']; // แก้ไขจาก userID เป็น userId

    // จัดการกับไฟล์รูปภาพ
    $target_dir = "../../../img/news_pic/";
    $new_filename = "new" . uniqid() . "." . pathinfo($_FILES["newImg"]["name"], PATHINFO_EXTENSION);
    $target_file = $target_dir . $new_filename;
    if (!move_uploaded_file($_FILES["newImg"]["tmp_name"], $target_file)) {
        echo json_encode(["success" => false, "message" => "Failed to upload image."]);
        exit;
    }

    // เพิ่มข้อมูลลงในฐานข้อมูล
    $sql = "INSERT INTO news (newTitle, newDetail, newType, newDate, user_userID, newPic)
    VALUES (:newTitle, :newDetail, :newType, :newDate, :user_userID, :newPic)";
    
    $stmt = $db_con->prepare($sql);
    $stmt->bindParam(':newTitle', $newName); // แก้ไขจาก $newTitle เป็น $newName
    $stmt->bindParam(':newDetail', $newDetail);
    $stmt->bindParam(':newType', $newStd); // แก้ไขจาก $newType เป็น $newStd
    $stmt->bindParam(':newDate', $newTime); // แก้ไขจาก $newDate เป็น $newTime
    $stmt->bindParam(':user_userID', $user_userID);
    $stmt->bindParam(':newPic', $new_filename);

    if($stmt->execute()){
        $response['status'] = 'ok';
    }else{
        $response['status'] = 'error';
        $response['message'] = 'Failed to insert data.';
    }

    echo json_encode($response);
}
?>

<?php
session_start();
include("../db_config.php");
$db_con = connect_db("client");

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $username = $_POST['username'];
    $passwd = $_POST['passwd'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $userLavelID = 4;
    $userProfile = "img/profile/profile_1.jpg";

    // $username = "member";
    // $passwd = "123456";
    // $fname = "member";
    // $lname = "test";
    // $email = "mem@com";
    // $tel = "02222222";
    // $age = 20;
    // $gender = "ชาย";
    // $location = "system";
    // $userLavelID = 4;

    $hashedPasswd = password_hash($passwd, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (userName, userPass, userFName, userLName,  userTel, userEmail,  userLavelID, userImg) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    try {

        $stmt = $db_con->prepare($sql);

        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $hashedPasswd);
        $stmt->bindParam(3, $fname);
        $stmt->bindParam(4, $lname);
        $stmt->bindParam(5, $tel);
        $stmt->bindParam(6, $email);
        $stmt->bindParam(7, $userLavelID);
        $stmt->bindParam(8, $userProfile);
        $result = $stmt->execute();

        if ($result) {
            $_SESSION['success'] = "สมัครสมาชิกสำเร็จ";
            header("Location: ../login.php");
            exit(); 
        } else {
            $_SESSION['error'] = "ไม่สามารถสมัครสมาชิกได้";
            header("Location: ../register_form.php");
            exit();
        }

    } catch (PDOException $e) {
        $_SESSION['error'] = "เกิดข้อผิดพลาด: " . $e->getMessage();
        header("Location: ../register_form.php");
        exit();
    }
// }
?>

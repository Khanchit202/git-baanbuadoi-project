<?php
session_start();
include("db_config.php");

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    // $username = $_POST['username'];
    // $passwd = $_POST['passwd'];
    // $fname = $_POST['fname'];
    // $lname = $_POST['lname'];
    // $email = $_POST['email'];
    // $tel = $_POST['tel'];
    // $age = $_POST['age'];
    // $gender = $_POST['gender'];
    // $location = $_POST['location'];
    // $userLavelID = 4;

    $username = "member";
    $passwd = "123456";
    $fname = "member";
    $lname = "test";
    $email = "mem@com";
    $tel = "02222222";
    $age = 20;
    $gender = "ชาย";
    $location = "system";
    $userLavelID = 4;

    $hashedPasswd = password_hash($passwd, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (userName, userPass, userFName, userLName, userAge, userGender, userTel, userEmail, userLocation, userLavelID) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    try {

        $stmt = $db_con->prepare($sql);

        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $hashedPasswd);
        $stmt->bindParam(3, $fname);
        $stmt->bindParam(4, $lname);
        $stmt->bindParam(5, $age);
        $stmt->bindParam(6, $gender);
        $stmt->bindParam(7, $tel);
        $stmt->bindParam(8, $email);
        $stmt->bindParam(9, $location);
        $stmt->bindParam(10, $userLavelID);

        $result = $stmt->execute();

        if ($result) {
            $_SESSION['success'] = "สมัครสมาชิกสำเร็จ";
            header("Location: login.php");
            exit(); 
        } else {
            $_SESSION['error'] = "ไม่สามารถสมัครสมาชิกได้";
            header("Location: register_form.php");
            exit();
        }

    } catch (PDOException $e) {
        $_SESSION['error'] = "เกิดข้อผิดพลาด: " . $e->getMessage();
        header("Location: register_form.php");
        exit();
    }
// }
?>

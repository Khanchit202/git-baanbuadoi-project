<?php
session_start();
include("../db_config.php");
$db_con = connect_db("client");

$form_username = $_POST['username'];
$form_passwd = $_POST['passwd'];

$sql = "SELECT userName, userPass, userLavelID, userImg, userFName, userLName FROM users WHERE userName = :username";
$stmt = $db_con->prepare($sql);

$stmt->bindValue(':username', $form_username, PDO::PARAM_STR);
$stmt->execute();

$row = $stmt->fetch(PDO::FETCH_ASSOC);

if ($row) {
    $hashedPasswd = $row['userPass'];
    $db_username = $row['userName'];
    $lavel = $row['userLavelID'];
    $userImg = $row['userImg'];
    $userFname = $row['userFName'];
    $userLname = $row['userLName'];

    if (password_verify($form_passwd, $hashedPasswd)) {
        $_SESSION['valid_login'] = $db_username;
        $_SESSION['user_lavel'] = $lavel;
        $_SESSION['userImg'] = $userImg;
        $_SESSION['FName'] = $userFname;
        $_SESSION['LName'] = $userLname;
        header('Location: ../index.php');
        exit();
    } else {
        $_SESSION['valid_login'] = "";
        $_SESSION['user_lavel'] = "";
        $_SESSION['userImg'] = "";
        $_SESSION['FName'] = "";
        $_SESSION['LName'] = "";
        echo "<script>alert('Username หรือ Password ไม่ถูกต้อง กรุณากรอกใหม่'); window.location.href='../login.php';</script>";
    }
} else {
    $_SESSION['valid_login'] = "";
    $_SESSION['user_lavel'] = "";
    echo "<script>alert('Username หรือ Password ไม่ถูกต้อง กรุณากรอกใหม่'); window.location.href='../login.php';</script>";
}
?>

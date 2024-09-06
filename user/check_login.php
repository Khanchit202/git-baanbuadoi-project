<header>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="../font-web.css">
</header>
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
        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'เข้าสู่ระบบสำเร็จ',
                text: 'กำลังนำคุณไปยังหน้าแรก...',
                timer: 2500,
                showConfirmButton: false
            }).then(() => {
                window.location.href = '../index.php';
            });
        </script>";
        exit();
    } else {
        $_SESSION['valid_login'] = "";
        $_SESSION['user_lavel'] = "";
        $_SESSION['userImg'] = "";
        $_SESSION['FName'] = "";
        $_SESSION['LName'] = "";
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'การเข้าสู่ระบบล้มเหลว',
                text: 'Username หรือ Password ไม่ถูกต้อง',
                confirmButtonText: 'ตกลง'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '../login.php';
                }
            });
        </script>";
    }
} else {
    $_SESSION['valid_login'] = "";
    $_SESSION['user_lavel'] = "";
    echo "<script>
        Swal.fire({
            icon: 'error',
            title: 'ไม่พบผู้ใช้',
            text: 'Username หรือ Password ไม่ถูกต้อง กรุณากรอกใหม่',
            confirmButtonText: 'ตกลง'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '../login.php';
            }
        });
    </script>";
}
?>

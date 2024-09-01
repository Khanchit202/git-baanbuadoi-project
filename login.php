<?php
    include("db_config.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contect เกี่ยวกับเรา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="tabbar_view/nav_bar.css">
    <link rel="stylesheet" href="style1.css"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="img/favicon.ico" rel="icon">
    <link rel="icon" type="image/x-icon" href="img/bua/logo.png" style="border-radius: 5px;">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    .btn-disabled {
        background-color: #d6d6d6;
        color: black;
        width: 100%;
        
    }
    .btn-enabled {
        background-color: #4DA866;
        color: white;
        width: 100%;"
    }
</style>

    </style>
</head>
<body>
    
    <div class="container-xxl bg-white p-0">
        <nav>
            <?php include("tabbar_view/tab_bar.php"); ?>
        </nav>
        
        <div class="container-xxl bg-white p-0" style="margin-top:100px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center justify-content-center">   
                        <img src="tabbar_view/baanbuadoi.png" alt="Logo" class="img-fluid" style="max-width: 70%; height: auto;">
                    </div>
                    <div class="col-md-6">
                        <h1><center>เข้าสู่ระบบจอง</center></h1>
                        <h2><center>Login</center></h2>
                        <form class="row g-3 needs-validation" method="POST" action="user/check_login.php" novalidate style="margin-top:20px; max-width: 350px; margin: auto;">
                            <div class="col-12">
                                <label for="validationCustom01" class="form-label"><strong>User Name</strong></label>
                                <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" id="username" name="username" required>
                            </div>
                            <div class="col-12">
                                <label for="validationCustom02" class="form-label"><strong>Password</strong></label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="passwd" name="passwd" placeholder="รหัสผ่าน" required>
                                    <span class="input-group-text" id="toggle-password" style="cursor: pointer;">
                                        <i class="fas fa-eye" id="toggle-password-icon"></i>
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 d-flex justify-content-center gap-3" style="margin-top:30px;">
                                <button class="btn btn-disabled" id="login-button" type="submit" name="submit" disabled>เข้าสู่ระบบ</button>
                            </div>
                            <div class="d-flex justify-content-between" style="border-bottom: 1px solid black; padding-bottom: 10px;">
                                <a href="index.php" class="align-self-end" style="margin-top:10px; text-decoration: none; color: black;"><i class="fas fa-arrow-left"></i> กลับหน้าหลัก</a>
                                <a href="" class="align-self-end" style="margin-top:10px; text-decoration: none; color: black;">ลืมรหัสผ่าน?</a>
                            </div>
                            <div class="text-center" style="margin-top: 10px;">
                                <p>หากคุณยังไม่มีบัญชีผู้ใช้
                                <a href="register_from.php" style=" color: #4DA866;">สมัครสมาชิก</a></p>
                            </div>
                        </form>
                    </div>
                    <div class="text-center mt-5">
                        <p>ออกแบบและพัฒนาโดย นายครรชิต บางพระ และนายสมชาย หมั่นเฮิง หลักสูตรระบบสารสนเทศทางธุรกิจ-พัฒนาซอฟต์แวร์ มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const usernameField = document.getElementById('username');
        const passwordField = document.getElementById('passwd');
        const loginButton = document.getElementById('login-button');
        const togglePassword = document.getElementById('toggle-password');
        const togglePasswordIcon = document.getElementById('toggle-password-icon');

        function checkInputFields() {
            if (usernameField.value.trim() !== "" && passwordField.value.trim() !== "") {
                loginButton.disabled = false;
                loginButton.classList.remove('btn-disabled');
                loginButton.classList.add('btn-enabled');
            } else {
                loginButton.disabled = true;
                loginButton.classList.remove('btn-enabled');
                loginButton.classList.add('btn-disabled');
            }
        }

        togglePassword.addEventListener('click', function () {
            const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordField.setAttribute('type', type);
            togglePasswordIcon.classList.toggle('fa-eye');
            togglePasswordIcon.classList.toggle('fa-eye-slash');
        });

        usernameField.addEventListener('input', checkInputFields);
        passwordField.addEventListener('input', checkInputFields);
    </script>

</body>
</html>

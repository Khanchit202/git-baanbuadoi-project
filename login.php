<?php
session_start();
include("db_conet.php");
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
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="icon" type="image/x-icon" href="img/bua/logo.png" style="border-radius: 5px;">
</head>
<body>
    <div class="container-xxl bg-white p-0">
        <nav>
            <?php include("tabbar_view/tab_bar.php"); ?>
        </nav>
        
    </div>
    <!-- form login start  -->
    <div class="container-xxl bg-white p-0" style="margin-top:100px;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 d-flex align-items-center justify-content-center">
                <!-- ใส่โลโก้ที่นี่ -->
                <img src="tabbar_view/baanbuadoi.png" alt="Logo" class="img-fluid" style="max-width: 70%; height: auto;">
            </div>
            <div class="col-md-6">
                <h1><center>เข้าสู่ระบบจอง</center></h1>
                <h2><center>Login</center></h2>
                <form class="row g-3 needs-validation" novalidate style="margin-top:20px; max-width: 350px; margin: auto;">
                        <div class="col-12">
                            <label for="validationCustom01" class="form-label"><strong>User Name</strong></label>
                            <input type="text" class="form-control" placeholder="ชื่อผู้ใช้" id="username" name="username" required>
                </div>
                        <div class="col-12">
                            <label for="validationCustom02" class="form-label"><strong>Password</strong></label>
                            <input type="password" class="form-control" placeholder="รหัสผ่าน" required>
                </div>
                <div class="col-12 d-flex justify-content-center gap-3" style="margin-top:30px;">
                        <button class="btn btn-success" style="background-color: #4DA866;  width: 100%;"  type="submit" name="submit">เข้าสู่ระบบ</button>
                </div>
                <div class="d-flex justify-content-between" style="border-bottom: 1px solid black; padding-bottom: 10px;">
                    <a href="index.php" class="align-self-end" style="margin-top:10px; text-decoration: none; color: black;"><i class="fas fa-arrow-left"></i> กลับหน้าหลัก</a>
                    <a href="" class="align-self-end" style="margin-top:10px; text-decoration: none; color: black;">ลืมรหัสผ่าน?</a>
                </div>
                <div class="text-center" style="margin-top: 10px;">
                    <p>หากคุณยังไม่มีบัญชีผู้ใช้
                    <a href="form_user.php" style=" color: #4DA866;">สมัครสมาชิก</a></p>
                </div>
                </form>
            </div>
            <div class="text-center mt-5">
                <p>ออกแบบและพัฒนาโดย นายครรชิต บางพระ และนายสมชาย หมั่นเฮิง หลักสูตรระบบสารสนเทศทางธุรกิจ-พัฒนาซอฟต์แวร์ มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</p>
            </div>
        </div>
    </div>
</div>

    <!-- form login end  -->
        
        
        

    
    
    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>

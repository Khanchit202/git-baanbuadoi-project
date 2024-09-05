<?php
include ("../db_config.php");
$db_con = connect_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> รายละเอียดห้องพัก</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../style1.css">
    <link rel="stylesheet" href="../backend/dash.css">

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">
    <link rel="icon" type="image/x-icon" href="img/bua/logo.png" style="border-radius: 5px;">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .home-icon {
            position: absolute;
            top: 10px;
            left: 10px;
            font-size: 30px;
            z-index: 1000;
        }
        body {
            background-color: #f0f0f0; /* กำหนดสีพื้นหลังเป็นสีเทา */
        }
    </style>

    

</head>
<body>
    

    <div class="main p-3" style="background-color: #ECF0F1;">
            <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px; margin-bottom: 20px;">
                <div class="bar">
                    <button class="toggle-btn" type="button">
                        <i class="lni lni-menu"></i>
                    </button>
                </div>
                <p style="margin: 5px 0px 0px 0px;">จองห้องพักและบริการ</p>
                <div class="sidebar-footer">
                <a href="../index.php" class="sidebar-link">
                    <i class="lni lni-home"></i>
                    <span>กลับหน้าหลัก</span>
                </a>
            </div>
            </nav>
        
        <div class="container-fluid mt-5">
        <div class="row">
        <!-- คอลัมน์ฝั่งซ้ายสำหรับรูปภาพ -->
             <div class="col-md-6" style="background-color: #D6EAF8; padding: 20px;">
                <img src="../img/room_pic/room1.jpg" class="img-fluid rounded" alt="Image Description">
            </div>

        <!-- คอลัมน์ฝั่งขวาสำหรับเนื้อหา -->
        <div class="col-md-6" style="background-color: #FFF; padding: 20px;">
                <p>รายละเอียดห้องพัก</p>
            <div class="container">
                <!-- แถวที่ 1 -->
                <div class="row mb-4">
                    <div class="col-md-4" style="background-color: #D6EAF8; padding: 20px;">
                        <p>ประเภทห้องพัก</p>
                    </div>
                    <div class="col-md-4" style="background-color: #D6EAF8; padding: 20px;">
                        <p>จำนวนเตียงนอน</p>
                    </div>
                    <div class="col-md-4" style="background-color: #D6EAF8; padding: 20px;">
                        <p>ห้องน้ำ</p>
                    </div>
                </div>
                <!-- แถวที่ 2 -->
                <div class="row mb-4">
                    <div class="col-md-4" style="background-color: #D6EAF8; padding: 20px;">
                        <p>MAX</p>
                    </div>
                    <div class="col-md-4" style="background-color: #D6EAF8; padding: 20px;">
                        <p>MIN</p>
                    </div>
                    <div class="col-md-4" style="background-color: #D6EAF8; padding: 20px;">
                        <p>ราคา/คืน</p>
                    </div>
                </div>
                <!-- แถวที่ 3 -->
                <div class="row mb-4">
                        <p>อุปกรณ์เครื่องใช้ต่าง</p>
                    
                    
                </div> 
            </div> 
        </div>
    

    </div>
    </div>
    </div>
    
    <nav>
        <?php include("../footer.php"); ?>
    </nav>
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

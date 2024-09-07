
<?php
    session_start();
    include("../db_config.php");
    include("../backend/menu_dash.php");

    $db_con = connect_db("client");
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
        <?php
        if (isset($_GET['userID'])) {
            // รับค่าพารามิเตอร์ userID
            $userID = $_GET['userID'];
            $userDetails = explode(' ', $userID); // แยกค่าตามช่องว่าง
            $firstName = $userDetails[0];
            $lastName = $userDetails[1];
    
            // เตรียมและดำเนินการคำสั่ง SQL
            $sql = "SELECT * FROM users WHERE userFName = :firstName AND userLName = :lastName";
            $stmt = $db_con->prepare($sql);
            $stmt->bindParam(':firstName', $firstName);
            $stmt->bindParam(':lastName', $lastName);
            $stmt->execute();
    
            // ตั้งค่าผลลัพธ์เป็น associative array
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $user = $stmt->fetch();
            
        }
        // ปิดการเชื่อมต่อ
        $db_con = null;
    ?>
       


    <div class="main p-3" style="background-color: #ECF0F1;">
            <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px; margin-bottom: 20px;">
                <div class="bar">
                    <button class="toggle-btn" type="button">
                        <i class="lni lni-menu"></i>
                    </button>
                </div>
                <p style="margin: 5px 0px 0px 0px;">โปรไฟล์ของฉัน</p>
                <div class="sidebar-footer">
                <a href="../index.php" class="sidebar-link">
                    <i class="lni lni-home"></i>
                    <span>กลับหน้าหลัก</span>
                </a>
            </div>
            </nav>
        
            <div class="container" style="display: flex; justify-content: center; align-items: center;">
            <div class="row" style="width: 100%;">
            <!-- คอลัมน์ฝั่งซ้ายสำหรับรูปภาพ -->
            <div class="col-md-4" style="background-color: #FFF; padding: 20px;border-radius:20px;text-align: right;">
                <img src="../img/user_img/<?php echo htmlspecialchars($user['userImg']); ?>" class="img-fluid rounded" alt="Image Description">
            </div>

            <!-- คอลัมน์ฝั่งขวาสำหรับเนื้อหา -->
             <div class="col-md-6 ml-2" style="background-color: #FFF; padding: 10px;border-radius:5px;">
                <p>รายละเอียดข้อมูลส่วนตัว</p>
                <button onclick="" class="btn btn-primary btn-sm" style="position: absolute; top: 10px; right: 10px;">
                    <i class="lni lni-pencil" style="padding: 5px;"></i>
                </button>
                <div class="container">
                    <!-- แถวที่ 1 -->
                    <div class="row mb-4" style="display: flex; align-items: center;">
                        <div class="col-md-3" style=" text-align: right;">
                            <p>UserName :</p>
                        </div>
                        <div class="col-md-4" style=" ">
                            <p><?php echo htmlspecialchars($user['userName']); ?></p>
                        </div>
                    </div>
                    <div class="row mb-4" style="display: flex; align-items: center;">
                        <div class="col-md-3" style=" text-align: right;">
                            <p>Password :</p>
                        </div>
                        <div class="col-md-4" style=" ">
                            <p><?php echo str_repeat('*', min(10, strlen($user['userPass']))); ?></p>
                        </div>
                    </div>
                    <div class="row mb-4" style="display: flex; align-items: center;">
                        <div class="col-md-3" style=" text-align: right;">
                            <p>Tel :</p>
                        </div>
                        <div class="col-md-4" style=" ">
                            <p><?php echo htmlspecialchars($user['userTel']); ?></p>
                        </div>
                    </div>
                    <!-- แถวที่ 2 -->
                    <div class="row mb-4" style="display: flex; align-items: center;">
                        <div class="col-md-3" style=" text-align: right;">
                            <p>ชื่อ :</p>
                        </div>
                        <div class="col-md-4" style=" ">
                            <p><?php echo htmlspecialchars($user['userFName']); ?></p>
                        </div>
                    </div>
                    <div class="row mb-4" style="display: flex; align-items: center;">
                        <div class="col-md-3" style=" text-align: right;">
                            <p>นามสกุล :</p>
                        </div>
                        <div class="col-md-4" style="">
                            <p><?php echo htmlspecialchars($user['userLName']); ?></p>
                        </div>
                    </div>
                    <div class="row mb-4" style="display: flex; align-items: center;">
                        <div class="col-md-3" style=" text-align: right;">
                            <p>Email :</p>
                        </div>
                        <div class="col-md-4" style="">
                            <p><?php echo htmlspecialchars($user['userEmail']); ?></p>
                        </div>
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

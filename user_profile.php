<?php

include ("db_config.php");
$db_con = connect_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฺHome Buadoi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="tabbar_view/nav_bar.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="button.css">
    
  
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="img/favicon.ico" rel="icon">
    <link rel="icon" type="image/x-icon" href="img/bua/logo.png" style="border-radius: 5px;">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    

    




    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-xxl bg-white p-0">
    <nav id="navbar">
        <?php include("tabbar_view/tab_bar.php"); ?>
    </nav>
    <?php
    if (isset($_GET['userID'])) {
        // รับค่าพารามิเตอร์ userID
        $userID = $_GET['userID'];
        

        // เตรียมและดำเนินการคำสั่ง SQL
        $sql = "SELECT * FROM users WHERE userID = :userID";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();

        // ตั้งค่าผลลัพธ์เป็น associative array
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();

        // ปิดการเชื่อมต่อ
        
    }
    ?>

    <div class="container" style="display: flex; justify-content: center; align-items: center;  margin-top: 30px;">
        <div class="row" style="width: 100%;justify-content: center;">
            <!-- คอลัมน์ฝั่งซ้ายสำหรับรูปภาพ -->
            <div class="col-md-4 ml-5" style="background-color: #FFF; padding: 20px; border-radius: 20px; text-align: right; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <div style="width: 100%; height: auto; text-align: center;">
                    <img src="img/user_img/<?php echo htmlspecialchars($user['userImg']); ?>" class="img-fluid rounded" alt="Image Description" style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div class="row mt-5" style="border: solid 5px green; border-radius: 10px;">
                    <button type="button" class="btn btn-light btn-block">อัพโหลดรูปโปรไฟล์</button>
                </div>
                <div class="row mt-3">
                <button type="button" class="btn btn-success btn-block" data-toggle="modal" data-target="#myModal">เปลี่ยนรหัสผ่าน
                </button>
                </div>
                <div class="row mt-3">
                    <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#editModal">แก้ไขข้อมูลส่วนตัว</button>
                    </div>
            </div>

            <!-- คอลัมน์ฝั่งขวาสำหรับเนื้อหา -->
            <div class="col-md-6 ml-2" style="background-color: #FFF; padding: 10px; border-radius: 20px;  margin-left: 10px;box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);">
                <p>รายละเอียดข้อมูลส่วนตัว</p>
                <div class="container">
                    <!-- แถวที่ 1 -->
                    <div class="row mb-4" style="display: flex; align-items: center;">
                        <p>UserName :</p>
                        <div class="col-md-3" style="flex: 1; border-radius: 10px; background-color: #f0f0f0;">
                            <p style="margin-top: 15px;"><?php echo htmlspecialchars($user['userName']); ?></p>
                        </div>
                    </div>

                    <div class="row mb-4" style="display: flex; align-items: center;">
                        <p>Password :</p>
                        <div class="col-md-3" style="flex: 1; border-radius: 10px; background-color: #f0f0f0;">
                            <p style="margin-top: 15px;"><?php echo str_repeat('*', min(10, strlen($user['userPass']))); ?></p>
                        </div>
                    </div>
                    <div class="row mb-4" style="display: flex; align-items: center;">
                        <p>ชื่อ-นามสกุล :</p>
                        <div class="col-md-3" style="flex: 1; border-radius: 10px; background-color: #f0f0f0;">
                            <p style="margin-top: 15px;"><?php echo htmlspecialchars($user['userFName']) . " " . htmlspecialchars($user['userLName']); ?></p>
                        </div>
                    </div>

                    <div class="row mb-4" style="display: flex; align-items: center;">
                        <p>เบอร์โทรศัพท์ :</p>
                        <div class="col-md-3" style="flex: 1; border-radius: 10px; background-color: #f0f0f0;">
                            <p style="margin-top: 15px;"><?php echo htmlspecialchars($user['userTel']); ?></p>
                        </div>
                    </div>
                    <div class="row mb-4" style="display: flex; align-items: center;">
                        <p>Email :</p>
                        <div class="col-md-3" style="flex: 1; border-radius: 10px; background-color: #f0f0f0;">
                            <p style="margin-top: 15px;"><?php echo htmlspecialchars($user['userEmail']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        

    </div>
    <!-- ส่วนแสดงประวัติการจอง -->
    <div class="container" style="display: flex; justify-content: center; align-items: center;  margin-top: 30px;">
            <div class="row mb-5" style="width: 85%; background-color: #fff; height: 300px; display: flex; justify-content: center; align-items: center; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <p>Content</p>
            </div>

        

    </div>
    <!-- ปิดส่วนแสดงประวัติการจอง -->

    <!-- ส่วนแสดงประวัติห้อง -->
    <div class="container" style="display: flex; justify-content: center; align-items: center; ">
            <div class="row mb-5" style="width: 85%; background-color: #fff; height: 300px; display: flex; justify-content: center; align-items: center; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                <p>Content</p>
            </div>

        

    </div>
     <!-- ปิดส่วนแสดงประวัติห้อง -->
</div>


  
        <nav>
            <?php include("footer.php"); ?>
        </nav>
        
        
    
    
    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript Libraries -->
    <script src="lib/wow/wow.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="user/user_data.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>



    <!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูล</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- ฟอร์มแก้ไขข้อมูล -->
                <form>
                    <div class="form-group">
                        <label for="username">User Name</label>
                        <input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($user['userName']); ?>">
                    </div>

                    <div class="form-group">
                        <label for="fname">ชื่อ</label>
                        <input type="text" class="form-control" id="fname" value="<?php echo htmlspecialchars($user['userFName']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="lname">นามสกุล</label>
                        <input type="text" class="form-control" id="lname" value="<?php echo htmlspecialchars($user['userLName']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="tel">Tel</label>
                        <input type="tel" class="form-control" id="tel" value="<?php echo htmlspecialchars($user['userTel']); ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" value="<?php echo htmlspecialchars($user['userEmail']); ?>">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" onclick="updateData()">บันทึกข้อมูล</button>
            </div>
            <script>
                var userId = <?php echo json_encode($_SESSION['userID']); ?>;
            </script>

        </div>
    </div>
</div>
<!-- Modal edit-->    


<!-- Modal pass-->  

<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title text-center w-100">เปลี่ยนรหัสผ่าน</h4>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form >
                    <div class="form-group">
                        <label for="currentPassword">รหัสผ่านปัจจุบัน:</label>
                        <input type="password" class="form-control" id="currentPassword">
                    </div>
                    <div class="form-group">
                        <label for="newPassword">รหัสผ่านใหม่:</label>
                        <input type="password" class="form-control" id="newPassword">
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">ยืนยันรหัสผ่านใหม่:</label>
                        <input type="password" class="form-control" id="confirmPassword">
                    </div>
                    <button type="submit" onclick="updatepass()" class="btn btn-primary">บันทึก</button>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>
            <script>
                var userId = <?php echo json_encode($_SESSION['userID']); ?>;
            </script>
        </div>
        
    </div>
</div>

    <!-- The Modal -->
</body>
</html>

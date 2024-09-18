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
    <link rel="icon" type="image/x-icon" href="tabbar_view/baanbuadoi.png" style="border-radius: 5px;">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


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
        
        $userLavelName = "";

            if ($user['userLavelID'] == 1) {
                $userLavelName = 'ผู้ดูแลระบบ';
            } else if ($user['userLavelID'] == 2) {
                $userLavelName = 'เจ้าของกิจการ';
            } else if ($user['userLavelID'] == 3) {
                $userLavelName = 'พนักงาน';
            } elseif ($user['userLavelID'] == 4) {
                $userLavelName = 'สมาชิก';
            }

        
    }
    ?>

    <div class="container" style="display: flex; padding: 60px 60px">
        <div class="menu_pro d-flex" style="width: 100%">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
                <div class="card" style="width: 250px;">
                    <img src="img/profile/<?php echo htmlspecialchars($user['userImg']); ?>" class="card-img-top" alt="Programer" style="height: 250px; object-fit: cover;">
                    <div class="card-body">
                        <h5 class="card-title" style="font-size: 16px; font-weight: bold;"><?php echo htmlspecialchars($user['userFName']) . " " . htmlspecialchars($user['userLName']); ?></h5>
                        <p class="card-text" style="font-size: 12px;"><?php echo htmlspecialchars($userLavelName); ?></p>
                        <div class="mt-3">
                            <button type="button" class="btn btn-block mb-2" data-toggle="modal" data-target="#myimg" style="font-size: 10px; color: #4caf50; width: 100%; border: solid 2px #4caf50;">อัพโหลดรูปโปรไฟล์</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6 ml-2" style="background-color: #FFF; padding: 40px; border-radius: 10px; margin-left: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); flex-grow: 1;">

                <div class="d-flex justify-content-between m-2 mb-5">
                    <p>ข้อมูลส่วนตัว</p>
                    <div class="d-flex ">
                        <button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 10px; background-color: #3B8386; color: #ffffff;"><i class="lni lni-key" style="padding: 5px;"></i>เปลี่ยนรหัสผ่าน</button>
                        <button class="btn " style="font-size: 10px; background-color: #4caf50; color: #ffffff;" type="button" data-toggle="modal" data-target="#editModal"><i class="lni lni-pencil" style="padding: 5px;"></i>แก้ไขข้อมูลส่วนตัว</button>
                    </div>
                </div>

                <div class="container" style="font-size: 12px; width: 100%">
                    <div class="row mb-1" style="display: flex; align-items: center;">
                        <p style="flex: 1; font-weight: bold;">ชื่อผู้ใช้ / User Name:</p>
                        <div class="col-md-8">
                            <p><?php echo htmlspecialchars($user['userName']); ?></p>
                        </div>
                    </div>
                    <div class="row mb-1" style="display: flex; align-items: center;">
                        <p style="flex: 1; font-weight: bold;">ชื่อ - นาทสกุล / First name - Last name:</p>
                        <div class="col-md-8">
                            <p><?php echo htmlspecialchars($user['userFName']) . " " . htmlspecialchars($user['userLName']); ?></p>
                        </div>
                    </div>
                    <div class="row mb-1" style="display: flex; align-items: center;">
                        <p style="flex: 1; font-weight: bold;">เบอร์โทรศัพท์ / Phone Number:</p>
                        <div class="col-md-8">
                            <p><?php echo htmlspecialchars($user['userTel']); ?></p>
                        </div>
                    </div>
                    <div class="row mb-1" style="display: flex; align-items: center;">
                        <p style="flex: 1; font-weight: bold; ">สิทธิผู้ใช้งาน / User Role:</p>
                        <div class="col-md-8">
                            <p><?php echo htmlspecialchars($userLavelName); ?></p>
                        </div>
                    </div>
                    
                    <div class="row mb-1" style="display: flex; align-items: center;">
                        <p style="flex: 1; font-weight: bold;">อีเมล / Email:</p>
                        <div class="col-md-8">
                            <p><?php echo htmlspecialchars($user['userEmail']); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
        // SQL Query to select data from booking_bill and other related tables
        $sql = "
            SELECT * 
            FROM booking_bill 
            INNER JOIN room_product ON booking_bill.roomID = room_product.roomID
            INNER JOIN booking ON booking_bill.bookID = booking.bookID
            LEFT JOIN booking_payment ON booking_bill.payID = booking_payment.payID
            WHERE booking_bill.userID = :userID
        ";

        $data2 = $db_con->prepare($sql);
        $userID = $_SESSION['userID'];
        $data2->bindParam(':userID', $userID, PDO::PARAM_INT);
        $data2->execute();
        $dataArray = $data2->fetchAll(PDO::FETCH_ASSOC);

        // Function to format date in Thai style
        function formatThaiDate($date) {
            $monthNames = [
                'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
                'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
            ];
                                                                            
            $day = $date->format('j');
            $month = $monthNames[$date->format('n') - 1];
            $year = $date->format('Y') + 543;
                                                                        
            return "{$day} {$month} {$year}";
        }
        ?>


    <!-- ส่วนแสดงประวัติการจอง -->
    <div class="container" style=" padding: 0px 60px;">
        <div class="pro" style="width: 100%; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px 0px;">
            <div class="d-flex justify-content-between m-2 mb-3" style="padding: 10px 35px;">
                <p>ข้อมูลประวัติการจอง</p>
                <div class="d-flex">
                    <button type="button" class="btn" data-toggle="modal" data-target="#myModal" style="font-size: 10px; background-color: #3B8386; color: #ffffff;">แสดงรายการทั้งหมด</button>
                </div>
            </div>
            
            
            <div class="testimonial-item rounded" style="font-size: 12px; padding: 10px 25px;">
                        <div class="table-responsive" style="overflow-x: auto;">
                            <table class="table table-hover table-bordered" style="min-width: 800px;">
                                <thead style="background-color: #97C7C9;">
                                    <tr>
                                        <th class="text-center">ชื่อรายการ</th>
                                        <th class="text-center">วันที่ทำการ</th>
                                        <th class="text-center">สถานะ</th>
                                        <th class="text-center">การชำระเงิน</th>
                                        <th class="text-center">หมายเหตุ</th>
                                        <th class="text-center">ตัวเลือก</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    <?php if ($dataArray) {
                                        foreach ($dataArray as $row) { ?>   
                                            <tr>
                                                <!-- ตัวอย่างการดึงข้อมูลจากฐานข้อมูล -->
                                                <td class="text-center"><?php echo $row['roomName']; ?></td>

                                                <?php 
                                                    $datetime = $row['bookDate'];
                                                    $date = new DateTime($datetime);

                                                    $thaiDate = formatThaiDate($date);
                                                ?>

                                                <td class="text-center"><?php echo $thaiDate; ?></td>
                                                <td class="text-center">

                                                <?php 
                                                    if ($row['payStatus'] === NULL) {
                                                        $pay_status = "";
                                                        $pay_color = '';
                                                    } elseif ($row['payStatus'] == 1) {
                                                        $pay_status = "ชำระเงินแล้ว";
                                                        $pay_color = '#A7CF5A';
                                                    } else {
                                                        $pay_status = "กำลังตรวจสอบ";
                                                        $pay_color = '#3B8386';
                                                    }
                                                ?>
                                                    <h5 class="text-center" style="background-color: <?php echo $pay_color; ?>; font-size: 8px; padding: 5px 0; border-radius: 10px; color: #ffffff;">
                                                        <?php echo $pay_status; ?>
                                                    </h5>
                                                </td>
                                                <td class="text-center">

                                                <?php 
                                                    if($row['billStatus'] == 1){
                                                        $bill_status = "จองสำเร็จ";
                                                        $bill_color = '#A7CF5A';
                                                    }else if($row['bookCancel'] == 1){
                                                        $bill_status = "ยกเลิก";
                                                        $bill_color = '#DE6461';
                                                    }else{
                                                        $bill_status = "รอดำเนินการ";
                                                        $bill_color = '#3B8386';
                                                    }
                                                ?>
                                                    <h5 class="text-center" style="background-color: <?php echo $bill_color; ?>; font-size: 8px; padding: 5px 0; border-radius: 10px; color: #ffffff;">
                                                        <?php echo $bill_status; ?> <!-- ใส่สถานะการจองจากฐานข้อมูล -->
                                                    </h5>
                                                </td>
                                                <td class="text-center"><?php echo $row['note'] ?? ' - '; ?></td>
                                                <td class="text-start">
                                                <?php
                                                    if($row['bookStatus'] == 1){
                                                        echo '<button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 8px; background-color: #3B8386; color: #ffffff; border-radius: 5px;">ดูรายละเอียด</button>';
                                                    }
                                                    if($row['payStatus'] == 1){
                                                        echo '<button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 8px; background-color: #4caf50; color: #ffffff; border-radius: 5px;">การชำระเงิน</button>';
                                                    }else if($row['payStatus'] === NULL){
                                                        echo '<button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 8px; background-color: #4caf50; color: #ffffff; border-radius: 5px;">ดำเนินการชำระเงิน</button>';
                                                    }
                                                     if($row['billStatus'] == 1){
                                                        echo '<button onclick="redirectToReport()" type="button" class="btn" style="font-size: 8px; background-color: #DE6461; color: #ffffff; border-radius: 5px;">พิมพ์ใบจอง</button>';
                                                    }
                                                ?>
                                                </td>
                                            </tr>
                                        <?php } // end foreach 
                                    } else { ?>
                                        <tr>
                                            <td colspan="6" class="text-center">ไม่มีรายการแสดง</td>
                                        </tr>
                                    <?php } ?>

                                </tbody>

                            </table>
                        </div>
            </div>
        </div>
    </div>
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
                <h5 class="modal-title" id="editModalLabel">แก้ไขข้อมูลส่วนตัว</h5>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <div class="modal-body" style="font-size: 12px;">
                <!-- ฟอร์มแก้ไขข้อมูล -->
                <form>
                    <div class="form-group mb-3" ">
                        <label for="username">User Name</label>
                        <input type="text" class="form-control" id="username" value="<?php echo htmlspecialchars($user['userName']); ?>">
                    </div>

                    <div class="form-group mb-3">
                        <label for="fname">ชื่อ</label>
                        <input type="text" class="form-control" id="fname" value="<?php echo htmlspecialchars($user['userFName']); ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="lname">นามสกุล</label>
                        <input type="text" class="form-control" id="lname" value="<?php echo htmlspecialchars($user['userLName']); ?>">
                    </div>
                    <div class="form-group mb-3">
                        <label for="tel">Tel</label>
                        <input type="tel" class="form-control" id="tel" value="<?php echo htmlspecialchars($user['userTel']); ?>">
                    </div>
                    <div class="form-group mb-3">
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
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form>
                    <div class="form-group mb-4">
                        <label for="currentPassword">รหัสผ่านปัจจุบัน:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="currentPassword">
                            <span class="input-group-text" id="toggle-current-password" style="cursor: pointer;">
                                <i class="fas fa-eye" id="toggle-current-password-icon"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-2">
                        <label for="newPassword">รหัสผ่านใหม่:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="newPassword">
                            <span class="input-group-text" id="toggle-new-password" style="cursor: pointer;">
                                <i class="fas fa-eye" id="toggle-new-password-icon"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="confirmPassword">ยืนยันรหัสผ่านใหม่:</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="confirmPassword">
                            <span class="input-group-text" id="toggle-confirm-password" style="cursor: pointer;">
                                <i class="fas fa-eye" id="toggle-confirm-password-icon"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ยกเลิก</button>
                <button type="button" onclick="updatepass()" class="btn btn-primary">บันทึกการเปลี่ยนแปลง</button>
            </div>
            <script>
                var userId = <?php echo json_encode($_SESSION['userID']); ?>;
            </script>
        </div>
    </div>
</div>

<!-- The Modal pass -->
    
<!-- Modal Img-->  
<div class="modal" id="myimg">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">อัพโหลดรูปโปรไฟล์</h4>
                <button type="button" class="btn-close" data-dismiss="modal"></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <form id="uploadForm" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="img">เลือกไฟล์รูปภาพ:</label>
                        <input type="file" class="form-control" id="img" name="userImg" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="upImg()">บันทึก</button>
                </form>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">ปิด</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal Img-->

<!-- แสดงรหัสที่กำลังกรอก -->
<script>
document.getElementById('toggle-current-password').addEventListener('click', function () {
    var passwordField = document.getElementById('currentPassword');
    var passwordIcon = document.getElementById('toggle-current-password-icon');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
});

document.getElementById('toggle-new-password').addEventListener('click', function () {
    var passwordField = document.getElementById('newPassword');
    var passwordIcon = document.getElementById('toggle-new-password-icon');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
});

document.getElementById('toggle-confirm-password').addEventListener('click', function () {
    var passwordField = document.getElementById('confirmPassword');
    var passwordIcon = document.getElementById('toggle-confirm-password-icon');
    if (passwordField.type === 'password') {
        passwordField.type = 'text';
        passwordIcon.classList.remove('fa-eye');
        passwordIcon.classList.add('fa-eye-slash');
    } else {
        passwordField.type = 'password';
        passwordIcon.classList.remove('fa-eye-slash');
        passwordIcon.classList.add('fa-eye');
    }
});

function redirectToReport() {
    window.location.href = 'report/report.php';
}

</script>
</body>
</html>

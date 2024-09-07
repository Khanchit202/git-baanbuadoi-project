
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="../backend/dash.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" src="../backend/user_data.js"></script>
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex" style="padding: 20px 0 20px 20px;">
                <img src="../tabbar_view/baanbuadoi.png" alt="" width="30px">
                <div class="sidebar-logo">
                    <a href="#">กิจการบ้านบัวดอย</a>
                </div>
            </div>

            <?php
                menu_dash();
            ?>
            
        </aside>

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
                    <div class="col-md-6 ml-3" style="background-color: #FFF; padding: 10px; border-radius: 5px; position: relative;">
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
                    </div>
            

            <div class="footer" style="background-color: white; border-radius: 10px; margin-top: 10px; text-align: center; height: 60px;padding-top:20px;">
                <div class="bar">
                    <p style="opacity: 50%; font-size: 10px;">&copy; 2024 Khanchit Bangphra & Somchai Manheang. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>

    <script src="../backend/main.js"></script>
    <script src="../backend/user_data/user_datas.js"></script>
</body>

</html>


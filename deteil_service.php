<?php
include ("db_config.php");
$db_con = connect_db();
$id = $_GET['id'];

$query = $db_con->prepare("SELECT * FROM service_product WHERE serviceID = :id");
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$ser = $query->fetch(PDO::FETCH_ASSOC);

$price = $ser['servicePrice'];
$deposit = ($price * 30) / 100;
$deposit = number_format($deposit, 2);

if (!$ser) {
    die("Service not found.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียด</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="tabbar_view/nav_bar.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript" src="indexs.js"></script>
</head>
<body>

    <div class="container-xxl bg-white p-0">
        <nav id="navbar">
            <?php include("tabbar_view/tab_bar.php"); ?>
        </nav>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 mb-3" id="deteil_img">
                    <?php if (isset($ser['servicePic'])): ?>
                        <img style="border-radius: 10px; width: 100%; height: 500px; object-fit: cover;" src="img/service/<?php echo htmlspecialchars($ser['servicePic']); ?>" alt="Service Image" class="img-fluid">
                    <?php endif; ?>
                </div>

                <div class="col-md-6" id="deteil_text" style="height: 500px; font-size: 14px; border-left: solid 4px #4DA865; border-radius: 10px; padding: 30px 30px; box-shadow: 2px 2px 5px #ccc">
                        <h1 class="fw-bold" style="font-size: 20px; margin-bottom: 20px;"><?php echo htmlspecialchars($ser['serviceName']); ?></h1>
                        <br>
                        <div class="row mb-1">
                            <div class="col-md-3 fw-bold"><p>รายละเอียด</p></div> 
                            <div class="col-md-7"><?php echo htmlspecialchars($ser['serviceDetail']); ?></div>
                        </div>
                        <br>
                        <div class="row mb-2">
                            <div class="col-md-3 fw-bold"><p>ตั้งอยู่ที่</p></div> 
                            <div style="color:#4DA865; " class="col-md-7 fw-bold"><i class="lni lni-map-marker me-2"></i>บ้านนอแล ดอยอ่างขาง</div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 fw-bold"><p>จำนวนเตียงนอน</p></div> 
                            <div style="color:#4DA865; " class="col-md-2 fw-bold"><?php echo htmlspecialchars($ser['servicePrice']); ?></div>
                            <div class="col-md-3 fw-bold"><p>เวลาให้บริการ/ครั้ง</p></div> 
                            <div style="color:#4DA865; " class="col-md-2 fw-bold"><?php echo htmlspecialchars($ser['serviceTime']); ?> ชั่วโมง</div>
                        </div>

                    <br><br>                     
                    <button onclick="window.location.href='service_booking/booking.php?id=<?php echo $ser['serviceID']; ?>'" class="btn btn-custom" style="width: 100%;"> + จอง </button>
                </div>
            </div>
        </div>
       
        <div class="container-xxl bg-light" style="margin-top:20px;">
            <div class="row " style="width: 100%;">
                <div class="text-end mt-3">
                    <p class="fw-bold" style="font-size: 14px; margin-bottom: 5px;">แสดงความคิดเห็น</p>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" style="text-decoration: none;"><p class="" style="font-size: 12px; margin:0; color: black;">แสดงเพิ่มเติม</p></a>
                </div>
            </div>
            <div class="container">
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    <?php for($i = 0; $i < 5 ; $i++){ ?>
                        <div class="testimonial-item bg-light rounded p-3">
                            <div class="bg-white border rounded p-3 pb-1 d-flex">
                                <div class="testimonial-image me-1" style="width: 70px;">
                                    <img src="img/profile/profile_1.jpg" alt="Reviewer Image" class="img-fluid rounded-circle" style="width: 40px; height: 40px;">
                                </div>
                                <div class="testimonial-content d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="star-rating" style="font-size: 12px;">
                                            <h5 class="fw-bold mb-0" style="font-size: 12px;">ครรชิต บางพระ</h5>
                                            <p class="mb-0" style="font-size: 8px; opacity: 60%;">09/09/2567</p>
                                        </div>
                                        <div class="star-rating" style="font-size: 12px; color: #BC5686;">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-alt"></i>
                                        </div>
                                    </div>
                                    <p class="testimonial-text" style="font-size: 10px;">บรรยากาศดี อาหารอร่อย บริการเยี่ยมมากครับ!</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" >
                <h5 style="font-size: 14px;" class="modal-title fw-bold" id="exampleModalLabel">ความคิดเห็นทั้งหมด</h5>
                <button style="font-size: 10px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php for($i = 0; $i < 5 ; $i++){ ?>

                            <div class="bg-white border rounded p-3 pb-1 d-flex mb-1">
                                <div class="testimonial-image me-1" style="width: 70px;">
                                    <img src="img/profile/profile_1.jpg" alt="Reviewer Image" class="img-fluid rounded-circle" style="width: 40px; height: 40px;">
                                </div>
                                <div class="testimonial-content d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <div class="star-rating" style="font-size: 12px;">
                                            <h5 class="fw-bold mb-0" style="font-size: 12px;">ครรชิต บางพระ</h5>
                                            <p class="mb-0" style="font-size: 8px; opacity: 60%;">09/09/2567</p>
                                        </div>
                                        <div class="star-rating" style="font-size: 12px; color: #BC5686;">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-alt"></i>
                                        </div>
                                    </div>
                                    <p style="width: 90%; font-size: 10px;">ห้องพักมีความสะดวกสบาย และสะอาดมากครับห้องพักมีความสะดวกสบาย และสะอาดมากครับห้องพักมีความสะดวกสบาย และสะอาดมากครับ</p>
                                </div>
                            </div>

                    <?php } ?>
            </div>
        </div>
    </div>
    </div>

    <div class="container-xxl bg-white p-0">


    <!-- ห้องพัก -->
    <div class="text-start mx-auto mt-5 mb-2 wow slideInLeft" data-wow-delay="0.1s">
                <h1 class="fw-bold" style="margin-left: 70px; color: #BC5686;">แนะนำห้องพัก</h1>
                <p style="margin-left: 70px; color: #BC5686;">โฮมสเตย์บ้านบัวดอย รวบรวมห้องพักทั่วทั้งดอยอ่างขาง</p>
        </div>
        <?php
            $roomShow = isset($_GET['roomShow']) ? $_GET['roomShow'] : '1';

            $sql = 'SELECT * FROM room_product WHERE roomShow = :roomShow';
            $stmt = $db_con->prepare($sql);
            $stmt->execute(['roomShow' => $roomShow]);

            $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="produc_pre d-flex flex-row flex-wrap justify-content-start" style="margin: 0 30px;">
                <!-- การ์ดสำหรับห้อง -->
                <?php 
                $count = 0;
                foreach ($rooms as $room) { 
                    if ($count >= 8) break;
                    if ($room['roomShow']) {
                        $statusText = 'ว่าง';
                        $badgeColor = '#4DA866';
                        $buttonText = '+ จอง';
                        $buttonColor = '#4DA866';
                    } else {
                        // กรณีอื่น ๆ
                    }
                ?>
                <div class="wow fadeInUp" data-wow-delay="0.5s" style="margin: 30px;">
                    <div class="card position-relative text-white card-hover mb-5" style="width: 250px; height: 300px; overflow: hidden; position: relative; border-radius: 5px;">
                        <img src="img/room_pic/<?php echo $room['roomPic']; ?>" class="card-img" alt="Room Image" style="height: 100%; object-fit: cover;">
                        <span class="badge position-absolute custom-badge" style="top: 10px; left: 15px; background-color: <?php echo $badgeColor; ?>; color: white; border-radius: 5px;  padding: 10px 20px; opacity: 60%;">
                            <?php echo $statusText; ?>
                        </span>
                        <div class="card-img-overlay d-flex flex-column justify-content-end" style="color: #000;">
                            <div class="overlay-content p-4" style="background: rgba(255, 255, 255, 0.9); border-radius: 10px; transition: transform 0.3s;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="card-title m-0" style="font-size: 14px;"><?php echo $room['roomName']; ?></h5>
                                    <p class="m-0">★ </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center" style="font-size: 12px;">
                                    <span class="icon-text" style="display: flex; align-items: center;"><i class="fa fa-bed text-dark me-2" style="background-color: #ccc; border-radius: 50%; padding: 5px; margin-right: 5px;"></i> <?php echo $room['roomBed']; ?></span>
                                    <span class="icon-text" style="display: flex; align-items: center;"><i class="fa fa-bath text-dark me-2" style="background-color: #ccc; border-radius: 50%; padding: 5px; margin-right: 5px;"></i> <?php echo $room['roomBath']; ?></span>
                                    <p class="card-text text-right font-weight-bold" style="font-size: 16px; font-weight: bold;"><?php echo $room['roomPrice']; ?>฿</p>
                                </div>
                            </div>
                        </div>
                        <a href="deteil_product.php?id=<?php echo $room['roomID']; ?>" class="book-button" style="position: absolute; top: 230px; left: 10%; width: 80%; height: 50px; background-color: <?php echo $buttonColor; ?>; color: white; border: none; border-radius: 5px; font-size: 10px; font-weight: bold; text-align: center; line-height: 50px; text-decoration: none;"><?php echo $buttonText; ?></a>
                    </div>
                </div>
                <?php 
                    $count++;
                } 
                ?>
            </div>
        <!-- ปิดห้องพัก -->

        <!-- บริการ -->
        <div class="text-start mx-auto mt-5 mb-2 wow slideInLeft" data-wow-delay="0.1s">
            <h1 class="fw-bold" style="margin-left: 70px; color: #BC5686;">แนะนำบริการ</h1>
            <p style="margin-left: 70px; color: #BC5686;">โฮมสเตย์บ้านบัวดอย รวบรวมบริการ และผลิตภัณท์ท้องถินดอยอ่างขาง</p>
        </div>

        <?php
            $stdID = isset($_GET['stdID']) ? $_GET['stdID'] : '00001';

            $sql = 'SELECT serviceID, serviceName, servicePrice, serviceDetail,servicePic,serviceTime,serviceTotal,stdID FROM service_product WHERE stdID = :stdID';
            $stmt = $db_con->prepare($sql);
            $stmt->execute(['stdID' => $stdID]);

            $services = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="produc_pre d-flex flex-row flex-wrap justify-content-start" style="margin: 0 30px;">
                <!-- การ์ดสำหรับบริการ -->
                <?php 
                $count = 0;
                foreach ($services as $service) { 
                    if ($count >= 4) break; // แสดงแค่ 4 การ์ด
                    // กำหนดข้อความและสีพื้นหลังตามค่า stdID
                    if ($room['stdID'] == '00001') {
                        $statusText = 'มีบริการ';
                        $badgeColor = '#4DA866';
                        $buttonText = '+ จอง';
                        $buttonColor = '#4DA866';
                    } else {
                        // กรณีอื่น ๆ
                    }
                ?>
                <div class="wow fadeInUp" data-wow-delay="0.5s" style="margin: 30px;">
                    <div class="card position-relative text-white card-hover mb-5" style="width: 250px; height: 300px; overflow: hidden; position: relative; border-radius: 5px;">
                        <img src="img/service/<?php echo $service['servicePic']; ?>" class="card-img" alt="Room Image" style="height: 100%; object-fit: cover;">
                        <span class="badge position-absolute custom-badge" style="top: 10px; left: 15px; background-color: <?php echo $badgeColor; ?>; color: white; border-radius: 5px; padding: 10px 20px; opacity: 60%;">
                            <?php echo $statusText; ?>
                        </span>
                        <div class="card-img-overlay d-flex flex-column justify-content-end" style="color: #000;">
                            <div class="overlay-content p-4" style="background: rgba(255, 255, 255, 0.9); border-radius: 10px; transition: transform 0.3s;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="card-title m-0" style="font-size: 14px;"><?php echo $service['serviceName']; ?></h5>
                                    <p class="m-0">★ </p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center" style="font-size: 12px;">
                                    <p class="card-text text-right font-weight-bold" style="font-size: 16px; font-weight: bold;"><?php echo $service['servicePrice']; ?>฿</p>
                                </div>
                            </div>
                        </div>
                        <a href="deteil_service.php?id=<?php echo $service['serviceID']; ?>" class="book-button" style="position: absolute; top: 230px; left: 10%; width: 80%; height: 50px; background-color: <?php echo $buttonColor; ?>; color: white; border: none; border-radius: 5px; font-size: 10px; font-weight: bold; text-align: center; line-height: 50px; text-decoration: none;"><?php echo $buttonText; ?></a>
                    </div>
                </div>
                <?php 
                    $count++;
                } 
                ?>
            </div>
    </div>
    <!-- ปิดบริการ -->

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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>

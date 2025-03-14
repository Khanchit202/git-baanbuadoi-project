<?php
include ("db_config.php");
$db_con = connect_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Buadoi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="tabbar_view/nav_bar.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="button.css">
    <link rel="stylesheet" href="card.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="img/favicon.ico" rel="icon">
    <link rel="icon" type="image/x-icon" href="baanbuadoi_top.png" style="border-radius: 5px;">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <script type="text/javascript" src="indexs.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-xxl bg-white p-0">
        <nav id="navbar">
            <?php include("tabbar_view/tab_bar.php"); ?>
        </nav>

        <div class="container-fluid" style="background-color: #ffffff; height: 780px; position: relative;">
            <div class="row">
                <div class="col-lg-7 py-vh-6 position-relative wow slideInLeft" data-wow-delay="0.1s" style="margin-top: 150px; z-index: 1;" data-aos="fade-right">
                    <h1 class="display-1 fw-bold" style="font-size: 60px; padding-left: 60px; color: #4DA865;">บ้านบัวดอยโฮมสเตย์</h1>
                    <div class="welcome fw-bold" style="font-size: 50px; padding-left: 60px; height: 70px; color: #BC5686;">
                        <?php include("welcome.php"); ?>
                    </div>
                    <p class="lead" style="font-size: 18px; padding-left: 60px; color: #4DA865;">ระบบจองห้องพักและบริการสำหรับนักท่องเที่ยวให้ความสะดวกสบายในการจองที่พักและบริการ พร้อมยกระดับประสบการณ์การท่องเที่ยวที่ดียิ่งขึ้น</p>
                    <a href="room_product.php" class="btn btn-custom shadow" style="margin-left: 60px; margin-top: 30px; font-size: 15px;"><i class="lni lni-pointer-top" style="font-size: 25px;"></i>&nbsp;&nbsp;ดูห้องพักและบริการทั้งหมด</a>
                </div>
                <div class="col-lg-5 wow slideInRight" data-wow-delay="0.1s" style="position: absolute; top: 0; right: 0; height: 100%; width: 50%; background: url('img/news_pic/baby1.jpg') no-repeat center center; background-size: cover;">
                </div>
            </div>
        </div>

        <div class="text-center mx-auto mt-5 mb-2 wow fadeInUp " data-wow-delay="0.1s">
            <h1 class="fw-bold" style="color: #BC5686;">โปรโมชั่นและคูปองส่วนลด</h1>
            <p style="color: #BC5686;">ท่านสามารถเก็บคูปอง หรือเข้าร่วมกิจกรรม เพื่อรับส่วนลดจากทางร้าน</p>
        </div>
        <!-- Testimonial Start -->
        <?php
            $sql = 'SELECT * FROM promotions';
            $stmt = $db_con->prepare($sql);
            $stmt->execute();

            $pmt = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <div class="container-xxl py-5">
                <div class="container">
                    <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                        <?php foreach ($pmt as $promotion): ?>
                            <div class="testimonial-item bg-light rounded p-3">
                                <div class="bg-white border rounded p-4">
                                <button type="button" class="btn btn-primary" style="padding: 0; border: none; background: none;" 
                                        onclick="select_promo({
                                            pmtID: '<?php echo addslashes($promotion['pmtID']); ?>',
                                            pmtTitle: '<?php echo addslashes($promotion['pmtTitle']); ?>',
                                            pmtDetail: '<?php echo addslashes($promotion['pmtDetail']); ?>',
                                            pmtDiscont: '<?php echo addslashes($promotion['pmtDiscont']); ?>',
                                            pmtCode: '<?php echo addslashes($promotion['pmtCode']); ?>',
                                            pmtStartDate: '<?php echo addslashes($promotion['pmtStartDate']); ?>',
                                            pmtEndDate: '<?php echo addslashes($promotion['pmtEndDate']); ?>'
                                        })">
                                    <img src="img/promotion_pic/<?php echo $promotion['pmtPic']; ?>" alt="Image 1" class="img-fluid" style="width: 500px; height: 150px; object-fit: cover;">
                                </button>


                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                    <div class="modal-header ">
                        <h5 class="modal-title " id="addDataModalLabel">
                        <img src="tabbar_view/baanbuadoi.png" alt="Logo" style="height: 80px; margin-right: 10px;">
                        รายละเอียดโปรโมชั่น
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-3 d-flex justify-content-center">
                            <div class="col-2">
                                <label for="pmtID" class="form-label" style="font-weight: bold;margin-left: 20px;">โปรโมชั่น:</label>
                            </div>
                            <div class="col-3">
                                <p id="pmtTitle"></p>
                            </div>
                            
                        </div>
                        <div class="row mb-3 d-flex justify-content-center">
                            <div class="col-2">
                                <label for="pmtDetail" class="form-label" style="font-weight: bold;margin-left: 20px;">รายละเอียดโปรโมชั่น:</label>
                            </div>
                            <div class="col-3">
                                <p id="pmtDetail"></p>
                            </div>
                            
                        </div>
                        <div class="row mb-3 d-flex justify-content-center">
                        <div class="col-2">
                                <label for="pmtTitle" class="form-label" style="font-weight: bold;margin-left: 20px;">โค๊ดส่วนลด:</label>
                            </div>
                            <div class="col-3" >
                                <p id="pmtCode"></p>
                            </div>
                        </div>
                        <div class="row mb-3 d-flex justify-content-center">
                        <div class="col-2">
                                <label for="pmtTitle" class="form-label" style="font-weight: bold;margin-left: 20px;">ส่วนลด:</label>
                            </div>
                            <div class="col-3" >
                                <p id="pmtDiscont"></p>
                            </div>
                        </div>
                        
                        <div class="row mb-3 d-flex justify-content-center">
                            <div class="col-2">
                                <label for="pmtStartDate" class="form-label" style="font-weight: bold;margin-left: 20px;">ใช้ได้ตั้งแต่วันที่</label>
                            </div>
                            <div class="col-3">
                                <p id="pmtStartDate"></p>
                            </div>
                            
                        </div>
                        <div class="row mb-3 d-flex justify-content-center">
                            <div class="col-2">
                                <label for="pmtPic" class="form-label" style="margin-left: 20px;font-weight: bold;">ถึงวันที่:</label>
                            </div>
                            <div class="col-3">
                                <p id="pmtEndDate"></p>
                            </div>
                            
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                        </div>
                    </div>
                    </div>
                </div>
                </div>
    <!-- ปิดmodal -->

        <div class="text-start mx-auto mt-5 mb-2 wow slideInLeft" data-wow-delay="0.1s">
                <h1 class="fw-bold" style="margin-left: 70px; color: #BC5686;">แนะนำห้องพัก</h1>
                <p style="margin-left: 70px; color: #BC5686;">โฮมสเตย์บ้านบัวดอย รวบรวมห้องพักทั่วทั้งดอยอ่างขาง</p>
        </div>

    <!-- ห้องพัก -->
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
                    if ($room['roomShow'] == '1') {
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


        <div class="text-end mx-auto mt-5 mb-2 wow slideInRight" data-wow-delay="0.1s">
            <h1 class="fw-bold" style="margin-right: 70px; color: #BC5686;">หมวดหมู่</h1>
            <p style="margin-right: 70px; color: #BC5686;">เลือกหมวดหมู่ที่ต้องการรับบริการ กับบ้านบัวดอย</p>
        </div>

        <div class="menu_pro d-flex justify-content-between" style="margin: 60px 60px;">
            
            <div class="wow fadeInUp" data-wow-delay="0.2s">
            <div class="button" onclick="window.location.href='./service_product.php'">
                    <i class="lni lni-grid-alt" style="font-size: 30px;  color: #BC5686;"></i>
                    <p style="font-size: 14px;  color: #BC5686;">บริการทั้งหมด</p>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.4s">
                <div class="button" onclick="window.location.href='./room_product.php'">
                    <i class="lni lni-caravan" style="font-size: 30px;  color: #BC5686;"></i>
                    <p style="font-size: 14px;  color: #BC5686;">ห้องพัก</p>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.6s">
                <div class="button" onclick="window.location.href='./contect.php'">
                    <i class="lni lni-basketball" style="font-size: 30px;  color: #BC5686;"></i>
                    <p style="font-size: 14px;  color: #BC5686;">เกี่ยวกับเรา</p>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.8s">
                <div class="button" onclick="window.location.href='./premaket.php'">
                    <i class="lni lni-book" style="font-size: 30px;  color: #BC5686;"></i>
                    <p style="font-size: 14px;  color: #BC5686;">ข่าวสาร</p>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="1s">
                <div class="button" onclick="showSystemUnavailableAlert()">
                    <i class="lni lni-offer" style="font-size: 30px;  color: #BC5686;"></i>
                    <p style="font-size: 14px;  color: #BC5686;">โปรโมชั่น</p>
                </div>
            </div>
            </div>

        <?php
            

            $sql = 'SELECT newTitle, newDetail,newID,newPic FROM news WHERE newID = "00015"';
            $stmt = $db_con->prepare($sql);
            $stmt->execute();

            $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>           
        <!--new Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <?php foreach ($news as $item) { ?>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                            <div class="about-img position-relative overflow-hidden p-5 pe-0">
                                <img class="img-fluid w-100" src="img/news_pic/<?php echo $item['newPic']; ?>"  alt="Product Image">
                            </div>
                        </div>
                        <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                            <h1 class="mb-4">ข่าวสารน่าสนใจวันนี้</h1>
                            <h2><?php echo $item['newTitle']; ?></h2>
                            <p class="mb-4"><?php echo $item['newDetail']; ?></p>
                            <a class="btn btn-custom py-3 px-5 mt-3"  onclick="window.location.href='./detail_premaket.php?id=<?php echo $item['newID']; ?>'">อ่านเพิ่มเติม</a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- new End -->

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
                    if ($count >= 4) break;
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

    <!-- ปิดบริการ -->
        

        <div class="text-center mx-auto mt-5 mb-2 wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="fw-bold" style="color: #BC5686;">ผลิตภัณฑ์ชุมชนแนะนำ</h1>
            <p style="color: #BC5686;">ผลิตภัณฑ์จากวิสาหกิจชุมชน เลือกชื้อได้เฉพาะที่นี้เท่านั้น</p>
        </div>
        <!-- procuct Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <?php
                    $sql = 'SELECT newPic, newTitle, newID, newType FROM news WHERE newType = "สินค้า"';
                    $stmt = $db_con->prepare($sql);
                    $stmt->execute();

                    // เก็บข้อมูลในตัวแปร $products
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="produc_pre" style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 10px; margin: 0 35px;">
                    <!-- การ์ดสำหรับกิจกรรม -->
                    <?php foreach ($products as $product) { ?>
                        <div class="col-lg-2 col-md-6  wow fadeInUp" data-wow-delay="0.3s">
                            <div class="property-item rounded overflow-hidden">
                                <div class="team-item rounded overflow-hidden bg-light">
                                    <div class="position-relative">
                                        <a href="product_detail.php?id=<?php echo $product['newID']; ?>"><img class="img-fluid zoom" src="img/news_pic/<?php echo $product['newPic']; ?>" alt="Product Image"></a>
                                        <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                        </div>
                                    </div>
                                    <div class="text-center p-4 mt-3 bg-light-green" >
                                        <h5 class="fw-bold mb-0" style="font-size: 16px;"><?php echo $product['newTitle']; ?></h5>
                                        <small></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
        <!--  End -->

    
        <div class="text-center mx-auto mt-5 mb-2 wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="fw-bold" style="color: #BC5686;">กิจกรรมชุมชน</h1>
            <p style="color: #BC5686;">กิจกรรม วัฒนธรรม และเทศการในชุมชน เพื่อรอคุณมาสัมผัส</p>
        </div>
        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
        <div class="container">
                <?php
                    $sql = "SELECT * FROM news WHERE newType IN ('ชุมชน', 'เทศกาล')";

                    $stmt = $db_con->prepare($sql);
                    $stmt->execute();

                    // เก็บข้อมูลในตัวแปร $products
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s" >
                    <!-- การ์ดสำหรับกิจกรรม -->
                    <?php foreach ($products as $product) { ?>
                        <div class="testimonial-item bg-light rounded p-3" style="display: flex; align-items: center;box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);border-radius:10px;">
                            <div class="bg-white border rounded p-4" style="display: flex; align-items: center;">
                                <div class="position-relative" style=" width: 250px; margin-right: 10px;">
                                    <a href="detail_premaket.php?id=<?php echo $product['newID']; ?>"><img class="img-fluid zoom" src="img/news_pic/<?php echo $product['newPic']; ?>" alt="Product Image" style="width: 250px; height: 250px;border-radius:5px;"></a>
                                </div>
                                <div class="text-center p-4 bg-light-green" style=" width: 250px;">
                                    <h5 class="fw-bold mb-0" style="font-size: 16px;"><?php echo $product['newTitle']; ?></h5>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>


            </div>
        </div>
    </div>
        <!-- Testimonial End -->

        <!-- ส่วนของสคิป -->
        
            <script>
                // JavaScript to show/hide the button on hover and move overlay-content
                const cards = document.querySelectorAll('.card-hover');

                cards.forEach(card => {
                    card.addEventListener('mouseenter', () => {
                        const overlayContent = card.querySelector('.overlay-content');
                        overlayContent.style.transform = 'translateY(-40px)'; // เลื่อนขึ้น
                        const bookButton = card.querySelector('.book-button');
                        setTimeout(() => {
                            bookButton.style.display = 'block';
                        }, 50); // หน่วงเวลา 0.3 วินาที
                    });

                    card.addEventListener('mouseleave', () => {
                        const overlayContent = card.querySelector('.overlay-content');
                        overlayContent.style.transform = 'translateY(0)'; // คืนสภาพเดิม
                        const bookButton = card.querySelector('.book-button');
                        bookButton.style.display = 'none'; // ซ่อนปุ่ม
                    });
                });
            </script>
            <!-- ตรวจสอบ optionที่เลือก -->
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const radioButtons = document.querySelectorAll('input[name="options"]');
                    radioButtons.forEach(radio => {
                        radio.addEventListener('change', function() {
                            const selectedValue = this.value;
                            window.location.href = `?stdID=${selectedValue}`;
                        });
                    });
                });
            </script>
            <!-- ปิดตรวจสอบ optionที่เลือก -->
            <script>
                function showSystemUnavailableAlert() {
                    Swal.fire({
                        title: 'โปรโมชั่น',
                        text: 'ท่านสามารถดูโปรโมชั่นที่หน้าหลักได้เลย',
                        icon: 'info',
                        confirmButtonText: 'ตกลง',
                        allowOutsideClick: false,
                        allowEscapeKey: false
                    });
                }
            </script>
            
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

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script type="text/javascript" src="./backend/promotion_data/promotion.js"></script>        
    
</body>
</html>


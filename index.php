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
    <link rel="stylesheet" href="card.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="icon" type="image/x-icon" href="img/bua/logo.png" style="border-radius: 5px;">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <script type="text/javascript" src="indexs.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
</head>
<body>
    <div class="container-xxl bg-white p-0">
        <nav>
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
                    <a href="#" class="btn btn-custom shadow" style="margin-left: 60px; margin-top: 30px; font-size: 15px;"><i class="lni lni-pointer-top" style="font-size: 25px;"></i>&nbsp;&nbsp;ดูห้องพักและบริการทั้งหมด</a>
                </div>
                <div class="col-lg-5 wow slideInRight" data-wow-delay="0.1s" style="position: absolute; top: 0; right: 0; height: 100%; width: 50%; background: url('img/news_pic/baby1.jpg') no-repeat center center; background-size: cover;">
                </div>
            </div>
        </div>



        <div class="text-start mx-auto mt-5 mb-2 wow slideInLeft" data-wow-delay="0.1s">
                <h1 class="fw-bold" style="margin-left: 70px; color: #BC5686;">แนะนำห้องพัก</h1>
                <p style="margin-left: 70px; color: #BC5686;">โฮมสเตย์บ้านบัวดอย รวบรวมห้องพักทั่วทั้งดอยอ่างขาง</p>
        </div>

    <!-- ห้องพัก -->
        <?php
            $stdID = isset($_GET['stdID']) ? $_GET['stdID'] : '00001';

            $sql = 'SELECT roomPic, roomName, roomID, roomBed, roomBath, roomPrice, stdID FROM room_product WHERE stdID = :stdID';
            $stmt = $db_con->prepare($sql);
            $stmt->execute(['stdID' => $stdID]);

            $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="produc_pre d-flex flex-row flex-wrap justify-content-start" style="margin: 0 30px;">
                <!-- การ์ดสำหรับห้อง -->
                <?php 
                $count = 0;
                foreach ($rooms as $room) { 
                    if ($count >= 8) break;
                    if ($room['stdID'] == '00001') {
                        $statusText = 'ว่าง';
                        $badgeColor = '#4caf50';
                        $buttonText = '+ จอง';
                        $buttonColor = '#4caf50';
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
                        <a href="javascript:void(0);" class="book-button" onclick="showSystemUnavailableAlert()" style="position: absolute; top: 230px; left: 10%; width: 80%; height: 50px; background-color: <?php echo $buttonColor; ?>; color: white; border: none; border-radius: 5px; font-size: 10px; font-weight: bold; text-align: center; line-height: 50px; text-decoration: none;"><?php echo $buttonText; ?></a>
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
            <div class="button" onclick="showSystemUnavailableAlert()">
                    <i class="lni lni-grid-alt" style="font-size: 30px;  color: #BC5686;"></i>
                    <p style="font-size: 14px;  color: #BC5686;">บริการทั้งหมด</p>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.4s">
                <div class="button" onclick="showSystemUnavailableAlert()">
                    <i class="lni lni-caravan" style="font-size: 30px;  color: #BC5686;"></i>
                    <p style="font-size: 14px;  color: #BC5686;">ห้องพัก</p>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.6s">
                <div class="button" onclick="showSystemUnavailableAlert()">
                    <i class="lni lni-basketball" style="font-size: 30px;  color: #BC5686;"></i>
                    <p style="font-size: 14px;  color: #BC5686;">บริการ</p>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.8s">
                <div class="button" onclick="showSystemUnavailableAlert()">
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
                            <a class="btn btn-custom py-3 px-5 mt-3" href="javascript:void(0);" onclick="showSystemUnavailableAlert()">อ่านเพิ่มเติม</a>
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
                    if ($count >= 4) break; // แสดงแค่ 4 การ์ด
                    // กำหนดข้อความและสีพื้นหลังตามค่า stdID
                    if ($room['stdID'] == '00001') {
                        $statusText = 'มีบริการ';
                        $badgeColor = '#4caf50';
                        $buttonText = '+ จอง';
                        $buttonColor = '#4caf50';
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
                        <a href="javascript:void(0);" class="book-button" onclick="showSystemUnavailableAlert()" style="position: absolute; top: 230px; left: 10%; width: 80%; height: 50px; background-color: <?php echo $buttonColor; ?>; color: white; border: none; border-radius: 5px; font-size: 10px; font-weight: bold; text-align: center; line-height: 50px; text-decoration: none;"><?php echo $buttonText; ?></a>
                    </div>
                </div>
                <?php 
                    $count++;
                } 
                ?>
            </div>

    <!-- ปิดบริการ -->
        

        <div class="text-center mx-auto mt-5 mb-2 wow slideInLeft" data-wow-delay="0.1s">
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
                                        <a href=""><img class="img-fluid zoom" src="img/news_pic/<?php echo $product['newPic']; ?>" alt="Product Image"></a>
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

    
        <div class="text-center mx-auto mt-5 mb-2 wow slideInLeft" data-wow-delay="0.1s">
            <h1 class="fw-bold" style="color: #BC5686;">กิจกรรมชุมชน</h1>
            <p style="color: #BC5686;">กิจกรรม วัฒนธรรม และเทศการในชุมชน เพื่อรอคุณมาสัมผัส</p>
        </div>
        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                            
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                            
                        </div>
                    </div>
                    <div class="testimonial-item bg-light rounded p-3">
                        <div class="bg-white border rounded p-4">
                            <p>Tempor stet labore dolor clita stet diam amet ipsum dolor duo ipsum rebum stet dolor amet diam stet. Est stet ea lorem amet est kasd kasd erat eos</p>
                           
                        </div>
                    </div>
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
                        title: 'ขออภัย!',
                        text: 'ระบบยังไม่เปิดให้บริการ',
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

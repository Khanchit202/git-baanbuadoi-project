<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="tabbar_view/nav_bar.css">
    
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="cs.css">
    <link rel="stylesheet" href="button.css">
    <link rel="stylesheet" href="card.css">

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

        <div class="container">
            <div class="text-container">
                <h1>โฮมสเตย์บ้านบัวดอย</h1>
                <div class="welcome">
                    <?php include("jas.php"); ?>
                </div>
                <div class="button-container">
                    <button class="view-rooms-button">
                        <span class="icon">&#x1F4E6;</span>
                        <span class="text">ดูห้องพักและบริการ</span>
                    </button>
                </div>
                <p>สู่เว็บไซต์จองห้องพักและบริการกิจการบ้านบัวดอย ดอยอ่างขาง อำเภอฝาง จังหวัดเชียงใหม่</p>
            </div>
            <div class="slideshow-container">
                <div class="mySlides fade">
                    <img src="img/bua/img1.jpg" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img src="img/bua/img2.jpg" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img src="img/bua/img3.jpg" style="width:100%">
                </div>
                <div class="mySlides fade">
                    <img src="img/bua/img4.jpg" style="width:100%">
                </div>
            </div>
        </div>

        <script src="index2.js"></script>

        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
            <div id="title">
                <h1>แนะนำห้องพัก โฮมสเตย์</h1>
                <p>ห้องพัก บ้านพัก และบริการ</p>
            </div>
        </div>


        <div class="produc_pre" style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 20px;">
            <?php 
            for ($i = 1; $i <= 4; $i++) { 
                echo "<div class='wow fadeInUp' data-wow-delay='0.5s'>"
                ?>    
                    <div class="card position-relative text-white card-hover mb-5" style="width: 250px; height: 300px; overflow: hidden; position: relative; border-radius: 20px; margin-bottom: 20px;">
                        <img src="pre_imag.jpg" class="card-img" alt="Room Image" style="height: 100%; object-fit: cover;">
                        <span class="badge position-absolute custom-badge p-3" style="top: 10px; left: 10px; background-color: #4caf50; color: white; border-radius: 20px; padding: 10px;">ว่าง</span>
                        <div class="card-img-overlay d-flex flex-column justify-content-end" style="color: #000;">
                            <div class="overlay-content p-4" style="background: rgba(255, 255, 255, 0.9); border-radius: 20px; transition: transform 0.3s;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="card-title m-0" style="font-size: 14px;">ห้องเดี่ยวส่วนตัว</h5>
                                    <p class="m-0">★ 4.5</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center" style="font-size: 12px;">
                                    <span class="icon-text" style="display: flex; align-items: center;"><i class="fa fa-bed text-dark me-2" style="background-color: #ccc; border-radius: 50%; padding: 5px; margin-right: 5px;"></i> 2 - 3</span>
                                    <span class="icon-text" style="display: flex; align-items: center;"><i class="fa fa-bath text-dark me-2" style="background-color: #ccc; border-radius: 50%; padding: 5px; margin-right: 5px;"></i> 2</span>
                                    <p class="card-text text-right font-weight-bold" style="font-size: 16px; font-weight: bold;">499฿</p>
                                </div>
                            </div>
                        </div>
                        <a href="index.php" class="book-button" style="display: none; position: absolute; top: 230px; left: 10%; width: 80%; height: 50px; background-color: #4caf50; color: white; border: none; border-radius: 5px; font-size: 10px; font-weight: bold; text-align: center; line-height: 50px; text-decoration: none;">+ จอง</a>
                    </div>
                </div>
            <?php } ?>
        </div>


        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
            <div id="title">
                <h1>หมวดหมู่</h1>
                <p>ห้องพัก บ้านพัก และบริการ</p>
            </div>
        </div>

        <div class="menu_pro d-flex justify-content-between m-5">
            
            <div class="wow fadeInUp" data-wow-delay="0.2s">
                <div class="button">
                    <img src="icon1.png" alt="icon" width="80" height="80">
                    <p>บริการทั้งหมด</p>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.4s">
                <div class="button">
                    <img src="icon1.png" alt="icon" width="80" height="80">
                    <p>บริการทั้งหมด</p>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.6s">
                <div class="button">
                    <img src="icon1.png" alt="icon" width="80" height="80">
                    <p>บริการทั้งหมด</p>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.8s">
                <div class="button">
                    <img src="icon1.png" alt="icon" width="80" height="80">
                    <p>บริการทั้งหมด</p>
                </div>
            </div>
            <div class="wow fadeInUp" data-wow-delay="0.10s">
                <div class="button">
                    <img src="icon1.png" alt="icon" width="80" height="80">
                    <p>บริการทั้งหมด</p>
                </div>
            </div>

        </div>

        <!-- About Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="img/bua/about1.jpg">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4">ข่าวสารน่าสนใจวันนี้</h1>
                        <p class="mb-4">Tempor erat elitr rebum at clita. Diam dolor diam ipsum sit. Aliqu diam amet diam et eos. Clita erat ipsum et lorem et sit, sed stet lorem sit clita duo justo magna dolore erat amet</p>
                        <!-- <p><i class="fa fa-check text-primary me-3"></i></p>
                        <p><i class="fa fa-check text-primary me-3"></i></p>
                        <p><i class="fa fa-check text-primary me-3"></i></p> -->
                        <a class="btn btn-custom py-3 px-5 mt-3" href="">อ่านเพิ่มเติม</a>
                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->

        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
            <div id="title">
                <h1>แนะนำบริการ</h1>
                <p>บริการ และสินค้าต่างๆ ของบ้านบัวดอย</p>
            </div>
        </div>

        <div class="produc_pre" style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 20px;">
            <!-- การ์ดสำหรับสินค้าประเภทอื่น -->
            <?php 
            for ($i = 1; $i <= 4; $i++) { 
                echo "<div class='wow fadeInUp' data-wow-delay='0.5s'>"
                ?>    
                    <div class="card position-relative text-white card-hover mb-5" style="width: 250px; height: 300px; overflow: hidden; position: relative; border-radius: 20px; margin-bottom: 20px;">
                        <img src="img/bua/po4.jpg" class="card-img" alt="Product Image" style="height: 100%; object-fit: cover;">
                        <span class="badge position-absolute custom-badge p-3" style="top: 10px; left: 10px; background-color: #4caf50; color: white; border-radius: 20px; padding: 10px;">มีสินค้า</span>
                        <div class="card-img-overlay d-flex flex-column justify-content-end" style="color: #000;">
                            <div class="overlay-content p-4" style="background: rgba(255, 255, 255, 0.9); border-radius: 20px; transition: transform 0.3s;">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <h5 class="card-title m-0" style="font-size: 14px;">สินค้าประเภทอื่น</h5>
                                    <p class="m-0">★ 4.8</p>
                                </div>
                                <div class="d-flex justify-content-between align-items-center" style="font-size: 12px;">
                                    <p class="card-text text-right font-weight-bold" style="font-size: 16px; font-weight: bold;">1,200฿</p>
                                </div>
                            </div>
                        </div>
                        <a href="product_page.php" class="book-button" style="display: none; position: absolute; top: 230px; left: 10%; width: 80%; height: 50px; background-color: #4caf50; color: white; border: none; border-radius: 5px; font-size: 10px; font-weight: bold; text-align: center; line-height: 50px; text-decoration: none;">+ สั่งซื้อ</a>
                    </div>
                </div>
            <?php } ?>
        </div>

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

        
        <!-- Team Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">ผลิตภัณฑ์ชุมชน</h1>
                    <p >สินค้าแนะนำจากบ้านบัวดอย ผลิตภัณฑ์ของเราและของชุมชนบ้านนอแล </p>
                </div>
                <div class="row g-4">
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                        <div class="property-item rounded overflow-hidden">
                        <div class="team-item rounded overflow-hidden bg-light">
                            <div class="position-relative">
                                <a href=""><img class="img-fluid" src="img/bua/po1.jpg" alt="" ></a>
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <!-- <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a> -->
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">ปู่เฒ่าทิ้งไม้เท้า</h5>
                                <small></small>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.3s" >
                        <div class="property-item rounded overflow-hidden">
                        <div class="team-item rounded overflow-hidden bg-light">
                            <div class="position-relative">
                                <a href=""><img class="img-fluid" src="img/bua/po2.jpg" alt=""></a>
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <!-- <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a> -->
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">สมุนไพรเจี่ยวกู่หลาน</h5>
                                <small></small>
                            </div>
                        </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                        <div class="property-item rounded overflow-hidden">
                        <div class="team-item rounded overflow-hidden bg-light">
                            <div class="position-relative">
                                <a href=""><img class="img-fluid" src="img/bua/po3.jpg" alt=""></a>
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <!-- <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a> -->
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">ผลไม้บัวหิมะ</h5>
                                <small></small>
                            </div>
                        </div>
                        
                    </div>
                    </div>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="0.7s">
                        <div class="property-item rounded overflow-hidden">
                        <div class="team-item rounded overflow-hidden bg-light">
                            <div class="position-relative">
                                <a href=""><img class="img-fluid" src="img/bua/po4.jpg" alt=""></a>
                                <div class="position-absolute start-50 top-100 translate-middle d-flex align-items-center">
                                    <!-- <a class="btn btn-square mx-1" href=""><i class="fab fa-facebook-f"></i></a>
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-twitter"></i></a>
                                    <a class="btn btn-square mx-1" href=""><i class="fab fa-instagram"></i></a> -->
                                </div>
                            </div>
                            <div class="text-center p-4 mt-3">
                                <h5 class="fw-bold mb-0">ผลไม้อะโวคาโด</h5>
                                <small></small>
                            </div>
                        </div>
                    </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <!-- Team End -->

    </div>
        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                    <h1 class="mb-3">ช่าวสารเพิ่มเติม</h1>
                    <p >กิจกรรมแจกของขวัญ คูปองส่วนลด กิจกรรมต่างของ Buodoi.</p>
                </div>
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
        <!-- Testimonial End -->
        
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

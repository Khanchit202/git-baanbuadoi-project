<?php
include ("db_config.php");
$db_con = connect_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>premaket ข่าวสารประชาสัมพันธ์</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="tabbar_view/nav_bar.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="button.css">
    <link rel="stylesheet" href="card.css">

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">
    <link rel="icon" type="image/x-icon" href="tabbar_view/baanbuadoi.png" style="border-radius: 5px;">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">

    
</style>
</head>
<body>
    <div class="container-xxl bg-white p-0">
        <nav id="navbar">
            <?php include("tabbar_view/tab_bar.php"); ?>
        </nav>

        
        

        <!-- ส่วนแสดงข่าวสารประชาสัมพันธ์ -->
        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
            <div id="title">
                <h1>กิจกรรมและประชาสัมพันธ์</h1>
                <p>ข่าวสารชุมชน กิจกรรมชุมชน ที่น่าสนใจ</p>
            </div>
        </div>
        <?php
            $sql = 'SELECT newPic, newTitle, newID, newType FROM news WHERE newType in ("ชุมชน","เทศกาล")';
            $stmt = $db_con->prepare($sql);
            $stmt->execute();

            // เก็บข้อมูลในตัวแปร $products
            $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <div class="container-xxl bg-white p-0">
                <div class="container">
                    <div class="row g-4">
                        <!-- การ์ดสำหรับกิจกรรม -->
                        <?php foreach ($products as $product) { ?>
                            <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.5s">
                                <div class="card position-relative text-white card-hover mb-5" style="width: 100%; height: 400px; overflow: hidden; position: relative; border-radius: 20px;">
                                    <img src="img/news_pic/<?php echo $product['newPic']; ?>" class="card-img" alt="Product Image" style="height: 100%; object-fit: cover;">
                                    <span class="badge position-absolute custom-badge p-3" style="top: 10px; left: 50%; transform: translateX(-50%); background-color: #fff; color: #000; border-radius: 5px; padding: 10px;"><?php echo $product['newTitle']; ?></span>
                                    <div class="card-img-overlay d-flex flex-column justify-content-end" style="color: #000;">
                                        <div class="overlay-content p-4" style="border-radius: 20px; transition: transform 0.3s;"></div>
                                    </div>
                                    <a href="detail_premaket.php?id=<?php echo $product['newID']; ?>" class="book-button" style="display: none; position: absolute; top: 320px; left: 10%; width: 80%; height: 50px; background-color: #fff; color: #000; border: none; border-radius: 5px; font-size: 10px; font-weight: bold; text-align: center; line-height: 50px; text-decoration: none;">อ่านเพิ่มเติม</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>

        <!-- ปิดส่วนแสดงข่าวสารประชาสัมพันธ์ -->

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
                <?php
                    $sql = 'SELECT newPic, newTitle, newID, newType FROM news WHERE newType = "สินค้า"';
                    $stmt = $db_con->prepare($sql);
                    $stmt->execute();

                    // เก็บข้อมูลในตัวแปร $products
                    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <div class="produc_pre" style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 10px; margin: 0 10px;">
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
                                    <div class="text-center p-4 mt-3 bg-light-green text-dark">
                                        <h5 class="fw-bold mb-0"><?php echo $product['newTitle']; ?></h5>
                                        <small></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
        <!-- Team End -->
    </div>
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

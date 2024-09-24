<?php
include ("db_config.php");
$db_con = connect_db();
$id = $_GET['id'];

$query = $db_con->prepare("SELECT * FROM news WHERE newID = :id");
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$news = $query->fetch(PDO::FETCH_ASSOC);

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
    
</head>
<body>

<div class="container-xxl bg-white p-0">
        <nav id="navbar">
            <?php include("tabbar_view/tab_bar.php"); ?>
        </nav>

        <!-- About Start -->
        <div class="container-xxl bg-white p-0" style="margin-top:150px;">
            <div class="container"style="box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);border-radius:10px;">
                <div class="row g-5 align-items-center">
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                    <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="./img/news_pic/<?php echo $news['newPic']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-5 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4"style="font-weight: bold;"><?php echo $news['newTitle']; ?></h1>
                        <p class="mt-3 mb-3 text-justify"><?php echo nl2br($news['newDetail']); ?></p>

                    </div>
                </div>
            </div>
        </div>
        <!-- About End -->
        <div class="text-center mx-auto mt-5 mb-2 wow fadeInUp" data-wow-delay="0.1s">
            <h1 class="fw-bold" style="color: #BC5686;">สินค้าชุมชนแนะนำ</h1>
            <p style="color: #BC5686;">สินค้าชุมชน ผลิตภัณฑ์จากวิสาหกิจชุมชน ผลไม้เมื่องหนาวของเรา</p>
        </div>
        <!-- Testimonial Start -->
        <div class="container-xxl py-5">
            <div class="container">
                <?php
                    $sql = 'SELECT * FROM news WHERE newType = "สินค้า"';
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
                                    <a href="product_detail.php?id=<?php echo $product['newID']; ?>"><img class="img-fluid zoom" src="img/news_pic/<?php echo $product['newPic']; ?>" alt="Product Image" style="width: 250px; height: 250px;border-radius:15px;"></a>
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

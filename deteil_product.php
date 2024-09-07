<?php
include ("db_config.php");
$db_con = connect_db();
$id = $_GET['id'];

$query = $db_con->prepare("SELECT * FROM room_product WHERE roomID = :id");
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$room = $query->fetch(PDO::FETCH_ASSOC);

// Check if room data is available
if (!$room) {
    die("Room not found.");
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
                <div class="col-md-6" id="deteil_img">
                    <?php if (isset($room['roomPic'])): ?>
                        <img style="border-radius: 5px;" src="img/room_pic/<?php echo htmlspecialchars($room['roomPic']); ?>" alt="Room Image" class="img-fluid">
                    <?php endif; ?>
                </div>
                <div class="col-md-6" id="deteil_text">
                    <h1><?php echo htmlspecialchars($room['roomName']); ?></h1>
                    <p><?php echo htmlspecialchars($room['roomDetail']); ?></p>
                    <p>Price: <?php echo htmlspecialchars($room['roomPrice']); ?> per night</p>
                    <button class="btn btn-primary" style="width: 100%;"> + จอง</button>
                </div>
            </div>
        </div>
       
        <div class="container-xxl py-5">
            <div class="container">
                <div class="owl-carousel testimonial-carousel wow fadeInUp" data-wow-delay="0.1s">
                    <?php for($i = 0; $i < 5 ; $i++){ ?>
                        <div class="testimonial-item bg-light rounded p-3">
                            <div class="bg-white border rounded p-4 d-flex">
                                <div class="testimonial-image me-3" style="width: 50px;">
                                    <img src="img/profile/profile_1.jpg" alt="Reviewer Image" class="img-fluid rounded-circle" style="width: 40px; height: 40px; object-fit: cover;">
                                </div>
                                <div class="testimonial-content d-flex flex-column">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h5 class="fw-bold mb-0" style="font-size: 16px;">ครรชิต บางพระ</h5>
                                        <div class="star-rating" style="font-size: 14px;">
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star text-warning"></i>
                                            <i class="fa fa-star-half-alt text-warning"></i>
                                        </div>
                                    </div>
                                    <p style="width: 440px; font-size: 12px;">ห้องพักมีความสะดวกสบาย และสะอาดมากครับห้องพักมีความสะดวกสบาย และสะอาดมากครับห้องพักมีความสะดวกสบาย และสะอาดมากครับ</p>
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

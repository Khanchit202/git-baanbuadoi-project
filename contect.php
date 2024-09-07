<?php
include ("db_config.php");
$db_con = connect_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contect เกี่ยวกับเรา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="tabbar_view/nav_bar.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="button.css">
    <link rel="stylesheet" href="card.css">

    <!-- Favicon -->
    <link href="../img/favicon.ico" rel="icon">
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
        <nav id="navbar">
            <?php include("tabbar_view/tab_bar.php"); ?>
        </nav>

        <?php
            

            $sql = 'SELECT newTitle, newDetail,newID,newPic FROM news WHERE newID = "00016"';
            $stmt = $db_con->prepare($sql);
            $stmt->execute();

            $news = $stmt->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <!-- About Start -->
        <div class="container-xxl bg-white p-0">
            <div class="container">
                <div class="row g-5 align-items-center">
                <?php foreach ($news as $item) { ?>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                        <div class="about-img position-relative overflow-hidden p-5 pe-0">
                            <img class="img-fluid w-100" src="img/news_pic/<?php echo $item['newPic']; ?>">
                        </div>
                    </div>
                    <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                        <h1 class="mb-4"><?php echo $item['newTitle']; ?></h1>
                        <p class="mt-3 mb-3 text-justify"><?php echo nl2br($item['newDetail']); ?></p>

                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <!-- About End -->
    
        
        <!-- Team  -->
        
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;margin-top:70px;">
                    <h1 class="mb-3">เจ้าหน้าที่ดูแลระบบ</h1>
                </div>

                <div class="menu_pro d-flex justify-content-between" style="margin: 60px 60px;" >
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="card" style="width: 250px;">
                            <img src="img/bua/team1.jpg" class="card-img-top" alt="Programer" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 16px; font-weight: bold;">Somchai Manhoeng</h5>
                                <p class="card-text" style="font-size: 12px;">Programer</p>
                                <div class="mt-3">
                                    <a href="https://www.facebook.com" target="_blank" style="text-decoration: none;">
                                        <div style="width: 40px; height: 40px; border-radius: 5px; background-color: #3b5998; display: inline-flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-facebook" style="font-size: 16px; color: white;"></i>
                                        </div>
                                    </a>
                                    <a href="https://www.instagram.com" target="_blank" style="text-decoration: none;">
                                        <div style="width: 40px; height: 40px; border-radius: 5px; background-color: #E1306C; display: inline-flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-instagram" style="font-size: 16px; color: white;"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wow fadeInUp" data-wow-delay="0.2s">
                        <div class="card" style="width: 250px;">
                            <img src="img/profile/khanchit.jpg" class="card-img-top" alt="Programer" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 16px; font-weight: bold;">ครรชิต บางพระ</h5>
                                <p class="card-text" style="font-size: 12px;">Programer</p>
                                <div class="mt-3">
                                    <a href="https://web.facebook.com/khanchit.bp/" target="_blank" style="text-decoration: none;">
                                        <div style="width: 40px; height: 40px; border-radius: 5px; background-color: #3b5998; display: inline-flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-facebook" style="font-size: 16px; color: white;"></i>
                                        </div>
                                    </a>
                                    <a href="https://www.instagram.com/khanchit.ig/" target="_blank" style="text-decoration: none;">
                                        <div style="width: 40px; height: 40px; border-radius: 5px; background-color: #E1306C; display: inline-flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-instagram" style="font-size: 16px; color: white;"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wow fadeInUp" data-wow-delay="0.4s">
                        <div class="card" style="width: 250px;">
                            <img src="img/profile/khanchit_bp.jpg" class="card-img-top" alt="Addmin" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 16px; font-weight: bold;">Khanchit Bangphra</h5>
                                <p class="card-text" style="font-size: 12px;">Admin</p>
                                <div class="mt-3">
                                    <a href="https://web.facebook.com/khanchit.bp/" target="_blank" style="text-decoration: none;">
                                        <div style="width: 40px; height: 40px; border-radius: 5px; background-color: #3b5998; display: inline-flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-facebook" style="font-size: 16px; color: white;"></i>
                                        </div>
                                    </a>
                                    <a href="https://www.instagram.com/khanchit.ig/" target="_blank" style="text-decoration: none;">
                                        <div style="width: 40px; height: 40px; border-radius: 5px; background-color: #E1306C; display: inline-flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-instagram" style="font-size: 16px; color: white;"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wow fadeInUp" data-wow-delay="0.6s">
                        <div class="card" style="width: 250px;">
                            <img src="img/bua/team1.jpg" class="card-img-top" alt="Addmin" style="height: 200px; object-fit: cover;">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 16px; font-weight: bold;">สมชาย หมั่นเฮิง</h5>
                                <p class="card-text" style="font-size: 12px;">Admin</p>
                                <div class="mt-3">
                                    <a href="https://web.facebook.com/khanchit.bp/" target="_blank" style="text-decoration: none;">
                                        <div style="width: 40px; height: 40px; border-radius: 5px; background-color: #3b5998; display: inline-flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-facebook" style="font-size: 16px; color: white;"></i>
                                        </div>
                                    </a>
                                    <a href="https://www.instagram.com/khanchit.ig/" target="_blank" style="text-decoration: none;">
                                        <div style="width: 40px; height: 40px; border-radius: 5px; background-color: #E1306C; display: inline-flex; align-items: center; justify-content: center;">
                                            <i class="bi bi-instagram" style="font-size: 16px; color: white;"></i>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <!-- Team End -->
         
        <!-- Call to Action Start -->
        <div class="container-xxl bg-white p-0">
            <div class="container">
                <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;margin-top:100px;">
                    <h1 class="mb-3">ติดต่อเราได้ที่</h1>
                    <p>หากท่านมีข้อสงสัย หรืออยากทราบข้อมูลเพื่อเติม หรือหลายละเอียดต่างๆ ท่านสามารถติดต่อเรา โดยตรง ตามช่องทางที่ท่านสะดวกได้เลย</p>
                </div>
            </div>
            <div class="container">
                    <div class="bg-white rounded p-4 px-3">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="row gy-4">
                                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                                        <div class="bg-light rounded p-3">
                                            <a href=""style="text-decoration:none;color: black;">
                                                <div class="d-flex align-items-center bg-white rounded p-3" style="border: 1px dashed rgba(0, 185, 142, .3)">
                                                <div class="icon me-3 " style="width: 60px; height: 60px;">
                                                    <i class="fab fa-instagram fa-4x "></i>
                                                </div>
                                                <span>Instagram</span>
                                            </div></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                                        <div class="bg-light rounded p-3">
                                            <a href=""style="text-decoration:none;color: black;">
                                                <div class="d-flex align-items-center bg-white rounded p-3" style="border: 1px dashed rgba(0, 185, 142, .3)">
                                                <div class="icon me-3 " style="width: 60px; height: 60px;">
                                                    <i class="fab fa-facebook-f fa-3x "></i>
                                                </div>
                                                <span>facebook pag</span>
                                            </div></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                                        <div class="bg-light rounded p-3">
                                            <a href=""style="text-decoration:none;color: black;">
                                                <div class="d-flex align-items-center bg-white rounded p-3" style="border: 1px dashed rgba(0, 185, 142, .3)">
                                                <div class="icon me-3" style="width: 60px; height: 60px;">
                                                    <i class="fab fa-tumblr  fa-3x "></i>
                                                </div>
                                                <span>Twitter & X</span>
                                            </div></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                                        <div class="bg-light rounded p-3">
                                            <a href=""style="text-decoration:none;color: black;">
                                                <div class="d-flex align-items-center bg-white rounded p-3" style="border: 1px dashed rgba(0, 185, 142, .3)">
                                                <div class="icon me-3" style="width: 60px; height: 60px;">
                                                    <i class="fab fa-weixin fa-3x "></i>
                                                </div>
                                                <span>Line</span>
                                            </div></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                                        <div class="bg-light rounded p-3">
                                            <a href=""style="text-decoration:none;color: black;">
                                                <div class="d-flex align-items-center bg-white rounded p-3" style="border: 1px dashed rgba(0, 185, 142, .3)">
                                                <div class="icon me-3" style="width: 60px; height: 60px;">
                                                    <i class="fa fa-envelope-open fa-3x "></i>
                                                </div>
                                                <span>BuadoiFram@gmail.com</span>
                                            </div></a>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-4 wow fadeIn" data-wow-delay="0.5s">
                                        <div class="bg-light rounded p-3">
                                            <a href=""style="text-decoration:none;color: black;">
                                                <div class="d-flex align-items-center bg-white rounded p-3" style="border: 1px dashed rgba(0, 185, 142, .3)">
                                                <div class="icon me-3" style="width: 60px; height: 60px;">
                                                    <i class="fa fa-phone-alt fa-3x "></i>
                                                </div>
                                                <span>0958935107</span>
                                            </div></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                    </div>
                    </div>
            </div>
        </div>
        <!-- Call to Action End -->
        <div class="text-center mx-auto mb-5 mt-5 fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
            <h1 class="mb-3">เยี่ยมชมทางเราถึงที่</h1>
            <p>บ้านนอแล ดอยอ่างขาง ตำบล ม่อนปิ่น อำเภอ ฝาง จังหวัดเชียงใหม่ 50110</p>
        </div>
                
                <div class="container-xxl bg-white p-0">
                    <div class="text-center mx-auto mb-5 wow fadeInUp " data-wow-delay="0.1s" >
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d120022.82019442834!2d98.95786453880915!3d19.93648999536336!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30d0d046dd2d052b%3A0x24a62e01d0ef8d07!2z4Lio4Li54LiZ4Lii4LmM4Lir4Lix4LiV4LiW4LiB4Lij4Lij4Lih4Lia4LmJ4Liy4LiZ4LiZ4Lit4LmB4Lil!5e0!3m2!1sth!2sth!4v1711204555439!5m2!1sth!2sth" width="500" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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

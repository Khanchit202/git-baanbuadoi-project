<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>บ้านบัวดอยโฮมสเตย์</title>
    <link rel="stylesheet" href="cs.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="tabbar_view/nav_bar.css">
</head>
<body>
    <?php include("tabbar_view/tab_bar.php"); ?>

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
</body>
</html>

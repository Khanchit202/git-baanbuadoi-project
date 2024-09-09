<?php

include ("../db_config.php");
$db_con = connect_db();
$id = $_GET['id'];

$query = $db_con->prepare("SELECT * FROM room_product WHERE roomID = :id");
$query->bindParam(':id', $id, PDO::PARAM_INT);
$query->execute();
$room = $query->fetch(PDO::FETCH_ASSOC);

$price = $room['roomPrice'];
$deposit = ($price * 30) / 100;

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
    <link rel="stylesheet" href="../tabbar_view/nav_bar.css">
    <link rel="stylesheet" href="../style1.css">
    <link rel="stylesheet" href="booking.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="booking.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container-xxl bg-white p-0">
        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 mb-3" id="deteil_img">
                    <?php if (isset($room['roomPic'])): ?>
                        <img style="border-radius: 10px;" src="../img/room_pic/<?php echo htmlspecialchars($room['roomPic']); ?>" alt="Room Image" class="img-fluid">
                    <?php endif; ?>
                </div>

                <div class="col-md-6 mt-2" id="deteil_text" style="font-size: 10px;">
                    <h1 class="fw-bold" style="font-size: 20px; margin-bottom: 20px;"><?php echo htmlspecialchars($room['roomName']); ?></h1>
                        <div class="row mb-1">
                            <div class="col-md-3 fw-bold"><p>รายละเอียด</p></div> 
                            <div class="col-md-7"><?php echo htmlspecialchars($room['roomDetail']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 fw-bold"><p>ตั้งอยู่ที่</p></div> 
                            <div style="color:#4DA865; " class="col-md-7 fw-bold"><i class="lni lni-map-marker me-2" style=""></i><?php echo htmlspecialchars($room['roomLocation']); ?></div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 fw-bold"><p>จำนวนเตียงนอน</p></div> 
                            <div style="color:#4DA865; " class="col-md-2 fw-bold"><?php echo htmlspecialchars($room['roomBed']); ?> <i class="fa fa-bed me-2" style="padding: 5px; margin-left: 5px;"></i></div>
                            <div class="col-md-3 fw-bold"><p>จำนวนห้องน้ำ</p></div> 
                            <div style="color:#4DA865; " class="col-md-2 fw-bold"><?php echo htmlspecialchars($room['roomBed']); ?> <i class="fa fa-bath me-2" style="padding: 5px; margin-left: 5px;"></i></div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3 fw-bold"><p>จำนวนห้องน้ำ</p></div> 
                            <div style="color:#4DA865; " class="col-md-2 fw-bold"><?php echo htmlspecialchars($room['roomMin']); ?> - <?php echo htmlspecialchars($room['roomMax']);?> <i class="lni lni-users me-2" style="font-size: 12px; margin-left: 5px;"></i></div>
                            <div class="col-md-3 fw-bold"><p>ราคามัดจำ (กรณีจองออนไลท์)</p></div> 
                            <div style="color:#4DA865; " class="col-md-2 fw-bold">30 เปอร์เซ็น</div>
                        </div>
                        
                        <div class="row mb-2">
                            <div class="col-md-3 fw-bold"><p>ราคา/คืน</p></div> 
                            <div class="col-md-2 bg-light text-center" style="margin:0; padding:0; border-radius: 10px;"><h3 class="fw-bold" style="font-size:14px; margin-top:10px;"><?php echo $price ?> ฿</h3></div>
                            <div class="col-md-3 fw-bold"><p>ราคามัดจำ</p></div> 
                            <div class="col-md-2 bg-light text-center" margin:0; padding:0; border-radius: 10px;"><h3 class="fw-bold" style="font-size:14px; margin-top:10px;"><?php echo $deposit ?> ฿</h3></div>
                        </div>
                    <br><br>                     
                    <button onclick="getCheckDate('<?php echo $id ?>')" class="btn btn-custom" style="width: 100%;"> ยืนยันการจอง </button>
                </div>
            </div>
        </div>
        
        <h1 class="fw-bold" style="font-size: 16px;">เลือกวันที่ต้องการจอง</h1>
        <div id="check_date" class="bg-light" style="margin:20px 2%; padding: 20px 30px; background-color: #ccc;">
            
            
        </div>


   
</div>

    <nav>
        <?php include("../footer.php"); ?>
    </nav>
    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="booking.js"></script>
</body>
</html>

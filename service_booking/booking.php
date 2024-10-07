<?php
session_start();
include ("../db_config.php");
$db_con = connect_db();
$id = $_GET['id'];

if (($_SESSION['userID']) == "") {
        header("Location: ../login.php");
    exit;
}

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
    <link rel="stylesheet" href="../tabbar_view/nav_bar.css">
    <link rel="stylesheet" href="../style1.css">
    <link rel="stylesheet" href="booking.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="icon" type="image/x-icon" href="../baanbuadoi_top.png" style="border-radius: 5px;">

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
        
        <div onclick="goBack()" class="btn btn-lg btn-custom " style="position: fixed;top: 70px;left: 86%;z-index: 1000;cursor: pointer;">
            <div class="d-flex">
                <i class="fa fa-arrow-left" style="color: #ffffff;"></i>
                <h5 style="font-size: 10px; padding:0; margin: 0; padding-left: 5px;">กลับ</h5>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-6 mb-3" id="deteil_img">
                    <?php if (isset($ser['servicePic'])): ?>
                        <img style="border-radius: 10px; width: 100%; height: 500px; object-fit: cover;" src="../img/service/<?php echo htmlspecialchars($ser['servicePic']); ?>" alt="Service Image" class="img-fluid">
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
                    <button onclick="showBookingForm('<?php echo $id ?>')" class="btn btn-custom" style="width: 100%;"> ยืนยันการจอง </button>
                </div>
            </div>
        </div>

        <div id="booking_form" class="bg-light" style="margin:20px 2%; padding: 20px 30px; display:none;">
            <h1 class="fw-bold" style="font-size: 16px;">เลือกวันที่ต้องการจอง</h1>
                <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="payer_first_name" class="form-label">เลือกวันรับบริการ</label>
                            <input type="date" id="booking_date" class="col-md-2 form-control"/>
                        </div>
                        <div class="col-6 mb-3">
                            <label for="time" class="form-label">รอบเวลาการจอง</label>
                            <select id="time" name="bookingTime" class="form-select" required>
                                <option value="">เลือกเวลารอบ</option>
                                <option value="09:00:00">รอบที่ 1 (เริ่ม 9.00 น.)</option>
                                <option value="10:00:00">รอบที่ 2 (เริ่ม 10.00 น.)</option>
                                <option value="11:00:00">รอบที่ 3 (เริ่ม 11.00 น.)</option>
                                <option value="12:00:00">รอบที่ 4 (เริ่ม 12.00 น.)</option>
                                <option value="13:00:00">รอบที่ 5 (เริ่ม 13.00 น.)</option>
                                <option value="14:00:00">รอบที่ 6 (เริ่ม 14.00 น.)</option>
                                <option value="15:00:00">รอบที่ 7 (เริ่ม 15.00 น.)</option>
                                <option value="16:00:00">รอบที่ 8 (เริ่ม 16.00 น.)</option>
                                <option value="17:00:00">รอบที่ 9 (เริ่ม 17.00 น.)</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3 text-end">
                            <button onclick="checkBooking('<?php echo $id ?>')" class="col-md-7 btn btn-custom " style="width: 200px; height">ตรวจสอบ</button>
                        </div>
                    </div> 
            </div>
        

        <div id="customer_info" class="bg-light" style="margin:20px 2%; padding: 20px 30px; display:none">            
            <div class="row mt-2">
                <div class="col-md-3 fw-bold"><p>สถานะห้องพัก</p></div> 
                <div style="color:#ffffff; border-radius: 20px; background-color: #4DA865; padding-top: 3px; margin:0; height: 20px" class="col-md-2 text-center">
                    <h1 style="font-size: 12px; padding:0;margin:0;">พร้อมให้บริการ</h1>
                </div>  
            </div>
            <div class="row mt-2 mb-2">
                <div class="col-md-3 fw-bold"><p>เวลาเข้าพัก</p></div> 
                <div class="col-md-2"><p>14.00 น.</p></div>
                <div class="col-md-2 fw-bold"><p>เวลาออก</p></div> 
                <div class="col-md-2"><p>11.00 น. (วันถัดไป)</p></div> 
            </div>
            <h1 class="fw-bold" style="font-size: 16px;">กรอกข้อมูลการจอง</h1>
            <input type="text" id="customer_name" class="form-control mb-3" placeholder="ชื่อผู้จอง (สำหรับออกใบเสร็จ)" />
            <input type="text" id="customer_phone" class="form-control mb-3" placeholder="เบอร์โทร" />
            <input type="text" id="customer_detail" class="form-control mb-3" placeholder="รายละเอียดเพิ่มเติม (ถ้ามี)" />
            <input type="text" id="customer_pro" class="form-control mb-3" placeholder="โค้ดส่วนลด (ถ้ามี)" />
            <input type="hidden" id="price" class="form-control mb-3" value="<?php echo $deposit ?>" />
            
            <h5>ช่องทางการชำระเงิน</h5>
            <div class="form-check">
                <input type="radio" id="payment1" name="payment" value="C" class="form-check-input">
                <label class="form-check-label d-flex align-items-center" for="payment1">
                    <i class="fab fa-cc-visa fa-2x me-2"></i>
                    <i class="fab fa-cc-mastercard payment-icon fa-2x me-2" aria-hidden="true"></i>
                    บัตรเครดิต (Visa)
                </label>
            </div>
            <div class="form-check">
                <input type="radio" id="payment2" name="payment" value="Q" class="form-check-input">
                <label class="form-check-label d-flex align-items-center" for="payment2">
                    <i class="fas fa-qrcode qr-code-icon me-2" style="font-size: 16px; color: #ffffff; border-radius: 3px; background-color: black; padding: 5px 11px;" aria-hidden="true"></i>
                    โอนผ่าน PromptPay QR CODE (รอการตรวจสอบภายใน 72 ชั่วโมง)
                </label>
            </div>

            <div class="row">
                <button onclick="confirmBooking('<?php echo $id ?>')" class="btn btn-success mt-3">ชำระเงิน</button>
            </div> 
        </div>


        <div id="reserved" class="bg-light" style="margin:20px 2%; padding: 20px 30px; display:none;">
            <div class="row">
                <div class="col-md-3 fw-bold"><p>สถานะห้องพัก</p></div> 
                <div style="color:#ffffff; border-radius: 20px; background-color: red; padding-top: 3px; margin:0; height: 20px" class="col-md-2 text-center" ><h1 style="font-size: 12px; padding:0;margin:0;">มีการจองแล้ว</h1></div>  
            </div>
        </div>

        <script>

            function formatCardNumber(input) {
                var value = input.value.replace(/\D/g, '');
                var formattedValue = value.replace(/(.{4})/g, '$1-').trim();
                input.value = formattedValue.substring(0, 19);
            }


            function formatExpiryDate(input) {
                var value = input.value.replace(/\D/g, '');
                if (value.length >= 2) {
                    input.value = value.substring(0, 2) + '/' + value.substring(2, 4);
                }
            }

            function goBack() {
                window.history.back();
            }

        </script>



        
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

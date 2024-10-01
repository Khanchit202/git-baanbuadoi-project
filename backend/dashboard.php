<?php
    session_start();
    include("../db_config.php");
    include("menu_dash.php");

    $db_con = connect_db("client");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แดชบอร์ด</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
    <link rel="stylesheet" href="dashss.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script> 
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>

<body>
    <div class="wrapper">
        <aside id="sidebar">
            <div class="d-flex" style="padding: 20px 0 20px 20px;">
                <img src="../tabbar_view/baanbuadoi.png" alt="" width="30px">
                <div class="sidebar-logo">
                    <a href="#">กิจการบ้านบัวดอย</a>
                </div>
            </div>

            <?php
                menu_dash();
            ?>
            
        </aside>

        <div class="main p-3" style="background-color: #ECF0F1;">
            <nav class="navbar navbar-light bg-light justify-content-between" style="border-radius: 10px; margin-bottom: 20px;">
                <div class="bar">
                    <button class="toggle-btn" type="button">
                        <i class="lni lni-menu"></i>
                    </button>
                </div>
                <p style="margin: 5px 0px 0px 0px;">ระบบบริหารจัดการกิจการ</p>
                <div class="sidebar-footer">
                <a href="../index.php" class="sidebar-link">
                    <i class="lni lni-home"></i>
                    <span>กลับหน้าหลัก</span>
                </a>
            </div>
            </nav>
            <div>
                <?php
                    if (isset($_GET['page'])) {
                        $page = $_GET['page'];
                        switch ($page) {
                            case 'dashboard':
                                include 'dash_data/dash.php';
                                break;
                            case 'user-data':
                                include 'user_data/user_data.php';
                                break;
                            case 'room-data':
                                include 'room_data/room.php';
                                break;
                            case 'service-data':
                                include 'service_data/service.php';
                                break;
                            case 'booking-data':
                                include 'booking_data/booking.php';
                                break;
                            case 'premaket-data':
                                include 'premaket_data/premaket.php';
                                break;
                            case 'bookingpayment-data':
                                include 'booking_payment_data/booking_payment.php';
                                break;
                            case 'promotion-data':
                                include 'promotion_data/promotion.php';
                                break;
                            case 'reviwsroom-data':
                                include 'reviwsroom_data/reviwsroom.php';
                                break;
                            case 'reviwsservice-data':
                                include 'reviwsservice_data/reviwsservice.php';
                                break;
                            case 'checkin-data':
                                include "checking_data/check_show.php";
                                break;
                            case 'checkout-data':
                                include "checking_data/check_show.php";
                                break;
                            default:
                                echo "<h2>ไม่พบหน้า</h2>";
                        }
                    } else {
                        include 'dash_data/dash.php';
                    }
                ?>
            </div>
            <div class="footer" style="background-color: white; border-radius: 10px; margin-top: 10px; text-align: center; height: 60px;padding-top:20px;">
                <div class="bar">
                    <p style="opacity: 50%; font-size: 10px;">&copy; 2024 Khanchit Bangphra & Somchai Manheang. All rights reserved.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- นำเข้า javascript .js -->
    <script src="main.js"></script>
    <script type="text/javascript" src="./user_data/user_datass.js"></script>
    <script type="text/javascript" src="./room_data/room_datass.js"></script>
    <script type="text/javascript" src="./service_data/service_datas.js"></script>
    <script type="text/javascript" src="./premaket_data/premaket_datas.js"></script>
    <script type="text/javascript" src="./booking_payment_data/payment.js"></script>
    <script type="text/javascript" src="./booking_data/booking.js"></script>
    <script type="text/javascript" src="./promotion_data/promotion.js"></script>
    <script type="text/javascript" src="./reviwsroom_data/reviwsroom.js"></script>

    <script type="text/javascript" src="./dash_data/dash.js"></script>
    <script type="text/javascript" src="./checking_data/check.js"></script>
    
    <script>
        
function showDetails(bookName, billStatus, bookType, checkIn, checkOut, payMoney, roomName, roomLocation, roomPrice) {
    // แปลงค่า payMoney เป็นตัวเลข และตรวจสอบค่าที่ถูกต้อง
    let parsedPayMoney = parseFloat(payMoney);
    let parsedRoomPrice = parseFloat(roomPrice);

    // เช็คว่าค่าเป็นตัวเลขหรือไม่ ถ้าไม่ใช่ให้ตั้งค่าเป็น 0
    if (isNaN(parsedPayMoney)) {
        parsedPayMoney = 0;
    }
    if (isNaN(parsedRoomPrice)) {
        parsedRoomPrice = 0;
    }

    let vat = (parsedRoomPrice * 7) / 100;
    let total = parsedRoomPrice + vat;
    let remainingPrice = total - parsedPayMoney;

    if (document.getElementById('modalName')) {
        document.getElementById('modalName').innerText = bookName;
    }
    if (document.getElementById('modalBookName')) {
        document.getElementById('modalBookName').innerText = bookName;
    }
    if (document.getElementById('modalBillStatus')) {
        document.getElementById('modalBillStatus').innerText = billStatus;
    }
    if (document.getElementById('modalBookType')) {
        document.getElementById('modalBookType').innerText = bookType;
    }
    if (document.getElementById('modalCheckIn')) {
        document.getElementById('modalCheckIn').innerText = checkIn;
    }
    if (document.getElementById('modalCheckOut')) {
        document.getElementById('modalCheckOut').innerText = checkOut;
    }
    if (document.getElementById('modalPayMoney')) {
        document.getElementById('modalPayMoney').innerText = parsedPayMoney.toFixed(2);
    }
    if (document.getElementById('modalRoomName')) {
        document.getElementById('modalRoomName').innerText = roomName;
    }
    if (document.getElementById('modalRoomLocation')) {
        document.getElementById('modalRoomLocation').innerText = roomLocation;
    }
    if (document.getElementById('modalRoomPrice')) {
        document.getElementById('modalRoomPrice').innerText = parsedRoomPrice.toFixed(2);
    }
    if (document.getElementById('modalPrice')) {
        document.getElementById('modalPrice').innerText = parsedRoomPrice.toFixed(2);
    }
    if (document.getElementById('modalVat')) {
        document.getElementById('modalVat').innerText = vat.toFixed(2);
    }
    if (document.getElementById('modalTotalAmount')) {
        document.getElementById('modalTotalAmount').innerText = total.toFixed(2);
    }
    if (document.getElementById('modalRemainingAmount')) {
        document.getElementById('modalRemainingAmount').innerText = remainingPrice.toFixed(2);
    }

    // เปิด modal
    $('#detailsModal').modal('show');
}



</script>



    
</body>

</html>

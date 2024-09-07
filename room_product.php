<?php
include ("db_config.php");
$db_con = connect_db();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>room product ห้องพัก</title>
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
    <!-- Data table -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <!-- SweetAlert CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript" >
      $(document).ready(function () {
        $('#room').DataTable();
      });

    </script>

</head>
<body>
    <div class="container-xxl bg-white p-0">
        <nav id="navbar">
            <?php include("tabbar_view/tab_bar.php"); ?>
        </nav>



        <!-- ส่วนแสดงข้อมูลห้องพัก -->
        
        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
            <div id="title2" style="margin: 60px 60px">
                <h1>ห้องพักทั้งหมด</h1>
                <p>โฮมสเตย์บ้านบัวดอย ดอยอ่างขาง</p>
            </div>
        </div>

        <?php
            $stdID = isset($_GET['stdID']) ? $_GET['stdID'] : null;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $limit = 12;
            $offset = ($page - 1) * $limit;

            if ($stdID) {
                $sql = 'SELECT roomPic, roomName, roomID, roomBed, roomBath, roomPrice, stdID FROM room_product WHERE stdID = :stdID LIMIT :limit OFFSET :offset';
                $stmt = $db_con->prepare($sql);
                $stmt->bindParam(':stdID', $stdID, PDO::PARAM_STR);
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
            } else {
                $sql = 'SELECT roomPic, roomName, roomID, roomBed, roomBath, roomPrice, stdID FROM room_product LIMIT :limit OFFSET :offset';
                $stmt = $db_con->prepare($sql);
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
                $stmt->execute();
            }

            $rooms = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="produc_pre d-flex flex-row flex-wrap justify-content-start" style="margin: 0 30px;" id="room">
                <!-- การ์ดสำหรับห้อง -->
                <?php foreach ($rooms as $room) { 
                    // กำหนดข้อความและสีพื้นหลังตามค่า stdID
                    if ($room['stdID'] == '00001') {
                        $statusText = 'ว่าง';
                        $badgeColor = '#4caf50';
                        $buttonText = '+ จอง';
                        $buttonColor = '#4caf50';
                    } elseif ($room['stdID'] == '00002') {
                        $statusText = 'เต็ม';
                        $badgeColor = '#DE6461';
                        $buttonText = 'รายละเอียด';
                        $buttonColor = '#DE6461';
                    } elseif ($room['stdID'] == '00003') {
                        $statusText = 'กำลังเตรียม';
                        $badgeColor = '#3B8386';
                        $buttonText = 'รายละเอียด';
                        $buttonColor = '#3B8386';
                    } else {
                        // กรณีอื่น ๆ
                    }
                ?>
                <div class="wow fadeInUp" data-wow-delay="0.5s" style="margin: 30px;">
                    <div class="card position-relative text-white card-hover mb-5" style="width: 250px; height: 300px; overflow: hidden; position: relative; border-radius: 5px;">
                        <img src="img/room_pic/<?php echo $room['roomPic']; ?>" class="card-img" alt="Room Image" style="height: 100%; object-fit: cover;">
                        <span class="badge position-absolute custom-badge" style="top: 10px; left: 15px; background-color: <?php echo $badgeColor; ?>; color: white; border-radius: 5px; padding: 10px; opacity: 80%; padding: 10px 20px;">
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
                        <a href="<?php echo ($statusText == 'เต็ม' || $statusText == 'กำลังเตรียม') ? 'javascript:void(0);' : 'deteil_product.php?id=' . $room['roomID']; ?>" class="book-button" onclick="showAlert('<?php echo $statusText; ?>')" style="position: absolute; top: 230px; left: 10%; width: 80%; height: 50px; background-color: <?php echo $buttonColor; ?>; color: white; border: none; border-radius: 5px; font-size: 10px; font-weight: bold; text-align: center; line-height: 50px; text-decoration: none;"><?php echo $buttonText; ?></a>
                    </div>
                </div>
                <?php } ?>
            </div>
            <!-- Pagination -->
            <div class="pagination d-flex justify-content-center">
                <?php
                $totalRooms = $db_con->query('SELECT COUNT(*) FROM room_product')->fetchColumn();
                $totalPages = ceil($totalRooms / $limit);

                if ($page > 1) {
                    echo '<a href="?page=' . ($page - 1) . '"><i class="fa fa-arrow-left" style="color: #4DA866;"></i></a>';
                }

                if ($page < $totalPages) {
                    echo '<a href="?page=' . ($page + 1) . '"><i class="fa fa-arrow-right" style="color: #4DA866;"></i></a>';
                }
                ?>
            </div>
     <!-- ปิด ส่วนแสดงข้อมูลห้องพัก -->


        <div class="produc_pre" style="display: flex; flex-wrap: wrap; justify-content: space-between; gap: 20px;">

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
        <!-- แสดงแจ้งเตือนเมื่อค่าเป็นไม่ว่าง -->
        <script>
            function showAlert(statusText) {
                if (statusText === 'เต็ม' ) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'ไม่สามารถจองได้',
                        text: 'ขออภัยห้องนี้ไม่ว่างหรือถูกจองแล้ว!',
                        confirmButtonText: 'ตกลง'
                    });
                }else if( statusText === 'กำลังเตรียม'){
                    Swal.fire({
                        icon: 'warning',
                        title: 'กำลังทำความสะอาด',
                        text: 'ขออภัยห้องนี้อยู่ในระหว่างเตรียมการกรุณารอสักครู่...',
                        confirmButtonText: 'ตกลง'
                    });
                }
            }
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

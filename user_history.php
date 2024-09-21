<?php
include ("db_config.php");
$db_con = connect_db();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ฺHome Buadoi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="tabbar_view/nav_bar.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="button.css">
    
  
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="img/favicon.ico" rel="icon">
    <link rel="icon" type="image/x-icon" href="img/bua/logo.png" style="border-radius: 5px;">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
  
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>
<body>
    <div class="container-xxl bg-white p-0">
    
    <nav id="navbar">
        <?php include("tabbar_view/tab_bar.php"); ?>
    </nav>
    <?php
    if (isset($_GET['userID'])) {
        // รับค่าพารามิเตอร์ userID
        $userID = $_GET['userID'];
        

        // เตรียมและดำเนินการคำสั่ง SQL
        $sql = "SELECT * FROM users WHERE userID = :userID";
        $stmt = $db_con->prepare($sql);
        $stmt->bindParam(':userID', $userID);
        $stmt->execute();

        // ตั้งค่าผลลัพธ์เป็น associative array
        $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $user = $stmt->fetch();
        
        $userLavelName = "";

            if ($user['userLavelID'] == 1) {
                $userLavelName = 'ผู้ดูแลระบบ';
            } else if ($user['userLavelID'] == 2) {
                $userLavelName = 'เจ้าของกิจการ';
            } else if ($user['userLavelID'] == 3) {
                $userLavelName = 'พนักงาน';
            } elseif ($user['userLavelID'] == 4) {
                $userLavelName = 'สมาชิก';
            }

        
    }
    ?>

    <?php
        // SQL Query to select data from booking_bill and other related tables
        $sql = "
            SELECT * 
            FROM booking_bill 
            INNER JOIN room_product ON booking_bill.roomID = room_product.roomID
            INNER JOIN booking ON booking_bill.bookID = booking.bookID
            LEFT JOIN booking_payment ON booking_bill.payID = booking_payment.payID
            WHERE booking_bill.userID = :userID
            ORDER BY booking_bill.billID DESC
        ";


        $data2 = $db_con->prepare($sql);
        $userID = $_SESSION['userID'];
        $data2->bindParam(':userID', $userID, PDO::PARAM_INT);
        $data2->execute();
        $dataArray = $data2->fetchAll(PDO::FETCH_ASSOC);

        // Function to format date in Thai style
        function formatThaiDate($date) {
            $monthNames = [
                'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
                'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
            ];
                                                                            
            $day = $date->format('j');
            $month = $monthNames[$date->format('n') - 1];
            $year = $date->format('Y') + 543;
                                                                        
            return "{$day} {$month} {$year}";
        }
        ?>

    <br><br>
    <!-- ส่วนแสดงประวัติการจอง -->
    <div class="container" style=" padding: 0px 60px;">
        <div class="pro" style="width: 100%; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px 0px;">
            <div class="d-flex justify-content-between m-2 mb-3" style="padding: 10px 35px;">
                <p>ข้อมูลประวัติการจอง</p>
                <div class="d-flex">
                    <button type="button" class="btn" data-toggle="modal" data-target="#myModal" style="font-size: 10px; background-color: #3B8386; color: #ffffff;">แสดงรายการทั้งหมด</button>
                </div>
            </div>
            
            
            <div class="testimonial-item rounded" style="font-size: 12px; padding: 10px 25px;">
                        <div class="table-responsive" style="overflow-x: auto;">
                            <table class="table table-hover table-bordered" style="min-width: 800px;">
                                <thead style="background-color: #97C7C9;">
                                    <tr>
                                        <th class="text-center">ชื่อรายการ</th>
                                        <th class="text-center">วันที่ทำการ</th>
                                        <th class="text-center">การชำระเงิน</th>
                                        <th class="text-center">สถานะ</th>
                                        <th class="text-center">หมายเหตุ</th>
                                        <th class="text-center">ตัวเลือก</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($dataArray) {
                                        foreach ($dataArray as $index => $row) : ?>
                                            <tr>
                                                <!-- ตัวอย่างการดึงข้อมูลจากฐานข้อมูล -->
                                                <td class="text-center"><?php echo $row['roomName']; ?></td>

                                                <?php 
                                                    $payId = $row['payID'];
                                                    $datetime = $row['bookDate'];
                                                    $date = new DateTime($datetime);

                                                    $thaiDate = formatThaiDate($date);
                                                ?>

                                                <td class="text-center"><?php echo $thaiDate; ?></td>
                                                <td class="text-center">

                                                <?php 
                                                    if ($row['payStatus'] === NULL || $row['bookCancel'] == 1) {
                                                        $pay_status = "";
                                                        $pay_color = '';
                                                    } else if ($row['payStatus'] == 1) {
                                                        $pay_status = "กำลังตรวจสอบ";
                                                        $pay_color = '#4caf50';
                                                    } else if ($row['payStatus'] == 2) {
                                                        $pay_status = "ชำระเงินแล้ว";
                                                        $pay_color = '#A7CF5A';
                                                    } else {
                                                        $pay_status = "รอการชำระเงิน";
                                                        $pay_color = '#3B8386';
                                                    }
                                                ?>
                                                    <h5 class="text-center" style="background-color: <?php echo $pay_color; ?>; font-size: 8px; padding: 5px 0; border-radius: 10px; color: #ffffff;">
                                                        <?php echo $pay_status; ?>
                                                    </h5>
                                                </td>
                                                <td class="text-center">

                                                <?php 
                                                    if($row['billStatus'] == 1){
                                                        $bill_status = "จองสำเร็จ";
                                                        $bill_color = '#A7CF5A';
                                                    }else if($row['bookCancel'] == 1){
                                                        $bill_status = "ยกเลิก";
                                                        $bill_color = '#DE6461';
                                                    }else if($row['bookCancel'] == 2){
                                                        $bill_status = "ถูกระงับ";
                                                        $bill_color = '#DE6461';
                                                    }else{
                                                        $bill_status = "รอดำเนินการ";
                                                        $bill_color = '#3B8386';
                                                    }
                                                ?>
                                                    <h5 class="text-center" style="background-color: <?php echo $bill_color; ?>; font-size: 8px; padding: 5px 0; border-radius: 10px; color: #ffffff;">
                                                        <?php echo $bill_status; ?> <!-- ใส่สถานะการจองจากฐานข้อมูล -->
                                                    </h5>
                                                </td>
                                                <td class="text-center"><?php echo $row['note'] ?? ' - '; ?></td>
                                                <td class="text-start">
                                                <?php
                                                    if($row['bookStatus'] == 1){
                                                        echo '<button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 8px; background-color: #3B8386; color: #ffffff; border-radius: 5px;">ดูรายละเอียด</button>';
                                                    }
                                                    if($row['payStatus'] == 2 || $row['payStatus'] == 1){
                                                        echo '<button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 8px; background-color: #4caf50; color: #ffffff; border-radius: 5px;">การชำระเงิน</button>';
                                                    }else if($row['payStatus'] === NULL || $row['payStatus'] == 0){
                                                        echo '<button type="button" onclick="goPay(' . $payId . ')" class="btn me-1" style="font-size: 8px; background-color: #4caf50; color: #ffffff; border-radius: 5px;">ดำเนินการชำระเงิน</button>';

                                                    }
                                                     if($row['billStatus'] == 1){
                                                        echo '<button onclick="redirectToReport()" type="button" class="btn" style="font-size: 8px; background-color: #DE6461; color: #ffffff; border-radius: 5px;">พิมพ์ใบจอง</button>';
                                                    }
                                                ?>
                                                </td>
                                            </tr>

                                        <?php  endforeach;
                                            
                                    } else { ?>
                                        <tr>
                                            <td colspan="6" class="text-center">ไม่มีรายการแสดง</td>
                                        </tr>
                                    <?php } ?>

                                </tbody>

                            </table>
                        </div>
            </div>
        </div>
    </div>
</div>
        
<script>
    function redirectToReport() {
        window.location.href = 'report/report.php';
    }
    function goPay(payID) {
        window.location.href = 'payment/payment.php?payId=' + payID;
    }
</script>

  
        <nav>
            <?php include("footer.php"); ?>
        </nav>
        
</body>
</html>

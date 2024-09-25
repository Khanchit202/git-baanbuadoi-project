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
    <div class="container " style=" padding: 0px 60px;">
        <div class="pro mb-4" style="width: 100%; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px 0px;">
            <div class="d-flex justify-content-between m-2 mb-3" style="padding: 10px 35px;">
                <p>ข้อมูลประวัติการจองห้องพัก</p>
                <div class="d-flex">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#roomModal" style="text-decoration: none;"><p class="btn" style="font-size: 10px; background-color: #3B8386; color: #ffffff;">แสดงรายการทั้งหมด</p></a>
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
                                <?php 
                                    $hasData = false; // สถานะการแสดงผลรายการ
                                    $displayCount = 0; // ตัวนับรายการที่แสดง
                                    foreach ($dataArray as $index => $row) : 
                                        if ($row['bookType'] != 1) continue; // ตรวจสอบ bookType

                                        if ($displayCount >= 5) break; // จำกัดจำนวนรายการที่แสดง
                                        $hasData = true; // มีข้อมูลที่ตรงตามเงื่อนไข
                                        $displayCount++; // เพิ่มตัวนับ
                                    ?>
                                        <tr>
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
                                                    } else if($row['bookCancel'] == 1){
                                                        $bill_status = "ยกเลิก";
                                                        $bill_color = '#DE6461';
                                                    } else if($row['bookCancel'] == 2){
                                                        $bill_status = "ถูกระงับ";
                                                        $bill_color = '#DE6461';
                                                    } else {
                                                        $bill_status = "รอดำเนินการ";
                                                        $bill_color = '#3B8386';
                                                    }
                                                ?>
                                                <h5 class="text-center" style="background-color: <?php echo $bill_color; ?>; font-size: 8px; padding: 5px 0; border-radius: 10px; color: #ffffff;">
                                                    <?php echo $bill_status; ?>
                                                </h5>
                                            </td>
                                            <td class="text-center"><?php echo $row['note'] ?? ' - '; ?></td>
                                            <td class="text-start">
                                                <?php
                                                    if($row['bookStatus'] == 1){
                                                        echo '<button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 8px; background-color: #3B8386; color: #ffffff; border-radius: 5px;">ดูรายละเอียด</button>';
                                                    }
                                                    if($row['payStatus'] == 2 || $row['payStatus'] == 1 && $row['bookCancel'] != 1){
                                                        echo '<button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 8px; background-color: #4caf50; color: #ffffff; border-radius: 5px;">การชำระเงิน</button>';
                                                    } else if($row['payStatus'] === NULL || $row['payStatus'] == 0 && $row['bookCancel'] != 1){
                                                        echo '<a href="payment/payment.php?payId='.$row['payID'].'" class="btn me-1 fw-bold" style="font-size: 8px; border: solid 1px #4caf50; color: #4caf50; background-color: none; border-radius: 5px;">ดำเนินการชำระเงิน</a>';
                                                    }
                                                    if($row['billStatus'] == 1){
                                                        echo '<button onclick="redirectToReport()" type="button" class="btn" style="font-size: 8px; background-color: #DE6461; color: #ffffff; border-radius: 5px;">พิมพ์ใบจอง</button>';
                                                    }
                                                ?>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                    <?php if (!$hasData) { ?>
                                        <tr>
                                            <td colspan="6" class="text-center">ไม่มีรายการแสดง</td>
                                        </tr>
                                    <?php } ?>
                                </tbody>


                            </table>
                        </div>
            </div>
        </div>



        <?php
        $sql2 = "
            SELECT * 
            FROM booking_bill 
            INNER JOIN service_product ON booking_bill.serviceID = service_product.serviceID
            INNER JOIN booking ON booking_bill.bookID = booking.bookID
            LEFT JOIN booking_payment ON booking_bill.payID = booking_payment.payID
            WHERE booking_bill.userID = :userID
            ORDER BY booking_bill.billID DESC
        ";


        $data3 = $db_con->prepare($sql2);
        $data3->bindParam(':userID', $userID, PDO::PARAM_INT);
        $data3->execute();
        $dataArray2 = $data3->fetchAll(PDO::FETCH_ASSOC);
        ?>


         <div class="pro" style="width: 100%; background-color: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px 0px;">
    <div class="d-flex justify-content-between m-2 mb-3" style="padding: 10px 35px;">
        <p>ข้อมูลประวัติการจองบริการ</p>
        <div class="d-flex">
            <a href="#" data-bs-toggle="modal" data-bs-target="#serviceModal" style="text-decoration: none;"><p class="btn" style="font-size: 10px; background-color: #3B8386; color: #ffffff;">แสดงรายการทั้งหมด</p></a>
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
            <?php 
                $hasData2 = false;
                $displayCount2 = 0;
                    foreach ($dataArray2 as $index2 => $row2) : 
                    if ($row2['bookType'] != 2) continue;

                    if ($displayCount2 >= 5) break;
                        $hasData2 = true;
                        $displayCount2++;
                    ?>

                    <tr>
                        <td class="text-center"><?php echo $row2['serviceName']; ?></td>

                        <?php 
                            $datetime = $row2['bookDate'];
                            $date = new DateTime($datetime);
                            $thaiDate = formatThaiDate($date);
                        ?>
                        <td class="text-center"><?php echo $thaiDate; ?></td>
                        <td class="text-center">
                            <?php 
                                $pay_status = ($row2['payStatus'] === NULL || $row2['bookCancel'] == 1) ? "" : ($row2['payStatus'] == 1 ? "กำลังตรวจสอบ" : ($row2['payStatus'] == 2 ? "ชำระเงินแล้ว" : "รอการชำระเงิน"));
                                $pay_color = ($row2['payStatus'] === NULL || $row2['bookCancel'] == 1) ? '' : ($row2['payStatus'] == 1 ? '#4caf50' : ($row2['payStatus'] == 2 ? '#A7CF5A' : '#3B8386'));
                            ?>
                            <h5 class="text-center" style="background-color: <?php echo $pay_color; ?>; font-size: 8px; padding: 5px 0; border-radius: 10px; color: #ffffff;">
                                <?php echo $pay_status; ?>
                            </h5>
                        </td>
                        <td class="text-center">
                            <?php 
                                $bill_status = ($row2['billStatus'] == 1) ? "จองสำเร็จ" : (($row2['bookCancel'] == 1 || $row2['bookCancel'] == 2) ? "ยกเลิก" : "รอดำเนินการ");
                                $bill_color = ($row2['billStatus'] == 1) ? '#A7CF5A' : (($row2['bookCancel'] == 1 || $row2['bookCancel'] == 2) ? '#DE6461' : '#3B8386');
                            ?>
                            <h5 class="text-center" style="background-color: <?php echo $bill_color; ?>; font-size: 8px; padding: 5px 0; border-radius: 10px; color: #ffffff;">
                                <?php echo $bill_status; ?>
                            </h5>
                        </td>
                        <td class="text-center"><?php echo $row2['note'] ?? ' - '; ?></td>
                        <td class="text-start">
                            <?php
                                if($row2['bookStatus'] == 1){
                                    echo '<button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 8px; background-color: #3B8386; color: #ffffff; border-radius: 5px;">ดูรายละเอียด</button>';
                                }
                                if($row2['payStatus'] == 2 || ($row2['payStatus'] == 1 && $row2['bookCancel'] != 1)){
                                    echo '<button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 8px; background-color: #4caf50; color: #ffffff; border-radius: 5px;">การชำระเงิน</button>';
                                } else if($row2['payStatus'] === NULL || ($row2['payStatus'] == 0 && $row2['bookCancel'] != 1)){
                                    echo '<a href="payment/payment_service.php?payId='.$row2['payID'].'" class="btn me-1 fw-bold" style="font-size: 8px; border: solid 1px #4caf50; color: #4caf50; background-color: none; border-radius: 5px;">ดำเนินการชำระเงิน</a>';
                                }
                                if($row2['billStatus'] == 1){
                                    echo '<button onclick="redirectToReport()" type="button" class="btn" style="font-size: 8px; background-color: #DE6461; color: #ffffff; border-radius: 5px;">พิมพ์ใบจอง</button>';
                                }
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                
                <?php if (!$hasData2) { ?>
                    <tr>
                        <td colspan="6" class="text-center">ไม่มีรายการแสดง</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
</div>


<!-- Modal -->
<div class="modal fade" id="roomModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 70%;">
        <div class="modal-content">
            <div class="modal-header" >
                <h5 style="font-size: 14px;" class="modal-title fw-bold" id="exampleModalLabel">รายการทั้งหมด</h5>
                <button style="font-size: 10px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-size: 12px;">
        

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
                                <?php 
                                    $hasData = false;
                                    foreach ($dataArray as $index => $row) : 
                                        if ($row['bookType'] != 1) continue;
                                        $hasData = true;
                                    ?>
                                        <tr>
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
                                                    } else if($row['bookCancel'] == 1){
                                                        $bill_status = "ยกเลิก";
                                                        $bill_color = '#DE6461';
                                                    } else if($row['bookCancel'] == 2){
                                                        $bill_status = "ถูกระงับ";
                                                        $bill_color = '#DE6461';
                                                    } else {
                                                        $bill_status = "รอดำเนินการ";
                                                        $bill_color = '#3B8386';
                                                    }
                                                ?>
                                                <h5 class="text-center" style="background-color: <?php echo $bill_color; ?>; font-size: 8px; padding: 5px 0; border-radius: 10px; color: #ffffff;">
                                                    <?php echo $bill_status; ?>
                                                </h5>
                                            </td>
                                            <td class="text-center"><?php echo $row['note'] ?? ' - '; ?></td>
                                            <td class="text-start">
                                                <?php
                                                    if($row['bookStatus'] == 1){
                                                        echo '<button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 8px; background-color: #3B8386; color: #ffffff; border-radius: 5px;">ดูรายละเอียด</button>';
                                                    }
                                                    if($row['payStatus'] == 2 || $row['payStatus'] == 1 && $row['bookCancel'] != 1){
                                                        echo '<button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 8px; background-color: #4caf50; color: #ffffff; border-radius: 5px;">การชำระเงิน</button>';
                                                    } else if($row['payStatus'] === NULL || $row['payStatus'] == 0 && $row['bookCancel'] != 1){
                                                        echo '<a href="payment/payment.php?payId='.$row['payID'].'" class="btn me-1 fw-bold" style="font-size: 8px; border: solid 1px #4caf50; color: #4caf50; background-color: none; border-radius: 5px;">ดำเนินการชำระเงิน</a>';
                                                    }
                                                    if($row['billStatus'] == 1){
                                                        echo '<button onclick="redirectToReport()" type="button" class="btn" style="font-size: 8px; background-color: #DE6461; color: #ffffff; border-radius: 5px;">พิมพ์ใบจอง</button>';
                                                    }
                                                ?>
                                            </td>
                                        </tr>

                                    <?php endforeach; ?>
                                    <?php if (!$hasData) { ?>
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

<!-- Modal -->
<div class="modal fade" id="serviceModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 70%;">
        <div class="modal-content">
            <div class="modal-header" >
                <h5 style="font-size: 14px;" class="modal-title fw-bold" id="exampleModalLabel">รายการทั้งหมด</h5>
                <button style="font-size: 10px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-size: 12px;">
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
                <?php 
                    $hasData2 = false;
                        foreach ($dataArray2 as $index2 => $row2) : 
                        if ($row2['bookType'] != 2) continue;
                            $hasData2 = true;
                        ?>

                        <tr>
                            <td class="text-center"><?php echo $row2['serviceName']; ?></td>

                            <?php 
                                $datetime = $row2['bookDate'];
                                $date = new DateTime($datetime);
                                $thaiDate = formatThaiDate($date);
                            ?>
                            <td class="text-center"><?php echo $thaiDate; ?></td>
                            <td class="text-center">
                                <?php 
                                    $pay_status = ($row2['payStatus'] === NULL || $row2['bookCancel'] == 1) ? "" : ($row2['payStatus'] == 1 ? "กำลังตรวจสอบ" : ($row2['payStatus'] == 2 ? "ชำระเงินแล้ว" : "รอการชำระเงิน"));
                                    $pay_color = ($row2['payStatus'] === NULL || $row2['bookCancel'] == 1) ? '' : ($row2['payStatus'] == 1 ? '#4caf50' : ($row2['payStatus'] == 2 ? '#A7CF5A' : '#3B8386'));
                                ?>
                                <h5 class="text-center" style="background-color: <?php echo $pay_color; ?>; font-size: 8px; padding: 5px 0; border-radius: 10px; color: #ffffff;">
                                    <?php echo $pay_status; ?>
                                </h5>
                            </td>
                            <td class="text-center">
                                <?php 
                                    $bill_status = ($row2['billStatus'] == 1) ? "จองสำเร็จ" : (($row2['bookCancel'] == 1 || $row2['bookCancel'] == 2) ? "ยกเลิก" : "รอดำเนินการ");
                                    $bill_color = ($row2['billStatus'] == 1) ? '#A7CF5A' : (($row2['bookCancel'] == 1 || $row2['bookCancel'] == 2) ? '#DE6461' : '#3B8386');
                                ?>
                                <h5 class="text-center" style="background-color: <?php echo $bill_color; ?>; font-size: 8px; padding: 5px 0; border-radius: 10px; color: #ffffff;">
                                    <?php echo $bill_status; ?>
                                </h5>
                            </td>
                            <td class="text-center"><?php echo $row2['note'] ?? ' - '; ?></td>
                            <td class="text-start">
                                <?php
                                    if($row2['bookStatus'] == 1){
                                        echo '<button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 8px; background-color: #3B8386; color: #ffffff; border-radius: 5px;">ดูรายละเอียด</button>';
                                    }
                                    if($row2['payStatus'] == 2 || ($row2['payStatus'] == 1 && $row2['bookCancel'] != 1)){
                                        echo '<button type="button" class="btn me-1" data-toggle="modal" data-target="#myModal" style="font-size: 8px; background-color: #4caf50; color: #ffffff; border-radius: 5px;">การชำระเงิน</button>';
                                    } else if($row2['payStatus'] === NULL || ($row2['payStatus'] == 0 && $row2['bookCancel'] != 1)){
                                        echo '<a href="payment/payment_service.php?payId='.$row2['payID'].'" class="btn me-1 fw-bold" style="font-size: 8px; border: solid 1px #4caf50; color: #4caf50; background-color: none; border-radius: 5px;">ดำเนินการชำระเงิน</a>';
                                    }
                                    if($row2['billStatus'] == 1){
                                        echo '<button onclick="redirectToReport()" type="button" class="btn" style="font-size: 8px; background-color: #DE6461; color: #ffffff; border-radius: 5px;">พิมพ์ใบจอง</button>';
                                    }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    
                    <?php if (!$hasData2) { ?>
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  
        <nav>
            <?php include("footer.php"); ?>
        </nav>
        
</body>
</html>

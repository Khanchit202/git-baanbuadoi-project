<?php
$users = $db_con->query("SELECT * FROM room_product");
$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);
$numberOfUsers = count($usersArray);

$booking = $db_con->query("SELECT * FROM booking_payment WHERE payStatus = 1");
$bookingArray = $booking->fetchAll(PDO::FETCH_ASSOC);
$numberOfpay = count($bookingArray);

$service = $db_con->query("SELECT * FROM service_product ");
$serviceArray = $service->fetchAll(PDO::FETCH_ASSOC);
$numberOfservice = count($serviceArray);


$date = date('Y-m-d') . ' 14:00:00'; // กำหนดวันที่ปัจจุบันและเวลา 14:00:00
$bookingday = $db_con->query("SELECT * FROM booking WHERE bookDateStart = '$date'");
$bookingdayArray = $bookingday->fetchAll(PDO::FETCH_ASSOC);
$numberOfbookingday = count($bookingdayArray);


$datesroom = date('Y-m-d-t'); // กำหนดวันที่ปัจจุบันและเวลา 14:00:00
$bookingdaygaf = $db_con->query("SELECT roomID FROM booking_payment WHERE  DATE(payDate) = '$datesroom'");
$bookingdaygafArray = $bookingdaygaf->fetchAll(PDO::FETCH_ASSOC);
$numberOfbookingdaygafArray = count($bookingdaygafArray);

$dates = date('Y-m-d'); // กำหนดวันที่ปัจจุบัน
$bookingdayser = $db_con->query("SELECT serviceID FROM booking_payment WHERE DATE(payDate) = '$dates'");
$bookingdayserArray = $bookingdayser->fetchAll(PDO::FETCH_ASSOC);
$numberOfbookingdayserArray = count($bookingdayserArray);

$mout = date('Y-m'); // กำหนดเดือนและปีปัจจุบัน
$mountbook = $db_con->query("SELECT serviceID FROM booking_payment WHERE DATE_FORMAT(payDate, '%Y-%m') = '$mout' AND serviceID IS NOT NULL");
$mountbookArray = $mountbook->fetchAll(PDO::FETCH_ASSOC);
$numberOfmountbookArray = count($mountbookArray);

$mouts = date('Y-m'); // กำหนดเดือนและปีปัจจุบัน
$mountbookr = $db_con->query("SELECT roomID FROM booking_payment WHERE DATE_FORMAT(payDate, '%Y-%m') = '$mouts' AND roomID IS NOT NULL");
$mountbookrArray = $mountbookr->fetchAll(PDO::FETCH_ASSOC);
$numberOfmountbookrArray = count($mountbookrArray);


$yeas = date('Y'); // กำหนดเดือนและปีปัจจุบัน
$yeasbookr = $db_con->query("SELECT roomID FROM booking_payment WHERE DATE_FORMAT(payDate, '%Y') = '$yeas' AND roomID IS NOT NULL");
$yeasbookrArray = $yeasbookr->fetchAll(PDO::FETCH_ASSOC);
$numberOfyeasbookrArray = count($yeasbookrArray);

 // กำหนดเดือนและปีปัจจุบัน
 $yeasbooks = $db_con->query("SELECT serviceID FROM booking_payment WHERE DATE_FORMAT(payDate, '%Y') = '$yeas' AND serviceID IS NOT NULL");
 $yeasbooksArray = $yeasbooks->fetchAll(PDO::FETCH_ASSOC);
 $numberOfyeasbooksArray = count($yeasbooksArray);
 
?>



<p style="font-size: 20px; padding: 5px 20px;">หน้าหลักแดชบอร์ด</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;font-weight:bold">ข้อมูลรายงานสารสนเทศ</p>
        
    </div>
        <div class="text-end">
            <div class="container">
                <div class="row mt-5"style="display: flex; justify-content: space-between;">
                <div class="col-md-2 green-box" style=" border-left: solid 4px #72d572;">
                    <div class="row center-text mt-2">
                        <p style="font-size: 12px;">จำนวนห้องพัก</p>
                    </div>
                    <div class="row">
                        <p style='font-size: 20px;'><?php echo $numberOfUsers; ?> ห้อง</p>
                    </div>
                </div>
                <div class="col-md-2 red-box" >
                    <div class="row center-text mt-2">
                        <p style="font-size: 12px;">รอตรวจสอบ</p>
                    </div>
                    <div class="row">
                        <p style="font-size: 20px;"><?php echo $numberOfpay; ?> รายการ</p>
                    </div>
                </div>
                <div class="col-md-2 blue-box">
                    <div class="row center-text mt-2">
                        <p style='font-size: 12px;'>จำนวนบริการ</p>
                    </div>
                    <div class="row">
                         <p style="font-size: 20px;"><?php echo $numberOfservice; ?> บริการ</p>
                    </div>
                </div>
                <?php 
                $sql_count = "SELECT COUNT(*) AS coundTime FROM statistic";
                $stmt_count = $db_con->prepare($sql_count);
                $stmt_count->execute();
                $result = $stmt_count->fetch(PDO::FETCH_ASSOC);
                $totalCount = $result['coundTime'];  // เก็บจำนวนข้อมูลในตัวแปร
                ?>

                <div class="col-md-2 yellow-box" style="background-color: #A7CF5A;">
                    <div class="row center-text mt-2">
                        <p style="font-size: 12px;">จำนวนการเข้าใช้ระบบ</p>
                    </div>
                    <div class="row">
                        <p style="font-size: 20px;"><?php echo $totalCount; ?> คน</p>
                    </div>
                </div>

                </div>
                <div class="row mt-3" style="display: flex; justify-content: space-between;">
                    <a href="?page=room-data" class="col-md-2 button-style">
                        จัดการ
                    </a>

                    <a href="?page=bookingpayment-data" class="col-md-2 button-style">
                        จัดการ
                    </a>

                    <a href="?page=service-data" class="col-md-2 button-style">
                        จัดการ
                    </a>

                    <a href="?page=checkin-data" class="col-md-2 button-style">
                        จัดการ
                    </a>


                </div>
                <div class="d-flex justify-content-between mt-5">
                    <p style="font-size: 20px;font-weight:bold">ข้อมูลการจองห้องพักและบริการทั้งหมด</p>
                    
                </div>
                <div class="row mt-5" style="display: flex; justify-content: space-between;">
                    <div class="col-md-5 py-2"style="width:50%;">
                        <p style="font-weight:bold">การจองวันนี้ <?php echo $dates; ?></p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="myBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 py-2"style="width:50%;">
                    <p style="font-weight:bold">การจองเดือนนี้ <?php echo $mouts; ?></p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="chLines"></canvas>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row mt-5" style="display: flex; justify-content: center;">
                    <div class="col-md-5 py-2"style="width:55%;">
                        <p style="font-weight:bold">การจองในปี <?php echo $yeas; ?></p>
                        <div class="card">
                            <div class="card-body">
                            <canvas id="chBar1" ></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="d-flex justify-content-between mt-5">
                    <p style="font-size: 20px;font-weight:bold">ข้อมูลการจองทั้งหมดทั้งหมด</p>
                    
                </div>
                <div class="row mt-5" style="display: flex; justify-content: space-between;">
                    <div class="col-md-4 py-1">
                        <p style="font-weight:bold">วัน</p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="chDonut1"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 py-1">
                    <p style="font-weight:bold">เดือน</p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="chDonut2"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 py-1">
                    <p style="font-weight:bold">ปี</p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="chDonut3"></canvas>
                            </div>
                        </div>
                    </div>
                </div> -->
                


            </div>
        </div>
</div>
<script>
        // รับข้อมูลจาก PHP
        var colors = ['#f8bbd0','#d0d9ff','#d0d9ff','#d0d9ff','#dc3545','#6c757d'];

        var roomOfBookings = <?php echo $numberOfbookingdaygafArray; ?>;
        var serOfBookings = <?php echo $numberOfbookingdayserArray; ?>;
        var ctx = document.getElementById('myBarChart').getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Today'],
                datasets: [{
                    label: 'จองห้องพัก',
                    data: [roomOfBookings],
                    backgroundColor: colors[0],
                    borderColor: colors[0],
                    borderWidth: 1
                },
            {
                label: 'จองบริการ',
                    data: [serOfBookings],
                    backgroundColor: colors[1],
                    borderColor: colors[1],
                    borderWidth: 1
            }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        var roomOfmount = <?php echo $numberOfmountbookrArray; ?>;
        var serOfmount = <?php echo $numberOfmountbookArray; ?>;
        var ctx = document.getElementById('chLines').getContext('2d');
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['เดือน'],
                datasets: [{
                    label: 'จองห้องพัก',
                    data: [roomOfmount],
                    backgroundColor: colors[0],
                    borderColor: colors[0],
                    borderWidth: 1
                },
            {
                label: 'จองบริการ',
                    data: [serOfmount],
                    backgroundColor: colors[1],
                    borderColor: colors[1],
                    borderWidth: 1
            }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        var roomOfyeas = <?php echo $numberOfyeasbookrArray; ?>;
        var serOfyeas = <?php echo $numberOfyeasbooksArray; ?>;
        var ctx = document.getElementById('chBar1').getContext('2d');
        var myDoughnutChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [ 'จองห้องพัก','จองบริการ'],
                datasets: [{
                    label: 'การจอง',
                    data: [roomOfyeas,serOfyeas],
                    backgroundColor: [colors[0], colors[1]],
                    borderColor: [colors[0], colors[1]],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });


        
            </script>

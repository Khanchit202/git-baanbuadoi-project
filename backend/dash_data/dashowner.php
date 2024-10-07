<?php
$users = $db_con->query("SELECT userLavelID FROM users WHERE userLavelID = 3");
$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);
$numberOfUsers = count($usersArray);

$booking = $db_con->query("SELECT userLavelID FROM users WHERE userLavelID = 4");
$bookingArray = $booking->fetchAll(PDO::FETCH_ASSOC);
$numberOfpay = count($bookingArray);

$service = $db_con->query("SELECT * FROM reviws_room ");
$serviceArray = $service->fetchAll(PDO::FETCH_ASSOC);
$numberOfservice = count($serviceArray);


$bookingday = $db_con->query("SELECT * FROM reviws_service ");
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
$mountbook = $db_con->query("SELECT serviceID FROM booking_payment WHERE DATE_FORMAT(payDate, '%Y-%m') = '$mout'");
$mountbookArray = $mountbook->fetchAll(PDO::FETCH_ASSOC);
$numberOfmountbookArray = count($mountbookArray);

$mouts = date('Y-m'); // กำหนดเดือนและปีปัจจุบัน
$mountbookr = $db_con->query("SELECT roomID FROM booking_payment WHERE DATE_FORMAT(payDate, '%Y-%m') = '$mouts'");
$mountbookrArray = $mountbookr->fetchAll(PDO::FETCH_ASSOC);
$numberOfmountbookrArray = count($mountbookrArray);
?>



<p style="font-size: 16px; padding: 5px 20px;">แดชบอร์ดส่วนเจ้าของกิจการ</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;font-weight:bold">ข้อมูลรายงานสารสนเทศเจ้าของกิจการ</p>
        
    </div>
        <div class="text-center">
            <div class="container">
                <div class="row mt-5"style="display: flex; justify-content: space-between;">
                <div class="col-md-2 green-box" style=" border-left: solid 4px #72d572;">
                    <div class="row center-text mt-2">
                        <p style="font-size: 14px;">จำนวนพนักงาน</p>
                    </div>
                    <div class="row">
                        <p style='font-size: 18px;'><?php echo $numberOfUsers; ?> คน</p>
                    </div>
                </div>
                <div class="col-md-2 red-box" >
                    <div class="row center-text mt-2">
                        <p style="font-size: 14px;">จำนวนสมาชิก</p>
                    </div>
                    <div class="row">
                        <p style="font-size: 18px;"><?php echo $numberOfpay; ?> คน</p>
                    </div>
                </div>
                <div class="col-md-2 blue-box">
                    <div class="row center-text mt-2">
                        <p style='font-size: 14px;'>การรีวิวห้องพัก</p>
                    </div>
                    <div class="row">
                         <p style="font-size: 18px;"><?php echo $numberOfservice; ?> รีวิว</p>
                    </div>
                </div>
                <div class="col-md-2 yellow-box">
                    <div class="row center-text mt-2">
                        <p style="font-size: 14px;">การรีวิวบริการ</p>
                    </div>
                    <div class="row">
                         <p style="font-size: 18px;"><?php echo $numberOfbookingday; ?> รีวิว</p>
                    </div>
                    
                </div>

                </div>
                <div class="row mt-3" style="display: flex; justify-content: space-between;">
                    <a href="?page=user-data" class="col-md-2 button-style">
                        จัดการ
                    </a>

                    <a href="?page=user-data" class="col-md-2 button-style">
                        จัดการ
                    </a>

                    <a href="?page=reviwsroom-data" class="col-md-2 button-style">
                        จัดการ
                    </a>

                    <a href="?page=reviwsservice-data" class="col-md-2 button-style">
                        จัดการ
                    </a>


                </div>
                <div class="d-flex justify-content-between mt-5">
                    <p style="font-size: 20px;font-weight:bold">ข้อมูลการจองห้องพักและบริการทั้งหมด</p>
                    
                </div>
                <div class="row mt-5" style="display: flex; justify-content: space-between;">
                    <div class="col-md-5 py-2"style="width:50%;">
                        <p style="font-weight:bold">การจองวันนี้</p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="myBarChart"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 py-2"style="width:50%;">
                    <p style="font-weight:bold">การจองเดือนนี้</p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="chLines"></canvas>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="row mt-5" style="display: flex; justify-content: center;">
                    <div class="col-md-5 py-2"style="width:80%;">
                        <p style="font-weight:bold">ปี</p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="chBar1"></canvas>
                            </div>
                        </div>
                    </div>
                </div> 
                <div class="d-flex justify-content-between mt-5">
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
                </div>
                


                
                
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
            </script>
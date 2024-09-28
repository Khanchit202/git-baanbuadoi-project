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



?>



<p style="font-size: 16px; padding: 5px 20px;">รายงานสารสนเทศ</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;font-weight:bold">ข้อมูลรายงานสารสนเทศ</p>
        
    </div>
        <div class="text-center">
            <div class="container">
                <div class="row mt-5"style="display: flex; justify-content: space-between;">
                <div class="col-md-2 green-box">
                    <div class="row center-text mt-2">
                        <p>จำนวนห้องพัก</p>
                    </div>
                    <div class="row">
                        <p><?php echo $numberOfUsers; ?> ห้อง</p>
                    </div>
                </div>
                <div class="col-md-2 red-box">
                    <div class="row center-text mt-2">
                        <p>รอตรวจสอบ</p>
                    </div>
                    <div class="row">
                        <p><?php echo $numberOfpay; ?> รายการ</p>
                    </div>
                </div>
                <div class="col-md-2 blue-box">
                    <div class="row center-text mt-2">
                        <p>จำนวนบริการ</p>
                    </div>
                    <div class="row">
                         <p><?php echo $numberOfservice; ?> บริการ</p>
                    </div>
                </div>
                <div class="col-md-2 yellow-box">
                    <div class="row center-text mt-2">
                        <p>ห้องพักที่มีการจองวันนี้</p>
                    </div>
                    <div class="row">
                        
                        <?php
                        if ($numberOfbookingday > 0) {
                                echo "<p> $numberOfbookingday ห้อง</p>";
                            } else {
                                echo "<p>ไม่มีการจองวันนี้</p>";
                            }
                            ?><
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
                        <p style="font-weight:bold">วัน</p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="chLine"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 py-2"style="width:50%;">
                    <p style="font-weight:bold">เดือน</p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="chBar"></canvas>
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

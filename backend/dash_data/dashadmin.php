<?php
$mouts = date('Y-m');
$previousMonth = (new DateTime())->modify('-1 month')->format('Y-m');
$yeas = date('Y');
$previousYear = (new DateTime())->modify('-1 year')->format('Y');


$users = $db_con->query("SELECT userLavelID FROM users WHERE userLavelID = 3");
$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);
$numberOfUsers = count($usersArray);

$booking = $db_con->query("SELECT userLavelID FROM users WHERE userLavelID = 4");
$bookingArray = $booking->fetchAll(PDO::FETCH_ASSOC);
$numberOfpay = count($bookingArray);

$owner = $db_con->query("SELECT * FROM users WHERE userLavelID = 2");
$ownerArray = $owner->fetchAll(PDO::FETCH_ASSOC);
$numberOfowner = count($ownerArray);

$admin = $db_con->query("SELECT * FROM users WHERE userLavelID = 1");
$adminArray = $admin->fetchAll(PDO::FETCH_ASSOC);
$numberOfadmin = count($adminArray);

$preple = $db_con->query("SELECT userLavelID FROM users ");
$prepleArray = $preple->fetchAll(PDO::FETCH_ASSOC);
$numberOfpreple = count($prepleArray);



$mout = date('Y-m'); // กำหนดเดือนและปีปัจจุบัน
$bookmaney = $db_con->query("SELECT payManey FROM booking_payment WHERE DATE_FORMAT(payDate, '%Y-%m') = '$mout'");
$showmaney = $bookmaney->fetchAll(PDO::FETCH_ASSOC);
// บวกจำนวนเงินทั้งหมดใน payManey
$totalPayManey = array_sum(array_column($showmaney, 'payManey'));

// แสดงรายได้เดือนที่ผ่านมา
$mouts = $previousMonth; // กำหนดเดือนและปีปัจจุบัน
$bookmaneys = $db_con->query("SELECT payManey FROM booking_payment WHERE DATE_FORMAT(payDate, '%Y-%m') = '$mouts'");
$showmaneys = $bookmaneys->fetchAll(PDO::FETCH_ASSOC);
// บวกจำนวนเงินทั้งหมดใน payManey
$totalPayManeys = array_sum(array_column($showmaneys, 'payManey'));

$yeas = date('Y'); // กำหนดเดือนและปีปัจจุบัน
$bookyeas = $db_con->query("SELECT payManey FROM booking_payment WHERE DATE_FORMAT(payDate, '%Y') = '$yeas' AND payManey IS NOT NULL");
$showmaneyyeas = $bookyeas->fetchAll(PDO::FETCH_ASSOC);
$totalPayManeyyear = array_sum(array_column($showmaneyyeas, 'payManey'));

// แสดงรายได้ปีที่ผ่านมา
$year = $previousYear; // กำหนดเดือนและปีปัจจุบัน
$bookyeas = $db_con->query("SELECT payManey FROM booking_payment WHERE DATE_FORMAT(payDate, '%Y') = '$year' AND payManey IS NOT NULL");
$showmaneyyeas = $bookyeas->fetchAll(PDO::FETCH_ASSOC);
$totalPayManeyyeas = array_sum(array_column($showmaneyyeas, 'payManey'));

//ห้องที่จองเยอะที่สุด
$bookingdaygaf = $db_con->query("SELECT roomID FROM booking_payment");
$bookingdaygafArray = $bookingdaygaf->fetchAll(PDO::FETCH_ASSOC);

// กรองค่า roomID ที่ไม่ใช่สตริงหรือจำนวนเต็มออก
$filteredRoomIDs = array_filter(array_column($bookingdaygafArray, 'roomID'), function($value) {
    return is_string($value) || is_int($value);
});

// นับจำนวนครั้งที่แต่ละ roomID ปรากฏ
$roomCount = array_count_values($filteredRoomIDs);

// เรียงลำดับตามจำนวนครั้งที่ปรากฏจากมากไปน้อย
arsort($roomCount);

// ดึง roomID ที่มีค่าซ้ำกันมากที่สุด
$mostCommonRoomID = array_slice($roomCount, 0, 1, true);

// แยก roomID และจำนวนครั้งที่ปรากฏ
$roomID = key($mostCommonRoomID);
$count = current($mostCommonRoomID);

//บริการที่จองเยอะที่สุด
$bookingdaygafs = $db_con->query("SELECT serviceID FROM booking_payment");
$bookingdaygafArrays = $bookingdaygafs->fetchAll(PDO::FETCH_ASSOC);

// กรองค่า serviceID ที่ไม่ใช่สตริงหรือจำนวนเต็มออก
$filteredServiceIDs = array_filter(array_column($bookingdaygafArrays, 'serviceID'), function($value) {
    return is_string($value) || is_int($value);
});

// นับจำนวนครั้งที่แต่ละ serviceID ปรากฏ
$serviceCount = array_count_values($filteredServiceIDs);

// เรียงลำดับตามจำนวนครั้งที่ปรากฏจากมากไปน้อย
arsort($serviceCount);

// ดึง serviceID ที่มีค่าซ้ำกันมากที่สุด
$mostCommonServiceID = array_slice($serviceCount, 0, 1, true);

// แยก serviceID และจำนวนครั้งที่ปรากฏ
$serviceID = key($mostCommonServiceID);
$counts = current($mostCommonServiceID);



// -----------------------------------
$avgroom = $db_con->query("SELECT rvrScore FROM reviws_room");
$avgrooms = $avgroom->fetchAll(PDO::FETCH_ASSOC);

// ดึงค่าของ rvrScore จากอาร์เรย์
$rvrScores = array_column($avgrooms, 'rvrScore');

// คำนวณผลรวมของ rvrScore
$totalScore = array_sum($rvrScores);

// คำนวณจำนวนรายการ
$count = count($rvrScores);

// หาค่าเฉลี่ย
$averageScore = $count > 0 ? $totalScore / $count : 0;
// คำนวณส่วนต่างที่ต้องเติมให้ถึง 5
$fillToFive = 5 - $averageScore;

// --------------------------------------
$avgser = $db_con->query("SELECT rvsScore FROM reviws_service");
$avgsers = $avgser->fetchAll(PDO::FETCH_ASSOC);

// ดึงค่าของ rvrScore จากอาร์เรย์
$rvsScores = array_column($avgsers, 'rvsScore');

// คำนวณผลรวมของ rvrScore
$totalScoreser = array_sum($rvsScores);

// คำนวณจำนวนรายการ
$counts = count($rvsScores);

// หาค่าเฉลี่ย
$averageScoreser = $counts > 0 ? $totalScoreser / $counts : 0;
// คำนวณส่วนต่างที่ต้องเติมให้ถึง 5
$fillToFives = 5 - $averageScoreser;

?>



<p style="font-size: 16px; padding: 5px 20px;">แดชบอร์ดส่วนเจ้าของกิจการ</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;font-weight:bold">ข้อมูลรายงานสารสนเทศเจ้าของกิจการ</p>
        
    </div>
        <div class="text-center">
            <div class="container">
                <div class="row mt-5"style="display: flex; justify-content: space-between;">
                <div class="col-md-2 blue-box">
                    <div class="row center-text mt-2">
                        <p style='font-size: 14px;'>เจ้าของกิจการ</p>
                    </div>
                    <div class="row">
                         <p style="font-size: 18px;"><?php echo $numberOfowner; ?> คน</p>
                    </div>
                </div>
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
                
                <div class="col-md-2 yellow-box">
                    <div class="row center-text mt-2">
                        <p style="font-size: 14px;">Admin</p>
                    </div>
                    <div class="row">
                         <p style="font-size: 18px;"><?php echo $numberOfadmin; ?> คน</p>
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

                    <a href="?page=user-data" class="col-md-2 button-style">
                        จัดการ
                    </a>

                    <a href="?page=user-data" class="col-md-2 button-style">
                        จัดการ
                    </a>


                </div>
                <div class="d-flex justify-content-between mt-5">
                    <p style="font-size: 20px;font-weight:bold">รายได้ทั้งหมดของกิจการ</p>
                    
                </div>
                <div class="row mt-5" style="display: flex; justify-content: center;">
                    <div class="col-md-5 py-2"style="width:50%;">
                        <p style="font-weight:bold">สมาชิกทั้งหมด</p>
                        
                            <div class="card-body"style="display: flex; justify-content: center;">
                                    <div class="circleDivinsideadmin">
                                        <div class="circleDivinside">
                                            <p style="font-weight:bold;font-size:50px;color: #3b8386"><i class="fa fa-user"></i> <?php echo $numberOfpreple; ?></p>
                                        </div>
                                    </div>
                            </div>
                    </div>
                    
                    
                </div>
                
                <div class="d-flex justify-content-between mt-5">
                    <p style="font-size: 20px;font-weight:bold">ห้องพักและบริการที่มีการจองมากที่สุด</p>
                    
                </div>
                <div class="row mt-5" style="display: flex; justify-content: center;">
                    <div class="col-md-4 py-1">
                        <p style="font-weight:bold">ห้องพักยอดนิยม</p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="roommax"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 py-1">
                    <p style="font-weight:bold">บริการยอดนิยม</p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="sermax"></canvas>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                <div class="d-flex justify-content-between mt-5">
                    <p style="font-size: 20px;font-weight:bold">ค่าเฉลี่ยคะแนนรีวิวห้องพัก</p>
                    
                </div>
                <div class="row mt-5" style="display: flex; justify-content: center;">
                    <div class="col-md-4 py-1">
                        <p style="font-weight:bold">คะแนนรีวิวห้องพักสูงสุด 5คะแนน</p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="avgroom"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 py-1">
                    <p style="font-weight:bold">บริการยอดนิยมสูงสุด 5คะแนน</p>
                        <div class="card">
                            <div class="card-body">
                                <canvas id="avgser"></canvas>
                            </div>
                        </div>
                    </div>
                    
                </div>
                


                
                
            </div>
        </div>
</div>

<!-- ส่วนแสดงกราฟ -->
<script>
    var colors = ['#f8bbd0','#d0d9ff','#d0d9ff','#00FF66','#FF0033','#6c757d'];
    var roomID = <?php echo json_encode($roomID); ?>;
    var count = <?php echo json_encode($count); ?>;
    var ctx = document.getElementById('roommax').getContext('2d');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [roomID],
            datasets: [{
                label: 'การจอง',
                data: [count],
                backgroundColor: [colors[0]],
                borderColor: [colors[0]],
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


    
    var serID = <?php echo json_encode($serviceID); ?>;
    var counts = <?php echo json_encode($counts); ?>;
    var ctx = document.getElementById('sermax').getContext('2d');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: [serID],
            datasets: [{
                label: 'การจอง',
                data: [counts],
                backgroundColor: [colors[1]],
                borderColor: [colors[1]],
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



    
    var serroom = <?php echo json_encode($averageScore); ?>;
    var maxreviws = <?php echo json_encode($fillToFive); ?>;
    var ctx = document.getElementById('avgroom').getContext('2d');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['คะแนนรีวิวที่ได้','คะแนนรีวิวที่ขาด'],
            datasets: [{
                label: 'คะแนน',
                data: [serroom,maxreviws],
                backgroundColor: [colors[3],colors[4]],
                borderColor: [colors[1],colors[0]],
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


    var ser = <?php echo json_encode($averageScoreser); ?>;
    var maxreviwsser = <?php echo json_encode($fillToFives); ?>;
    var ctx = document.getElementById('avgser').getContext('2d');
    var myDoughnutChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['คะแนนรีวิวที่ได้','คะแนนรีวิวที่ขาด'],
            datasets: [{
                label: 'คะแนน',
                data: [ser,maxreviwsser],
                backgroundColor: [colors[3],colors[4]],
                borderColor: [colors[1],colors[0]],
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

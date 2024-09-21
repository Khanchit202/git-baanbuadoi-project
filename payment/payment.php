<?php
session_start();
include ("../db_config.php");
$db_con = connect_db();

$payId = $_GET['payId'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียด</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../tabbar_view/nav_bar.css">
    <link rel="stylesheet" href="../style1.css">
    <link rel="stylesheet" href="https://cdn.lineicons.com/3.0/lineicons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Icon Font Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

<?php

        $sql = "
            SELECT * 
            FROM booking_bill 
            INNER JOIN room_product ON booking_bill.roomID = room_product.roomID
            INNER JOIN booking ON booking_bill.bookID = booking.bookID
            LEFT JOIN booking_payment ON booking_bill.payID = booking_payment.payID
            WHERE booking_payment.payID = ?
        ";

        $data2 = $db_con->prepare($sql);
        $data2->bindParam(1, $payId, PDO::PARAM_INT);
        $data2->execute();
        $dataArray = $data2->fetchAll(PDO::FETCH_ASSOC);

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

    <div class="container-xxl bg-white p-0">
        
        <?php 
        if (!empty($dataArray)) {
            // ดึงแถวแรกจากผลลัพธ์ (เพราะใช้ LIMIT 1)
            $row = $dataArray[0];
            
            // ตรวจสอบ payType และกำหนดค่าให้ $credit และ $qrcode
            if ($row['payType'] == 'C') {
                $credit = '';
                $qrcode = 'none';
            } else if ($row['payType'] == 'Q') {
                $credit = 'none';
                $qrcode = '';
            }
        
            // เรียกใช้ฟังก์ชันเพื่อแสดงวันที่แบบไทย
            $bookingDate = new DateTime($row['bookDate']);
            $thaiDate = formatThaiDate($bookingDate);

        } else {
            echo "ไม่มีข้อมูล";
        }
        
        ?>

        <div onclick="goBack()" class="btn btn-lg btn-custom " style="position: fixed;top: 45px;left: 88%;z-index: 1000;cursor: pointer;">
            <i class="fa fa-arrow-left" style="color: #ffffff;"></i>
        </div>
        

            <!-- <div class="" style="background-color: #FFF; padding: 40px; border-radius: 10px; margin-left: 10px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); flex-grow: 1;width: 100%;">
                <div class="container" style="font-size: 12px; width: 100%">
                    <div class="row mb-1" style="display: flex; align-items: center;">
                        <p style="flex: 1; font-weight: bold;">รายละเอียด</p>
                        <div class="col-md-8">
                            <p><?php echo $row['roomDetail'] ?></p>
                        </div>
                    </div>
                    <div class="row mb-1" style="display: flex; align-items: center;">
                        <p style="flex: 1; font-weight: bold;">ช่องทางการชำระเงิน</p>
                        <div class="col-md-8">
                            <p><p><?php echo $row['roomDetail'] ?></p></p>
                        </div>
                    </div>
                    <div class="row mb-1" style="display: flex; align-items: center;">
                        <p style="flex: 1; font-weight: bold;">จำนวนเงิน</p>
                        <div class="col-md-8">
                            <p><p><?php echo $row['roomDetail'] ?></p></p>
                        </div>
                    </div>
                    
                </div>
            </div> -->
        
        
        

            <div id="credit_card" class="bg-light" style="margin:20px 2%; padding: 20px 30px; display:<?php echo $credit ?>;">
                <h5>ช่องทางชำระเงิน</h5>
                <p>ข้อมูลบัตรเครดิต</p>
                <input type="text" id="credit_number" class="form-control mb-3" placeholder="เลขบัตรเครดิต" maxlength="19" oninput="formatCardNumber(this)" />
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="payer_first_name" class="form-label">ชื่อผู้ถือบัตร</label>
                        <input type="text" id="first_name" class="form-control" placeholder="ชื่อผู้ชำระเงิน" required />
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="last_name" class="form-label">นามสกุลผู้ถือบัตร</label>
                        <input type="text" id="last_name" class="form-control" placeholder="นามสกุลผู้ชำระเงิน" required />
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <input type="text" id="credit_date" class="form-control mb-3" placeholder="วันหมดอายุ (MM/YY)" maxlength="5" oninput="formatExpiryDate(this)" />
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <input type="password" id="cvv" class="form-control" placeholder="CVV" maxlength="3" />
                            <span class="input-group-text">
                                <i class="fas fa-question-circle" id="cvv-tooltip" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="click" title="Last 3 digits on the back of your card"></i>
                            </span>
                        </div>
                    </div>
                </div>

                <div class="row d-flex">
                <button onclick="creditPayment(<?php echo $payId; ?>)" class="btn btn-success mt-3">ชำระเงิน</button>
                    <div class="text-end mt-3" style="margin-top: 10px;">
                        <p>หากท่านไม่สามารถดำเนินการได้
                            <a onclick="goSkip()" style="color: #4DA866; cursor: pointer;">ดำเนินการภายหลัง <i class="fas fa-arrow-right"></i></a>
                        </p>
                    </div>
                </div>
            </div>


        <div class="menu_pro d-flex " style="width: 100%">
            <div class="wow fadeInUp" data-wow-delay="0.2s">
                <div class="card" style="width: 400px;display:<?php echo $qrcode ?>">
                    <img src="../img/qrcode/promptpay.jpg" class="card-img-top" style="height: 400px; object-fit: cover;">
                    <div class="card-body text-center">
                        <h5 class="card-title" style="font-size: 12px; font-weight: bold;">ชื่อบัญชี: บ้านบัวดอยโฮมสเตย์</h5>
                        <p style="font-size: 12px;">เลขบัญลชี: 062-1-97990-6 ธนาคาร: กสิกรไทย</p>
                    </div>
                </div>
            </div>
            
            <div id="qrcode" class="bg-light me-1" style="margin:0 20px 2%; padding: 20px 30px; display:<?php echo $qrcode ?>;width: 100%;">
                <h5>ช่องทางชำระเงิน</h5>
                <div class="mb-3">
                    <label for="payer_name" class="form-label">ชื่อผู้ชำระเงิน</label>
                    <input type="text" id="qr_name" class="form-control" placeholder="ชื่อผู้ชำระเงิน" required />
                </div>
                <div class="mb-3">
                    <label for="transaction_date" class="form-label">วันที่ทำรายการ</label>
                    <input type="date" id="qr_date" class="form-control" required />
                </div>
                <div class="mb-3">
                    <label for="bank" class="form-label">ธนาคารที่ชำระเงิน</label>
                    <select id="qr_bank" class="form-select" required>
                        <option value="">เลือกธนาคาร</option>
                        <option value="BBL">ธนาคารกรุงเทพ</option>
                        <option value="KBANK">ธนาคารกสิกรไทย</option>
                        <option value="KTB">ธนาคารกรุงไทย</option>
                        <option value="SCB">ธนาคารไทยพาณิชย์</option>
                        <option value="BAY">ธนาคารกรุงศรีอยุธยา</option>
                        <option value="TMB">ธนาคารทหารไทย</option>
                        <option value="TBANK">ธนาคารธนชาต</option>
                        <option value="KK">ธนาคารเกียรตินาคิน</option>
                        <option value="TISCO">ธนาคารทิสโก้</option>
                        <option value="CIMBT">ธนาคารซีไอเอ็มบีไทย</option>
                        <option value="LH">ธนาคารแลนด์ แอนด์ เฮ้าส์</option>
                        <option value="UOB">ธนาคารยูโอบี</option>
                        <option value="BACC">ธนาคารเพื่อการเกษตรและสหกรณ์การเกษตร</option>
                        <option value="ICBC">ธนาคารไอซีบีซี</option>
                        <option value="GSB">ธนาคารออมสิน</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="payment_amount" class="form-label">จำนวนเงินที่ชำระ</label>
                    <input type="number" id="qr_price" class="form-control" placeholder="กรอกจำนวนเงิน" required />
                </div>
                <div class="mb-3">
                    <label for="payment_receipt" class="form-label">อัพโหลดภาพหลักฐานการชำระเงิน</label>
                    <input type="file" id="payment_receipt" class="form-control" accept="image/*" required />
                </div>
                <div class="row d-flex">
                    <button onclick="qrPayment(<?php $payId; ?>)" class="btn btn-success mt-3">ชำระเงิน</button>
                    <div class="text-end mt-3" style="margin-top: 10px;">
                        <p>หากท่านไม่สามารถดำเนินการตอนนี้
                        <a onclick="goSkip()" style=" color: #4DA866; cursor: pointer;">ดำเนินการภายหลัง <i class="fas fa-arrow-right"></i></a></p>
                    </div>
                </div>
            </div>
        </div>
        
</div> 

    <nav>
        <?php include("../footer.php"); ?>
    </nav>

    <script>
    
        document.addEventListener('DOMContentLoaded', function () {
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });
        });
    </script>
    
    <!-- Include Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="pay.js"></script>
</body>
</html>

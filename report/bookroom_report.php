<?php
	require_once __DIR__ . '/vendor/autoload.php';
	include ("../db_config.php");
    $db_con = connect_db();

$defaultConfig = (new Mpdf\Config\ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new Mpdf\Config\FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];	
$mpdf = new \Mpdf\Mpdf([
            'mode' => 'utf-8', 
            'format' => 'A4',
            'margin_left' => 15,
            'margin_right' => 15,
            'margin_top' => 16,
            'margin_bottom' => 16,
            'margin_header' => 9,
            'margin_footer' => 9,
            'mirrorMargins' => true,


            //configfont
            'fontDir' => array_merge($fontDirs, [
                __DIR__ . 'vendor/mpdf/mpdf/custom/font/directory',
            ]),
            'fontdata' => $fontData + [
                'thsarabun' => [
                    'R' => 'THSarabunNew.ttf',
                    'I' => 'THSarabunNew Italic.ttf',
                    'B' => 'THSarabunNew Bold.ttf',
                    'U' => 'THSarabunNew BoldItalic.ttf'
                ]
            ],
            'default_font' => 'thsarabun',
            'defaultPageNumStyle' => 1
            // close configfont



        ]);

$mpdf->setFooter('{PAGENO}');//ตัวรันหน้า
//http://fordev22.com/
	

$sql = "
            SELECT * 
            FROM booking_bill 
            INNER JOIN room_product ON booking_bill.roomID = room_product.roomID
            INNER JOIN booking ON booking_bill.bookID = booking.bookID
            LEFT JOIN booking_payment ON booking_bill.payID = booking_payment.payID
            WHERE booking_bill.bookID = :bookID
            ORDER BY booking_bill.billID DESC
        ";


        $data2 = $db_con->prepare($sql);
        $userID = $_GET['bookId'];
        $data2->bindParam(':bookID', $userID, PDO::PARAM_INT);
        $data2->execute();
        $dataArray = $data2->fetchAll(PDO::FETCH_ASSOC);



$body_1='
	<style>
		body{

			
			  font-family: "thsarabun"; 


			  /* http://fordev22.com */
       		/* https://www.facebook.com/fordev22/ */

			
		}
	</style>';
    $fordev22 = ''; // กำหนดค่าเริ่มต้นให้กับตัวแปร fordev22
    function formatThaiDate($dateString) {
        // แปลงสตริงวันที่เป็นออบเจ็กต์ DateTime
        $date = new DateTime($dateString);
        
        // กำหนดรูปแบบเดือนที่คุณต้องการ
        $thaiMonth = [
            '01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม',
            '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน',
            '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน',
            '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'
        ];
        
        // ดึงวันที่ ปี เดือน และเวลา
        $day = $date->format('d');
        $month = $date->format('m');
        $year = $date->format('Y') + 543; // แปลงปีจาก ค.ศ. เป็น พ.ศ.
        $time = $date->format('H.i'); // ดึงเวลาในรูปแบบชั่วโมง.นาที
        
        // สร้างวันที่ในรูปแบบไทยพร้อมเวลา
        return "{$day} {$thaiMonth[$month]} {$year} เวลา {$time} น.";
    }
    

    $currentDateTime = date('Y-m-d H:i:s');
    
    if (!empty($dataArray)) {
        foreach ($dataArray as $index => $row) {
            if($row['payType'] == 'Q'){
                $paytype = "โอนผ่าน QR Payment";
            }else{
                $paytype = "โอนผ่าน Creditcard";
            }
            if($row['payStatus'] == 2){
                $status = "ชำระเงินสำเร็จ";
            }else{
                $status = "ไม่สำเร็จ";
            }
            $payManey = $row['payManey'];
            $bookPrice = $row['bookPrice'];
            $payPrice = $bookPrice - $payManey;

            $fordev22 .= '
            <style>
                div {}
                table {
                    border-collapse: collapse;
                    width: 100%;
                }
                td, th {
                    font-size: 18px;
                    border: 1px solid #AED6F1;
                    text-align: left;
                    padding: 8px;
                }
                tr:nth-child(even) {
                    background-color: #AED6F1;
                }
            </style>
    
            <img width="250" src="logo_fordev22_2.png" style="vertical-align: middle; width: 250px;">
            <h1 style="margin:0; margin-top: 30px; font-size: 28px;">ใบแสดงการจอง</h1>
            <h1 style="margin:0; font-size: 32px;">ชื่อผู้จอง: '.$row['bookName'].'</h1>
            <div class="alert alert-info"><strong>เบอร์โทรศัพท์: </strong>'.$row['bookTel'].'</div>
            <div class="table-responsive">
            <div class="alert alert-info"><strong>วันที่ทำรายการ: </strong>' .formatThaiDate($row['bookDate']).'</div>
            <br>
            <h1 style="margin:0; font-size: 20px;">ข้อมูลการจอง</h1>
            <table>
                <thead>
                    <tr>
                        <th><b>ชื่อรายการ</b></th>
                        <th>ที่ตั้ง</th>
                        <th>เวลาเข้าใช้</th>
                        <th>เวลาเข้าคืน</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>'.$row['roomName'].'</td>
                        <td>'.$row['roomLocation'].'</td>
                        <td>'.formatThaiDate($row['bookDateStart']).'</td>
                        <td>'.formatThaiDate($row['bookDateEnd']).'</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h1 style="margin:0; font-size: 20px;">ข้อมูลชำระเงิน</h1>
            <table>
                <thead>
                    <tr>
                        <th><b>ช่องทางชำระเงิน</b></th>
                        <th>ชื่อบัญชี</th>
                        <th>วันชำระเงิน</th>
                        <th>จำนวน</th>
                        <th>สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>'.$paytype.'</td>
                        <td>'.$row['payNameAc'].'</td>
                        <td>'.formatThaiDate($row['payDate']).'</td>
                        <td>'.$payManey.' บาท</td>
                        <td>'.$status.'</td>
                    </tr>
                </tbody>
            </table>
            <br><br>
            <img width="100" src="rai.png" style="vertical-align: middle; width: 100px;" style="padding-left: 500px;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 500px; border: 1px solid white; padding: 5px;">ต้องจ่ายทั้งหมด '.$bookPrice.' บาท</td>
                    <td style="width: 200px; border: 1px solid white; padding: 5px;">(นายครรชิต บางพระ)</td>
                </tr>
            </table>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                   <td style="width: 500px; border: 1px solid white; padding: 5px;">จ่ายแล้ว '.$payManey.' บาท</td>
                    <td style="width: 200px; border: 1px solid white; padding: 5px;">พนักงาน</td>
                </tr>
            </table>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="width: 500px; border: 1px solid white; padding: 5px;"><h1 style="margin:0; font-size: 18px;">คงเหลือจ่าย '.$payPrice.' บาท</h1></td>
                    <td style="width: 200px; border: 1px solid white; padding: 5px;"></td>
                </tr>
            </table>
            <br><br>
            <div class="alert alert-info"><strong>พิมพ์เมื่อ: </strong>'.formatThaiDate($currentDateTime).'</div>
            <div class="table-responsive"></div>
            ';
        }
    } else {
        // กรณีที่ไม่มีข้อมูลจากฐานข้อมูล
        $fordev22 = '<p>ไม่พบข้อมูลการจอง</p>';
    }


	

$mpdf->WriteHTML($fordev22);
  

$mpdf->WriteHTML($body_1);
$output = 'fordev22.com';
$mpdf->Output($output, 'I');
/* http://fordev22.com */
/* https://www.facebook.com/fordev22/ */
//https://monkeywebstudio.com/%E0%B8%AA%E0%B8%A3%E0%B9%89%E0%B8%B2%E0%B8%87%E0%B9%84%E0%B8%9F%E0%B8%A5%E0%B9%8C-pdf-%E0%B8%94%E0%B9%89%E0%B8%A7%E0%B8%A2-mpdf/
?>
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
			 if($row['payStatus'] == 0 || $row['payStatus'] == 1){
                $bookstatus = "จองไม่สำเร็จ";
            }else{
                 $bookstatus = "จองสำเร็จ";
            }
            $payManey = $row['payManey'];
            $bookPrice = $row['bookPrice'];
            $vat = ($bookPrice * 7) /100;
            $bookManey = $bookPrice + $vat;
            $payPrice = $bookManey - $payManey;
			
            $day =  $bookPrice / $row['roomPrice'];

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
				<div class="alert alert-info" style=" text-align: right; font-size: 16px;">บ้านบัวดอย โฮมสเตย์</div>
				<div class="alert alert-info" style=" text-align: right;">เลขที่ 348 หมู่ที่ 14 บ้านนอแล ดอยอ่างขาง</div>
				<div class="alert alert-info" style=" text-align: right;">ตำบลเวียง อำเภอฝาง จังหวัดเชียงใหม่ 50110</div>
				<div class="alert alert-info" style=" text-align: right;">โทร. 063-245-5648 หรือ 080-659-569</div>

            <h1 style="margin:0; font-size: 28px;">ใบแสดงการจอง</h1>
            <h1 style="margin:0; font-size: 32px;">ชื่อลูกค้า: '.$row['bookName'].'</h1>
            <div class="alert alert-info"><strong>เบอร์โทรศัพท์: </strong>'.$row['bookTel'].'</div>
            <div class="table-responsive">
            <div class="alert alert-info"><strong>วันที่ทำรายการ: </strong>' .formatThaiDate($row['bookDate']).'</div>
            <br>
            <h1 style="margin:0; font-size: 20px;">ข้อมูลการจอง</h1>
            <table>
                <thead>
                    <tr>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;"><b>ชื่อรายการ</b></th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;">ที่ตั้ง</th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;">เช็คอิน</th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;">เช็คเอาท์</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-size: 14px; height: 2px; border: none;">'.$row['roomName'].'</td>
                        <td style="font-size: 14px; height: 2px; border: none;">'.$row['roomLocation'].'</td>
                        <td style="font-size: 14px; height: 2px; border: none;">'.formatThaiDate($row['bookDateStart']).'</td>
                        <td style="font-size: 14px; height: 2px; border: none;">'.formatThaiDate($row['bookDateEnd']).'</td>
                    </tr>
                </tbody>
            </table>
            <br>
            
            </table>
            <br>
			<table>
                <thead>
                    <tr>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;"><b>จำนวน</b></th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;">ราคา/วัน</th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;">วันทำรายการ</th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-size: 14px; height: 2px; border: none;">'.$day.' วัน</td>
                        <td style="font-size: 14px; height: 2px; border: none;">'.number_format($row['roomPrice']).' บาท</td>
                        <td style="font-size: 14px; height: 2px; border: none;">'.formatThaiDate($row['bookDate']).'</td>
                        <td style="font-size: 14px; height: 2px; border: none;">'.$bookstatus.'</td>
                    </tr>
					<tr style="background-color: #ccc;">
                        <td style="font-size: 14px; height: 2px; border: none; border-top: solid 1px black; "></td>
                        <td style="font-size: 14px; height: 2px; border: none; border-top: solid 1px black; "></td>
                        <td style="font-size: 14px; height: 2px; border: none; border-top: solid 1px black;  text-align: right;font-weight: bold;">รวม</td>
                        <td style="font-size: 14px; height: 2px; border: none; border-top: solid 1px black; ">'.number_format($bookPrice).' บาท</td>
                    </tr>
					<tr style="background-color: #ccc;">
                        <td style="font-size: 14px; height: 2px; border: none;"></td>
                        <td style="font-size: 14px; height: 2px; border: none;"></td>
                        <td style="font-size: 14px; height: 2px; border: none; text-align: right;">7.00% VAT</td>
                        <td style="font-size: 14px; height: 2px; border: none;">'.number_format($vat).' บาท</td>
                    </tr>
					<tr style="background-color: #ccc;">
						<td style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black;"></td>
						<td style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black;"></td>
						<td style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; text-align: right;font-weight: bold;font-weight: bold;">รวมทั้งสิ้น</td>
						<td style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black;">'.number_format($bookManey).' บาท</td>
					</tr>
                </tbody>
            </table>
            <br>
			 <h1 style="margin:0; font-size: 20px;">ข้อมูลชำระเงิน</h1>
            <table>
                <thead>
                    <tr>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;"><b>ช่องทางชำระเงิน</b></th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;">ชื่อบัญชี</th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;">วันชำระเงิน</th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;">จำนวน</th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;">สถานะ</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="font-size: 14px; height: 2px; border: none;">'.$paytype.'</td>
                        <td style="font-size: 14px; height: 2px; border: none;">'.$row['payNameAc'].'</td>
                        <td style="font-size: 14px; height: 2px; border: none;">'.formatThaiDate($row['payDate']).'</td>
                        <td style="font-size: 14px; height: 2px; border: none;">'.$payManey.' บาท</td>
                        <td style="font-size: 14px; height: 2px; border: none;">'.$status.'</td>
                    </tr>
					<tr style="background-color: #ccc;">
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;"><b></b></th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;"></th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;"></th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;text-align: right;">จ่ายแล้ว</th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;">'.number_format($payManey).'</th>
                    </tr><tr style="background-color: #ccc;">
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;"><b></b></th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;"></th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;"></th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;text-align: right;">คงเหลือ</th>
                        <th style="font-size: 14px; height: 2px; border: none; border-bottom: solid 1px black; border-top: solid 1px black;">'.number_format($bookManey-$payManey).'</th>
                    </tr>
                </tbody>
            </table>
            <br>
            <img width="100" src="rai.png" style="vertical-align: middle; width: 100px;" style="padding-left: 500px;">
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="font-size: 14px; height: 2px; width: 500px; border: 1px solid white; padding: 5px;">*หมายเหตุ</td>
                    <td style="font-size: 14px; height: 2px; width: 200px; border: 1px solid white; padding: 5px;">(นายพุทธรักษ์ ลายเฮิง)</td>
                </tr>
				
            </table>
			
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                   <td style="font-size: 14px; height: 2px; width: 500px; border: 1px solid white; padding: 5px;">*ใบเสร็จฉบับสมบูรณ์ขอได้ตอนเช็คเอาท์  ระบบจะตักการจองโดยอัตโนมัติ โปรดเช็คอินไม่เกิน 30 นาทีตามเวลาเช็คอิน</td>
                    <td style="font-size: 14px; height: 2px; width: 200px; border: 1px solid white; padding: 5px;">เจ้าของกิจการ</td>
                </tr>
            </table>
            
            <div class="alert alert-info" style=" text-align: right;"><strong>พิมพ์เมื่อ: </strong>'.formatThaiDate($currentDateTime).'</div>
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
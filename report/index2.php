<?php
	require_once __DIR__ . '/vendor/autoload.php';
	 include('condb.php');

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
        ]);

$mpdf->setFooter('{PAGENO}');//ตัวรันหน้า
//http://fordev22.com/
	

	$tableh1 = '
	

	<h2 style="text-align:center">List Member (SELECT FROM Database) </h2>

	<table id="bg-table" width="100%" style="border-collapse: collapse;font-size:12pt;margin-top:8px;">
	    <tr style="border:1px solid #000;padding:4px;">
	        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"   width="10%">ลำดับ</td>
	        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">username</td>
	        <td  width="15%" style="border-right:1px solid #000;padding:4px;text-align:center;">&nbsp; ชื่อ </td>
	        <td  style="border-right:1px solid #000;padding:4px;text-align:center;"  width="15%">สกุล </td>
	        <td  style="border-right:1px solid #000;padding:4px;text-align:center;" width="15%">อีเมล์</td>
	    </tr>

	</thead>
		<tbody>';
		//คำสั่งให้เลือกข้อมูลจาก TABLE ชื่อ tbl_member โดยเรียงจาก member_id และให้เรียงลำดับจากมากไปน้อยคือ DESC และ เปิดดู error เวลามีปัญหา
$query = "SELECT * FROM tb_member " or die("Error:" . mysqli_error()); 
 	

//ประกาศตัวแปร sqli
// $result = mysqli_query($conn, $query);
	// $sql = "SELECT * FROM tb_member";
	$result = mysqli_query($conn, $query);
	
	$content = "";
	// if (mysqli_num_rows($result) > 1) {
		// $i = 1;
		foreach ($result as $rs) {
			$tablebody .= '<tr style="border:1px solid #000;">
				<td style="border-right:1px solid #000;padding:3px;text-align:center;"  >'.$rs['member_id'].'</td>
				<td style="border-right:1px solid #000;padding:3px;">'.$rs['email'].'</td>
				<td style="border-right:1px solid #000;padding:3px;">'.$rs['username'].'</td>
				<td style="border-right:1px solid #000;padding:3px;">'.$rs['member_name'].'</td>
				<td style="border-right:1px solid #000;padding:3px;">'.$rs['member_lname'].'</td>
			</tr>';
			// $i++;
		}
	//}
	
//mysqli_close($conn);


$tableend1 = "</tbody>
</table>";
// print_r($result);
// $mpdf->Output();
// exit();



$body_1='
	<style>
		body{

			
			  font-family: "thsarabun"; 


			  /* http://fordev22.com */
       		/* https://www.facebook.com/fordev22/ */

			
		}
	</style>';
$fordev22 ='
<style>
     

div{
       
    }
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


<img width="250"  src="logo_fordev22_2.png" style="vertical-align: middle;
  width: 250px;">
<h1>Php mPdf (Print Pdf For Php v.5 - v.7 ++) By fordev22.com</h1>
<div class="alert alert-info">
    <strong> mPdf</strong>
    ภาษา ไทย และ Eng</div>
<p></p>
<div class="table-responsive">
<table>
    <thead>
    <tr>
        <th><b>Website</b> </th>
        <th>Name</th>
        <th>Address</th>
    </tr>
    </thead>
    <tbody>
    
    <tr>
        <td>fordev22.com</td>
        <td>Mr.fordev22</td>
        <td>ไทย
        </td>
    </tr>

    <tr>
        <td>fordev22.com</td>
        <td>Mr.fordev22</td>
        <td>Japan
        </td>
    </tr>

   

    
    </tbody>


   
</table>
</div>

';
	


	

 $mpdf->WriteHTML($fordev22);
  
 $mpdf->WriteHTML($tableh1);

 $mpdf->WriteHTML($tablebody);

$mpdf->WriteHTML($tableend1);
$mpdf->WriteHTML($body_1);
//$output = 'fordev22.com';
$mpdf->Output($output, 'I');
/* http://fordev22.com */
/* https://www.facebook.com/fordev22/ */
//https://monkeywebstudio.com/%E0%B8%AA%E0%B8%A3%E0%B9%89%E0%B8%B2%E0%B8%87%E0%B9%84%E0%B8%9F%E0%B8%A5%E0%B9%8C-pdf-%E0%B8%94%E0%B9%89%E0%B8%A7%E0%B8%A2-mpdf/
?>
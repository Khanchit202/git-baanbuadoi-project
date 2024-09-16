<?php
require('fpdf/fpdf.php');

$pdf = new FPDF('P', 'mm', 'A4');
$pdf->AddPage();

// Set Font
$pdf->AddFont('THSarabunPSK', '', 'THSarabun.php');
$pdf->SetFont('THSarabunPSK', '', 20);

// Header
$pdf->Image('../tabbar_view/baanbuadoi.png', 10, 10, 20); // Logo
$pdf->SetFont('THSarabunPSK', '', 16);
$pdf->Cell(190, 10, 'Baanbuadoi', 0, 1, 'C');
$pdf->SetFont('THSarabunPSK', '', 12);
$pdf->Cell(190, 7, 'Baan nor la Sub-district, Fang District, Chiang Mai 50110', 0, 1, 'C');
$pdf->Cell(190, 7, 'Tel: 02-222-2222, 03-003-0033', 0, 1, 'C');

// Receipt Information
$pdf->SetFont('THSarabunPSK', '', 14);
$pdf->Cell(190, 10, 'Receipt', 0, 1, 'C');

// General Information
$pdf->SetFont('THSarabunPSK', '', 12);
$pdf->Cell(130, 7,iconv('utf-8', 'cp874', 'ลูกต้า : Date: January 3, 2024'), 0, 0);
$pdf->Cell(60, 7,iconv('utf-8', 'cp874', 'ลูกต้า : Receipt No: 654-525-654-85265'), 0, 1);

// Customer Information
$pdf->Cell(130, 7, iconv('utf-8', 'cp874', 'ลูกต้า : ครรชิต บางพระ'), 0, 0);
$pdf->Cell(60, 7, 'Phone: 095-555-5555', 0, 1);

// Table Header
$pdf->SetFont('THSarabunPSK', '', 12);
$pdf->Cell(10, 7, 'No.', 1, 0, 'C');
$pdf->Cell(80, 7, 'Description', 1, 0, 'C');
$pdf->Cell(20, 7, 'Quantity', 1, 0, 'C');
$pdf->Cell(40, 7, 'Unit Price', 1, 0, 'C');
$pdf->Cell(40, 7, 'Total', 1, 1, 'C');

// Table Data
$pdf->SetFont('THSarabunPSK', '', 12);
$pdf->Cell(10, 7, '1', 1, 0, 'C');
$pdf->Cell(80, 7, 'A4 Paper', 1, 0);
$pdf->Cell(20, 7, '200', 1, 0, 'C');
$pdf->Cell(40, 7, '2.00', 1, 0, 'R');
$pdf->Cell(40, 7, '400.00', 1, 1, 'R');

// Total
$pdf->Cell(150, 7, 'Total', 0, 0, 'R');
$pdf->Cell(40, 7, '1070.00', 0, 1, 'R');

// Notes and Signature
$pdf->Ln(10);
$pdf->Cell(190, 7, 'Thank you for your business', 0, 1, 'C');

// Signature
$pdf->Ln(10);
$pdf->Cell(190, 7, '....................................................', 0, 1, 'C');
$pdf->Cell(190, 7, '(Receiver)', 0, 1, 'C');

$pdf->Output();
?>

<?php
include ("db_config.php");
$db_con = connect_db();

try {
    $sql = "UPDATE booking 
            SET payCancel = 1 
            WHERE payStatus = 1 
            AND DATEDIFF(CURDATE(), payDate) > 3";

    // ประมวลผลคำสั่ง SQL
    $stmt = $db_con->prepare($sql);
    $stmt->execute();

    echo "อัปเดตสถานะการชำระเงินสำเร็จ: " . $stmt->rowCount() . " รายการถูกเปลี่ยนสถานะ";
    
} catch (PDOException $e) {
    echo "เกิดข้อผิดพลาด: " . $e->getMessage();
}

// ปิดการเชื่อมต่อ
$pdo = null;
?>

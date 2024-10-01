<?php
$query = $_POST['query'] ?? '';
include("../../db_config.php");

$db_con = connect_db("client");
try {
    // ตรวจสอบการเชื่อมต่อฐานข้อมูล
    if (!$db_con) {
        throw new Exception('Database connection not established.');
    }

    if ($query) {
        $sql = "
            SELECT * 
            FROM booking_bill 
            INNER JOIN room_product ON booking_bill.roomID = room_product.roomID
            INNER JOIN booking ON booking_bill.bookID = booking.bookID
            LEFT JOIN booking_payment ON booking_bill.payID = booking_payment.payID
            WHERE booking.bookName LIKE :query AND 
                  booking_bill.billStatus = 1 AND 
                  booking_bill.billID NOT IN (SELECT billID FROM checking)
            ORDER BY booking_bill.billID DESC
        ";
        $data2 = $db_con->prepare($sql);
        $searchParam = '%' . $query . '%';
        $data2->bindParam(':query', $searchParam, PDO::PARAM_STR);
    } else {
        $sql = "
            SELECT * 
            FROM booking_bill 
            INNER JOIN room_product ON booking_bill.roomID = room_product.roomID
            INNER JOIN booking ON booking_bill.bookID = booking.bookID
            LEFT JOIN booking_payment ON booking_bill.payID = booking_payment.payID
            WHERE booking_bill.billStatus = 1 AND 
                  booking_bill.billID NOT IN (SELECT billID FROM checking)
            ORDER BY booking_bill.billID DESC
        ";
        $data2 = $db_con->prepare($sql);
    }

    $data2->execute();
    $dataArray = $data2->fetchAll(PDO::FETCH_ASSOC);

    function highlightKeyword($text, $keyword) {
        if ($keyword) {
            return preg_replace('/(' . preg_quote($keyword, '/') . ')/iu', '<span style="color: green; font-weight: bold;">$1</span>', $text);
        }
        return $text;
    }

    function formatDateToThai($dateString) {
        $date = new DateTime($dateString);
        $thaiMonth = [
            '01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม',
            '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน',
            '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน',
            '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'
        ];
        $formattedDate = $date->format('d') . ' ' . $thaiMonth[$date->format('m')] . ' ' . ($date->format('Y') + 543);
        return $formattedDate . ' ' . $date->format('H:i') . ' น.';
    }

    // เริ่มต้นตารางภายใน div ที่ตอบสนอง
    echo '<div class="table-responsive" style="overflow-x: auto;">';
    echo '<table class="table table-hover table-bordered" style="min-width: 800px; font-size: 12px;">';
    echo '<thead style="background-color: #97C7C9;">';
    echo '<tr>';
    echo '<th class="text-center">ชื่อผู้จอง(ในใบจอง)</th>';
    echo '<th class="text-center">สถานะ</th>';
    echo '<th class="text-center">ประเภทจอง</th>';
    echo '<th class="text-center">Check In</th>';
    echo '<th class="text-center">Check out</th>';
    echo '<th class="text-center">ตัวเลือก</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    if ($dataArray) {
        foreach ($dataArray as $row) {
            if ($row['billStatus'] == 1) {
                $bill_status = "สำเร็จ";
                $bill_color = '#A7CF5A';
            } else {
                $bill_status = "รอดำเนินการ";
                $bill_color = '#3B8386';
            }

            $tyle_status = $row['bookType'] == 1 ? "ห้องพัก" : "บริการ";

            echo '<tr>';
            echo '<td class="text-center">' . highlightKeyword(htmlspecialchars($row['bookName']), $query) . '</td>';
            echo '<td class="text-center"><h5 style="background-color: ' . $bill_color . '; font-size: 8px; padding: 5px 0; border-radius: 10px; color: #ffffff; margin: 0;">' . $bill_status . '</h5></td>';
            echo '<td class="text-center">' . $tyle_status . '</td>';
            echo '<td class="text-center">' . htmlspecialchars(formatDateToThai($row['bookDateStart'])) . '</td>';
            echo '<td class="text-center">' . htmlspecialchars(formatDateToThai($row['bookDateEnd'])) . '</td>';
            // สร้างปุ่มรายละเอียด
            echo '<td class="text-center">
                <button class="btn" style="font-size: 8px; background-color: #4caf50; color: #ffffff; border-radius: 5px;" 
                    onclick="showDetails(
                        \'' . htmlspecialchars($row['bookName']) . '\', 
                        \'' . $bill_status . '\', 
                        \'' . $tyle_status . '\', 
                        \'' . htmlspecialchars(formatDateToThai($row['bookDateStart'])) . '\', 
                        \'' . htmlspecialchars(formatDateToThai($row['bookDateEnd'])) . '\', 
                        \'' . htmlspecialchars($row['payManey']) . '\', 
                        \'' . htmlspecialchars($row['roomName']) . '\', 
                        \'' . htmlspecialchars($row['roomLocation']) . '\', 
                        \'' . htmlspecialchars($row['roomPrice']) . '\'
                    )">รายละเอียด</button>
            </td>';

            echo '</tr>';
        }
    } else {
        echo '<tr><td colspan="6" class="text-center">ไม่มีข้อมูลที่ตรงกับการค้นหา</td></tr>';
    }

    echo '</tbody>';
    echo '</table>';
    echo '</div>'; // ปิด div ของ table-responsive
} catch (PDOException $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
} catch (Exception $e) {
    echo "Error: " . htmlspecialchars($e->getMessage());
}
?>

<!-- Modal -->
<div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 70%;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-size: 16px;" class="modal-title fw-bold" id="modalName"></h5>
                <button style="font-size: 10px;" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="font-size: 10px; padding: 10px 20px;">
        
            <h1 class="fw-bold" style="font-size: 12px;">ข้อมูลรายการ</h1>
            <div class="table-responsive" style="overflow-x: auto;">
                <table class="table table-hover table-bordered" style="min-width: 800px; font-size: 10px;">
                    <thead style="background-color: #97C7C9;">
                        <tr>
                            <th>ชื่อรายการ</th>
                            <th>ที่ตั้ง</th>
                            <th>ราคา/หน่วย</th>
                            <th>ประเภทรายการ</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><p id="modalRoomName"></p></td>
                            <td><p id="modalRoomLocation"></p></td>
                            <td><p id="modalRoomPrice"></p></td>
                            <td><p id="modalBookType"></p></td>
                        </tr>
                    </tbody>
                </table>
                <h1 class="fw-bold" style="font-size: 12px;">ข้อมูลผู้จอง</h1>
                <table class="table table-hover table-bordered" style="min-width: 800px; font-size: 10px;">
                    <thead style="background-color: #97C7C9;">
                        <tr>
                            <th>ชื่อผู้จอง</th>
                            <th>สถานะรายการ</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>เบอร์โทรศัพท์</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><p id="modalBookName" style="background-color: yellow;"></p</td>
                            <td><p id="modalBillStatus"></p</td>
                            <td><p id="modalCheckIn"></p</td>
                            <td><p id="modalCheckOut"></p</td>
                            <td><p id="modalName">0958053137</p</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div class="row ">
                <div class="col-md-2"></div>
                <div class="col-md-4"></div>
                <div class="col-md-2 text-end">
                    <strong>ราคา(ก่อนหักภาษี):</strong>
                </div>
                <div class="col-md-3">
                    <p id="modalPrice"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4"></div>
                <div class="col-md-2 text-end">
                    <strong>หักภาษีมูลค่าเพิ่ม:</strong>
                </div>
                <div class="col-md-3">
                    <p id="modalVat"></p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4"></div>
                <div class="col-md-2 text-end">
                    <strong>ส่วนลด:</strong>
                </div>
                <div class="col-md-3">
                    <p id="modalDiscount">-</p>
                </div>
            </div>

            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-4"></div>
                <div class="col-md-2 text-end">
                    <strong>ราคารวม:</strong>
                </div>
                <div class="col-md-3">
                    <p id="modalTotalAmount"></p>
                </div>
            </div>

            <div class="row mb-2">
                <div class="col-md-2"></div>
                <div class="col-md-4"></div>
                <div class="col-md-2 text-end">
                    <strong>จ่ายมัดจำแล้ว:</strong>
                </div>
                <div class="col-md-3">
                    <p id="modalPayMoney"></p>
                </div>
            </div>

            <div class="row mb-2" >
                <div class="col-md-2"></div>
                <div class="col-md-4"></div>
                <div class="col-md-2 text-end">
                    <strong>คงเหลือจ่าย:</strong>
                </div>
                <div class="col-md-3">
                    <p id="modalRemainingAmount" class="fw-bold " style="padding: 15px; border: solid 1px red;"></p>
                </div>
            </div>

            </div>
            <div class="modal-footer">
                <a href="" class="btn me-1 fw-bold" style="font-size: 14px; border: solid 1px #DE6461; color: #4caf50; background-color: none; border-radius: 5px;">ยกเลิกรายการ</a>
                <a href="#" class="btn me-1 " style="font-size: 14px; background-color: #4caf50; color: #ffffff; background-color: none; border-radius: 5px;" onclick="checkinHandler('<?php echo htmlspecialchars($row['billID']); ?>')">Checkin</a>
            </div>
        </div>
    </div>
</div>


<!-- Password Modal -->
<div class="modal fade" id="passwordModal" tabindex="-1" aria-labelledby="passwordModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="passwordModalLabel">กรุณาใส่รหัสผ่าน</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="password" id="passwordInput" class="form-control" placeholder="ใส่รหัสผ่านของคุณ">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ยกเลิก</button>
                <button type="button" class="btn btn-primary" id="submitPasswordBtn">ยืนยัน</button>
            </div>
        </div>
    </div>
</div>






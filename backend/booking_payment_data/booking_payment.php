<?php
$users = $db_con->query("SELECT * FROM booking_payment WHERE payStatus = 1");

$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);




?>
<p style="font-size: 16px; padding: 5px 20px;">การชำระเงิน</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;">การชำระเงินทั้งหมด</p>
        <!-- <button class="btn btn-primary" style="font-size: 12px;margin-right: 80px;" data-bs-toggle="modal" data-bs-target="#addDataModal">
            <i class="lni lni-circle-plus" style="padding: 5px;"></i>
            เพิ่มบริการ 
        </button> -->
    </div>
    <div class="text-center">
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table table-hover table-bordered" style="min-width: 800px; font-size: 12px;">
            <thead style="background-color: #97C7C9;">
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">ชื่อผู้จอง</th>
                    <th scope="col">วันที่จอง</th>
                    <th scope="col">จองห้องเลขที่</th>
                    <th scope="col">ID ลูกค้า</th>
                    <th scope="col">จำนวนเงินที่ชำระ</th>
                    <th scope="col">ตัวเลือก</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersArray as $index => $pay) : ?>
                <tr>
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td><?php echo htmlspecialchars($pay['payNameAc']); ?></td>
                    <td><?php echo htmlspecialchars($pay['payDate']); ?></td>
                    <td><?php echo htmlspecialchars($pay['roomID']); ?></td>
                    <td><?php echo htmlspecialchars($pay['userID']); ?></td>
                    <td><?php echo htmlspecialchars($pay['payManey']); ?></td>
                    
                    <td>
                        <button onclick="select_pay({
                            payID: '<?php echo addslashes($pay['payID']); ?>',
                            payNameAc: '<?php echo addslashes($pay['payNameAc']); ?>',
                            payDate: '<?php echo addslashes($pay['payDate']); ?>',
                            roomID: '<?php echo addslashes($pay['roomID']); ?>',
                            userID: '<?php echo addslashes($pay['userID']); ?>',
                            payManey: '<?php echo addslashes($pay['payManey']); ?>',
                            bookID: '<?php echo addslashes($pay['bookID']); ?>',
                            payType: '<?php echo addslashes($pay['payType']); ?>',
                            payBank: '<?php echo addslashes($pay['payBank']); ?>',
                            payPic: '<?php echo addslashes($pay['payPic']); ?>'
                })" class="btn btn-success btn-sm">
                            <i class="lni lni-eye" style="padding: 5px;"></i>
                        </button>

                        <button onclick="delete_pay('<?php echo str_pad($pay['payID'], 5, "0", STR_PAD_LEFT); ?>')" class="btn btn-danger btn-sm">
                            <i class="lni lni-trash-can" style="padding: 5px;"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</div>
<!-- Add Modal -->
<div class="modal fade" id="select_pay" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">
          <img src="booking_payment_data/api/baanbuadoi.png" alt="Logo" style="height: 80px; margin-right: 10px;">
          รายละเอียดการชำระเงิน
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
    <div class="row mb-3">
        <div class="col-6">
            <label for="payPic" class="form-label" style="font-weight: bold;">สลิปโอนเงิน:</label>
            <img id="payPic" src="" alt="สลิปโอนเงิน" style="width: 100%;">
        </div>
        <div class="col-6">
            <div class="row mb-3"style="margin-top:30px">
                <div class="col-4">
                    <label for="payID" class="form-label" style="font-weight: bold;">รหัสการชำระเงิน:</label>
                </div>
                <div class="col-8">
                    <p id="payID"></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="payDate" class="form-label" style="font-weight: bold;">วันที่ชำระเงิน:</label>
                </div>
                <div class="col-8">
                    <p id="payDate"></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="payNameAc" class="form-label" style="font-weight: bold;">ชื่อผู้ชำระเงิน:</label>
                </div>
                <div class="col-8">
                    <p id="payNameAc"></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="userID" class="form-label" style="font-weight: bold;">รหัสลูกค้า:</label>
                </div>
                <div class="col-8">
                    <p id="userID"></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="bookID" class="form-label" style="font-weight: bold;">รหัสการจอง:</label>
                </div>
                <div class="col-8">
                    <p id="bookID"></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="roomID" class="form-label" style="font-weight: bold;">รหัสห้องพัก:</label>
                </div>
                <div class="col-8">
                    <p id="roomID"></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="payType" class="form-label" style="font-weight: bold;">ประเภทการชำระเงิน:</label>
                </div>
                <div class="col-8">
                    <p id="payType"></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="payBank" class="form-label" style="font-weight: bold;">ธนาคารที่เลือก:</label>
                </div>
                <div class="col-8">
                    <p id="payBank"></p>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-4">
                    <label for="payManey" class="form-label" style="font-weight: bold;">จำนวนเงินที่ชำระ:</label>
                </div>
                <div class="col-8">
                    <p id="payManey"></p>
                </div>
            </div>
          <div class="modal-footer">
            <button type="button" onclick="cancle('<?php echo addslashes($pay['payID']); ?>')" class="btn btn-danger">ข้อมูลไม่ถูกต้อง</button>
            <button type="button" onclick="confirm('<?php echo addslashes($pay['payID']); ?>')" class="btn btn-success">ยืนยัน</button>
            <a href="#" class="btn me-1 " style="font-size: 14px; background-color: #4caf50; color: #ffffff; background-color: none; border-radius: 5px;" onclick="confirm('<?php echo addslashes($pay['payID']); ?>')">Checkin</a>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->
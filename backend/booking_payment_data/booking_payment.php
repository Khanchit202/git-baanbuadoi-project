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
        <table class="table" style="margin-top: 20px; font-size: 16px;">
            <thead>
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">ชื่อผู้จอง</th>
                    <th scope="col">วันที่จอง</th>
                    <th scope="col">จองห้องเลขที่</th>
                    <th scope="col">ID ลูกค้า</th>
                    <th scope="col">จำนวนเงินที่ชำระ</th>
                    
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
          <div class="row mb-3 d-flex justify-content-center">
              <div class="col-2">
                  <label for="payID" class="form-label" style="font-weight: bold;margin-left: 20px;">รหัสการชำระเงิน:</label>
              </div>
              <div class="col-3">
                  <p id="payID"></p>
              </div>
              <div class="col-2">
                  <label for="payDate" class="form-label" style="font-weight: bold;margin-left: 20px;">วันที่ชำระเงิน:</label>
              </div>
              <div class="col-3">
                  <p id="payDate"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
          <div class="col-2">
                  <label for="payNameAc" class="form-label" style="font-weight: bold;margin-left: 20px;">ชื่อผู้ชำระเงิน:</label>
              </div>
              <div class="col-3">
                  <p id="payNameAc"></p>
              </div>
              <div class="col-2">
                  <label for="userID" class="form-label" style="font-weight: bold;margin-left: 20px;">รหัสลูกค้า:</label>
              </div>
              <div class="col-3">
                  <p id="userID"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
          <div class="col-2">
                  <label for="bookID" class="form-label" style="font-weight: bold;margin-left: 20px;">รหัสการจอง:</label>
              </div>
              <div class="col-3">
                  <p id="bookID"></p>
              </div>
              <div class="col-2">
                  <label for="roomID" class="form-label" style="font-weight: bold;margin-left: 20px;">รหัสห้องพัก:</label>
              </div>
              <div class="col-3">
                  <p id="roomID"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
              <div class="col-2">
                  <label for="payType" class="form-label" style="font-weight: bold;margin-left: 20px;">ประเภทการชำระเงิน:</label>
              </div>
              <div class="col-3">
                  <p id="payType"></p>
              </div>
              <div class="col-2">
                  <label for="payBank" class="form-label" style="font-weight: bold;margin-left: 20px;">ธนาคารที่เลือก:</label>
              </div>
              <div class="col-3">
                  <p id="payBank"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
                <div class="col-2">
                    <label for="payPic" class="form-label" style="font-weight: bold;margin-left: 20px;">สลิปโอนเงิน:</label>
                </div>
                <div class="col-3">
                    <img id="payPic" src="" alt="สลิปโอนเงิน" style="max-width: 100%;">
                </div>
                <div class="col-2">
                    <label for="" class="form-label" style="font-weight: bold;margin-left: 20px;"></label>
                </div>
                <div class="col-3">
                    
                </div>
            </div>

          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
          </div>
      </div>
    </div>
  </div>
</div>

<!-- End Modal -->
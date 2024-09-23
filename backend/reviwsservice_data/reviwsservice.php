<?php
$users = $db_con->query("SELECT * FROM reviws_service");
$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);




?>
<p style="font-size: 16px; padding: 5px 20px;">จัดการข้อมูลรีวิวบริการ</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;">ข้อมูลรีวิวบริการทั้งหมด</p>
        
    </div>
    <div class="text-center">
        <table class="table" style="margin-top: 20px; font-size: 16px;">
            <thead>
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">รหัสลูกค้า</th>
                    <th scope="col">คะแนนที่รีวิว</th>
                    <th scope="col">บริการที่รีวิว</th>
                    <th scope="col">วันที่รีวิว</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersArray as $index => $reser) : ?>
                <tr>
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td><?php echo htmlspecialchars($reser['userID']); ?></td>
                    <td><?php echo htmlspecialchars($reser['rvsScore']); ?></td>
                    <td><?php echo htmlspecialchars($reser['serviceID']); ?></td>
                    <td><?php echo htmlspecialchars($reser['rvsDate']); ?></td>
                    <td>
                    <button onclick="showreviwsSer({
                            rvsID: '<?php echo addslashes($reser['rvsID']); ?>',
                            rvsDetail: '<?php echo addslashes($reser['rvsDetail']); ?>',
                            rvsScore: '<?php echo addslashes($reser['rvsScore']); ?>',
                            rvsDate: '<?php echo addslashes($reser['rvsDate']); ?>',
                            serviceID: '<?php echo addslashes($reser['serviceID']); ?>',
                            billID: '<?php echo addslashes($reser['billID']); ?>',
                            userID: '<?php echo addslashes($reser['userID']); ?>',
                            checkID: '<?php echo addslashes($reser['checkID']); ?>',})" class="btn btn-success btn-sm">
                            <i class="lni lni-eye" style="padding: 5px;"></i>
                        </button>

                        <button onclick="delete_reviwsSer('<?php echo str_pad($reser['rvsID'], 5, "0", STR_PAD_LEFT); ?>')" class="btn btn-danger btn-sm">
                            <i class="lni lni-trash-can" style="padding: 5px;"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- select Modal -->
<div class="modal fade" id="select_reser" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">
          <img src="./booking_payment_data/api/baanbuadoi.png" alt="Logo" style="height: 80px; margin-right: 10px;">
          รายละเอียดรีวิว
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="row mb-3 d-flex justify-content-center">
              <div class="col-2">
                  <label for="rvsID" class="form-label" style="font-weight: bold;margin-left: 20px;">รหัสรีวิวบริการ:</label>
              </div>
              <div class="col-3">
                  <p id="rvsID"></p>
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
                  <label for="roomID" class="form-label" style="font-weight: bold;margin-left: 20px;">บริการที่รีวิว:</label>
              </div>
              <div class="col-3">
                  <p id="roomID"></p>
              </div>
              <div class="col-2">
                  <label for="billID" class="form-label" style="font-weight: bold;margin-left: 20px;">รหัสการจอง:</label>
              </div>
              <div class="col-3">
                  <p id="billID"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
          <div class="col-2">
                  <label for="checkID" class="form-label" style="font-weight: bold;margin-left: 20px;">รหัสการตรวจสอบ :</label>
              </div>
              <div class="col-3">
                  <p id="checkID"></p>
              </div>
              <div class="col-2">
                  <label for="rvsScore" class="form-label" style="font-weight: bold;margin-left: 20px;">คะแนนที่รีวิว</label>
              </div>
              <div class="col-3">
                  <p id="rvsScore"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
            <div class="col-2">
                  <label for="rvsDate" class="form-label" style="font-weight: bold;margin-left: 20px;">วันที่รีวิว</label>
              </div>
              <div class="col-3">
                  <p id="rvsDate"></p>
              </div>
            <div class="col-2">
                  <label for="rvsDetail" class="form-label" style="font-weight: bold;margin-left: 20px;">รายละเอียดรีวิว:</label>
              </div>
              <div class="col-3">
                  <p id="rvsDetail"></p>
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
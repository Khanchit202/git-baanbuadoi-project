<?php
$users = $db_con->query("SELECT * FROM booking");
$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);




?>
<p style="font-size: 16px; padding: 5px 20px;">จัดการข้อมูลการจอง</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;">ข้อมูลการจองทั้งหมด</p>
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
                    <th scope="col">รหัสลูกค้า</th>
                    <th scope="col">รหัสห้องที่จอง</th>
                    <th scope="col">ชื่อผู้จอง</th>
                    <th scope="col">เบอร์โทรศัพท์</th>
                    <th scope="col">เวลาเช็คอิน</th>
                    <th scope="col">เวลาเช็คเอาท์</th>
                    <th scope="col">ราคา</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersArray as $index => $book) : ?>
                <tr>
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td><?php echo htmlspecialchars($book['userID']); ?></td>
                    <td><?php echo htmlspecialchars($book['roomID']); ?></td>
                    <td><?php echo htmlspecialchars($book['bookName']); ?></td>
                    <td><?php echo htmlspecialchars($book['bookTel']); ?></td>
                    <td><?php echo htmlspecialchars($book['bookDateStart']); ?></td>
                    <td><?php echo htmlspecialchars($book['bookDateEnd']); ?></td>
                    <td><?php echo htmlspecialchars($book['bookPrice']); ?></td>
                    
                    <td>
                        <button onclick="select_book({
                            bookID: '<?php echo addslashes($book['bookID']); ?>',
                            userID: '<?php echo addslashes($book['userID']); ?>',
                            roomID: '<?php echo addslashes($book['roomID']); ?>',
                            bookName: '<?php echo addslashes($book['bookName']); ?>',
                            bookTel: '<?php echo addslashes($book['bookTel']); ?>',
                            bookDateStart: '<?php echo addslashes($book['bookDateStart']); ?>',
                            bookDateEnd: '<?php echo addslashes($book['bookDateEnd']); ?>',
                            bookPrice: '<?php echo addslashes($book['bookPrice']); ?>',
                            bookDate: '<?php echo addslashes($book['bookDate']); ?>',
                            bookDetail: '<?php echo addslashes($book['bookDetail']); ?>',
                            bookConfirm: '<?php echo addslashes($book['bookConfirm']); ?>',
                            bookStatus: '<?php echo addslashes($book['bookStatus']); ?>',
                            bookCancel: '<?php echo addslashes($book['bookCancel']); ?>',
                            serviceID: '<?php echo addslashes($book['serviceID']); ?>',
                            pmtID: '<?php echo addslashes($book['pmtID']); ?>'
                            })" class="btn btn-success btn-sm">
                            <i class="lni lni-eye" style="padding: 5px;"></i>
                        </button>

                        <button onclick="delete_book('<?php echo str_pad($book['bookID'], 5, "0", STR_PAD_LEFT); ?>')" class="btn btn-danger btn-sm">
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
<div class="modal fade" id="select_book" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">
          <img src="./booking_payment_data/api/baanbuadoi.png" alt="Logo" style="height: 80px; margin-right: 10px;">
          รายละเอียดการจอง
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="row mb-3 d-flex justify-content-center">
              <div class="col-2">
                  <label for="bookID" class="form-label" style="font-weight: bold;margin-left: 20px;">รหัสการจอง:</label>
              </div>
              <div class="col-3">
                  <p id="bookID"></p>
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
                  <label for="bookName" class="form-label" style="font-weight: bold;margin-left: 20px;">ชื่อผู้จอง:</label>
              </div>
              <div class="col-3">
                  <p id="bookName"></p>
              </div>
              <div class="col-2">
                  <label for="bookTel" class="form-label" style="font-weight: bold;margin-left: 20px;">เบอร์โทรศัพท์:</label>
              </div>
              <div class="col-3">
                  <p id="bookTel"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
          <div class="col-2">
                  <label for="bookDate" class="form-label" style="font-weight: bold;margin-left: 20px;">เวลา/วันที่ทำการจอง:</label>
              </div>
              <div class="col-3">
                  <p id="bookDate"></p>
              </div>
              <div class="col-2">
                  <label for="bookDetail" class="form-label" style="font-weight: bold;margin-left: 20px;">รายละเอียดเพิ่มเติม:</label>
              </div>
              <div class="col-3">
                  <p id="bookDetail"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
          <div class="col-2">
                  <label for="bookDateStart" class="form-label" style="font-weight: bold;margin-left: 20px;">วันที่เช็คอิน:</label>
              </div>
              <div class="col-3">
                  <p id="bookDateStart"></p>
              </div>
              <div class="col-2">
                  <label for="bookDateEnd" class="form-label" style="font-weight: bold;margin-left: 20px;">วันที่เช็คเอาท์:</label>
              </div>
              <div class="col-3">
                  <p id="bookDateEnd"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
            <div class="col-2">
                  <label for="roomID" class="form-label" style="font-weight: bold;margin-left: 20px;">รหัสห้องที่จอง:</label>
              </div>
              <div class="col-3">
                  <p id="roomID"></p>
              </div>
              <div class="col-2">
                  <label for="bookPrice" class="form-label" style="font-weight: bold;margin-left: 20px;">ราคา:</label>
              </div>
              <div class="col-3">
                  <p id="bookPrice"></p>
              </div>
              
          </div>
          <div class="row mb-3 d-flex justify-content-center">
              <div class="col-2">
                  <label for="bookConfirm" class="form-label" style="font-weight: bold;margin-left: 20px;">การยืนยัน:</label>
              </div>
              <div class="col-3">
                  <p id="bookConfirm"></p>
              </div>
              <div class="col-2">
                  <label for="bookStatus" class="form-label" style="font-weight: bold;margin-left: 20px;">สถานะการจอง:</label>
              </div>
              <div class="col-3">
                  <p id="bookStatus"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
          <div class="col-2">
                  <label for="pmtID" class="form-label" style="font-weight: bold;margin-left: 20px;">โปรโมชั่น:</label>
              </div>
              <div class="col-3">
                  <p id="pmtID"></p>
              </div>
              <div class="col-2">
                  <label for="serviceID" class="form-label" style="font-weight: bold;margin-left: 20px;">บริการเพิ่มเติม:</label>
              </div>
              <div class="col-3">
                  <p id="serviceID"></p>
              </div>
              
          </div>
          <div class="row mb-3 d-flex justify-content-center">
            <div class="col-2">
                  <label for="bookCancel" class="form-label" style="margin-left: 20px;font-weight: bold;">สถานะลูกค้า:</label>
            </div>
            <div class="col-3">
                  <p id="bookCancel"></p>
              </div>
              <div class="col-2">
                  <label for="bookCancel" class="form-label" style="color: blue;margin-left: 20px;"></label>
              </div>
              <div class="col-3">
                  <p ></p>
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
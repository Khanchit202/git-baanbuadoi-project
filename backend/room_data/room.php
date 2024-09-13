<?php
$users = $db_con->query("SELECT * FROM room_product");
$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);




?>
<p style="font-size: 16px; padding: 5px 20px;">จัดการข้อมูลห้องพัก</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;">ข้อมูลห้องพักทั้งหมด</p>
        <button class="btn btn-primary" style="font-size: 12px;margin-right: 80px;" data-bs-toggle="modal" data-bs-target="#addDataroom">
            <i class="lni lni-circle-plus" style="padding: 5px;"></i>
            เพิ่มห้องพัก 
        </button>
    </div>
    <div class="text-center">
        <table class="table" style="margin-top: 20px; font-size: 16px;">
            <thead>
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">รหัสห้อง</th>
                    <th scope="col">ชื่อห้อง</th>
                    <th scope="col">จำนวนเตียง</th>
                    <th scope="col">จำนวนห้องน้ำ</th>
                    <th scope="col">ราคาห้องพัก/คืน</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersArray as $index => $room) : ?>
                <tr>
                    
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td><?php echo htmlspecialchars($room['roomID']); ?></td>
                    <td><?php echo htmlspecialchars($room['roomName']); ?></td>
                    <td><?php echo htmlspecialchars($room['roomBed']); ?></td>
                    <td><?php echo htmlspecialchars($room['roomBath']); ?></td>
                    <td><?php echo htmlspecialchars($room['roomPrice']); ?></td>
                    <td>
                        
                        <button onclick="updateroom()" class="btn btn-primary btn-sm">
                            <i class="lni lni-pencil" style="padding: 5px;"></i>
                        </button>

                        <button onclick="delete_room('<?php echo str_pad($room['roomID'], 5, "0", STR_PAD_LEFT); ?>')" class="btn btn-danger btn-sm">
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
<div class="modal fade" id="addDataroom" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">เพิ่มข้อมูลห้องพัก</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
              <label for="roomName" class="form-label">ชื่อห้อง</label>
              <input type="text" class="form-control" name="roomName" id="roomName" required>
          </div>
          <div class="mb-3">
              <label for="roomDetail" class="form-label">รายละเอียดห้องพัก</label>
              <input type="text" class="form-control" name="roomDetail" id="roomDetail" required>
          </div>
          <div class="mb-3">
              <label for="roomBed" class="form-label">จำนวนเตียงนอน</label>
              <input type="number" class="form-control" name="roomBed" id="roomBed" required>
          </div>
          <div class="mb-3">
              <label for="roomBath" class="form-label">ห้องน้ำ</label>
              <input type="number" class="form-control" name="roomBath" id="roomBath" required>
          </div>
          <div class="mb-3">
              <label for="roomMax" class="form-label">พักได้สูงสุด</label>
              <input type="number" class="form-control" name="roomMax" id="roomMax" required>
          </div>
          <div class="mb-3">
              <label for="roomMin" class="form-label">พักได้ต่ำสุด</label>
              <input type="number" class="form-control" name="roomMin" id="roomMin" required>
          </div>
          <div class="mb-3">
              <label for="roomPrice" class="form-label">ราคา/คืน</label>
              <input type="number" class="form-control" name="roomPrice" id="roomPrice" required>
          </div>
          <div class="mb-3">
              <label for="roomStd" class="form-label">สถานะห้องพัก</label>
              <select class="form-select" name="roomStd" id="roomStd" required>
                  <option value="00001">ว่าง</option>
                  <option value="00002">ไม่ว่าง</option>
                  <option value="00003">รอสักครู่</option>
              </select>
          </div>
          <div class="mb-3">
              <label for="roomImage" class="form-label">อัปโหลดรูปภาพห้องพัก</label>
              <input type="file" class="form-control" name="roomImage" id="roomImage" accept="image/*" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <button type="button" onclick="save_room()" class="btn btn-primary">บันทึกข้อมูล</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->


    <!-- Modal edit-->
<div class="modal fade" id="editdatauser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">เเก้ไขข้อมูลนักศึกษา</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
          <div class="mb-3">
              <label for="name" class="form-label">ชื่อผู้ใช้</label>
              <input type="text" class="form-control"  id="edit_userName" required disabled>
          </div>
          <div class="mb-3">
              <label for="fname" class="form-label">ชื่อจริง</label>
              <input type="text" class="form-control"  id="edit_userFName" required disabled>
          </div>
          <div class="mb-3">
              <label for="lname" class="form-label">นามสกุล</label>
              <input type="text" class="form-control"  id="edit_userLName" required disabled>
          </div>
          <div class="mb-3">
              <label for="tel" class="form-label">เบอร์โทรศัพท์</label>
              <input type="number" class="form-control"  id="edit_userTel" required disabled>
          </div>
          <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control"  id="edit_userEmail" required disabled>
          </div>
          <div class="mb-3">
              <label for="accessLevel" class="form-label">สิทธิ์การเข้าถึง</label>
              <select class="form-select"  id="edit_userLavelID" required >
                  <option value="1">ผู้ดูแลระบบ (Admin)</option>
                  <option value="2">เจ้าของกิจการ (Owner)</option>
                  <option value="3">พนักงาน (Employee)</option>
                  <option value="4">สมาชิก (Member)</option>
              </select>
          </div>
          <input type="hidden" id="edit_userID">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" onclick="update_data()" class="btn btn-primary" name="submit">UPDATE</button>
    
      </div>
    </div>
  </div>
</div>
 <!-- Modal edit-->
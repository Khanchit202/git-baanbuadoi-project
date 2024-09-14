<?php

$users = $db_con->query("SELECT * FROM news");
$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);




?>
<p style="font-size: 16px; padding: 5px 20px;">จัดการข้อมูลสารหน้าเว็บ</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;">ข้อมูลข่าวสารทั้งหมด</p>
        <button class="btn btn-primary" style="font-size: 12px;margin-right: 80px;" data-bs-toggle="modal" data-bs-target="#addDatanew">
            <i class="lni lni-circle-plus" style="padding: 5px;"></i>
            เพิ่มข่าวสาร 
        </button>
    </div>
    <div class="text-center">
        <table class="table" style="margin-top: 20px; font-size: 16px;">
            <thead>
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">รหัสข่าวสาร</th>
                    <th scope="col">หัวข้อข่าว</th>
                    <th scope="col">ข่าวเกี่ยวกับ</th>
                    <th scope="col">เวลาลงข่าว</th>
                    
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersArray as $index => $new) : ?>
                <tr>
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td><?php echo htmlspecialchars($new['newID']); ?></td>
                    <td><?php echo htmlspecialchars($new['newTitle']); ?></td>
                    <td><?php echo htmlspecialchars($new['newType']); ?></td>
                    <td><?php echo htmlspecialchars($new['newDate']); ?></td>
                    
                    
                    <td>
                        <button onclick="updatenew()" class="btn btn-primary btn-sm">
                            <i class="lni lni-pencil" style="padding: 5px;"></i>
                        </button>

                        <button onclick="delete_new('<?php echo str_pad($new['newID'], 5, "0", STR_PAD_LEFT); ?>')" class="btn btn-danger btn-sm">
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
<div class="modal fade" id="addDatanew" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">เพิ่มข้อมูลข่าวสาร</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
          <div class="mb-3">
              <label for="newName" class="form-label">หัวข้อข่าว</label>
              <input type="text" class="form-control" name="newName" id="newName" required>
          </div>
          <div class="mb-3">
              <label for="newDetail" class="form-label">รายละเอียดข่าวสาร</label>
              <input type="text" class="form-control" name="newDetail" id="newDetail" required>
          </div>
          <div class="mb-3">
              <label for="newStd" class="form-label">ชนิดข่าว</label>
              <select class="form-select" name="newStd" id="newStd" required>
                  <option value="ชุมชน">ชุมชน</option>
                  <option value="เทศกาล">เทศกาล</option>
                  <option value="สินค้า">สินค้า</option>
                  <option value="ข่าวสารอื่นๆ">ข่าวสารอื่นๆ</option>
              </select>
          </div>
          <div class="mb-3">
              <label for="newTime" class="form-label">เวลาลงข่าว</label>
              <input type="datetime-local" class="form-control" name="newTime" id="newTime" required>
          </div>
          <div class="mb-3">
              <label for="newImg" class="form-label">อัปโหลดรูปภาพ</label>
              <input type="file" class="form-control" name="newImg" id="newImg" accept="image/*" required>
          </div>
          <div class="mb-3">
                <input type="hidden" class="form-control" name="userId" id="userId" value="<?php echo $_SESSION['userID']; ?>">
            </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <button type="button" onclick="save_new()" class="btn btn-primary">บันทึกข้อมูล</button>
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
<?php

$users = $db_con->query("SELECT * FROM news");
$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);




?>
<p style="font-size: 16px; padding: 5px 20px;">จัดการข้อมูลสารหน้าเว็บ</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;">ข้อมูลข่าวสารทั้งหมด</p>
        <button class="btn btn-primary" style="font-size: 12px;margin-right: 50px;" data-bs-toggle="modal" data-bs-target="#addDatanew">
            <i class="lni lni-circle-plus" style="padding: 5px;"></i>
            เพิ่มข่าวสาร 
        </button>
    </div>
    <div class="text-center">
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table table-hover table-bordered" style="min-width: 800px; font-size: 12px;">
            <thead style="background-color: #97C7C9;">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">ภาพประชาสัมพันธ์</th>
                    <th scope="col">หัวข้อประชาสัมพันธ์</th>
                    <th scope="col">ประเภทประชาสัมพันธ์</th>
                    <th scope="col">จัดการข้อมูล</th> 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersArray as $index => $new) : ?>
                <tr>
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td>
                        <div class="card" style="width: 120px;">
                            <img src="../img/news_pic/<?php echo htmlspecialchars($new['newPic']); ?>" class="card-img-top" style="height: 80px; object-fit: cover;">
                        </div>
                    </td>
                    <td><?php echo htmlspecialchars($new['newTitle']); ?></td>
                    <td><?php echo htmlspecialchars($new['newType']); ?></td>                    
                    <td>
                    <button onclick="updateshownew({
                            newID: '<?php echo addslashes($new['newID']); ?>',
                            newTitle: '<?php echo addslashes($new['newTitle']); ?>',
                            newDetail: '<?php echo addslashes($new['newDetail']); ?>',
                            newPic: '<?php echo addslashes($new['newPic']); ?>',
                            newType: '<?php echo addslashes($new['newType']); ?>',
                            newDate: '<?php echo addslashes($new['newDate']); ?>',
                            user_userID: '<?php echo addslashes($new['user_userID']); ?>'
                        })" class="btn btn-primary btn-sm">
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
    <div class="modal fade" id="editDatanew" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">เเก้ไขข้อมูลข่าวสาร</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" >
        <input type="hidden" id="edit_newID">
          <div class="mb-3">
              <label for="newName" class="form-label">หัวข้อข่าว</label>
              <input type="text" class="form-control"  id="edit_newTitle" required>
          </div>
          <div class="mb-3">
              <label for="newDetail" class="form-label">รายละเอียดข่าวสาร</label>
              <input type="text" class="form-control"  id="edit_newDetail" required>
          </div>
          <div class="mb-3">
              <label for="newStd" class="form-label">ชนิดข่าว</label>
              <select class="form-select"  id="edit_newType" required>
                  <option value="ชุมชน">ชุมชน</option>
                  <option value="เทศกาล">เทศกาล</option>
                  <option value="สินค้า">สินค้า</option>
                  <option value="ข่าวสารอื่นๆ">ข่าวสารอื่นๆ</option>
              </select>
          </div>
          <div class="mb-3">
              <label for="newTime" class="form-label">เวลาลงข่าว</label>
              <input type="datetime-local" class="form-control"  id="edit_newTime" required>
          </div>
          <div class="mb-3">
              <label for="newImg" class="form-label">อัปโหลดรูปภาพ</label>
              <input type="file" class="form-control"  id="edit_newImg" accept="image/*" required>
          </div>
          <div class="mb-3">
                <input type="hidden" class="form-control"  id="edit_userId" value="<?php echo $_SESSION['userID']; ?>">
            </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <button type="button" onclick="update_new()" class="btn btn-primary">บันทึกข้อมูล</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
 <!-- Modal edit-->
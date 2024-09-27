<?php
$users = $db_con->query("SELECT * FROM promotions");
$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);




?>
<p style="font-size: 16px; padding: 5px 20px;">จัดการข้อมูลโปรโมชั่น</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;">ข้อมูลโปรโมชั่นทั้งหมด</p>
        <button class="btn btn-primary" style="font-size: 12px;margin-right: 80px;" data-bs-toggle="modal" data-bs-target="#addProModal">
            <i class="lni lni-circle-plus" style="padding: 5px;"></i>
            เพิ่มโปรโมชั่น
        </button>
    </div>
    <div class="text-center">
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table table-hover table-bordered" style="min-width: 800px; font-size: 16px;">
            <thead style="background-color: #97C7C9;">
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">หัวข้อโปรโมชั่น</th>
                    <th scope="col">รายละเอียด</th>
                    <th scope="col">ส่วนลด/บาท</th>
                    <th scope="col">รหัส/Code ส่วนลด</th>
                    <th scope="col">ตัวเลือก</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersArray as $index => $pro) : ?>
                <tr>
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td><?php echo htmlspecialchars($pro['pmtTitle']); ?></td>
                    <td><?php echo htmlspecialchars($pro['pmtDetail']); ?></td>
                    <td><?php echo htmlspecialchars($pro['pmtDiscont']); ?></td>
                    <td><?php echo htmlspecialchars($pro['pmtCode']); ?></td>
                    
                    <td>
                        <button onclick="select_pro({
                            pmtID: '<?php echo addslashes($pro['pmtID']); ?>',
                            pmtTitle: '<?php echo addslashes($pro['pmtTitle']); ?>',
                            pmtDetail: '<?php echo addslashes($pro['pmtDetail']); ?>',
                            pmtDiscont: '<?php echo addslashes($pro['pmtDiscont']); ?>',
                            pmtCode: '<?php echo addslashes($pro['pmtCode']); ?>',
                            pmtUnit: '<?php echo addslashes($pro['pmtUnit']); ?>',
                            pmtDate: '<?php echo addslashes($pro['pmtDate']); ?>',
                            pmtStartDate: '<?php echo addslashes($pro['pmtStartDate']); ?>',
                            pmtEndDate: '<?php echo addslashes($pro['pmtEndDate']); ?>',
                            userID: '<?php echo addslashes($pro['userID']); ?>',
                            pmtPic: '<?php echo addslashes($pro['pmtPic']); ?>',
                            })" class="btn btn-success btn-sm">
                            <i class="lni lni-eye" style="padding: 5px;"></i>
                        </button>
                        <button onclick="show_pro({
                            pmtID: '<?php echo addslashes($pro['pmtID']); ?>',
                            pmtTitle: '<?php echo addslashes($pro['pmtTitle']); ?>',
                            pmtDetail: '<?php echo addslashes($pro['pmtDetail']); ?>',
                            pmtDiscont: '<?php echo addslashes($pro['pmtDiscont']); ?>',
                            pmtCode: '<?php echo addslashes($pro['pmtCode']); ?>',
                            pmtUnit: '<?php echo addslashes($pro['pmtUnit']); ?>',
                            pmtDate: '<?php echo addslashes($pro['pmtDate']); ?>',
                            pmtStartDate: '<?php echo addslashes($pro['pmtStartDate']); ?>',
                            pmtEndDate: '<?php echo addslashes($pro['pmtEndDate']); ?>',
                            userID: '<?php echo addslashes($pro['userID']); ?>',
                            pmtPic: '<?php echo addslashes($pro['pmtPic']); ?>',
                            })" class="btn btn-primary btn-sm">
                            <i class="lni lni-pencil" style="padding: 5px;"></i>
                        </button>

                        <button onclick="delete_pro('<?php echo str_pad($pro['pmtID'], 5, "0", STR_PAD_LEFT); ?>')" class="btn btn-danger btn-sm">
                            <i class="lni lni-trash-can" style="padding: 5px;"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div></div>
<!-- Add Modal -->
<div class="modal fade" id="addProModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">เพิ่มข้อมูลโปรโมชั่น</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
              <label for="pmtTitle" class="form-label">หัวข้อโปรโมชั่น</label>
              <input type="text" class="form-control" name="addpmtTitle" id="addpmtTitle" required>
          </div>
          <div class="mb-3">
              <label for="pmtDetail" class="form-label">รายละเอียด</label>
              <input type="text" class="form-control" name="addpmtDetail" id="addpmtDetail" required>
          </div>
          <div class="mb-3">
              <label for="pmtCode" class="form-label">รหัส/Code ส่วนลด</label>
              <input type="text" class="form-control" name="addpmtCode" id="addpmtCode" required>
          </div>
          <div class="mb-3">
              <label for="pmtDiscont" class="form-label">ส่วนลด/บาท</label>
              <input type="number" class="form-control" name="addpmtDiscont" id="addpmtDiscont" required>
          </div>
          <div class="mb-3">
              <label for="pmtUnit" class="form-label">สกุลเงิน</label>
              <input type="text" class="form-control" name="addpmtUnit" id="addpmtUnit" required>
          </div>
          <div class="mb-3">
              <label for="pmtDate" class="form-label">วันที่ลงโปรโมชั่น</label>
              <input type="datetime-local" class="form-control" name="addpmtDate" id="addpmtDate"  required>
          </div>
          <div class="mb-3">
              <label for="pmtStartDate" class="form-label">เริ่มใช้โปรโมชั่น</label>
              <input type="datetime-local" class="form-control" name="addpmtStartDate" id="addpmtStartDate" required>
          </div>
          <div class="mb-3">
              <label for="pmtEndDate" class="form-label">สิ้นสุดโปรโมชั่น</label>
              <input type="datetime-local" class="form-control" name="addpmtEndDate" id="addpmtEndDate" required>
          </div>
          <div class="mb-3">
                <input type="hidden" class="form-control"  name="adduserId" id="adduserId" value="<?php echo $_SESSION['userID']; ?>">
            </div>
          <div class="mb-3">
              <label for="pmtImg" class="form-label">อัปโหลดรูปภาพ</label>
              <input type="file" class="form-control" name="addpmtImg" id="addpmtImg" accept="image/*" required>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <button type="button" onclick="save_pro()" class="btn btn-primary">บันทึกข้อมูล</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->


<!-- select Modal -->
<div class="modal fade" id="select_pro" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">
          <img src="./booking_payment_data/api/baanbuadoi.png" alt="Logo" style="height: 80px; margin-right: 10px;">
          รายละเอียดโปรโมชั่น
        </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="row mb-3 d-flex justify-content-center">
              <div class="col-2">
                  <label for="pmtID" class="form-label" style="font-weight: bold;margin-left: 20px;">รหัสโปรโมชั่น:</label>
              </div>
              <div class="col-3">
                  <p id="pmtID"></p>
              </div>
              <div class="col-2">
                  <label for="userID" class="form-label" style="font-weight: bold;margin-left: 20px;">รหัสพนักงาน:</label>
              </div>
              <div class="col-3">
                  <p id="userID"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
          <div class="col-2">
                  <label for="pmtTitle" class="form-label" style="font-weight: bold;margin-left: 20px;">หัวข้อโปรโมชั่น:</label>
              </div>
              <div class="col-3">
                  <p id="pmtTitle"></p>
              </div>
              <div class="col-2">
                  <label for="pmtDetail" class="form-label" style="font-weight: bold;margin-left: 20px;">รายละเอียด:</label>
              </div>
              <div class="col-3">
                  <p id="pmtDetail"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
          <div class="col-2">
                  <label for="pmtCode" class="form-label" style="font-weight: bold;margin-left: 20px;">รหัส/Code ส่วนลด:</label>
              </div>
              <div class="col-3">
                  <p id="pmtCode"></p>
              </div>
              <div class="col-2">
                  <label for="pmtDiscont" class="form-label" style="font-weight: bold;margin-left: 20px;">ส่วนลด/บาท:</label>
              </div>
              <div class="col-3">
                  <p id="pmtDiscont"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
          <div class="col-2">
                  <label for="pmtUnit" class="form-label" style="font-weight: bold;margin-left: 20px;">สกุลเงิน</label>
              </div>
              <div class="col-3">
                  <p id="pmtUnit"></p>
              </div>
              <div class="col-2">
                  <label for="pmtDate" class="form-label" style="font-weight: bold;margin-left: 20px;">วันที่ลงโปรโมชั่น</label>
              </div>
              <div class="col-3">
                  <p id="pmtDate"></p>
              </div>
          </div>
          <div class="row mb-3 d-flex justify-content-center">
            <div class="col-2">
                  <label for="pmtStartDate" class="form-label" style="font-weight: bold;margin-left: 20px;">เริ่มใช้โปรโมชั่น:</label>
              </div>
              <div class="col-3">
                  <p id="pmtStartDate"></p>
              </div>
              <div class="col-2">
                  <label for="pmtEndDate" class="form-label" style="font-weight: bold;margin-left: 20px;">สิ้นสุดโปรโมชั่น</label>
              </div>
              <div class="col-3">
                  <p id="pmtEndDate"></p>
              </div>   
          </div>
          <div class="row mb-3 d-flex justify-content-center">
            <div class="col-2">
                  <label for="pmtPic" class="form-label" style="margin-left: 20px;font-weight: bold;">รูปโปรโมชั่น:</label>
            </div>
            <div class="col-3">
                  <p id="pmtPic"></p>
              </div>
              <div class="col-2">
                  <label for="" class="form-label" style="color: blue;margin-left: 20px;"></label>
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

<!-- edit Modal -->
<div class="modal fade" id="editProModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">เพิ่มข้อมูลโปรโมชั่น</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="editpmtID">
          <div class="mb-3">
              <label for="pmtTitle" class="form-label">หัวข้อโปรโมชั่น</label>
              <input type="text" class="form-control"  id="editpmtTitle" required>
          </div>
          <div class="mb-3">
              <label for="pmtDetail" class="form-label">รายละเอียด</label>
              <input type="text" class="form-control"  id="editpmtDetail" required>
          </div>
          <div class="mb-3">
              <label for="pmtCode" class="form-label">รหัส/Code ส่วนลด</label>
              <input type="text" class="form-control"  id="editpmtCode" required>
          </div>
          <div class="mb-3">
              <label for="pmtDiscont" class="form-label">ส่วนลด/บาท</label>
              <input type="number" class="form-control"  id="editpmtDiscont" required>
          </div>
          <div class="mb-3">
              <label for="pmtUnit" class="form-label">สกุลเงิน</label>
              <input type="text" class="form-control"  id="editpmtUnit" required>
          </div>
          <div class="mb-3">
              <label for="pmtDate" class="form-label">วันที่ลงโปรโมชั่น</label>
              <input type="datetime-local" class="form-control"  id="editpmtDate"  required>
          </div>
          <div class="mb-3">
              <label for="pmtStartDate" class="form-label">เริ่มใช้โปรโมชั่น</label>
              <input type="datetime-local" class="form-control"  id="editpmtStartDate" required>
          </div>
          <div class="mb-3">
              <label for="pmtEndDate" class="form-label">สิ้นสุดโปรโมชั่น</label>
              <input type="datetime-local" class="form-control"  id="editpmtEndDate" required>
          </div>
          <div class="mb-3">
                <input type="hidden" class="form-control"   id="edituserId" value="<?php echo $_SESSION['userID']; ?>">
            </div>
          <div class="mb-3">
              <label for="pmtImg" class="form-label">อัปโหลดรูปภาพ</label>
              <input type="file" class="form-control"  id="editpmtImg" accept="image/*" required>
          </div>
          
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <button type="button" onclick="update_pro()" class="btn btn-primary">บันทึกข้อมูล</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

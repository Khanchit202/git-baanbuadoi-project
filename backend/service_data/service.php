<?php
$users = $db_con->query("SELECT * FROM service_product");
$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);




?>
<p style="font-size: 16px; padding: 5px 20px;">จัดการข้อมูลบริการ</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;">ข้อมูลบริการทั้งหมด</p>
        <button class="btn btn-primary" style="font-size: 12px;margin-right: 80px;" data-bs-toggle="modal" data-bs-target="#addDatservice">
            <i class="lni lni-circle-plus" style="padding: 5px;"></i>
            เพิ่มบริการ 
        </button>
    </div>
    <div class="text-center">
    <div class="table-responsive" style="overflow-x: auto;">
        <table class="table table-hover table-bordered" style="min-width: 800px; font-size: 16px;">
            <thead style="background-color: #97C7C9;">
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">ชื่อบริการ</th>
                    <th scope="col">รายละเอียดบริการ</th>
                    <th scope="col">จำนวนบริการ</th>
                    <th scope="col">ราคาค่าบริการ</th>
                    <th scope="col">ระยะเวลาบริการ</th>
                    <th scope="col">สถานะบริการ</th>
                    <th scope="col">ตัวเลือก</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersArray as $index => $service) : ?>
                <tr>
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td><?php echo htmlspecialchars($service['serviceName']); ?></td>
                    <td><?php echo htmlspecialchars($service['serviceDetail']); ?></td>
                    <td><?php echo htmlspecialchars($service['serviceTotal']); ?></td>
                    <td><?php echo htmlspecialchars($service['servicePrice']); ?></td>
                    <td><?php echo htmlspecialchars($service['serviceTime']); ?></td>
                    <td>
                        <?php 
                        if ($service['stdID'] == '00001') {
                            echo '<span style=" color: green; padding: 5px;">มีบริการ</span>';
                        } elseif ($service['stdID'] == '00002') {
                            echo '<span style="  color: red; padding: 5px;">ไม่มีบริการ</span>';
                        } elseif ($service['stdID'] == '00003') {
                            echo '<span style=" color: blue; padding: 5px;">กำลังเตรียม</span>';
                        }
                        ?>
                    </td>
                    <td>
                    <button onclick="updateshowservice({
                            serviceID: '<?php echo addslashes($service['serviceID']); ?>',
                            serviceName: '<?php echo addslashes($service['serviceName']); ?>',
                            serviceDetail: '<?php echo addslashes($service['serviceDetail']); ?>',
                            servicePrice: '<?php echo addslashes($service['servicePrice']); ?>',
                            serviceTotal: '<?php echo addslashes($service['serviceTotal']); ?>',
                            stdID: '<?php echo addslashes($service['stdID']); ?>',
                            serviceTime: '<?php echo addslashes($service['serviceTime']); ?>'
                        })" class="btn btn-primary btn-sm">
                            <i class="lni lni-pencil" style="padding: 5px;"></i>
                        </button>

                        <button onclick="delete_service('<?php echo str_pad($service['serviceID'], 5, "0", STR_PAD_LEFT); ?>')" class="btn btn-danger btn-sm">
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
<div class="modal fade" id="addDatservice" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">เพิ่มข้อมูลบริการ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <div class="mb-3">
              <label for="serviceName" class="form-label">ชื่อบริการ</label>
              <input type="text" class="form-control" name="roomName" id="serviceName" required>
          </div>
          <div class="mb-3">
              <label for="serviceDetail" class="form-label">รายละเอียดบริการ</label>
              <input type="text" class="form-control" name="serviceDetail" id="serviceDetail" required>
          </div>
          <div class="mb-3">
              <label for="servicePrice" class="form-label">ราคาค่าบริการ</label>
              <input type="number" class="form-control" name="servicePrice" id="servicePrice" required>
          </div>
          <div class="mb-3">
              <label for="serviceTotal" class="form-label">มีบริการทั้งหมด</label>
              <input type="number" class="form-control" name="serviceTotal" id="serviceTotal" required>
          </div>
          <div class="mb-3">
              <label for="serviceTime" class="form-label">ระยะเวลาให้บริการ</label>
              <input type="number" class="form-control" name="serviceTime" id="serviceTime" required>
          </div>
          <div class="mb-3">
              <label for="serviceStd" class="form-label">สถานะบริการ</label>
              <select class="form-select" name="serviceStd" id="serviceStd" required>
                  <option value="00001">มีบริการ</option>
                  <option value="00002">หมด</option>
                  <option value="00003">กำลังเตรียม</option>
              </select>
          </div>
          <div class="mb-3">
              <label for="serviceImg" class="form-label">อัปโหลดรูปภาพบริการ</label>
              <input type="file" class="form-control" name="serviceImg" id="serviceImg" accept="image/*" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <button type="button" onclick="save_service()" class="btn btn-primary">บันทึกข้อมูล</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

<!-- edit Modal -->
<div class="modal fade" id="editDatservice" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">เพิ่มข้อมูลบริการ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <input type="hidden" id="edit_serviceID">
          <div class="mb-3">
              <label for="serviceName" class="form-label">ชื่อบริการ</label>
              <input type="text" class="form-control"  id="edit_serviceName" required>
          </div>
          <div class="mb-3">
              <label for="serviceDetail" class="form-label">รายละเอียดบริการ</label>
              <input type="text" class="form-control"  id="edit_serviceDetail" required>
          </div>
          <div class="mb-3">
              <label for="servicePrice" class="form-label">ราคาค่าบริการ</label>
              <input type="number" class="form-control"  id="edit_servicePrice" required>
          </div>
          <div class="mb-3">
              <label for="serviceTotal" class="form-label">มีบริการทั้งหมด</label>
              <input type="number" class="form-control"  id="edit_serviceTotal" required>
          </div>
          <div class="mb-3">
              <label for="serviceTime" class="form-label">ระยะเวลาให้บริการ</label>
              <input type="number" class="form-control"  id="edit_serviceTime" required>
          </div>
          <div class="mb-3">
              <label for="serviceStd" class="form-label">สถานะบริการ</label>
              <select class="form-select"  id="edit_serviceStd" required>
                  <option value="00001">มีบริการ</option>
                  <option value="00002">หมด</option>
                  <option value="00003">กำลังเตรียม</option>
              </select>
          </div>
          <div class="mb-3">
              <label for="serviceImg" class="form-label">อัปโหลดรูปภาพบริการ</label>
              <input type="file" class="form-control"  id="edit_serviceImg" accept="image/*" required>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
            <button type="button" onclick="update_service()" class="btn btn-primary">บันทึกข้อมูล</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->
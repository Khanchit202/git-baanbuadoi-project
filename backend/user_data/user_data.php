<?php
include("../../db_config.php");
$db_con = connect_db("client");

// ดึงข้อมูลผู้ใช้งาน
$users = $db_con->query("SELECT * FROM users");
$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);


function getUserLevelName($level) {
    switch ($level) {
        case 1: return 'ผู้ดูแลระบบ';
        case 2: return 'เจ้าของกิจการ';
        case 3: return 'พนักงาน';
        case 4: return 'สมาชิก';
        default: return '';
    }
}
?>
<p style="font-size: 16px; padding: 5px 20px;">กำหนดสิทธิ์การเข้าถึงระบบ</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between m-2">
        <p style="font-size: 24px;">รายชื่อ</p>
        <button class="btn btn-primary" style="font-size: 16px;" data-bs-toggle="modal" data-bs-target="#addDataModal">
            <i class="lni lni-circle-plus" style="padding: 5px;"></i>
            เพิ่มผู้ใช้  
        </button>
    </div>
    <div class="text-center">
        <table class="table" style="margin-top: 20px; font-size: 16px;">
            <thead>
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">ชื่อผู้ใช้</th>
                    <th scope="col">ชื่อจริง</th>
                    <th scope="col">นามสกุล</th>
                    <th scope="col">ระดับผู้ใช้งาน</th>
                    <th scope="col">จัดการข้อมูล</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersArray as $index => $user) : ?>
                <tr>
                    <?php 
                        if($user['userLavelID'] == 1) {
                            $lavel_name = "ผู้ดูแลระบบ";
                            $lavel_color = "red";
                        } else if($user['userLavelID'] == 2) {
                            $lavel_name = "เจ้าของกิจการ";
                            $lavel_color = "LimeGreen";
                        } else if($user['userLavelID'] == 3) {
                            $lavel_name = "พนักงาน";
                            $lavel_color = "blue";
                        } else {
                            $lavel_name = "สมาชิก";
                            $lavel_color = "Violet";
                        }
                    ?>
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td><?php echo htmlspecialchars($user['userName']); ?></td>
                    <td><?php echo htmlspecialchars($user['userFName']); ?></td>
                    <td><?php echo htmlspecialchars($user['userLName']); ?></td>
                    <td style="color: <?php echo $lavel_color; ?>;"><i class="lni lni-checkmark-circle" style="margin-right: 8px;"></i><?php echo getUserLevelName($user['userLavelID']); ?></td>
                    <td>
                        <button onclick="openEditModal(<?php echo $user['userID']; ?>)" class="btn btn-primary btn-sm">
                            <i class="lni lni-pencil" style="padding: 5px;"></i>
                        </button>
                        <button onclick="delete_data('<?php echo str_pad($user['userID'], 5, "0", STR_PAD_LEFT); ?>')" class="btn btn-danger btn-sm">
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
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">เพิ่มข้อมูลผู้ใช้ระบบ</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="employeeForm">
          <div class="mb-3">
              <label for="username" class="form-label">ชื่อผู้ใช้</label>
              <input type="text" class="form-control" name="username" id="username" required>
          </div>
          <div class="mb-3">
              <label for="firstName" class="form-label">ชื่อจริง</label>
              <input type="text" class="form-control" name="firstName" id="firstName" required>
          </div>
          <div class="mb-3">
              <label for="lastName" class="form-label">นามสกุล</label>
              <input type="text" class="form-control" name="lastName" id="lastName" required>
          </div>
          <div class="mb-3">
              <label for="phone" class="form-label">เบอร์โทรศัพท์</label>
              <input type="tel" class="form-control" name="phone" id="phone" required>
          </div>
          <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" class="form-control" name="email" id="email" required>
          </div>
          <div class="mb-3">
              <label for="accessLevel" class="form-label">สิทธิ์การเข้าถึง</label>
              <select class="form-select" name="accessLevel" id="accessLevel" required>
                  <option value="1">ผู้ดูแลระบบ (Admin)</option>
                  <option value="2">เจ้าของกิจการ (Owner)</option>
                  <option value="3">พนักงาน (Employee)</option>
                  <option value="4">สมาชิก (Member)</option>
              </select>
          </div>
          <div class="mb-3">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="resetPassword">
                  <label class="form-check-label" for="resetPassword">
                      รีเซ็ตรหัสผ่าน
                  </label>
              </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="save_data()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

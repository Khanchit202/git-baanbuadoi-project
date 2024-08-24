<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sidebar With Bootstrap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet" />
    <link rel="stylesheet" href="dash.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
</head>

<body>
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
<div id="user-table" style="background-color: white; border-radius: 10px; padding: 20px; font-size: 12px;">
    <div class="d-flex justify-content-between m-2">
        <p>รายชื่อ</p>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addDataModal">
            <i class="lni lni-circle-plus" style="padding: 5px;"></i>
        </button>
    </div>

    <table class="table" style="margin-top: 20px;">
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
                    <th scope="row"><?= $index + 1 ?></th>
                    <td><?= htmlspecialchars($user['userName']) ?></td>
                    <td><?= htmlspecialchars($user['userFName']) ?></td>
                    <td><?= htmlspecialchars($user['userLName']) ?></td>
                    <td><?= getUserLevelName($user['userLavelID']) ?></td>
                    <td>
                        <button onclick="openEditModal(<?= $user['userID'] ?>)" class="btn btn-primary btn-sm">
                            <i class="lni lni-pencil" style="padding: 5px;"></i>
                        </button>
                        <button onclick="delete_data(<?= $user['userID'] ?>)" class="btn btn-danger btn-sm">
                            <i class="lni lni-trash-can" style="padding: 5px;"></i>
                        </button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addDataModal" tabindex="-1" aria-labelledby="addDataModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addDataModalLabel">เพิ่มข้อมูลพนักงาน</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3">
            <label for="name" class="form-label">ชื่อพนักงาน</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="mb-3">
            <label for="salary" class="form-label">เงินเดือน</label>
            <input type="number" class="form-control" name="salary" id="salary" required>
        </div>
        <div class="mb-3">
            <label for="position" class="form-label">ตำแหน่ง</label>
            <input type="text" class="form-control" name="position" id="position" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" onclick="save_data()" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<!-- End Modal -->

</body>
</html>
<?php
$users = $db_con->query("SELECT * FROM room_product");
$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);




?>
<p style="font-size: 16px; padding: 5px 20px;">จัดการข้อมูลห้องพัก</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;">ข้อมูลห้องพักทั้งหมด</p>
        <button class="btn btn-primary" style="font-size: 12px;margin-right: 80px;" data-bs-toggle="modal" data-bs-target="#addDataModal">
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
                <?php foreach ($usersArray as $index => $user) : ?>
                <tr>
                    
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td><?php echo htmlspecialchars($user['roomID']); ?></td>
                    <td><?php echo htmlspecialchars($user['roomName']); ?></td>
                    <td><?php echo htmlspecialchars($user['roomBed']); ?></td>
                    <td><?php echo htmlspecialchars($user['roomBath']); ?></td>
                    <td><?php echo htmlspecialchars($user['roomPrice']); ?></td>
                    <td>
                        
                        <button onclick="updateroom()" class="btn btn-primary btn-sm">
                            <i class="lni lni-pencil" style="padding: 5px;"></i>
                        </button>

                        <button onclick="delete_room()" class="btn btn-danger btn-sm">
                            <i class="lni lni-trash-can" style="padding: 5px;"></i>
                        </button>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
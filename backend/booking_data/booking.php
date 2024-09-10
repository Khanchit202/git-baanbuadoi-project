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
                    <th scope="col">รหัสการจอง</th>
                    <th scope="col">รหัสลูกค้า</th>
                    <th scope="col">รหัสห้องที่จอง</th>
                    <th scope="col">ชื่อผู้จอง</th>
                    <th scope="col">เบอร์โทรศัพท์</th>
                    <th scope="col">เวลาเช็คอิน</th>
                    <th scope="col">เวลาเช็คเอาท์</th>
                    <th scope="col">ราคา</th>
                    <th scope="col">รายละเอียด</th>
                    <th scope="col">การยืนยัน</th>
                    <th scope="col">สถานะห้อง</th>
                    <th scope="col">ยกเลิก</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersArray as $index => $user) : ?>
                <tr>
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td><?php echo htmlspecialchars($user['bookID']); ?></td>
                    <td><?php echo htmlspecialchars($user['userID']); ?></td>
                    <td><?php echo htmlspecialchars($user['roomID']); ?></td>
                    <td><?php echo htmlspecialchars($user['bookName']); ?></td>
                    <td><?php echo htmlspecialchars($user['bookTel']); ?></td>
                    <td><?php echo htmlspecialchars($user['bookDateStart']); ?></td>
                    <td><?php echo htmlspecialchars($user['bookDateEnd']); ?></td>
                    <td><?php echo htmlspecialchars($user['bookPrice']); ?></td>
                    <td><?php echo htmlspecialchars($user['bookDetail']); ?></td>
                    <td><?php echo htmlspecialchars($user['bookConfirm']); ?></td>
                    <td><?php echo htmlspecialchars($user['bookStatus']); ?></td>
                    <td><?php echo htmlspecialchars($user['bookCancel']); ?></td>
                    
                    <td>
                        <button onclick="updatebook()" class="btn btn-primary btn-sm">
                            <i class="lni lni-pencil" style="padding: 5px;"></i>
                        </button>

                        <button onclick="delete_book()" class="btn btn-danger btn-sm">
                            <i class="lni lni-trash-can" style="padding: 5px;"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<p style="font-size: 16px; padding: 5px 20px;">กำหนดสิทธิ์การเข้าถึงระบบ</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;">ผู้ใช้ระบบทั้งหมด</p>
        <button class="btn btn-primary" style="font-size: 12px;margin-right: 80px;" data-bs-toggle="modal" data-bs-target="#addDataModal">
            <i class="lni lni-circle-plus" style="padding: 5px;"></i>
            เพิ่มผู้ใช้  
        </button>
    </div>
    <div class="text-center">
        <!-- <table class="table" style="margin-top: 20px; font-size: 16px;">
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
                        <button onclick="resetpass('<?php echo str_pad($user['userID'], 5, "0", STR_PAD_LEFT); ?>')" class="btn btn-primary btn-sm">
                            <i class="lni lni-key" style="padding: 5px;"></i>
                        </button>
                        <button onclick="updateLavel({
                            userID: '<?php echo addslashes($user['userID']); ?>',
                            userName: '<?php echo addslashes($user['userName']); ?>',
                            userFName: '<?php echo addslashes($user['userFName']); ?>',
                            userLName: '<?php echo addslashes($user['userLName']); ?>',
                            userTel: '<?php echo addslashes($user['userTel']); ?>',
                            userEmail: '<?php echo addslashes($user['userEmail']); ?>',
                            userLavelID: '<?php echo addslashes($user['userLavelID']); ?>'
                        })" class="btn btn-primary btn-sm">
                            <i class="lni lni-pencil" style="padding: 5px;"></i>
                        </button>

                        <button onclick="delete_data('<?php echo str_pad($user['userID'], 5, "0", STR_PAD_LEFT); ?>')" class="btn btn-danger btn-sm">
                            <i class="lni lni-trash-can" style="padding: 5px;"></i>
                        </button>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table> -->
    </div>
</div>
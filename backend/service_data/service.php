<?php
$users = $db_con->query("SELECT * FROM service_product");
$usersArray = $users->fetchAll(PDO::FETCH_ASSOC);




?>
<p style="font-size: 16px; padding: 5px 20px;">จัดการข้อมูลบริการ</p>
<div id="user-table" style="align-items: center;background-color: white; border-radius: 10px; padding: 50px;">
    <div class="d-flex justify-content-between">
        <p style="font-size: 20px;">ข้อมูลบริการทั้งหมด</p>
        <button class="btn btn-primary" style="font-size: 12px;margin-right: 80px;" data-bs-toggle="modal" data-bs-target="#addDataModal">
            <i class="lni lni-circle-plus" style="padding: 5px;"></i>
            เพิ่มบริการ 
        </button>
    </div>
    <div class="text-center">
        <table class="table" style="margin-top: 20px; font-size: 16px;">
            <thead>
                <tr>
                    <th scope="col">ลำดับ</th>
                    <th scope="col">รหัสบริการ</th>
                    <th scope="col">ชื่อบริการ</th>
                    <th scope="col">รายละเอียดบริการ</th>
                    <th scope="col">จำนวนบริการ</th>
                    <th scope="col">ราคาค่าบริการ</th>
                    <th scope="col">ระยะเวลาบริการ</th>
                    <th scope="col">สถานะบริการ</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usersArray as $index => $user) : ?>
                <tr>
                    <th scope="row"><?php echo $index + 1; ?></th>
                    <td><?php echo htmlspecialchars($user['serviceID']); ?></td>
                    <td><?php echo htmlspecialchars($user['serviceName']); ?></td>
                    <td><?php echo htmlspecialchars($user['serviceDetail']); ?></td>
                    <td><?php echo htmlspecialchars($user['serviceTotal']); ?></td>
                    <td><?php echo htmlspecialchars($user['servicePrice']); ?></td>
                    <td><?php echo htmlspecialchars($user['serviceTime']); ?></td>
                    <td>
                        <?php 
                        if ($user['stdID'] == '00001') {
                            echo '<span style=" color: green; padding: 5px;">มีบริการ</span>';
                        } elseif ($user['stdID'] == '00002') {
                            echo '<span style="  color: red; padding: 5px;">ไม่มีบริการ</span>';
                        } elseif ($user['stdID'] == '00003') {
                            echo '<span style=" color: blue; padding: 5px;">กำลังเตรียม</span>';
                        }
                        ?>
                    </td>
                    <td>
                        <button onclick="updateservice()" class="btn btn-primary btn-sm">
                            <i class="lni lni-pencil" style="padding: 5px;"></i>
                        </button>

                        <button onclick="delete_service()" class="btn btn-danger btn-sm">
                            <i class="lni lni-trash-can" style="padding: 5px;"></i>
                        </button>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<div style="display: flex; justify-content: space-between;">
    <div style="background-color: #f5f5f5; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; width: 25%; display: flex; flex-direction: column; align-items: center;">
        <div style="background-color: #e0e0e0; border-radius: 50%; width: 100px; height: 100px; margin-bottom: 15px;"></div>
        <div>นายครรชิต บางพระ</div>
        <div>ผู้ดูแลระบบ</div>
        <button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-align: center; margin-top: 20px;">รีเซตรหัสผ่าน</button>
    </div>


    <div style="background-color: #f5f5f5; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); padding: 20px; width: 73%; display: flex; flex-direction: column;">
           
           <div class="col" style="font-size: 12px;">
               <form class="row g-3 needs-validation" novalidate 
                   style="margin-top:20px; max-width: 450px; margin: auto;" 
                   method="POST" action="user/register.php">
                    <label for="password" class="form-label"><strong>Password</strong></label>
                    <input type="password" class="form-control" id="passwd" name="passwd"  required>
           </div>
        <button style="background-color: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; text-align: center; margin-top: 20px;">บันทึกข้อมูล</button>
    </div>

    

</div>
<div style="margin-top: 20px; background-color: #f5f5f5; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);padding: 20px;">
<table class="table" id="">
  <thead>
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">ชื่อผู้ใช้</th>
      <th scope="col">ชื่อ - นาสกุล</th>
      <th scope="col">ระดับสิทธิ์</th>
      <th scope="col">จัดการ</th>
    </tr>
  </thead>
  <tbody>

  <?php
            $sql = "SELECT * FROM users";
            $result = $db_con -> query($sql);

            $i = 1;
                while ($row = $result -> fetch(PDO::FETCH_ASSOC)) {
            
                    if($row['userLavelID'] == 1) {
                        $lavel_name = "ผู้ดูแลระบบ";
                        $lavel_color = "red";
                    }else if($row['userLavelID'] == 2){
                        $lavel_name = "เจ้าของกิจการ";
                        $lavel_color = "LimeGreen";
                    }else if($row['userLavelID'] == 3){
                        $lavel_name = "พนักงาน";
                        $lavel_color = "blue";
                    }else{
                        $lavel_name = "สมาชิก";
                        $lavel_color = "Violet";
                    }
    
            ?>
                <tr style="font-size: 14px;">
                    <td><?=$i?></td>
                    <td><?=$row['userName']?></td>
                    <td><?=$row['userFName']?> <?=$row['userLName']?></td>
                    <td style="color: <?php echo $lavel_color ?>;"><i class="lni lni-checkmark-circle" style="margin-right: 8px;"></i><?= $lavel_name ?></td>
                     <td>
                        <button onclick="openEditModal(${i})" class="btn btn-primary btn-sm"><i class="lni lni-pencil" style="padding: 5px 3px 3px 3px;"></i></button>
                        <button onclick="delete_data(${i})" class="btn btn-danger btn-sm"><i class="lni lni-trash-can" style="padding: 5px 3px 3px 3px;;"></i></button>
                    </td>
                </tr>

            <?php
                $i++;   
                }
            ?>
  </tbody>
</table>
</div>

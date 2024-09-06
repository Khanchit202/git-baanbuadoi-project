<?php
    session_start();
    include("../db_config.php");
    $id = $_GET['id'];

    $sql = "SELECT * FROM users WHERE id= ?";
    $stmt= $db_con->prepare($sql);
    $stmt->bindParam(1,$id);
    $stmt->execute();

    $row = $stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-4">
        <h3>แก้ไขข้อมูล</h3>
        </div>
</div>
        <div class="row justify-content-center">
            <div class="col-4">
            <form action="updatadata.php" method="POST">
                <div class="mb-3">
                    <label for="name" class="form-label">ชื่อผู้ใช้</label>
                    <input type="text" class="form-control" name="edit_userName"  value="<?=$row['userName']?>">
                </div>
                <div class="mb-3">
                    <label for="course" class="form-label">ชื่อจริง</label>
                    <input type="text" class="form-control" name="edit_userFName" value="<?=$row['userFName']?>">
                </div>
                <div class="mb-3">
                    <label for="gender" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" name="edit_userLName" value="<?=$row['userLName']?>">
                </div>
                <div class="mb-3">
                    <label for="age" class="form-label">เบอร์โทรศัพท์</label>
                    <input type="number" class="form-control" name="edit_userTel" value="<?=$row['userTel']?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="text" class="form-control" name="edit_userEmail" value="<?=$row['userEmail']?>">
                </div>

                <input type="hidden" name="id" value="<?=$id?>" >
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary" name="submit">แก้ไข</button>
                    </form>
            </div>
        </div>

    </div>
    
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact เกี่ยวกับเรา</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="tabbar_view/nav_bar.css">
    <link rel="stylesheet" href="style1.css">
    <link href="../img/favicon.ico" rel="icon">
    <link rel="icon" type="image/x-icon" href="img/bua/logo.png" style="border-radius: 5px;">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.0/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.0.0/js/dataTables.js"></script>
    <style>
        .is-valid {
            border-color: #28a745; /* สีเขียวสำหรับข้อความที่ถูกต้อง */
        }
        .is-invalid {
            border-color: #dc3545; /* สีแดงสำหรับข้อความที่ไม่ถูกต้อง */
        }
        .invalid-feedback {
            display: none;
            color: #dc3545;
        }
        .btn-disabled {
            background-color: #d6d6d6; /* สีพื้นหลังปุ่มเมื่อไม่สามารถกดได้ */
            color: #6c757d; /* สีข้อความปุ่มเมื่อไม่สามารถกดได้ */
            cursor: not-allowed; /* เปลี่ยนเคอร์เซอร์เป็นสัญลักษณ์ไม่สามารถคลิกได้ */
        }
    </style>
</head>
<body>

<div class="container-xxl bg-white p-0">
    <nav>
        <?php include("tabbar_view/tab_bar.php"); ?>
    </nav>
    
    <!-- form login start  -->
    <div class="container-xxl bg-white p-0" style="margin-top:100px;">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="text-center">สมัครสมาชิก</h2>
                    <h5 class="text-center">REGISTER</h5>
                    <form class="row g-3 needs-validation" novalidate 
                        style="margin-top:20px; max-width: 450px; margin: auto;" 
                        method="POST" action="register.php">

                        <div class="col-12">
                            <label for="username" class="form-label"><strong>User Name: ใช้เข้าสู่ระบบ</strong></label>
                            <input type="text" class="form-control" id="username" name="username" required>
                            <div class="invalid-feedback">กรุณากรอกชื่อผู้ใช้</div>
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label"><strong>Password</strong></label>
                            <input type="password" class="form-control" id="passwd" name="passwd" placeholder="ควรตั้ง 6 หลักขึ้นไป" required>
                        </div>
                        <div class="col-12">
                            <label for="confirm-password" class="form-label"><strong>ยืนยัน Password</strong></label>
                            <input type="password" class="form-control" id="confirm-password" name="confirm-password" required>
                            <div id="password-feedback" class="invalid-feedback">รหัสผ่านไม่ตรงกัน</div>
                        </div>
                        <div class="col-12">
                            <label for="fname" class="form-label"><strong>Name: ชื่อ</strong></label>
                            <input type="text" class="form-control" id="fname" name="fname" required>
                        </div>

                        <div class="col-12">
                            <label for="lname" class="form-label"><strong>Surname: นามสกุล</strong></label>
                            <input type="text" class="form-control" id="lname" name="lname" required>
                        </div>

                        <div class="col-12">
                            <label for="email" class="form-label"><strong>Email: อีเมล์</strong></label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="UserXXXX.Gmail.com" required>
                        </div>

                        <div class="col-12">
                            <label for="tel" class="form-label"><strong>Tel: เบอร์โทรศัพท์</strong></label>
                            <input type="number" class="form-control" id="tel" name="tel" placeholder="08XXXXXX" required>
                        </div>

                        <div class="col-12">
                            <label for="location" class="form-label"><strong>Location: ที่อยู่</strong></label>
                            <input type="text" class="form-control" id="location" name="location" placeholder="บ้านเลขที่/ตำบล/อำเภอ/จังหวัด/รหัสไปรษณีย์" required>
                        </div>

                        <div class="col-12 d-flex align-items-center">
                            <div class="me-3">
                                <label for="age" class="form-label"><strong>Age: อายุ</strong></label>
                                <input type="number" class="form-control" id="age" name="age" placeholder="อายุ" required>
                            </div>
                            <div>
                                <label for="gender" class="form-label"><strong>Gender: เพศ</strong></label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="">เลือกเพศ</option>
                                    <option value="0">ชาย</option>
                                    <option value="1">หญิง</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-12 d-flex justify-content-center gap-3" style="margin-top:30px;">
                            <button id="submit" class="btn btn-success" style="background-color: #4DA866; width: 100%;" type="submit"  disabled>ลงทะเบียน</button>
                        </div>

                        <div class="d-flex justify-content-between" style="border-bottom: 1px solid black; padding-bottom: 10px;">
                            <a href="index.php" class="align-self-end" style="margin-top:10px; text-decoration: none; color: black;">
                                <i class="fas fa-arrow-left"></i> กลับหน้าหลัก
                            </a>
                            <a href="#" class="align-self-end" style="margin-top:10px; text-decoration: none; color: black;">ลืมรหัสผ่าน?</a>
                        </div>

                        <div class="text-center" style="margin-top: 10px;">
                            <p>หากคุณมีบัญชีผู้ใช้อยู่แล้ว
                                <a href="login.php" style="color: #4DA866;">เข้าสู่ระบบ</a>
                            </p>
                        </div>
                    </form> 


                </div>

                <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <img src="tabbar_view/baanbuadoi.png" alt="Logo" class="img-fluid" style="max-width: 70%; height: auto;">
                </div>

                <div class="text-center mt-5">
                    <p>ออกแบบและพัฒนาโดย นายครรชิต บางพระ และนายสมชาย หมั่นเฮิง หลักสูตรระบบสารสนเทศทางธุรกิจ-พัฒนาซอฟต์แวร์ มหาวิทยาลัยเทคโนโลยีราชมงคลล้านนา</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const password = document.getElementById('passwd');
    const confirmPassword = document.getElementById('confirm-password');
    const feedback = document.getElementById('password-feedback');
    const submitButton = document.getElementById('submit');
    const formFields = document.querySelectorAll('.needs-validation input, .needs-validation select');
    
    function validateForm() {
        let allFieldsValid = true;
        formFields.forEach(field => {
            if (!field.checkValidity()) {
                allFieldsValid = false;
            }
        });
        
        if (password.value !== confirmPassword.value) {
            allFieldsValid = false;
            confirmPassword.classList.remove('is-valid');
            confirmPassword.classList.add('is-invalid');
            feedback.style.display = 'block';
        } else {
            confirmPassword.classList.remove('is-invalid');
            confirmPassword.classList.add('is-valid');
            feedback.style.display = 'none';
        }

        submitButton.disabled = !allFieldsValid;
        submitButton.classList.toggle('btn-disabled', !allFieldsValid);
    }

    formFields.forEach(field => {
        field.addEventListener('input', validateForm);
    });

    password.addEventListener('input', validateForm);
    confirmPassword.addEventListener('input', validateForm);
});

</script>

</body>
</html>

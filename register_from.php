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
    <link rel="icon" type="image/x-icon" href="tabbar_view/baanbuadoi.png" style="border-radius: 5px;">
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
            border-color: #28a745;
        }
        .is-invalid {
            border-color: #dc3545;
        }
        .invalid-feedback {
            display: none;
            color: #dc3545;
        }
        .btn-disabled {
            background-color:  #d6d6d6;
            color: black;
            cursor: not-allowed;
        }
    </style>
</head>
<body>

<div class="container-xxl bg-white p-0">
    <nav id="navbar">
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
                        method="POST" action="user/register.php">

                        <div class="col-12">
                            <label for="username" class="form-label">
                                <strong>User Name: ใช้เข้าสู่ระบบ</strong>
                            </label>
                            <div style="position: relative;">
                                <input type="text" class="form-control" id="username" name="username" required>
                                <div class="invalid-feedback">มีชื่อผู้ใช้นี้อยู่แล้ว</div>
                            </div>
                        </div>
                        <div class="col-12">
                            <label for="password" class="form-label"><strong>Password</strong></label>
                            <input type="password" class="form-control" id="passwd" name="passwd" required>
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
                            <input type="text" class="form-control" id="email" name="email" required>
                        </div>

                        <div class="col-12">
                            <label for="tel" class="form-label"><strong>Tel: เบอร์โทรศัพท์</strong></label>
                            <input type="number" class="form-control" id="tel" name="tel" required>
                        </div>
                        
                        <div class="col-12 d-flex justify-content-center gap-3" style="margin-top:30px;">
                            <button id="submit" class="btn btn-success" style="background-color: #4DA866; width: 100%;" type="submit" disabled>ลงทะเบียน</button>
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
        const username = document.getElementById('username');

        // ฟังก์ชันการตรวจสอบ password
        function validatePasswords() {
            const passwordValid = password.value.length >= 8 &&
                                  password.value.length <= 25 &&
                                  /[A-Za-z]/.test(password.value) &&
                                  !/\s/.test(password.value);

            // Validate password format
            if (!passwordValid) {
                setInvalid(password, 'Invalid password format');
                return false;
            } else {
                setValid(password);
            }

            // Check if passwords match
            if (password.value !== confirmPassword.value) {
                setInvalid(confirmPassword, 'Passwords do not match');
                feedback.style.display = 'block';
                return false;
            } else {
                setValid(confirmPassword);
                feedback.style.display = 'none';
            }
            return true;
        }

        function validateName(input) {
            const nameValid = /^[ก-๙A-Za-z]+$/.test(input.value);
            nameValid ? setValid(input) : setInvalid(input, 'Invalid name format');
        }

        function validateUsername() {
            if (username.value.length === 0) {
                username.classList.remove('is-valid', 'is-invalid');
                return false;
            }
            setValid(username);
            return true;
        }

        function setValid(input) {
            input.classList.remove('is-invalid');
            input.classList.add('is-valid');
            input.setCustomValidity('');
        }

        function setInvalid(input, message) {
            input.classList.remove('is-valid');
            input.classList.add('is-invalid');
            input.setCustomValidity(message);
        }

        // ฟังก์ชันการตรวจสอบฟิลด์ทั้งหมด
        function validateForm() {
            let allFieldsValid = [...formFields].every(field => field.checkValidity());
            const usernameValid = validateUsername();
            const passwordsValid = validatePasswords();
            submitButton.disabled = !(allFieldsValid && usernameValid && passwordsValid);
            submitButton.classList.toggle('btn-disabled', !(allFieldsValid && usernameValid && passwordsValid));
        }

        // การตรวจสอบเมื่อมีการพิมพ์ข้อมูลในฟิลด์
        formFields.forEach(field => {
            field.addEventListener('input', () => {
                if (field.id === 'fname' || field.id === 'lname') {
                    validateName(field);
                }
                validateForm();
            });
        });

        password.addEventListener('input', validatePasswords);
        confirmPassword.addEventListener('input', validatePasswords);

    });

    $(document).ready(function() {
        $('#username').on('input', function() {
            var usernameValue = $(this).val();

            if (usernameValue.length > 0) {
                $.ajax({
                    url: 'user/check_username.php',
                    type: 'POST',
                    data: { username: usernameValue },
                    dataType: 'json',
                    success: function(response) {
                        if (response.available) {
                            $('#username').removeClass('is-invalid').addClass('is-valid');
                            $('#username-check').html('<i style="color: green;" class="fas fa-check-circle"></i>');
                        } else {
                            $('#username').removeClass('is-valid').addClass('is-invalid');
                            $('#username-check').html('<i style="color: red;" class="fas fa-times-circle"></i>');
                        }
                        validateForm(); // ตรวจสอบฟอร์มทั้งหมด
                    },
                    error: function() {
                        console.error("Error checking username availability");
                        $('#username-check').html('<i style="color: red;">Error!</i>');
                    }
                });
            } else {
                $('#username').removeClass('is-valid is-invalid');
                $('#username-check').html('');
            }
        });
    });
</script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-uRksnIelQ4Lo6zw4zOz+n26sB1RZlgS7/I5QiFTIOZWbH/uREH5ChW+lHR8eD4g1" crossorigin="anonymous"></script>

</body>
</html>

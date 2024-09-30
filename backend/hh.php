<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Test SweetAlert2</title>
</head>
<body>
    <button onclick="checkinHandler(1)">Checkin</button>
    <script>
        function checkinHandler(billID) {
            Swal.fire({
        title: 'กรุณาใส่รหัสผ่านเพื่อยืนยันการ Checkin',
        input: 'password',
        inputPlaceholder: 'ใส่รหัสผ่านของคุณ',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        preConfirm: (password) => {
            return new Promise((resolve) => {
                if (password) {
                    resolve(password);
                } else {
                    Swal.showValidationMessage('กรุณาใส่รหัสผ่าน');
                }
            });
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const password = result.value;

            fetch('con_check.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ password: password })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('การตอบกลับจากเครือข่ายไม่ถูกต้อง');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    return fetch('api/check_check.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ billID: billID, password: password })
                    });
                } else {
                    throw new Error('รหัสผ่านไม่ถูกต้อง');
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'สำเร็จ',
                        text: 'Checkin เสร็จเรียบร้อย',
                        icon: 'success',
                        confirmButtonText: 'ตกลง'
                    });
                } else {
                    throw new Error('ไม่สามารถดำเนินการ Checkin ได้');
                }
            })
            .catch(error => {
                console.error('ข้อผิดพลาด:', error);
                Swal.fire({
                    title: 'เกิดข้อผิดพลาด',
                    text: error.message || 'ไม่สามารถดำเนินการ Checkin ได้',
                    icon: 'error',
                    confirmButtonText: 'ตกลง'
                });
            });
        }
    });
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>No Signal</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0;">

<script>
    Swal.fire({
        title: 'ขออภัย',
        text: 'ระบบยังไม่เปิดให้บริการหน้านี้',
        icon: 'info',
        confirmButtonText: 'กลับหน้าหลัก',
        allowOutsideClick: false,
        allowEscapeKey: false
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../index.php';
        }
    });

</script>

</body>
</html>

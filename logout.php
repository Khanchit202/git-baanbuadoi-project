<header>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="font-web.css">
</header>
<?php

session_start();
session_destroy();
?>
<script>
    Swal.fire({
        icon: 'success',
        title: 'กำลังออกจากระบบ',
        html: '<button class="btn btn-success" type="button" disabled>' +
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>' +
                ' กำลังนำท่านไปยังหน้าหลัก...' +
                '</button>',
        timer: 2000,
        showConfirmButton: false
    }).then(() => {
        window.location.href = 'index.php';
    });
</script>
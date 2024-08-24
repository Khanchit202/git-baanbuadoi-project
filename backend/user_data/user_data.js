function delete_data(userID) {
    console.log(userID);
    Swal.fire({
        title: "ยืนยันการลบ",
        text: "ลบข้อมูลของผู้ใช้นี้หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'user_data/api/delete.php',
                type: 'POST',
                dataType: 'json',
                data: { userID: userID }
            })
            .done(function(response) {
                if (response.status == 'ok') {
                    Swal.fire({
                        title: "ลบข้อมูลสำเร็จ",
                        text: "ข้อมูลของผู้ใช้ถูกลบเรียบร้อยแล้ว",
                        icon: "success"
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        title: "ไม่สามารถลบข้อมูลได้",
                        text: "มีข้อผิดพลาดในการลบข้อมูลของผู้ใช้",
                        icon: "error"
                    });
                }
            })
            .fail(function() {
                Swal.fire({
                    title: "ข้อผิดพลาด",
                    text: "ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้",
                    icon: "error"
                });
            });
        }
    });
}

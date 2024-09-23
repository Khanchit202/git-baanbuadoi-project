function showreviwsSer(rvsID) {
    // ตรวจสอบข้อมูลที่ส่งเข้ามา
    $('#select_reroom').modal('show');

    // ตั้งค่าข้อมูลการจอง
    $('#rvsID').text(rvsID.rvsID);
    $('#userID').text(rvsID.userID);
    $('#rvsDetail').text(rvsID.rvsDetail);
    $('#rvsScore').text(rvsID.rvsScore);
    $('#roomID').text(rvsID.roomID);
    $('#checkID').text(rvsID.checkID);
    $('#billID').text(rvsID.billID);
    $('#rvsDate').text(rvsID.rvsDate);
}

function delete_reviwsSer(rvsID) {
    Swal.fire({
        title: "ยืนยันการลบ",
        text: "ลบข้อมูลรีวิวเลขที่ " + rvsID + " หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ยืนยัน, ลบข้อมูล",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'reviwsroom_data/api/delete.php',
                type: 'POST',
                dataType: 'json',
                data: { rvsID: rvsID }
            })
            .done(function(response) {
                if (response.status == 'ok') {
                    Swal.fire({
                        title: "ลบข้อมูลสำเร็จ",
                        text: "ข้อมูลถูกลบเรียบร้อยแล้ว",
                        icon: "success"
                    }).then(() => {
                        window.location.reload(); // Refresh the page
                    });
                } else {
                    Swal.fire({
                        title: "ไม่สามารถลบข้อมูลได้",
                        text: "มีข้อผิดพลาดในการลบข้อมูล",
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
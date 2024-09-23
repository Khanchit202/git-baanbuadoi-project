function showreviwsroom(rvrID) {
    // ตรวจสอบข้อมูลที่ส่งเข้ามา
    $('#select_reroom').modal('show');

    // ตั้งค่าข้อมูลการจอง
    $('#rvrID').text(rvrID.rvrID);
    $('#userID').text(rvrID.userID);
    $('#rvrDetail').text(rvrID.rvrDetail);
    $('#rvrScore').text(rvrID.rvrScore);
    $('#roomID').text(rvrID.roomID);
    $('#checkID').text(rvrID.checkID);
    $('#billID').text(rvrID.billID);
    $('#rvrDate').text(rvrID.rvrDate);
}

function delete_reviwsroom(rvrID) {
    Swal.fire({
        title: "ยืนยันการลบ",
        text: "ลบข้อมูลรีวิวเลขที่ " + rvrID + " หรือไม่?",
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
                data: { rvrID: rvrID }
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
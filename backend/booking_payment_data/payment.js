function delete_pay(payID) {
    Swal.fire({
        title: "ยืนยันการลบ",
        text: "ลบข้อมูลกสรชำระเงินเลขที่ " + payID + " หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ยืนยัน, ลบข้อมูล",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'booking_payment_data/api/delete_pay.php',
                type: 'POST',
                dataType: 'json',
                data: { payID: payID }
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

function select_pay(payID) {
    // ตรวจสอบข้อมูลที่ส่งเข้ามา
    $('#select_pay').modal('show');

    // ตั้งค่าข้อมูลห้องพัก
    $('#payID').text(payID.payID);
    $('#payNameAc').text(payID.payNameAc);
    $('#payDate').text(payID.payDate);
    $('#bookID').text(payID.bookID);
    $('#userID').text(payID.userID);
    $('#roomID').text(payID.roomID);
    $('#payType').text(payID.payType);
    $('#payBank').text(payID.payBank);
    $('#payPic').attr('', payID.payPic);
}
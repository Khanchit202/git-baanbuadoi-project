function delete_book(bookID) {
    Swal.fire({
        title: "ยืนยันการลบ",
        text: "ลบข้อมูลของผู้ใช้เลขที่ " + bookID + " หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ยืนยัน, ลบบัญชี",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'booking_data/api/deletes.php',
                type: 'POST',
                dataType: 'json',
                data: { bookID: bookID }
            })
            .done(function(response) {
                if (response.status == 'ok') {
                    Swal.fire({
                        title: "ลบข้อมูลสำเร็จ",
                        text: "ข้อมูลของผู้ใช้ถูกลบเรียบร้อยแล้ว",
                        icon: "success"
                    }).then(() => {
                        window.location.reload();
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

function select_book(bookID) {
    // ตรวจสอบข้อมูลที่ส่งเข้ามา
    $('#select_book').modal('show');

    // ตั้งค่าข้อมูลการจอง
    $('#bookID').text(bookID.bookID);
    $('#userID').text(bookID.userID);
    $('#bookName').text(bookID.bookName);
    $('#bookTel').text(bookID.bookTel);
    $('#bookDate').text(bookID.bookDate);
    $('#bookDetail').text(bookID.bookDetail);
    $('#bookDateStart').text(bookID.bookDateStart);
    $('#bookDateEnd').text(bookID.bookDateEnd);
    $('#roomID').text(bookID.roomID);
    $('#bookPrice').text(bookID.bookPrice);
    $('#bookConfirm').text(bookID.bookConfirm == 1 ? 'ยืนยัน' : 'ยกเลิก');
    $('#bookStatus').text(bookID.bookStatus == 1 ? 'สำเร็จ' : 'ไม่สำเร็จ');
    $('#pmtID').text(bookID.pmtID);
    $('#serviceID').text(bookID.serviceID);
    $('#bookCancel').text(bookID.bookCancel == 0 ? 'ยืนยัน' : 'ยกเลิก');
}

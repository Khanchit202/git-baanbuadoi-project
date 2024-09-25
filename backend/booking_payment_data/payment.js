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
    // Log the payID object to the console
    console.log(payID);

    // Show the modal with ID 'select_pay'
    $('#select_pay').modal('show');

    // Set the payment details in the modal
    $('#payID').text(payID.payID);
    $('#payNameAc').text(payID.payNameAc);
    $('#payDate').text(payID.payDate);
    $('#bookID').text(payID.bookID);
    $('#userID').text(payID.userID);
    $('#roomID').text(payID.roomID);
    $('#payType').text(payID.payType);
    $('#payBank').text(payID.payBank);
    $('#payManey').text(payID.payManey + 'บาท');
    $('#payPic').attr('src','booking_payment_data/api/slip/' +payID.payPic); // Append payPic to the src path
}

function cancle(payID) {
    // แสดง SweetAlert เพื่อยืนยันการดำเนินการ
    swal({
        title: "คุณแน่ใจหรือไม่?",
        text: "คุณต้องการยกเลิกการชำระเงินนี้หรือไม่?",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            // สร้าง FormData เพื่อส่งข้อมูล
            var formData = new FormData();
            formData.append('payID', payID);
            formData.append('status', '3');

            console.log('Sending payID:', payID);
            console.log('Sending status:', '3');

            // ส่งข้อมูลไปยังไฟล์ PHP
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "booking_payment_data/api/updatepayStatus_no.php", true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        // ปิด Modal ก่อน
                        $('#select_pay').modal('hide');
                        
                        // แสดง SweetAlert หลังจากปิด Modal
                        swal({
                            title: "แก้ไขข้อมูลสำเร็จ",
                            text: response.message,
                            icon: "success",
                            button: "OK",
                        }).then(() => {
                            // รีเฟรชข้อมูลใหม่
                            location.reload();
                        });
                    } else {
                        swal({
                            title: "แก้ไขข้อมูลไม่สำเร็จ",
                            text: response.message,
                            icon: "error",
                            button: "OK",
                        });
                    }
                }
            };

            xhr.onerror = function() {
                console.error("Request failed");
            };

            xhr.send(formData);
        } else {
            swal("การยกเลิกถูกยกเลิก");
        }
    });
}


function confirm(payID) {
    // แสดง SweetAlert เพื่อยืนยันการดำเนินการ
    swal({
        title: "คุณแน่ใจหรือไม่?",
        text: "คุณต้องการยืนยันการชำระเงินนี้หรือไม่?",
        icon: "success",
        buttons: true,
        successMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            // สร้าง FormData เพื่อส่งข้อมูล
            var formData = new FormData();
            formData.append('payID', payID);
            formData.append('paystatus', '2');
            formData.append('billstatus', '1');

            // ส่งข้อมูลไปยังไฟล์ PHP
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "booking_payment_data/api/updatepayStatus_yes.php", true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.status === 'success') {
                        // ปิด Modal ก่อน
                        $('#select_pay').modal('hide');
                        
                        // แสดง SweetAlert หลังจากปิด Modal
                        swal({
                            title: "ยืนยันการชำระเงินสำเร็จ",
                            text: response.message,
                            icon: "success",
                            button: "OK",
                        }).then(() => {
                            // รีเฟรชข้อมูลใหม่
                            location.reload();
                        });
                    } else {
                        swal({
                            title: "ยืนยันการชำระเงินไม่สำเร็จ",
                            text: response.message,
                            icon: "error",
                            button: "OK",
                        });
                    }
                }
            };

            xhr.onerror = function() {
                console.error("Request failed");
            };

            xhr.send(formData);
        } else {
            swal("การยกเลิก");
        }
    });
}
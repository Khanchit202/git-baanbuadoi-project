function checkoutHandler(billID) {
    Swal.fire({
        title: 'ยืนยันการ CheckOut',
        text: 'คุณต้องการดำเนินการ Check Out หรือไม่?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'checkout_data/api/check.php',
                type: 'POST',
                data: {
                    billID: billID,
                }
            })
            .done(function(response) {
                if (response === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'เช็คเอาท์สำเร็จ'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'มีบางอย่างผิดพลาดโปรดลองอีกครั้ง!',
                    });
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                Swal.fire({
                    title: "ข้อผิดพลาด",
                    text: "ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้: " + textStatus + " - " + errorThrown,
                    icon: "error"
                });
            });
        }
    });
}

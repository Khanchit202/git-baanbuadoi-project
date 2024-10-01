function checkinHandler(billID) {
    Swal.fire({
        title: 'ยืนยันการ Checkin',
        text: 'คุณต้องการดำเนินการ Checkin หรือไม่?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'ใช่',
        cancelButtonText: 'ไม่'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'checking_data/api/check.php',
                type: 'POST',
                data: {
                    billID: billID,
                }
            })
            .done(function(response) {
                if (response === "success") {
                    Swal.fire({
                        icon: 'success',
                        title: 'เช็คอินสำเร็จ'
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

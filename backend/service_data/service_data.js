
function delete_service(serviceID) {
    console.log(serviceID);
    Swal.fire({
        title: "ยืนยันการลบ",
        text: "ลบข้อมูลบริการเลขที่ " + serviceID + " หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ยืนยัน, ลบบัญชี",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'service_data/api/delete.php',
                type: 'POST',
                dataType: 'json',
                data: { serviceID: serviceID }
            })
            .done(function(response) {
                if (response.status == 'ok') {
                    Swal.fire({
                        title: "ลบข้อมูลสำเร็จ",
                        text: "ข้อมูลบริการถูกลบเรียบร้อยแล้ว",
                        icon: "success"
                    }).then(() => {
                        window.location.reload(); // Refresh the page
                    });
                } else {
                    Swal.fire({
                        title: "ไม่สามารถลบข้อมูลได้",
                        text: "มีข้อผิดพลาดในการลบข้อมูลบริการ",
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

function save_service() {
    var serviceName = $('#serviceName').val();
    var serviceDetail = $('#serviceDetail').val();
    var servicePrice = $('#servicePrice').val();
    var serviceTotal = $('#serviceTotal').val();
    var serviceTime = $('#serviceTime').val();
    var serviceStd = $('#serviceStd').val();
    var serviceImg = $('#serviceImg')[0].files[0];

    if(serviceName == "" || serviceDetail == "" || servicePrice == "" || serviceTotal == "" || serviceTime == "" || serviceStd == "" || !serviceImg) {
        Swal.fire({
            title: "กรุณากรอกข้อมูลให้ครบ",
            text: "คุณกรอกข้อมูลไม่ครบ กรุณากรอกข้อมูลแล้วลองอีกครั้ง",
            icon: "warning"
        });
    } else {
        var formData = new FormData();
        formData.append('serviceName', serviceName);
        formData.append('serviceDetail', serviceDetail);
        formData.append('servicePrice', servicePrice);
        formData.append('serviceTotal', serviceTotal);
        formData.append('serviceTime', serviceTime);
        formData.append('serviceStd', serviceStd);
        formData.append('serviceImg', serviceImg);

        $.ajax({
            url: 'service_data/api/add_service.php',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false
        })
        .done(function(result) {
            if (result.status == 'ok') {
                Swal.fire({
                    title: "บันทึกข้อมูลสำเร็จ",
                    text: "",
                    icon: "success",
                    didClose: () => {
                        $('#addDataroom').modal('hide');
                        window.location.reload(); // Refresh the page
                    }
                });
            } else {
                Swal.fire({
                    title: "บันทึกข้อมูลไม่สำเร็จ",
                    text: result.message,
                    icon: "error"
                });
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            console.log("error", textStatus, errorThrown);
            Swal.fire({
                title: "ข้อผิดพลาด",
                text: "ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้: " + textStatus,
                icon: "error"
            });
        })
        .always(function() {
            console.log("complete");
        });
    }
}





 
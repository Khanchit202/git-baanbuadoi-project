
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



function updateshowservice(serviceID) {
    // ตรวจสอบข้อมูลที่ส่งเข้ามา
    $('#editDatservice').modal('show');

    // ตั้งค่าข้อมูลห้องพัก
    $('#edit_serviceID').val(serviceID.serviceID);
    $('#edit_serviceName').val(serviceID.serviceName);
    $('#edit_serviceDetail').val(serviceID.serviceDetail);
    $('#edit_servicePrice').val(serviceID.servicePrice);
    $('#edit_serviceTotal').val(serviceID.serviceTotal);
    $('#edit_serviceTime').val(serviceID.serviceTime);
    $('#edit_serviceStd').val(serviceID.stdID);
}


function update_service() {
    // รับค่าจากฟอร์ม
    var serviceID = document.getElementById('edit_serviceID').value;
    var serviceName = document.getElementById('edit_serviceName').value;
    var serviceDetail = document.getElementById('edit_serviceDetail').value;
    var servicePrice = document.getElementById('edit_servicePrice').value;
    var serviceTotal = document.getElementById('edit_serviceTotal').value;
    var serviceTime = document.getElementById('edit_serviceTime').value;
    var serviceStd = document.getElementById('edit_serviceStd').value;
    var serviceImg = document.getElementById('edit_serviceImg').files[0];

    // สร้าง FormData object
    var formData = new FormData();
    formData.append('serviceID', serviceID);
    formData.append('serviceName', serviceName);
    formData.append('serviceDetail', serviceDetail);
    formData.append('servicePrice', servicePrice);
    formData.append('serviceTotal', serviceTotal);
    formData.append('serviceTime', serviceTime);
    formData.append('serviceStd', serviceStd);
    formData.append('serviceImg', serviceImg);

    // ส่งข้อมูลไปยังไฟล์ PHP
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "service_data/api/update_service.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                // ปิด Modal ก่อน
                $('#editDatservice').modal('hide');
                
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
}


 
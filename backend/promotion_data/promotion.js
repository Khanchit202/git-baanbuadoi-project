function delete_pro(pmtID) {
    Swal.fire({
        title: "ยืนยันการลบ",
        text: "ลบข้อมูลโปรโมชั่นเลขที่ " + pmtID + " หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ยืนยัน, ลบข้อมูล",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'promotion_data/api/delete.php',
                type: 'POST',
                dataType: 'json',
                data: { pmtID: pmtID }
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

function select_pro(pmtID) {
    // ตรวจสอบข้อมูลที่ส่งเข้ามา
    $('#select_pro').modal('show');

    // ตั้งค่าข้อมูลการจอง
    $('#pmtID').text(pmtID.pmtID);
    $('#userID').text(pmtID.userID);
    $('#pmtTitle').text(pmtID.pmtTitle);
    $('#pmtDetail').text(pmtID.pmtDetail);
    $('#pmtCode').text(pmtID.pmtCode);
    $('#pmtDiscont').text(pmtID.pmtDiscont);
    $('#pmtUnit').text(pmtID.pmtUnit);
    $('#pmtDate').text(pmtID.pmtDate);
    $('#pmtStartDate').text(pmtID.pmtStartDate);
    $('#pmtEndDate').text(pmtID.pmtEndDate);
}


function save_pro() {
    var addpmtTitle = $('#addpmtTitle').val();
    var addpmtDetail = $('#addpmtDetail').val();
    var addpmtCode = $('#addpmtCode').val();
    var addpmtDiscont = $('#addpmtDiscont').val();
    var addpmtUnit = $('#addpmtUnit').val();
    var addpmtDate = $('#addpmtDate').val();
    var addpmtStartDate = $('#addpmtStartDate').val();
    var addpmtEndDate = $('#addpmtEndDate').val();
    var addpmtImg = $('#addpmtImg')[0].files[0];
    var userId = $('#adduserId').val();

    if(addpmtTitle == "" || addpmtDetail == "" || addpmtCode == "" || addpmtDiscont == "" || !addpmtImg || userId == "") {
        Swal.fire({
            title: "กรุณากรอกข้อมูลให้ครบ",
            text: "คุณกรอกข้อมูลไม่ครบ กรุณากรอกข้อมูลแล้วลองอีกครั้ง",
            icon: "warning"
        });
    } else {
        var formData = new FormData();
        formData.append('addpmtTitle', addpmtTitle);
        formData.append('addpmtDetail', addpmtDetail);
        formData.append('addpmtCode', addpmtCode);
        formData.append('addpmtDiscont', addpmtDiscont);
        formData.append('addpmtUnit', addpmtUnit);
        formData.append('addpmtDate', addpmtDate);
        formData.append('addpmtStartDate', addpmtStartDate);
        formData.append('addpmtEndDate', addpmtEndDate);
        formData.append('addpmtImg', addpmtImg);
        formData.append('adduserId', userId);

        $.ajax({
            url: 'promotion_data/api/add_promotion.php',
            type: 'POST',
            dataType: 'json',
            data: formData,
            processData: false,
            contentType: false
        })
        .done(function(result) {
            console.log(result); // ตรวจสอบข้อมูลที่ได้รับ
            if (result.status == 'ok') {
                Swal.fire({
                    title: "บันทึกข้อมูลสำเร็จ",
                    text: "",
                    icon: "success",
                    didClose: () => {
                        $('#addProModal').modal('hide');
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
            console.log("responseText", jqXHR.responseText); // ตรวจสอบข้อมูลที่ได้รับ
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



function show_pro(pmtID) {
    // ตรวจสอบข้อมูลที่ส่งเข้ามา
    $('#editProModal').modal('show');

    $('#editpmtID').val(pmtID.pmtID);
    $('#edituserID').val(pmtID.userID);
    $('#editpmtTitle').val(pmtID.pmtTitle);
    $('#editpmtDetail').val(pmtID.pmtDetail);
    $('#editpmtCode').val(pmtID.pmtCode);
    $('#editpmtDiscont').val(pmtID.pmtDiscont);
    $('#editpmtUnit').val(pmtID.pmtUnit);
    $('#editpmtDate').val(pmtID.pmtDate);
    $('#editpmtStartDate').val(pmtID.pmtStartDate);
    $('#editpmtEndDate').val(pmtID.pmtEndDate);
}

function update_pro() {
    // รับค่าจากฟอร์ม
    var pmtID = document.getElementById('editpmtID').value;
    var pmtTitle = document.getElementById('editpmtTitle').value;
    var pmtDetail = document.getElementById('editpmtDetail').value;
    var pmtCode = document.getElementById('editpmtCode').value;
    var pmtDiscont = document.getElementById('editpmtDiscont').value;
    var pmtUnit = document.getElementById('editpmtUnit').value;
    var pmtDate = document.getElementById('editpmtDate').value;
    var pmtStartDate = document.getElementById('editpmtStartDate').value;
    var pmtEndDate = document.getElementById('editpmtEndDate').value;
    var pmtImg = document.getElementById('editpmtImg').files[0];
    var userID = document.getElementById('edituserId').value;

    // สร้าง FormData object
    var formData = new FormData();
    formData.append('pmtID', pmtID);
    formData.append('pmtTitle', pmtTitle);
    formData.append('pmtDetail', pmtDetail);
    formData.append('pmtCode', pmtCode);
    formData.append('pmtDiscont', pmtDiscont);
    formData.append('pmtUnit', pmtUnit);
    formData.append('pmtDate', pmtDate);
    formData.append('pmtStartDate', pmtStartDate);
    formData.append('pmtEndDate', pmtEndDate);
    formData.append('pmtImg', pmtImg);
    formData.append('userID', userID);


    // ส่งข้อมูลไปยังไฟล์ PHP
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "promotion_data/api/update_promotion.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                // ปิด Modal ก่อน
                $('#editDatanew').modal('hide');
                
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
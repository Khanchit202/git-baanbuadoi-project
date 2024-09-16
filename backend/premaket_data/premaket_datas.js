
function delete_new(newID) {
    console.log(newID);
    Swal.fire({
        title: "ยืนยันการลบ",
        text: "ลบข้อมูลข่าวสารเลขที่ " + newID + " หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ยืนยัน, ลบบัญชี",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'premaket_data/api/delete.php',
                type: 'POST',
                dataType: 'json',
                data: { newID: newID }
            })
            .done(function(response) {
                if (response.status == 'ok') {
                    Swal.fire({
                        title: "ลบข้อมูลสำเร็จ",
                        text: "ข้อมูลข่าวสารถูกลบเรียบร้อยแล้ว",
                        icon: "success"
                    }).then(() => {
                        window.location.reload(); // Refresh the page
                    });
                } else {
                    Swal.fire({
                        title: "ไม่สามารถลบข้อมูลได้",
                        text: "มีข้อผิดพลาดในการลบข้อมูลข่าวสาร",
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

function save_new() {
    var newName = $('#newName').val();
    var newDetail = $('#newDetail').val();
    var newStd = $('#newStd').val();
    var newTime = $('#newTime').val();
    var newImg = $('#newImg')[0].files[0];
    var userId = $('#userId').val();

    if(newName == "" || newDetail == "" || newStd == "" || newTime == "" || !newImg || userId == "") {
        Swal.fire({
            title: "กรุณากรอกข้อมูลให้ครบ",
            text: "คุณกรอกข้อมูลไม่ครบ กรุณากรอกข้อมูลแล้วลองอีกครั้ง",
            icon: "warning"
        });
    } else {
        var formData = new FormData();
        formData.append('newName', newName);
        formData.append('newDetail', newDetail);
        formData.append('newStd', newStd);
        formData.append('newTime', newTime);
        formData.append('newImg', newImg);
        formData.append('userId', userId);

        $.ajax({
            url: 'premaket_data/api/add_premaket.php',
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
                        $('#addDatanew').modal('hide');
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


function updateshownew(newID) {
    // ตรวจสอบข้อมูลที่ส่งเข้ามา
    $('#editDatanew').modal('show');

    // ตั้งค่าข้อมูลห้องพัก
    $('#edit_newID').val(newID.newID);
    $('#edit_newTitle').val(newID.newTitle);
    $('#edit_newDetail').val(newID.newDetail);
    $('#edit_newType').val(newID.newType);
    $('#edit_newTime').val(newID.newDate);
    $('#edit_newImg').val(newID.newImg);
    $('#edit_userId').val(newID.user_userID);
}

function update_new() {
    // รับค่าจากฟอร์ม
    var newID = document.getElementById('edit_newID').value;
    var newTitle = document.getElementById('edit_newTitle').value;
    var newDetail = document.getElementById('edit_newDetail').value;
    var newType = document.getElementById('edit_newType').value;
    var newTime = document.getElementById('edit_newTime').value;
    var newImg = document.getElementById('edit_newImg').files[0];
    var userID = document.getElementById('edit_userId').value;

    // สร้าง FormData object
    var formData = new FormData();
    formData.append('newID', newID);
    formData.append('newTitle', newTitle);
    formData.append('newDetail', newDetail);
    formData.append('newType', newType);
    formData.append('newTime', newTime);
    formData.append('newImg', newImg);
    formData.append('userID', userID);

    // ส่งข้อมูลไปยังไฟล์ PHP
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "premaket_data/api/update_new.php", true);

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






 
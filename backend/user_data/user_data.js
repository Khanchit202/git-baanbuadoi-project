
function delete_data(userID) {
    console.log(userID);
    Swal.fire({
        title: "ยืนยันการลบ",
        text: "ลบข้อมูลของผู้ใช้เลขที่ " + userID + " หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ยืนยัน, ลบบัญชี",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'user_data/api/delete.php',
                type: 'POST',
                dataType: 'json',
                data: { userID: userID }
            })
            .done(function(response) {
                if (response.status == 'ok') {
                    Swal.fire({
                        title: "ลบข้อมูลสำเร็จ",
                        text: "ข้อมูลของผู้ใช้ถูกลบเรียบร้อยแล้ว",
                        icon: "success"
                    }).then(() => {
                        window.location.reload(); // Refresh the page
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

function save_data(){
    var userName = $('#userName').val();
    var userFName = $('#userFName').val();
    var userLName = $('#userLName').val();
    var userTel = $('#userTel').val();
    var userEmail = $('#userEmail').val();
    var userLavelID = $('#userLavelID').val();

    console.log("ชื่อ: " + userName);
    console.log("หลักสูตร: " + userFName);
    console.log("เพศ: " + userLName);
    console.log("อายุ: " + userTel);
    console.log("อีเมล: " + userEmail);
    console.log("อีเมล: " + userEmail);

    if(userName == "" || userFName == "" || userLName == ""
       || userTel == "" || userEmail == "" || userLavelID == ""
    ){
        Swal.fire({
            title: "กรุณากรอกข้อมูลให้ครบ",
            text: "คุณกรอกข้อมูลไม่ครบ กรุณากรอกข้อมูลแล้วลองอีกครั้ง",
            icon: "warning"
          });
    }else{
        $.ajax({
            url: 'user_data/api/add_data.php',
            type: 'POST',
            dataType: 'json',
            data: {
                userName: userName,
                userFName: userFName,
                userLName: userLName,
                userTel: userTel,
                userEmail: userEmail,
                userLavelID: userLavelID
            },
        })
        .done(function(result) {
            if (result.status == 'ok') {
                Swal.fire({
                    title: "บันทึกข้อมูลสำเร็จ",
                    text: "",
                    icon: "success",
                    didClose: () => {
                        $('#addDataModal').modal('hide');
                        window.location.reload(); // Refresh the page
                    }
                });
            }else{
                Swal.fire({
                    title: "บันทึกข้อมูลไม่สำเร็จ",
                    text: "",
                    icon: "error"
                  });
            }
        })
        .fail(function() {
            console.log("error");
        })
        .always(function() {
            console.log("complete");
        });

    }

}

var id;
function reset(userID) {
    // ตรวจสอบข้อมูลที่ส่งเข้ามา
    $('#editdatauser').modal('show');

    
    $('#edit_userLavelID').val(userID.userLavelID);
    
}

function update_data() {
    var id = $('#edit_userID').val(); // สมมติว่ามี input field สำหรับ id
    var level = $('#edit_userLavelID').val();
    
    $.ajax({
        url: 'user_data/api/updatadata.php',
        type: 'POST',
        dataType: 'json',
        data: {
            id: id,
            level: level,
        },
        beforeSend: function() {
            console.log("Sending data:", {
                id: id,
                level: level,
            });
        }
    })
    .done(function(result) {
        console.log("Response received:", result);
        if (result.status === 'success') {
            swal({
                title: "Success",
                text: result.message,
                icon: "success",
                button: "OK",
            }).then(() => {
                // ปิด Modal
                $('#editdatauser').modal('hide');
                // รีเฟรชข้อมูลใหม่
                location.reload();
            });
        } else {
            swal({
                title: "Error",
                text: result.message,
                icon: "error",
                button: "OK",
            });
        }
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
}






 function resetpass(userID) {
    console.log(userID);
    Swal.fire({
        title: "คุณต้องการ Reset รหัสผ่านหรือไม่",
        text: "Reset รหัสผ่าน ข้อมูลของผู้ใช้เลขที่ " + userID + " หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ยืนยัน,",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            
            $.ajax({
                url: 'user_data/api/edit.php',
                type: 'POST',
                dataType: 'json',
                data: { userID: userID,
                 }
            })
            .done(function(response) {
                if (response.status == 'ok') {
                    Swal.fire({
                        title: "Reset รหัสผ่านเรียบร้อบ",
                        text: "",
                        icon: "success"
                    }).then(() => {
                        window.location.reload(); // Refresh the page
                    });
                } else {
                    Swal.fire({
                        title: "ไม่สามารถReset รหัสผ่านได้",
                        text: "มีข้อผิดพลาดในการReset รหัสผ่านของผู้ใช้",
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
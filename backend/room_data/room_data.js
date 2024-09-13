
function delete_room(roomID) {
    console.log(roomID);
    Swal.fire({
        title: "ยืนยันการลบ",
        text: "ลบข้อมูลห้องพักเลขที่ " + roomID + " หรือไม่?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "ยืนยัน, ลบบัญชี",
        cancelButtonText: "ยกเลิก"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: 'room_data/api/delete.php',
                type: 'POST',
                dataType: 'json',
                data: { roomID: roomID }
            })
            .done(function(response) {
                if (response.status == 'ok') {
                    Swal.fire({
                        title: "ลบข้อมูลสำเร็จ",
                        text: "ข้อมูลห้องพักถูกลบเรียบร้อยแล้ว",
                        icon: "success"
                    }).then(() => {
                        window.location.reload(); // Refresh the page
                    });
                } else {
                    Swal.fire({
                        title: "ไม่สามารถลบข้อมูลได้",
                        text: "มีข้อผิดพลาดในการลบข้อมูลห้องพัก",
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


function save_room() {
    var roomName = $('#roomName').val();
    var roomDetail = $('#roomDetail').val();
    var roomBed = $('#roomBed').val();
    var roomBath = $('#roomBath').val();
    var roomLo = $('#roomLo').val();
    var roomMax = $('#roomMax').val();
    var roomMin = $('#roomMin').val();
    var roomPrice = $('#roomPrice').val();
    var roomStd = $('#roomStd').val();
    var roomImage = $('#roomImage')[0].files[0];

    if(roomName == "" || roomDetail == "" || roomBed == "" || roomBath == "" || roomLo == "" || roomMax == "" || roomMin == "" || roomPrice == "" || roomStd == "" || !roomImage) {
        Swal.fire({
            title: "กรุณากรอกข้อมูลให้ครบ",
            text: "คุณกรอกข้อมูลไม่ครบ กรุณากรอกข้อมูลแล้วลองอีกครั้ง",
            icon: "warning"
        });
    } else {
        var formData = new FormData();
        formData.append('roomName', roomName);
        formData.append('roomDetail', roomDetail);
        formData.append('roomBed', roomBed);
        formData.append('roomBath', roomBath);
        formData.append('roomLo', roomLo);
        formData.append('roomMax', roomMax);
        formData.append('roomMin', roomMin);
        formData.append('roomPrice', roomPrice);
        formData.append('roomStd', roomStd);
        formData.append('roomImage', roomImage);

        $.ajax({
            url: 'room_data/api/Add_room.php',
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
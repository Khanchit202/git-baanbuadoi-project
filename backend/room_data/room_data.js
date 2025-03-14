
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
    var roomShow = $('#roomShow').is(':checked') ? 1 : 0;
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
        formData.append('roomShow', roomShow);
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


function updateshow(roomID) {
    // ตรวจสอบข้อมูลที่ส่งเข้ามา
    $('#editDataroom').modal('show');

    // ตั้งค่าข้อมูลห้องพัก
    $('#edit_roomID').val(roomID.roomID);
    $('#edit_roomName').val(roomID.roomName);
    $('#edit_roomDetail').val(roomID.roomDetail);
    $('#edit_roomBed').val(roomID.roomBed);
    $('#edit_roomBath').val(roomID.roomBath);
    $('#edit_roomLo').val(roomID.roomLocation);
    $('#edit_roomMax').val(roomID.roomMax);
    $('#edit_roomMin').val(roomID.roomMin);
    $('#edit_roomPrice').val(roomID.roomPrice);
    $('#edit_roomShow').prop('checked', roomID.roomShow == 1); // ตั้งค่า checkbox
    $('#edit_roomStd').val(roomID.stdID);
}


function update_room() {
    // รับค่าจากฟอร์ม
    var roomID = document.getElementById('edit_roomID').value;
    var roomName = document.getElementById('edit_roomName').value;
    var roomDetail = document.getElementById('edit_roomDetail').value;
    var roomBed = document.getElementById('edit_roomBed').value;
    var roomBath = document.getElementById('edit_roomBath').value;
    var roomLo = document.getElementById('edit_roomLo').value;
    var roomMax = document.getElementById('edit_roomMax').value;
    var roomMin = document.getElementById('edit_roomMin').value;
    var roomPrice = document.getElementById('edit_roomPrice').value;
    var roomShow = document.getElementById('edit_roomShow').checked ? 1 : 0;
    var roomStd = document.getElementById('edit_roomStd').value;
    var roomImg = document.getElementById('edit_roomImg').files[0];

    // แสดงค่าที่รับมาที่คอนโซล
    console.log("roomID: " + roomID);
    console.log("roomName: " + roomName);
    console.log("roomDetail: " + roomDetail);
    console.log("roomBed: " + roomBed);
    console.log("roomBath: " + roomBath);
    console.log("roomLo: " + roomLo);
    console.log("roomMax: " + roomMax);
    console.log("roomMin: " + roomMin);
    console.log("roomPrice: " + roomPrice);
    console.log("roomShow: " + roomShow);
    console.log("roomStd: " + roomStd);
    console.log("roomImg: ", roomImg);

    // สร้าง FormData object
    var formData = new FormData();
    formData.append('roomID', roomID);
    formData.append('roomName', roomName);
    formData.append('roomDetail', roomDetail);
    formData.append('roomBed', roomBed);
    formData.append('roomBath', roomBath);
    formData.append('roomLo', roomLo);
    formData.append('roomMax', roomMax);
    formData.append('roomMin', roomMin);
    formData.append('roomPrice', roomPrice);
    formData.append('roomShow', roomShow);
    formData.append('roomStd', roomStd);
    formData.append('roomImg', roomImg);

    // ส่งข้อมูลไปยังไฟล์ PHP
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "room_data/api/update_room.php", true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                // ปิด Modal ก่อน
                $('#editDataroom').modal('hide');
                
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





 
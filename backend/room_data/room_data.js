
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
    // Get form data
    const roomName = document.getElementById('roomName').value;
    const roomDetail = document.getElementById('roomDetail').value;
    const roomBed = document.getElementById('roomBed').value;
    const roomBath = document.getElementById('roomBath').value;
    const roomMax = document.getElementById('roomMax').value;
    const roomMin = document.getElementById('roomMin').value;
    const roomPrice = document.getElementById('roomPrice').value;
    const roomStd = document.getElementById('roomStd').value;
    const roomImage = document.getElementById('roomImage').files[0];

    // Create a FormData object to send the data
    const formData = new FormData();
    formData.append('roomName', roomName);
    formData.append('roomDetail', roomDetail);
    formData.append('roomBed', roomBed);
    formData.append('roomBath', roomBath);
    formData.append('roomMax', roomMax);
    formData.append('roomMin', roomMin);
    formData.append('roomPrice', roomPrice);
    formData.append('roomStd', roomStd);
    formData.append('roomImage', roomImage);

    // Log the form data to the console
    console.log('Form Data:');
    for (let [key, value] of formData.entries()) {
        console.log(key, value);
    }

    // Send the data to the server using fetch
    fetch('room_data/api/Add_room.php', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            Swal.fire({
                icon: 'success',
                title: 'บันทึกข้อมูลสำเร็จ',
                showConfirmButton: false,
                timer: 1500
            });
            // Close the modal or reset the form if needed
        } else {
            Swal.fire({
                icon: 'error',
                title: 'เกิดข้อผิดพลาด',
                text: data.message
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'เกิดข้อผิดพลาดError',
            text: error.message
        });
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
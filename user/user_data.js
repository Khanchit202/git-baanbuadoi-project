function updateData() {
    // รับค่าจากฟอร์ม
    var username = document.getElementById('username').value;
    var fname = document.getElementById('fname').value;
    var lname = document.getElementById('lname').value;
    var tel = document.getElementById('tel').value;
    var email = document.getElementById('email').value;

    // ส่งข้อมูลไปยังไฟล์ PHP
    var xhr = new XMLHttpRequest();
    xhr.open("POST", "user/api/updatadatas.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === 'success') {
                // ปิด Modal ก่อน
                $('#editModal').modal('hide');
                
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

    var data = "username=" + encodeURIComponent(username) + 
               "&fname=" + encodeURIComponent(fname) + 
               "&lname=" + encodeURIComponent(lname) + 
               "&tel=" + encodeURIComponent(tel) + 
               "&email=" + encodeURIComponent(email) + 
               "&userId=" + encodeURIComponent(userId);

    xhr.send(data);
}



function updatepass() {
    var currentPassword = document.getElementById('currentPassword').value;
    var newPassword = document.getElementById('newPassword').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    if (newPassword !== confirmPassword) {
        Swal.fire({
            icon: 'error',
            title: 'ข้อผิดพลาด',
            text: 'รหัสผ่านใหม่ไม่ตรงกัน'
        });
        return;
    }

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'user/api/update_password.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                Swal.fire({
                    icon: response.message === 'รหัสผ่านถูกเปลี่ยนเรียบร้อยแล้ว' ? 'success' : 'error',
                    title: response.message === 'รหัสผ่านถูกเปลี่ยนเรียบร้อยแล้ว' ? 'สำเร็จ' : 'ข้อผิดพลาด',
                    text: response.message
                }).then((result) => {
                    if (result.isConfirmed && response.message === 'รหัสผ่านถูกเปลี่ยนเรียบร้อยแล้ว') {
                        location.reload();
                    }
                });
            } catch (e) {
                console.error('ไม่สามารถแปลงข้อมูล JSON ได้:', e);
            }
        }
    };
    xhr.send('userID=' + userId + '&currentPassword=' + currentPassword + '&newPassword=' + newPassword);
}


function upImg() {
    var form = document.getElementById('uploadForm');
    var formData = new FormData(form);

    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'user/api/insert_img.php', true);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            try {
                var response = JSON.parse(xhr.responseText);
                Swal.fire({
                    icon: response.success ? 'success' : 'error',
                    title: response.success ? 'สำเร็จ' : 'ข้อผิดพลาด',
                    text: response.message
                }).then((result) => {
                    if (result.isConfirmed && response.success) {
                        location.reload();
                    }
                });
            } catch (e) {
                console.error('ไม่สามารถแปลงข้อมูล JSON ได้:', e);
            }
        }
    };
    xhr.send(formData);
}
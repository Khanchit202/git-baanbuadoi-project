
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
        swal('ข้อผิดพลาด', 'รหัสผ่านใหม่และยืนยันรหัสผ่านไม่ตรงกัน', 'error');
        return false;
    }

    // ส่งข้อมูลไปยังเซิร์ฟเวอร์
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'user/api/update_password.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var response = JSON.parse(xhr.responseText);
            if (response.status === "success") {
                swal('สำเร็จ', response.message, 'success').then(() => {
                    location.reload(); // รีโหลดหน้าใหม่
                });
            } else {
                swal('ข้อผิดพลาด', response.message, 'error');
            }
        }
    };
    xhr.send('currentPassword=' + encodeURIComponent(currentPassword) + 
             '&newPassword=' + encodeURIComponent(newPassword));

    return false; // ป้องกันการรีเฟรชหน้า
}

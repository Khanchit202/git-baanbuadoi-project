function updateData() {
    // รับค่าจากฟอร์ม
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
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
               "&password=" + encodeURIComponent(password) + 
               "&fname=" + encodeURIComponent(fname) + 
               "&lname=" + encodeURIComponent(lname) + 
               "&tel=" + encodeURIComponent(tel) + 
               "&email=" + encodeURIComponent(email);

    xhr.send(data);
}

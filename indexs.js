var html,data;

// เพิ่มข้อมูลลุกค้า
function save_data(){
    var username = $("#username").val();
    var pass = $("#pass").val();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var tel = $("#tel").val();
    var age = $("#age").val();
    var gender = $("#gender").val();
    var location = $("#location").val();

    if(username == "" || pass == "" || fname == "" || lname == "" || email == ""|| tel == ""|| age == ""|| gender == ""|| location == ""){
        Swal.fire({
            title: "กรุณาระบุข้อมูลให้ครบ",
            text: "",
            icon: "warning"
          });
    }else{
        $.ajax({
            url: 'user/insert_user.php',
            type: 'POST',
            dataType: 'json',
            data: {
                username: username,
                pass: pass,
                fname: fname,
                lname: lname,
                email: email,
                tel: tel,
                age: age,
                gender: gender,
                location: location
                
            },
        })
        .done(function(result) {
            
            if(result.status == 'ok'){
                Swal.fire({
                    title: "บันทึกข้อมูลสำเร็จ",
                    text: "",
                    icon: "success",
                    didClose:() => {
                        window.location.href = 'index.php';
                    }
                  });
                  
            }else{
                Swal.fire({
                    title: "ไม่สามารถบันทึกข้อมูล",
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
//end
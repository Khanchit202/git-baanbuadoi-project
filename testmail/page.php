<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<form id="myForm" action="">
    <div class="msg"></div>
    
    <div class="form-control">
        <h2>name</h2>  
        <input type="text" id="name" class="txt">  
    </div>
    <div class="form-control">
        <h2>EMAIL</h2>  
        <input type="text" id="email" class="txt">  
    </div>
    <div class="form-control">
        <h2>Head</h2>  
        <input type="text" id="header" class="txt">  
    </div>
    <div class="form-control">
        <h2>Detail</h2>  
        <textarea id="detail" class="txt"></textarea>
    </div>

    <button type="button" onclick="senEmail()" class="btn-submit">ส่ง</button>
</form>

<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script type="text/javascript">
    function senEmail() {
        var name = $("#name");
        var email = $("#email");
        var header = $("#header");
        var detail = $("#detail");

        console.log(name);  // Corrected typo

        if (isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(header) && isNotEmpty(detail)) {
            $.ajax({
                url: 'send_email.php',
                method: 'POST',
                dataType: 'json',
                data: {
                    name: name.val(),
                    email: email.val(),
                    header: header.val(),
                    detail: detail.val()
                },
                success: function (response) {
                    $("#myForm")[0].reset();
                    $('.msg').text("สำเร็จ");
                },
                error: function () {
                    $('.msg').text("เกิดข้อผิดพลาด กรุณาลองอีกครั้ง");
                }
            });
        } else {
            $('.msg').text("กรุณากรอกข้อมูลให้ครบถ้วน");
        }
    }

    function isNotEmpty(field) {
        return field.val().trim() !== "";
    }
</script>
    
</body>
</html>

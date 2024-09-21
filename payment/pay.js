function formatCardNumber(input) {
    var value = input.value.replace(/\D/g, '');
    var formattedValue = value.replace(/(.{4})/g, '$1-').trim();
    input.value = formattedValue.substring(0, 19);
}


function formatExpiryDate(input) {
    var value = input.value.replace(/\D/g, '');
    if (value.length >= 2) {
        input.value = value.substring(0, 2) + '/' + value.substring(2, 4);
    }
}

function goBack() {
    window.history.back();
}

function goHis() {
    window.location.href = '../user_history.php';
}
function goSkip() {
    Swal.fire({
        title: "โปรดชำระเงินภายในเวลาที่กำหนด",
        text: "การจองจะถูกยกเลิก หากยังไม่ดำเนินการชำระเงินภายใน 3 วัน",
        icon: "info",
        showCancelButton: true,
        confirmButtonText: 'ยืนยัน, ดำเนินการภายหลัง',
        cancelButtonText: 'ยกเลิก'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '../user_history.php';
        }
    });
}
function qrPayment(payId){
    var qrname = $('#qr_name').val();
    var qrdate = $('#qr_date').val();
    var qrbank = $('#qr_bank').val();
    var qrprice = $('#qr_price').val();

    if (qrname === "") {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกข้อมูล: ชื่อบัญชี',
        }).then(() => {
            document.getElementById("qr_name").focus();
        });
    }else if(qrdate === "") {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกข้อมูล: วันชำระเงิน',
        }).then(() => {
            document.getElementById("qr_name").focus();
        });
    }else if(qrbank === "") {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกข้อมูล: ชื่อธนาคาร',
        }).then(() => {
            document.getElementById("qr_name").focus();
        });
    }else if(qrprice === "") {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกข้อมูล: จำนวนเงิน',
        }).then(() => {
            document.getElementById("qr_name").focus();
        });
    }else{

        $.ajax({
            url: 'promt_pay/qrpay.php',
            type: 'POST',
            data: {
                payId: payId,
                qrname: qrname,
                qrdate: qrdate,
                qrbank: qrbank,
                qrprice: qrprice,
            }
        })
        .done(function(response) {
            if (response === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'การจองสำเร็จ'
                }).then(() => {
                    window.location.href = '../user_history.php';
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'มีบ้างอย่างผิดพลาดโปรดลองอีกครั้ง!',
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
}

function creditPayment(payId){
    var creditNumber = $('#credit_number').val();
    var creditfname = $('#first_name').val();
    var creditlname = $('#last_name').val();
    var creditdate = $('#credit_date').val();
    var creditcvv = $('#cvv').val();
    
    console.log(payId)
    console.log(creditNumber)
    console.log(creditfname)
    console.log(creditlname)
    console.log(creditdate)
    console.log(creditcvv)


    if (creditNumber === "") {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกข้อมูล: เลขบัตรเคดิต',
        }).then(() => {
            document.getElementById("credit_number").focus();
        });
    }else if(creditfname === "") {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกข้อมูล: ชื่อผู้ถือบัตร',
        }).then(() => {
            document.getElementById("first_name").focus();
        });
    }else if(creditlname === "") {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกข้อมูล: นามสกุลผู้ถือบัตร',
        }).then(() => {
            document.getElementById("last_name").focus();
        });
    }else if(creditdate === "") {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกข้อมูล: วันหมดอายุบัตร',
        }).then(() => {
            document.getElementById("credit_date").focus();
        });
    }else if(creditcvv === "") {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกข้อมูล: กรอกเลข CVV',
        }).then(() => {
            document.getElementById("cvv").focus();
        });
    }else{

        $.ajax({
            url: 'credit_pay/credit.php',
            type: 'POST',
            data: {
                payId: payId,
                creditNumber: creditNumber,
                creditfname: creditfname,
                creditlname: creditlname,
                creditdate: creditdate,
                creditcvv: creditcvv
            }
        })
        .done(function(response) {
            if (response === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'การจองสำเร็จ'
                }).then(() => {
                    window.location.href = '../user_history.php';
                });
            }else if (response === "no") {
                Swal.fire({
                    icon: 'error',
                    title: 'ไม่พบข้อมูลบัตรเคดิต'+payId,
                    text: 'ไม่สามารถตัดค่าบริการได้'
                });
            }else if (response === "error") {
                Swal.fire({
                    icon: 'error',
                    title: 'error',
                    text: 'ไม่สามารถตัดค่าบริการได้'
                });
            }  else {
                Swal.fire({
                    icon: 'error',
                    title: 'มีบ้างอย่างผิดพลาดโปรดลองอีกครั้ง!',
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
    
}
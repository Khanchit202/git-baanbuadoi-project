function showBookingForm(roomId) {
    document.getElementById('booking_form').style.display = 'block';
    document.getElementById("booking_form").scrollIntoView({
        behavior: 'smooth'
    });
}

var lastBookingDate = "";
var lastBookingTime = "";

    $('#booking_date').on('change', function() {
        var currentBookingDate = $(this).val();
        var currentBookingTime = $('#time').val();

        if (currentBookingDate !== lastBookingDate || currentBookingTime !== lastBookingTime) {
            $('#customer_info').hide();
            $('#reserved').hide();
            lastBookingDate = currentBookingDate;
            lastBookingTime = currentBookingTime;
        }
    });

    $('#time').on('change', function() {
        var currentBookingTime = $(this).val();
        if (currentBookingTime !== lastBookingTime) {
            $('#customer_info').hide();
            $('#reserved').hide();
            lastBookingTime = currentBookingTime;
        }
    });


        function checkBooking(serviceId) {
            var bookingDate = $('#booking_date').val();
            var bookingTime = $('#time').val();

            console.log(bookingDate)
            console.log(bookingTime)
            console.log(serviceId)
        
            if (bookingDate === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณาเลือกวันที่ต้องการเข้าพัก',
                });
                return;
            }
            if (bookingTime === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณาเลือกวันที่ต้องการเข้าพัก',
                });
                return;
            }
        
            $.ajax({
                url: 'check_booking.php',
                type: 'POST',
                data: {
                    serviceId: serviceId, 
                    bookingDate: bookingDate,
                    bookingTime: bookingTime
                },
                success: function(response) {
                    console.log(response);
                    if (response === "available") {
                        $('#customer_info').show();
                        document.getElementById("customer_info").scrollIntoView({
                            behavior: 'smooth'
                        });
                    } else if (response === "booked") {
                        $('#reserved').show();
                        document.getElementById("reserved").scrollIntoView({
                            behavior: 'smooth'
                        });
                    } else if (response === "oldday") {
                        Swal.fire({
                            icon: 'warning',
                            title: 'กรุณาเลือกวันที่ต้องการเข้าพัก',
                            text: "คุณเลือกวันที่ย้อนหลัง",
                            confirmButtonText: 'ตกลง'
                        });
                    }
                }
            });
        }        

function confirmBooking(serviceId) {
    var customerName = $('#customer_name').val();
    var customerPhone = $('#customer_phone').val();
    var customerDetail = $('#customer_detail').val();
    var customerPro = $('#customer_pro').val();
    var customerPrice = $('#price').val();
    var bookingDate = $('#booking_date').val();
    var bookingTime = $('#time').val();
    var paymentMethods = [];

    const payment1 = document.getElementById('payment1');
    const payment2 = document.getElementById('payment2');

    console.log(customerName)
    console.log(customerPhone)
    console.log(customerDetail)
    console.log(customerPro)
    console.log(customerPrice)
    console.log(bookingDate)
    console.log(bookingTime)
    console.log(paymentMethods)
    
    
    if ($('#payment1').is(':checked')) {
        paymentMethods.push($('#credit_card').val());
    }
    
    if ($('#payment2').is(':checked')) paymentMethods.push($('#payment2').val());

    if (customerName === "" || customerPhone === "" || paymentMethods.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'กรุณากรอกข้อมูลให้ครบ',
        });
        return;
    }

    let paymentMethod = null;

        if (payment1.checked) {
            paymentMethod = payment1.value;
        } else if (payment2.checked) {
            paymentMethod = payment2.value;
        }

        $.ajax({
            url: 'confirm_booking.php',
            type: 'POST',
            data: {
                serviceId: serviceId,
                name: customerName,
                phone: customerPhone,
                detail: customerDetail,
                promotion: customerPro,
                price: customerPrice,
                date: bookingDate,
                time: bookingTime,
                pay: paymentMethod
                }
        })
        .done(function(response) {
            let data = JSON.parse(response);
            if (data.status === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'การจองสำเร็จ'
                }).then(() => {
                    window.location.href = '../payment/payment_service.php?payId=' + data.payID;
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
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

function showAlearLogin(){
    Swal.fire({
        icon: 'warning',
        title: 'กรุณาเข้าสู่ระบบ',
        text: "โปรดเข้าสู่ระบบก่อนทำรายการ",
        confirmButtonText: 'ตกลง'
    });
}

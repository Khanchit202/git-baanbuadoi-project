function showBookingForm(roomId) {
    document.getElementById('booking_form').style.display = 'block';
}

var lastBookingDate = "";

        $('#booking_date').on('change', function() {
            var currentBookingDate = $(this).val();
            if (currentBookingDate !== lastBookingDate) {
                $('#customer_info').hide();
                $('#reserved').hide();
                lastBookingDate = currentBookingDate;
            }
        });

        function checkBooking(roomId) {
            var bookingDate = $('#booking_date').val();

            if (bookingDate === "") {
                Swal.fire({
                    icon: 'warning',
                    title: 'กรุณาเลือกวันที่ต้องการเข้าพัก',
                });
                return;
            }

            $.ajax({
                url: 'check_booking.php',
                type: 'POST',
                data: {roomId: roomId, bookingDate: bookingDate},
                success: function(response) {
                    console.log(response);
                    if (response === "available") {
                        $('#customer_info').show();
                        console.log(response);
                    } else if (response === "booked") {
                        $('#reserved').show();
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

function confirmBooking(roomId) {
    var customerName = $('#customer_name').val();
    var customerPhone = $('#customer_phone').val();
    var customerDetail = $('#customer_detail').val();
    var customerPro = $('#customer_pro').val();
    var customerPrice = $('#price').val();
    var bookingDate = $('#booking_date').val();
    var paymentMethods = [];

    console.log(customerName)
    console.log(customerPhone)
    console.log(customerDetail)
    console.log(customerPro)
    console.log(customerPrice)
    console.log(bookingDate)
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

    $.ajax({
        url: 'confirm_booking.php',
        type: 'POST',
        data: {
            roomId: roomId,
            name: customerName,
            phone: customerPhone,
            detail: customerDetail,
            promotion: customerPro,
            price: customerPrice,
            date: bookingDate
        },
        success: function(response) {
            if (response === "success") {
                Swal.fire({
                    icon: 'success',
                    title: 'การจองสำเร็จ',
                }).then(() => {
                    $('#credit_card').show();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'เกิดข้อผิดพลาด',
                });
            }
        }
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

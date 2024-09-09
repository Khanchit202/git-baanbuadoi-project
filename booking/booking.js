var user_id;

function getCheckDate(room_id) {
    document.getElementById("check_date").innerHTML = `
        <div class="row">
            <input id="booking-date" class="col-md-2 form-control" type="date">
            <button id="check-btn" class="col-md-7 btn btn-custom" onclick="statusDate(${room_id})" style="width: 200px;">ตรวจสอบ</button>
        </div>
    `;
}

function statusDate() {
    var dateString = document.getElementById("booking-date").value;
    var date = new Date(dateString);

    var thaiMonths = [
        'มกราคม', 'กุมภาพันธ์', 'มีนาคม', 'เมษายน', 'พฤษภาคม', 'มิถุนายน',
        'กรกฎาคม', 'สิงหาคม', 'กันยายน', 'ตุลาคม', 'พฤศจิกายน', 'ธันวาคม'
    ];
    
    var year = date.getFullYear() + 543; // เพิ่ม 543 เพื่อเปลี่ยนเป็น พ.ศ.
    var month = thaiMonths[date.getMonth()]; // เดือนในภาษาไทย
    var day = date.getDate();
    var formattedDate = day + ' ' + month + ' ' + year;

    // แสดงวันที่เลือก
    document.getElementById("check_date").innerHTML = `
        <div class="row mb-2 mt-3">
            <div class="col-md-3 fw-bold"><p>วันที่เลือก</p></div> 
            <div class="col-md-2 bg-light text-center" style="margin:0; padding:0; border-radius: 10px;">
                <h3 class="fw-bold" style="font-size:14px;">${formattedDate}</h3>
            </div>
        </div>
    `;
    
 true;
}





// $(document).ready(function() {

//     var selectedData = {};
//     function getBookingBill(selectedId) {
//         $.ajax({
//             url: 'getBookingBill.php',
//             type: 'POST',
//             dataType: 'json',
//             data: { id: selectedId }, // ส่ง ID ที่เลือกไปยังเซิร์ฟเวอร์
            
//         })
//         .done(function(result) {
//             if (result.data) {
//                 console.log(result.data);
//                 selectedData = result.data; // เก็บข้อมูลในตัวแปร global
//                 document.getElementById('selected-date').innerHTML = '<h3 class="fw-bold" style="font-size:14px; margin-top:10px;">' + selectedData.payID + '</h3>';
                
//                 // ตรวจสอบข้อมูลหลังจากการดึงข้อมูลเสร็จ
//                 console.log("ข้อมูลที่เก็บไว้: ", selectedData);
//             } else {
//                 console.log(result.error);
//             }
//         })
//         .fail(function() {
//             console.log("error");
//         })
//         .always(function() {
//             console.log("complete");
//         });
//     }

//     // เรียกใช้ฟังก์ชัน getBookingBill หลังจากเอกสารโหลด
//     getBookingBill('00003'); // ใส่ ID ที่ต้องการ

//     console.log("ข้อมูลที่เก็บไว้ภายนอก: ",selectedData)
// });




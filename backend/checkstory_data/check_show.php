<p style="font-size: 16px; padding: 5px 20px;">ประวัติการทำรายการ</p>

<div id="user-table" style="background-color: white; border-radius: 10px; padding: 20px; font-size: 14px; height: 150px; margin-bottom: 10px; display: flex; justify-content: center; align-items: center;">
    <form id="search-form" style="display: flex; gap: 10px;">
        <input type="text" id="search-input" placeholder="ค้นหาชื่อผู้จอง.." style="padding: 5px; border-radius: 5px; border: 1px solid #ccc;" onkeyup="searchBooking()"/>
        <button type="button" onclick="searchBooking()" style="padding: 5px 10px; border-radius: 5px; background-color: #007bff; color: white; border: none;">ค้นหา</button>
    </form>
</div>

<div id="result-table" style="background-color: white; border-radius: 10px; padding: 20px; font-size: 14px; height: 100%;">
    
</div>

<script>
function searchBooking() {
    let query = document.getElementById('search-input').value;
    
    fetch('checkstory_data/search_booking.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'query=' + encodeURIComponent(query)
    })
    .then(response => response.text())
    .then(data => {
        document.getElementById('result-table').innerHTML = data;
    })
    .catch(error => console.error('Error:', error));
}

window.onload = function() {
    searchBooking();
};

</script>

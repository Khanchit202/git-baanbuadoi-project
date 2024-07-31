<div class="container mt-5">
    <form class="d-flex align-items-center p-4" style="background-color: #f8f9fa; border-radius: 20px;">
        <select class="form-control" id="roomType" style="margin-right: 10px; border-radius: 20px;">
            <option value="">ประเภทห้องพักและบริการ</option>
            <option value="1">Type 1</option>
            <option value="2">Type 2</option>
            <option value="3">Type 3</option>
        </select>
        <input type="text" class="form-control datepicker" id="startDate" placeholder="วันเข้าพัก" style="margin-right: 10px; border-radius: 20px;" readonly>
        <input type="text" class="form-control datepicker" id="endDate" placeholder="วันสิ้นสุด" style="margin-right: 10px; border-radius: 20px;" readonly>
        <button type="submit" class="btn btn-success" style="margin-left: auto; border-radius: 20px;">ค้นหา</button>
    </form>
</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Bootstrap Datepicker JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<script>
    $(document).ready(function() {
        $('.datepicker').datepicker({
            format: 'dd M yy',
            autoclose: true
        });
    });
</script>
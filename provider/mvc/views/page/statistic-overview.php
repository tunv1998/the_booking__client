<div class="row mb-3">
    <div class="col-6">
        <?php
        require_once 'public/block/chart/pie-countbooking.php';
        ?>
    </div>
    <div class="col-6">
        <?php
        require_once 'public/block/chart/pie-countbooking-month.php';
        ?>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tổng lượt đặt phòng từng năm</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="col-2">
                    <label for="bookingSelectYear">Nhập năm: </label>
                    <input type="number" value="<?php echo date("Y"); ?>" id="bookingSelectYear" min="2010" max="2100" class="form-control"/>
                </div>
                <p id="sumBookingYear" class="m-3 text-primary h5"></p>
                <div class="chart-bar-totalBookingYear pt-4" style="position: relative; height:450px;" class="mw-100">
                    <canvas id="totalBookingYear"></canvas>
                </div>
                <hr>
                Thống kê lượt đặt phòng theo năm của tất cả khách sạn.
            </div>
        </div>
    </div>
</div>
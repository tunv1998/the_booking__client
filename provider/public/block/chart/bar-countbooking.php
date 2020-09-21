<div class="card shadow mb-4">
    <!-- Card Header - Dropdown -->
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Lượt đặt phòng của một khách sạn</h6>
    </div>
    <!-- Card Body -->
    <div class="card-body">
        <div class="chart-filter mb-3">
            <div class="col-3">
                <select name="hotelName" id="hotelName" class="form-control">
                    <option value="" selected>Chọn khách sạn</option>
                    <?php foreach ($data['hotel'] as $key => $value) : ?>
                        <option value="<?php echo $value['hotel_id'] ?>"><?php echo $value['hotel_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="chart-bar-countbooking pt-4" style="position: relative; height:300px; width:80vw">
            <canvas id="countHotelBooking"></canvas>
        </div>
        <hr>
        Thống kê toàn bộ lượt đặt phòng trong 12 tháng của khách sạn.
    </div>
</div>
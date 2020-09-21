<div class="row my-3">
    <div class="col-3">
        <select name="" id="revenueChooseHotel" class="custom-select">
            <option value="" selected>Chọn khách sạn</option>
            <?php foreach ($data['listHotel'] as $key => $value) : ?>
                <option value="<?php echo $value['hotel_id'] ?>"><?php echo $value['hotel_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tổng doanh thu theo tháng / năm</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p class="h5">Lọc theo tháng hoặc năm</p>
                <div class="row">
                    <div class="col-2">
                        <label for="revenueDetailMonth">Nhập tháng: </label>
                        <input type="number" value="" id="revenueDetailMonth" min="1" max="12" class="form-control" />
                    </div>
                    <div class="col-2">
                        <label for="revenueDetailYear">Nhập năm: </label>
                        <input type="number" value="<?php echo date("Y"); ?>" id="revenueDetailYear" min="2010" max="2100" class="form-control" />
                    </div>
                </div>
                <p id="sumHotelRevenue" class="m-3 text-primary h5">Tổng doanh thu: 0</p>
                <div class="chart-bar-hotelRevenue pt-4" style="position: relative; height:300px;" class="mw-100">
                    <canvas id="hotelRevenue"></canvas>
                </div>
                <hr>
                Thống kê doanh thu theo năm của tất cả khách sạn.
            </div>
        </div>
    </div>
</div>
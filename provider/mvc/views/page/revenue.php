<div class="row">
    <div class="col-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tổng doanh thu</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie-totalRevenue pt-4" style="position: relative; height:300px; max-width: 100%">
                    <canvas id="totalRevenue"></canvas>
                </div>
                <p id="showTotalRevenue" class="mt-3 h5 text-primary"></p>
                <hr>
                Thống kê tổng doanh thu của tất cả khách sạn
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tổng doanh thu tháng hiện tại</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="chart-pie-totalRevenueMonth pt-4" style="position: relative; height:300px; max-width: 100%">
                    <canvas id="totalRevenueMonth"></canvas>
                </div>
                <p id="showTotalRevenueMonth" class="mt-3 h5 text-primary"></p>
                <hr>
                Thống kê tổng doanh thu tháng hiện tại của toàn bộ khách sạn
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Tổng doanh thu theo năm</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="col-2">
                    <label for="revenueSelectYear">Nhập năm: </label>
                    <input type="number" value="<?php echo date("Y"); ?>" id="revenueSelectYear" min="2010" max="2100" class="form-control"/>
                </div>
                <p id="sumRevenueYear" class="m-3 text-primary h5"></p>
                <div class="chart-bar-totalRevenueYear pt-4" style="position: relative; height:450px;" class="mw-100">
                    <canvas id="totalRevenueYear"></canvas>
                </div>
                <hr>
                Thống kê doanh thu theo năm của tất cả khách sạn.
            </div>
        </div>
    </div>
</div>
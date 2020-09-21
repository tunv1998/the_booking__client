<div class="row m-3">
    <!--  -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-1">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng lượt đặt phòng</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="allBookingHotel">0</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-1">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng lượt khách</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="countGuest">0</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--  -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-1">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Trung bình số ngày ở</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="avgStayed">0</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Lượt đặt phòng theo tháng</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <p class="h5 text-primary" id="sumBookingHotel"></p>
                <div class="chart-bar-countBooking pt-3" style="position: relative; height:300px; width:80vw">
                    <canvas id="countHotelBooking"></canvas>
                </div>
                <hr>
                Thống kê lượt đặt phòng trong 12 tháng của khách sạn
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-6">
        <div class="card shadow mb-4">
            <!-- Card Header - Dropdown -->
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Loại phòng</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="row pl-3">
                    <div class="form-group">
                        <label for="chooseMonthRt" class="text-primary">Chọn tháng:</label>
                        <input type="month" name="" id="chooseMonthRt" class="form-control">
                    </div>
                </div>
                <div class="chart-pie-countRt pt-4" style="position: relative; height:300px;" class="mw-100">
                    <canvas id="countRoomType"></canvas>
                </div>
                <hr>
                Thống kê tỷ lệ đặt các loại phòng trong khách sạn. Mặc định là toàn bộ thời gian
            </div>
        </div>
    </div>
</div>
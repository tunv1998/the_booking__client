<div class="row mb-3">
    <div class="col-3">
        <select name="" id="selectHotelRating" class="custom-select">
            <option value="">Chọn khách sạn</option>
            <?php foreach ($data['listHotel'] as $key => $value) : ?>
                <option value="<?php echo $value['hotel_id']; ?>"><?php echo $value['hotel_name']; ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<div class="row">
    <!--  -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-1">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Tổng lượt đánh giá</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="sumAllRating">0</div>
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
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Điểm đánh giá trung bình</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800" id="avgRating">0</div>
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
            <div class="card-header py-3">

                <h6 class="m-0 font-weight-bold text-primary">Lượt đánh giá theo năm</h6>
            </div>
            <!-- Card Body -->
            <div class="card-body">
                <div class="form-group col-2">
                    <label for="ratingChooseYear">Chọn năm</label>
                    <input type="number" value="<?php echo date("Y"); ?>" class="form-control" id="ratingChooseYear" min="2000" max="2050">
                </div>
                <p class="h5 text-primary pl-2" id="sumRating">Tổng lượt đánh giá: 0 lượt</p>
                <div class="chart-bar-countRating pt-3" style="position: relative; height:300px; width:80vw">
                    <canvas id="countRating"></canvas>
                </div>
                <hr>
                Thống kê lượt đánh giá theo năm.
            </div>
        </div>
    </div>
</div>
<div class="table table-responsive my-3">
    <table id="rating_detail" class="table table-striped table-bordered table-sm dt-horizontal-scroll" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="th-sm">STT</th>
                <th class="th-sm">Người đánh giá
                </th>
                <th class="th-sm">Username
                </th>
                <th class="th-sm">Nội dung
                </th>
                <th class="th-sm">Rating
                </th>
                <th class="th-sm">Ngày đánh giá
                </th>
            </tr>
        </thead>
        <tbody id="table-rating_detail-body">
        </tbody>
    </table>
</div>
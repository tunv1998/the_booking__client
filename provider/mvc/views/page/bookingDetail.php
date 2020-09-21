<div class="row">
    <div class="col-3 mb-3">
        <select name="selectHotel" id="selectHotel" class="form-control">
            <option value="" selected>Chọn khách sạn</option>
            <?php foreach ($data['hotel'] as $key => $value) : ?>
                <option value="<?php echo $value['hotel_id'] ?>"><?php echo $value['hotel_name'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
</div>
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="chart-tab" data-toggle="tab" href="#chart" role="tab" aria-controls="chart" aria-selected="true">Biểu đồ</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="detail-tab" data-toggle="tab" href="#detail" role="tab" aria-controls="detail" aria-selected="false">Chi tiết</a>
    </li>
</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active chart-tab" id="chart" role="tabpanel" aria-labelledby="chart-tab">
        <?php require_once "public/block/tab-chartHotel.php"; ?>
    </div>
    <div class="tab-pane fade p-3" id="detail" role="tabpanel" aria-labelledby="detail-tab">
        <?php require_once "public/block/table-detailbooking.php"; ?>
    </div>
</div>
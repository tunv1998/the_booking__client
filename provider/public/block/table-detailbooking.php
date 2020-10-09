<div class="my-3">
    <p class="text-primary h5 m-2">Lọc theo ngày đặt</p>
    <div class="row m-2">
        <div class="form-group mr-3">
            <label for="dateFrom">Từ ngày</label>
            <input type="date" id="dateFrom" class="form-control" value="">
        </div>
        <div class="form-group">
            <label for="dateTo">Đến ngày</label>
            <input type="date" id="dateTo" class="form-control" value="">
        </div>
    </div>
    <button class="btn btn-danger" id="resetFilter">Xóa bộ lọc</button>
</div>
<div class="table table-responsive">
    <table id="booking_detail" class="table table-striped table-bordered table-sm dt-horizontal-scroll" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th class="th-sm">STT</th>
                <th class="hidenCol">ID</th>
                <th class="th-sm">Người đặt
                </th>
                <th class="th-sm">SĐT
                </th>
                <th class="th-sm">Email
                </th>
                <th class="th-sm">Tổng số khách
                </th>
                <th class="th-sm">S.Lượng phòng
                </th>
                <th class="th-sm">Loại phòng
                </th>
                <th class="th-sm">Số ngày ở
                </th>
                <th class="th-sm">Ngày check-in
                </th>
                <th class="th-sm">Ngày check-out
                </th>
                <th class="th-sm">Ngày đặt phòng
                </th>
                <th class="th-sm">Trạng thái
                </th>
                <th class="th-sm">Thanh toán
                </th>
            </tr>
        </thead>
        <tbody id="table-detail-body">
        </tbody>
    </table>
</div>
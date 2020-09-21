<!-- view -->
<div class="row">
    <!-- edit img -->
    <div class="col-xl-4 col-md-5">
        <img src="https://www.amjatravels.com/image/cache/catalog/hotels/sri-lanka/the-gateway-hotel-airport-garden-colombo-katunayake/gateway-airport-garden-hotel-32370-650x500-500x500.jpg" alt="" class="w-100 rounded mb-4">
    </div>
    <!-- Edit Info -->

    <div class="col-xl-8 col-md-7">
        <!-- room child name -->
        <form action="" method="post" multiple="multiple">
            <h4>Tên Phòng</h4>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="">
                        <i class="fas fa-hotel"></i>
                    </span>
                </div>
                <input type="text" id="room-name" class="form-control" placeholder="Tên phòng" aria-label="Username" aria-describedby="basic-addon1" value="" required>
            </div>

            <hr class="divider">

            <!-- hotel address -->
            <!-- fields tags -->
            <h4 class="text-primary">Chính sách phòng</h4>
            <div>
                <div class="w-100 mb-4 p-2 border rounded" id="choosePolicy">
                </div>
                <div class="d-flex flex-wrap policy">
                    <!-- Group of default radios - option 1 -->
                    <?php
                    foreach ($data['id_group'] as $key1 => $value1) {
                        foreach ($data['list_policy'] as $key2 => $value2) {
                            if ($value1 == $value2['group_id']) {
                                echo "<div class='custom-control custom-radio col-3'>
                            <input type='radio' class='custom-control-input' id='policy-" . $value2['id'] . "' name='group-" . $value2['group_id'] . "' value='" . $value2['id'] . "'>
                            <label class='custom-control-label radio-policy' for='policy-" . $value2['id'] . "'>" . $value2['name'] . "</label>
                        </div>";
                            }
                        }
                    }
                    ?>
                </div>
            </div>
            <hr>
            <!-- hotel address -->
            <h4 class="text-primary">Đặt giá tiền theo khoảng thời gian</h4>
            <div class="border rounded mb-3" id="setPrice">
                <div class="row mb-1 p-3 setPrice position-relative" id="price-0">
                    <div class="position-absolute fixed-top" style="left: unset; right: 1rem;">
                        <button type="button" class="btn text-danger" id="delCreate" ><i class="fas fa-times" style="font-size: 1.2rem"></i></button> 
                        <input type="hidden" name="rateId" value="">
                    </div>
                    <div class="col-3">
                        <label for="from-date" class="text-danger">Ngày bắt đầu</label>
                        <input type="date" name="from-date[]" id="from-date" class="form-control from-date" min="<?php echo date('yy-m-d'); ?>" required>
                    </div>
                    <div class="col-3">
                        <label for="count_date" class="text-danger">Số ngày</label>
                        <input type="number" name="count_date" id="count_date" class="form-control count_date" placeholder="Nhập số ngày" value="1" required>
                    </div>
                    <div class="col-3">
                        <label for="to-date" class="text-danger">Ngày kết thúc</label>
                        <input type="text" name="to-date" id="to-date" class="form-control" readonly>
                    </div>
                    <div class="col-3">
                        <label for="from-date" class="text-danger">Giá tiền</label>
                        <input type="number" class="form-control" placeholder="Nhập giá tiền" aria-label="Username" aria-describedby="basic-addon1" required>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary createNewDate" type="button"><i class="fas fa-plus align-middle" style="font-size: 1.2rem;"></i></button>
            <hr>
            <div>
                <a href="" class="btn btn-danger btn-icon-split">
                    <span class="icon text-white-50">
                        <i class="fas fa-times"></i>
                    </span>
                    <span class="text">Huỷ</span>
                </a>
                <input type="button" class="btn btn-primary w-100" id="createRoomChild" value="Lưu" name="createRoomChild">
            </div>
            <div class="mb-4"></div>
        </form>
    </div>

    <div class="mb-4"></div>
</div>
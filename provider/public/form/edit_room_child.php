<!-- view -->
<div class="row">
    <!-- edit img -->
    <div class="col-xl-4 col-md-5">
        <img src="https://www.amjatravels.com/image/cache/catalog/hotels/sri-lanka/the-gateway-hotel-airport-garden-colombo-katunayake/gateway-airport-garden-hotel-32370-650x500-500x500.jpg" alt="" class="w-100 rounded mb-4">
    </div>
    <!-- Edit Info -->

    <div class="col-xl-8 col-md-7">
        <!-- room child name -->
        <h4>Tên Phòng</h4>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="">
                    <i class="fas fa-hotel"></i>
                </span>
            </div>
            <input type="text" id="room-name" class="form-control" placeholder="Tên phòng" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo isset($data['room_infor'][0]['rc_name']) ? $data['room_infor'][0]['rc_name'] : ""; ?>">
        </div>

        <hr class="divider">

        <!-- hotel address -->
        <!-- fields tags -->
        <h4 class="text-primary">Chính sách phòng hiện tại</h4>
        <div>
            <div class="w-100 mb-4 p-2 border rounded" id="choosePolicy">
                <?php  $listId = ""; foreach ($data['room_policy'] as $rpKey => $rpValue) :  ?>
                    <?php
                    $listId .= $rpValue['rp_id'] . "-"; ?>
                    <div class="badge badge-primary mr-3 mb-3" group="<?php echo "group-" . $rpValue['p_group'] ?>" style="font-size: 1rem;" pId="<?php echo $rpValue['rp_policyId'] ?>"><?php echo $rpValue['p_name'] ?></div>
                <?php endforeach; ?>
                <?php
                $listId = substr($listId, 0, strlen($listId) - 1);
                echo "<input type='hidden' name='' id='policyId' value='$listId'>";
                ?>
            </div>
            <div class="d-flex flex-wrap policy">
                <!-- Group of default radios - option 1 -->
                <?php
                $listId = "";
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
        <h4 class="text-primary">Sửa giá phòng theo khoảng</h4>
        <span>Chú thích:</span><br>
        <span>- Ngày tháng định dạng: tháng/ ngày/ năm</span><br>
        <div class="border rounded mb-3" id="setPrice">
            <?php foreach ($data['room_rate'] as $rateKey => $rateValue) : ?>
                <div class="row mb-1 p-3 setPrice position-relative" id="<?php echo "price-" . $rateKey; ?>">
                    <div class="position-absolute fixed-top" style="left: unset; right: 1rem;">
                        <button type="button" class="btn text-danger delRate"><i class="fas fa-times" style="font-size: 1.2rem"></i></button>
                        <input type="hidden" name="rateId" value="<?php echo $rateValue['rr_id']  ?>" required>
                    </div>
                    <div class="col-3">
                        <label for="from-date" class="text-danger">Ngày bắt đầu</label>
                        <input type="date" name="from-date[]" id="from-date" class="form-control from-date" min="<?php echo helper::parseDateTimeToDate($rateValue['rr_dateFrom']); ?>" value="<?php echo helper::parseDateTimeToDate($rateValue['rr_dateFrom']); ?>">
                    </div>
                    <div class="col-3">
                        <label for="count_date" class="text-danger">Số ngày</label>
                        <input type="number" name="count_date" id="count_date" class="form-control count_date" placeholder="Nhập số ngày" value="0">
                    </div>
                    <div class="col-3">
                        <label for="to-date" class="text-danger">Ngày kết thúc</label>
                        <input type="text" name="to-date" class="form-control" readonly value="<?php echo helper::convertDateToTextDate(helper::parseDateTimeToDate($rateValue['rr_dateTo'])); ?>">
                    </div>
                    <div class="col-3">
                        <label for="from-date" class="text-danger">Giá tiền</label>
                        <input type="number" class="form-control" placeholder="Nhập giá tiền" aria-label="Username" aria-describedby="basic-addon1" value="<?php echo $rateValue['rr_rate']; ?>">
                    </div>
                </div>
                <?php
                $a = count($data['room_rate']);
                if ($rateKey < $a - 1) {
                    echo "<hr>";
                }
                ?>
            <?php endforeach; ?>
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
            <input type="button" class="btn btn-primary w-100" id="editRoomChild" value="Lưu" name="editRoomChild">
        </div>
        <div class="mb-4"></div>
    </div>

    <div class="mb-4"></div>
</div>
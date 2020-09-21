<div class="wrap">
    <h4 class="text-primary mb-3">Gia hạn gói</h4>
    <div class="row p-3">
        <?php if ($data['packInfo'][0]['pack_id'] != 4) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Tên gói</th>
                        <th scope="col">Ngày mua</th>
                        <th scope="col">Ngày hết hạn</th>
                        <th scope="col">Mua thêm(Tháng)</th>
                        <th scope="col">Ngày hết hạn mới</th>
                        <th scope="col">Cần thanh toán</th>
                        <th scope="col">Hành động</th>
                    </tr>
                </thead>
                <tbody>

                    <tr>
                        <?php foreach ($data['packInfo'] as $key => $value) : ?>
                            <th scope="row"><?php echo $value['pack_name']; ?></th>
                            <td><input type="date" name="" id="packDateFrom" class="form-control" value="<?php echo $value['date_from']; ?>" disabled></td>
                            <td><input type="date" name="" id="packDateTo" class="form-control" value="<?php echo $value['date_to']; ?>" disabled></td>
                            <input type="hidden" name="" value="<?php echo $value['pack_id']; ?>" id="packId">
                            <input type="hidden" name="" value="<?php echo $value['pack_h_id']; ?>" id="packHId">
                            <input type="hidden" name="" value="<?php echo $value['price']; ?>" id="packPrice">
                            <input type="hidden" name="" value="<?php echo $value['level']; ?>" id="currentLevel">
                        <?php endforeach; ?>
                        <td><input type="number" class="form-control" value="0" max="12" min="1" id="addMonthPack"></td>
                        <td><input type="date" name="" id="newDateTo" class="form-control" disabled></td>
                        <td id="needPrice">0</td>
                        <td>
                            <button type="button" class="btn btn-primary" id="packageExtend">Gia hạn</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        <?php } else{ $id = $data['packInfo'][0]['pack_h_id'];
                                        echo "<input type='hidden' value=$id id='packHId'>";
            echo "<h5 class='text-danger'>Gói free trial không thể gia hạn<h5>"; } ?>
    </div>
    <div>
        <h4 class="text-primary mb-3">Nâng cấp gói</h4>
        <div class="row">
            <div class="col-2">
                <label for="">Chọn gói cần nâng cấp:</label>
                <select name="" id="selectPack" class="custom-select">
                    <?php foreach ($data['allPack']['pack'] as $key => $value) : ?>
                        <option value="<?php echo $value['id']; ?>" p-val="<?php echo $value['price']; ?>"><?php echo $value['name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="form-group col-2">
                <label for="">Thời gia thuê(Tháng): </label>
                <input type="number" name="" id="upPackMonth" value="0" class="form-control">
            </div>
            <div class="form-group col-2">
                <label for="">Phải thanh toán: </label>
                <input type="text" name="" id="needPay" value="0" class="form-control" disabled>
            </div>
        </div>
        <div class="mb-4">
            <button type="button" class="btn btn-primary" id="upPackage">Nâng cấp</button>
        </div>
        <div class="row">
            <?php foreach ($data['allPack']['pack'] as $key => $value) : ?>
                <div class="col-4">
                    <div class="list-group" id="list-tab" role="tablist">
                        <a class="list-group-item list-group-item-action text-light bg-info">Tên gói: <?php echo $value['name']; ?> </a>
                        <a class="list-group-item list-group-item-action">Giá gói: <?php echo $value['price'] . "đ"; ?> </a>
                        <a class="list-group-item list-group-item-action">Giới hạn khách sạn: <?php echo $value['hotel_quantity']; ?> </a>
                        <a class="list-group-item list-group-item-action">Giới hạn phòng: <?php echo $value['room_quantity']; ?> </a>
                        <a class="list-group-item list-group-item-action">Phí dịch vụ: <?php echo $value['booking_fee']; ?> </a>
                        <?php foreach ($data['allPack']['option'] as $key2 => $value2) :  if ($value['id'] == $value2['pack_id']) { ?>
                                <a class="list-group-item list-group-item-action"><?php echo $value2['pack_op_name']; ?> </a>
                        <?php };
                        endforeach; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
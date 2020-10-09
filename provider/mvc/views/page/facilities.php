<div class="wrap">
    <div class="row">
        <div class="col-6">
            <div class="wrap p-3">
                <div class="col-6 mb-3">
                    <select name="" id="facilitiesSelectHotel" class="custom-select">
                        <option value="">Chọn khách sạn</option>
                        <?php foreach ($data['listHotel'] as $key => $value) : ?>
                            <option value="<?php echo $value['hotel_id']; ?>"><?php echo $value['hotel_name']; ?></option>
                        <?php endforeach; ?> 
                    </select>
                </div>
                <div class="row p-3">
                    <?php foreach ($data['allHotelFacilities'] as $key => $value) : ?>
                        <div class="form-group col-6">
                            <input type="checkbox" value="" f-id = "<?php echo $value['hf_id']; ?>"  class="facilities" id="<?php echo "facilities-".$key; ?>">
                            <label for="<?php echo "facilities-".$key; ?>" class="text-info"><?php echo $value['hf_name']; ?></label>
                        </div>
                    <?php endforeach; ?>
                    <button type="button" class="btn btn-primary" id="changeHotelFacilities" style="display: none;">Lưu thông tin</button>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="wrap p-3">
                <div class="col-6 mb-3">
                    <select name="" id="SelectRoomFacilities" class="custom-select">
                        <option value="">Chọn loại phòng</option>
                    </select>
                </div>
                <div class="row p-3">
                    <?php foreach ($data['allRoomFacilities'] as $key => $value) : ?>
                        <div class="form-group col-6">
                            <input type="checkbox" value="" f-id = "<?php echo $value['hf_id']; ?>"  class="room-facilities" id="<?php echo "room-facilities-".$key; ?>">
                            <label for="<?php echo "room-facilities-".$key; ?>" class=""><?php echo $value['hf_name']; ?></label>
                        </div>
                    <?php endforeach; ?>
                    <button type="button" class="btn btn-primary" id="changeRoomFacilities" style="display: none;">Lưu thông tin</button>
                </div>
            </div>
        </div>
    </div>
</div>
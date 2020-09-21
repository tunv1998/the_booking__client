<div class="media-body">
    <div class="row">
        <div class="col-6">
            <h2 class="text-primary">Hình ảnh khách sạn</h2>
            <div class="choose-hotel pb-3">
                <select name="listHotel" id="listHotel" class="form-control col-6">
                    <?php foreach ($data['listHotel'] as $hotelKey => $hotelValue) : ?>
                        <option value="<?php echo $hotelValue['hotel_id']; ?>"><?php echo $hotelValue['hotel_name']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <!-- Show ảnh khách sạn -->
            <div class="hotel-image-active border rounded p-3 d-flex flex-wrap">
                <?php foreach ($data['allHotelImageActive'] as $hotelImgActiveKey => $hotelImgActiveValue) : ?>
                    <div class=" nopad text-center position-relative" style="flex-basis: 25%;max-width: 25%;">
                        <label for="<?php echo "hotelImage-" . $hotelImgActiveKey; ?>">
                            <img class="img-responsive mw-100 mb-3 hotelImg" src="<?php echo $hotelImgActiveValue; ?>" style="width: 120px;height: 100px" />
                            <input type="checkbox" name="hotelName[]" class="hotelName" value="<?php echo $hotelImgActiveKey; ?>" id="<?php echo "hotelImage-" . $hotelImgActiveKey; ?>" />
                        </label>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row p-3" id="hotelButton">
                <button type="button" class="btn btn-primary mr-3 hotelChoose" data-toggle="modal" data-target="#chooseImage">
                    Thêm từ bộ sưu tập
                </button>
                <button type="button" class="btn btn-primary delButton" id="delHotelImage">
                    Xóa hình ảnh
                </button>
            </div>

        </div>
        <div class="col-6">
            <h2 class="text-primary">Hình ảnh phòng</h2>
            <div class="pb-3">
                <select name="chooseRoom" id="chooseRoom" class="form-control">
                    <option value="" selected>Chọn phòng</option>
                    <?php foreach ($data['listRoom'] as $roomKey => $roomValue) : ?>
                        <option value="<?php echo $roomValue['r_id'] ?>"><?php echo $roomValue['r_name'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="room-image border rounded p-3 d-flex flex-wrap">
               
            </div>
            <div class="row p-3" id="roomButton">
                <button type="button" class="btn btn-primary mr-3 roomChoose" data-toggle="modal" data-target="#chooseImage">
                    Thêm từ bộ sưu tập
                </button>
                <button type="button" class="btn btn-primary delButton" id="delRoomImage">
                    Xóa hình ảnh
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="chooseImage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chọn hình ảnh</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body choose-image-modal">
                <div class="row px-3 d-flex justify-content-start">

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>
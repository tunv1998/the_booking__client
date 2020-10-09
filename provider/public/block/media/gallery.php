<div class="media-body mb-5">
    <div class="row">
        <div class="col-12">
            <h3 class="text-primary">Tất cả hình ảnh</h3>
            <div class="choose-hotel pb-3 col-6">
                <select name="galListHotel" id="galListHotel" class="form-control col-6">
                    <?php foreach ($data['listHotel'] as $key => $value) : ?>
                        <option value="<?php echo $value['hotel_id']; ?>"><?php echo $value['hotel_name']; ?></option>
                    <?php endforeach ?>
                </select>
            </div> <!-- Show ảnh khách sạn -->
            <div class="folder-hotel-image border rounded p-3 d-flex flex-wrap">
                <?php if (!empty($data['hotelImage']['filePath'])) { ?>
                    <?php foreach ($data['hotelImage']['filePath'] as $key => $value) : ?>
                        <div class=" nopad text-center position-relative mr-3">
                            <label for="<?php echo "hotelImage-" . $key; ?>">
                                <img class="img-responsive mw-100 mb-3 hotelImg" src="<?php echo $value; ?>" style="width: 120px;height: 100px" />
                                <input type="checkbox" name="" class="galHotelImage" id="<?php echo "hotelImage-" . $key; ?>" />
                            </label>
                        </div>
                    <?php endforeach; ?>
                <?php } ?>
            </div>
            <div class="row p-3" id="hotelButton">
                <button type="button" class="btn btn-primary delButton" id="delHotelImageFolder">
                    Xóa hình ảnh
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <h3 class="text-primary">Upload hình ảnh</h3>
            <div class="preUpload border rounded p-3 d-flex flex-wrap">
            </div>
            <div class="row p-3 col-3" id="upload">
                <form action="./?ctrl=media&act=uploadToStore" name="uploadForm" method="post" enctype="multipart/form-data">
                    <div class="custom-file mb-2">
                        <input type="file" class="custom-file-input" name="fileUpload[]" id="fileUpload" multiple>
                        <label class="custom-file-label" for="fileUpload">Chọn file</label>
                        <input type="hidden" name="hotelName" id="hotelName" value="">
                    </div>
                    <input type="submit" class="btn btn-info" value="Tải lên" name="uploadFile" id="uploadFile" style="display: none;">
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row m-3">
    <div class="col-3">
        <div class="mb-3" id="userImg">
            <img src="../public/uploads/avatar/<?php echo @$data['userInfo'][0]['avatar_img']; ?>" alt="" class="mw-100">
        </div>
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input userAvatar" id="fileUpload">
            <label class="custom-file-label" for="customFile">Sửa ảnh đại diện</label>
        </div>
        <button type="button" class="btn btn-primary" id="uploadConfirm" style="display: none;">Upload</button>
    </div>
    <div class="col-5">
        <div class="wra4">
            <div class="col">
                <?php foreach ($data['userInfo'] as $key => $value) : ?>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" name="" id="username" class="form-control" value="<?php echo $value['username'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Họ tên</label>
                        <input type="text" name="fullname" id="fullname" class="form-control" value="<?php echo $value['fullname'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="text" name="email" id="email" class="form-control" value="<?php echo $value['email'] ?>" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Số điện thoại</label>
                        <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" value="<?php echo $value['phone_number'] ?>" disabled>
                    </div>
                    <input type="hidden" name="" id="idUser" value="<?php echo $value['id']; ?>">
                <?php endforeach; ?>

            </div>
            <div class="col group-button">
                <button type="button" class="btn btn-primary" id="editUserInfo">Sửa thông tin</button>
                <button type="button" class="btn btn-info" id="saveUserInfo" style="display: none;">Lưu thông tin</button>
                <button type="button" class="btn btn-secondary" id="outEdit" style="display: none;">Hủy</button>
            </div>
        </div>
    </div>
    <div class="col-4">
        <h4 class="text-primary">Gói đang dùng:</h4>
        <div class="card" style="width: 100%;">
            <div class="card-header h5">
                Tên gói: <?php echo @$data['packInfo']['name']; ?>
            </div>
            <ul class="list-group list-group-flush mb-3">
                <li class="list-group-item">Ngày mua: <?php echo @$data['packInfo']['date_from']; ?></li>
                <li class="list-group-item">Ngày hết hạn: <?php echo @$data['packInfo']['date_to']; ?></li>

                <div class="card-header h5">
                    Lợi ích:
                </div>
                <li class="list-group-item">Giới hạn khách sạn: <?php echo @$data['packInfo']['hotel_num']; ?> khách sạn</li>
                <li class="list-group-item">Giới hạn phòng: <?php echo @$data['packInfo']['room_num']; ?> phòng</li>
                <li class="list-group-item">Phí dịch vụ: <?php echo @$data['packInfo']['fee']; ?>%</li>
                <?php foreach ($data['packBenifit'] as $key => $value) : ?>
                    <li class="list-group-item"><?php echo $value; ?></li>
                <?php endforeach; ?>
            </ul>
            <a href="./?ctrl=user&act=package" class="btn btn-primary">Quản lý gói</a>
        </div>
    </div>
</div>
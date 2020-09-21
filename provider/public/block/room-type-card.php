<a class="btn btn-primary text-white mr-3 createRoomChildBtn" style="margin-bottom: 1.875rem; cursor: pointer;">THÊM LOẠI PHÒNG</a>
<div class="align-items-center justify-content-between mb-4">
    <!-- loop here -->
    <!-- each hotel will go into each card -->
    <div class="">
        <!-- Loop here -->
        <?php if (empty($data['room_list'])) {
            echo "<h2 class=''>Chưa có phòng nào, hãy tạo mới!</h2>";
        }
        foreach ($data['room_list'] as $key => $value) : ?>
            <div class="">
                <div class="card row mb-4">
                    <!-- Header -->
                    <div class="card-header header-room-type p-3">
                        <h1 class="mb-0" style="font-size: 1.1rem;">
                            <a class="text-primary"><?php echo $value['r_name']; ?></a>
                        </h1>
                    </div>
                    <!-- Body -->
                    <div class="row align-items-center flex-wrap">
                        <div class="col-9 p-3">
                            <div class="d-flex room-card-content" style="justify-content: space-between; align-items: center;">
                                <!-- Facilities -->
                                <!-- Limit People -->
                                <div class="col-3">
                                    <span class="icon">
                                        <i class="fas fa-hotel"></i>
                                    </span>
                                    <span id="limit-people"> Số phòng cung cấp: <?php echo $value['r_count']; ?></span>
                                </div>

                                <!-- Limit People -->
                                <div class="col-3">
                                    <span class="icon">
                                        <i class="fas fa-user"></i>
                                    </span>
                                    <span id="limit-people">Số khách giới hạn: <?php echo $value['r_guestLimit'] . ""; ?></span>
                                </div>

                                <!-- Limit People -->
                                <div class="col-3">
                                    <span class="icon">
                                        <i class="fas fa-ruler-combined"></i>
                                    </span>
                                    <span id="limit-people">Diện tích: <?php echo $value['r_sqm'] . "m<sup>2</sup>"; ?></span>
                                </div>

                                <!-- Limit People -->
                                <div class="col-3">
                                    <span class="icon">
                                        <i class="fas fa-dollar-sign"></i>
                                    </span>
                                    <span id="limit-people">Giá cơ bản: ~</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3 p-3">
                            <div class="wrap">
                                <div class="d-flex">
                                    <a href="./?ctrl=hotel&act=createRoomChild&param=<?php echo $value['r_id'];  ?>" class="btn btn-primary mb-2 mr-3" id="addRoomChild" data-toggle="tooltip" data-placement="top" title="Thêm loại option">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-plus"></i>
                                        </span>
                                    </a>
                                    <button class="btn btn-secondary mb-2 mr-3" data-toggle="modal" data-target="<?php echo "#room-type-detail-" . $value['r_id']; ?>" data-toggle="tooltip" data-placement="top" title="Xem chi tiết loại phòng">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-eye"></i>
                                        </span>
                                    </button>
                                    <a href="<?php echo "./?ctrl=hotel&act=roomedit&param=" . $value['r_id']; ?>" class="btn btn-info mb-2 mr-3" data-toggle="tooltip" data-placement="top" title="Sửa thông tin loại phòng">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                    </a>
                                    <button href="#" class="btn btn-danger mb-2 changeRoomStatus" rid="<?php echo $value['r_id'] ?>" data-toggle="tooltip" data-placement="top" title="Xóa loại phòng">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-trash"></i>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col m-3">
                            <div class="d-flex flex-wrap" style="align-items: center;">
                                <?php foreach ($data['allRoomChild'] as $key2 => $value2) : if ($value['r_id'] == $value2['rc_parent']) { ?>
                                        <a data-toggle="modal" data-target="#roomChild-<?php echo $value2['rc_id'] ?>" class="col-4 mb-3" style="text-align: center; cursor: pointer">
                                            <div class="border rounded p-3">
                                                <div class="text-primary mb-2"><?php echo "Phòng " . $value2['rc_name'] ?>
                                                    <img src="https://icon-library.com/images/more-icon-png/more-icon-png-1.jpg" style="width: 2.8125rem;position: absolute; right: 1.25rem;top: 0;">
                                                </div>
                                                <span class="badge badge-success roomChildPrice" price="<?php echo $value2['rc_id']; ?>" style="font-size: 0.9rem"></span>
                                            </div>
                                        </a>
                                <?php }
                                endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- Room Type Detail Modal -->

<?php foreach ($data['list_id_room'] as $listIdKey => $listIdValue) :  ?>
    <!-- loop to render Modal -->
    <div class="modal" tabindex="-1" role="dialog" id="<?php echo "room-type-detail-" . $listIdValue['id']; ?>">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <!-- Header -->
                <!-- Loop 1 -->
                <div class="modal-header">
                    <!-- Change Room type name here -->
                    <h4 class="modal-title text-primary"><?php echo $listIdValue['r_name']; ?></h4>

                    <!-- close modal icon -->
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Body -->
                <div class="modal-body">
                    <div class="row">
                        <!-- room type img -->
                        <div class="col-xl-5 col-md-6">
                            <div class="main-img">
                                <img src="https://ik.imagekit.io/tvlk/apr-asset/TzEv3ZUmG4-4Dz22hvmO9NUDzw1DGCIdWl4oPtKumOg=/hotels/12000000/11830000/11821900/11821812/0519c25a_z.jpg?tr=q-40,c-at_max,w-740,h-500&_src=imagekit" alt="" id="" class="mw-100 rounded">
                            </div>
                            <hr class="divider">
                            <div class="gallery">
                                <div class="row">
                                    <!-- Loop here -->
                                    <?php
                                    foreach ($data['all_image'] as $imageKey => $imageValue) : ?>
                                        <?php
                                        if ($imageValue['hi_roomId'] == $listIdValue['id']) {
                                            echo '  <div class="col-3 mb-2">';
                                            echo "<img alt='Ảnh' src='" . "../public/uploads/hotel/" . $data['hotelName'] . "/" . $imageValue['hi_name'] . "'alt='' class='active rounded mw-100 roomTypeImg' style='width: 100px; height: 80px;'/>";
                                            echo ' </div>';
                                        }
                                        ?>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <!-- room type -->
                        <div class="col-xl-7 col-md-6 position-relative p-4 bg-light">
                            <!-- Room Info -->
                            <h5 class="text-primary">Thông tin phòng</h5>
                            <ul class="room_infor_general">
                                <?php foreach ($data['list_general_infor'] as $generalInforKey => $generalInforValue) : ?>
                                    <?php
                                    if ($generalInforValue['r_id'] == $listIdValue['id']) {
                                        echo "<li>Số phòng cung cấp: " . $generalInforValue['r_count'] . "</li>";
                                        echo "<li>Khách giới hạn: " . $generalInforValue['r_guestLimit'] . "</li>";
                                        echo "<li>Diện tích: " . $generalInforValue['r_sqm'] . "</li>";
                                        echo "<li>Loại giường: " . $generalInforValue['b_name'] . "</li>";
                                    } ?>
                                <?php endforeach; ?>
                            </ul>
                            <hr class="divider">

                            <!-- Room Facilities -->
                            <h5 class="text-primary">Tiện ích phòng</h5>
                            <ul class="room_facilites1">
                                <?php foreach ($data['facilities4'] as $facilities4Key => $facilities4Value) : ?>
                                    <?php
                                    if ($facilities4Value['hfd_roomId'] == $listIdValue['id']) {
                                        echo "<li>" . $facilities4Value['hf_name'] . "</li>";
                                    } ?>
                                <?php endforeach; ?>
                            </ul>
                            <hr class="divider">
                            <h5 class="text-primary">Tiện ích phòng tắm</h5>
                            <ul class="room_facilities2">
                                <?php foreach ($data['facilities5'] as $facilities5Key => $facilities5Value) : ?>
                                    <?php
                                    if ($facilities5Value['hfd_roomId'] == $listIdValue['id']) {
                                        echo "<li>" . $facilities5Value['hf_name'] . "</li>";
                                    } ?>
                                <?php endforeach; ?>
                            </ul>
                            <!-- Muốn thêm gì thì thêm vào -->
                            <!-- Fixed price block -->
                            <div class="text-primary">
                                <span>Giá mặc định</span>
                                <h2 id="price" class="text-primary">
                                    <?php foreach ($data['list_general_infor'] as $generalInforKey => $generalInforValue) : ?>
                                        <?php
                                        if ($generalInforValue['r_id'] == $listIdValue['id']) {
                                            echo number_format($generalInforValue['r_dePrice'], 0, ".", ".");
                                        } ?>
                                    <?php endforeach; ?>
                                    <span id="curency">VND</span> </h2>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <a href="<?php echo "./?ctrl=hotel&act=roomedit&param=" . $listIdValue['id']; ?>" class="btn btn-info text-light">Thay đổi thông tin</a>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<!--  -->
<?php foreach ($data['allRoomChild'] as $key => $value) : ?>
    <div class="modal fade" id="roomChild-<?php echo $value['rc_id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h3" id="exampleModalLongTitle">Thông tin loại phòng con</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-4">
                            <div class="p-3">
                                <img src="https://www.yourrooms.com/onlineshop/store_00002/image/cache/data/h4-500x500.jpg" alt="" class="mw-100">
                            </div>
                        </div>
                        <div class="col-8">
                            <div class="p-3">
                                <h5 class="text-primary"><?php echo $value['rc_name']; ?></h5>
                                <hr class="divider">
                                <h5 class="text-primary">Chính sách: </h5>
                                <div class="d-flex flex-column" style="margin-left: 2rem;">
                                    <?php foreach ($data['roomChildInfo'] as $key2 => $value2) :
                                        if ($value['rc_id'] == $value2['rc_id']) {
                                            $price = $value2['rr_rate'];
                                    ?>
                                            <span>
                                                <i class="fas fa-check-circle" style="padding-right: 7px; padding-bottom: 7px; color: #1cc88a;"></i>
                                                <?php echo $value2['p_name']; ?>
                                            </span>
                                    <?php }
                                    endforeach; ?>
                                    <span>
                                        <i class="fas fa-dollar-sign" style="padding-right: 7px; padding-bottom: 7px; color: #1cc88a;"></i>
                                        <span price="<?php echo $value['rc_id'] ?>" class="priceModal">Giá tiền: <?php echo $price . "đ"; ?></span>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <a href="?ctrl=hotel&act=roomchildedit&param=<?php echo $value['rc_id']; ?>" class="btn btn-primary">Thay đổi thông tin</a>
                    <button type="button" class="btn btn-danger changeRoomChildStatus" rcid="<?php echo $value['rc_id']; ?>" data-dismiss="modal">Xóa phòng</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                </div>
            </div>
        </div>
    </div>
<?php endforeach; ?>
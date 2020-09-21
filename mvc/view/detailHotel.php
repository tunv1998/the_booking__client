<?php
$showDetail = $data['show'];
$showImg = $data['showImg'];
$showAllImg = $data['showAllImg'];
$showAllRoom = $data['showAllRoom'];
$showAllRoomChild = $data['showAllRoomChild'];
$showPostComment = $data['checkisBooking'];
$checkUser = $data['checkUser'];
$rating1 = $data['rating1'];
$rating2 = $data['rating2'];
$rating3 = $data['rating3'];
$rating4 = $data['rating4'];
$rating5 = $data['rating5'];
$totalRating = $data['totalRating'];
// echo $_COOKIE['type'];
?>
<?php 
    foreach($showDetail as $row){ 
      $star = helpers::showStar($row['hStar']); 
    ?>
    <!-- BREADCRUMB -->
    <section class="py-4">
        <div class="px-2 mx-auto sm:px-8 py-2 max-w-screen-xl">
            <ol class="list-none p-0 inline-flex">
                <li class="flex items-center hover:underline hover:underline">
                <a href="./index.php?controller=hotel&action=listHotel&id=<?php echo $row['pName'];?>"><?php echo $row['pName'];?></a>                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center hover:underline">
                <a href="./index.php?controller=hotel&action=listHotel&id=<?php echo $row['dName'];?>"><?php echo $row['dName'];?></a>                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li class="flex items-center hover:underline">
                <a href="./index.php?controller=hotel&action=listHotel&id=<?php echo $row['wName'];?>"><?php echo $row['wName'];?></a>                    <svg class="fill-current w-3 h-3 mx-3" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512">
                        <path
                            d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z" />
                    </svg>
                </li>
                <li>
                    <a href="#" class="text-gray-500" aria-current="page"><?php echo $row['hName'];?></a>
                </li>
            </ol>
        </div>
    </section>
    <!-- END BREADCRUMB -->

    <!-- HOTEL DETAIL -->
    <!-- Hotel Overview -->
    <section id="hotel-overview" class="pb-8 pt-4">
        <div class="flex px-2 mx-auto sm:px-8 py-2 max-w-screen-xl">
            <div class="w-4/5 mr-2">
                <div class="w-full">
                    <div class="box py-4 px-6 rounded-lg border bg-white">
                        <!-- name and bookmark -->
                        <div class="flex items-center justify-between mb-2">
                            <!-- hotel name -->
                            <h3 class="text-black text-2xl font-semibold"><?php echo $row['hName'];?></h3>

                            <!-- save to wishlish -->
                            <ion-icon name="bookmark" class="text-black text-xl hover:text-red-700"></ion-icon>
                        </div>
                        <!-- star and address -->
                        <div class="mb-2">
                            <!-- stars -->
                            <div class="flex items-center text-yellow-400 text-xl mb-1">
                                <?php echo $star = helpers::showStar($row['hStar']);?>
                            </div>
                            <!-- address -->
                            <div class="flex items-center text-xl mb-4">
                                <i class="fa fa-map-marker text-red-700"></i>
                                <span class="pl-2 text-lg"><?php echo $row['hAddress']?>,<?php echo $row['wName']?>,<span id="state"><?php echo $row['dName']?>, </span> <span id="city"><?php echo $row['pName']?>, </span><span id="country">Việt Nam</span> - <span id="postal-code">550000</span></span>
                            </div>

                            <!-- hotel img -->
                            <div class="grid grid-cols-3 gap-2">
                                <div class="h-96 col-span-2">
                                    <img src="./public/uploads/hotel/<?php 
                            $img = helper::convertHotelNameToFolderName([$row['hName']]);
                            echo implode('-',$img);
                            ?>/<?php echo $row['avatar']?>"
                                        alt="" class="w-full h-full rounded-lg">
                                </div>
                                <div class="h-full grid grid-rows-3 gap-2 h-96">
                                <?php foreach($showImg as $show){
                                    $images = helper::convertHotelNameToFolderName([$row['hName']]);
                                    $img = './public/uploads/hotel/'.implode('-',$images).'/'.$show["Iname"].'';
                                    echo "<div class='rounded-lg w-full h-full bg-grey-dark bg-no-repeat bg-center bg-cover'
                                    style='background-image: url(".$img.");'>
                                </div>
                                    ";
                                    }?>
                                    <!-- <div class="rounded-lg w-full h-full bg-grey-dark bg-no-repeat bg-center bg-cover"
                                        style="background-image: url(https://lh3.googleusercontent.com/jVnVgukM3j9TsapcSdlTkpXfkBVb30r88ou4ekiPtNpPiv3ikD1gv29fKD4uYqDwfJE=w412-h220-rw);">
                                    </div>
                                    <div class="rounded-lg w-full h-full bg-grey-dark bg-no-repeat bg-center bg-cover"
                                        style="background-image: url(https://lh3.googleusercontent.com/jVnVgukM3j9TsapcSdlTkpXfkBVb30r88ou4ekiPtNpPiv3ikD1gv29fKD4uYqDwfJE=w412-h220-rw);">
                                    </div> -->
                                    <div class="relative">
                                        <button
                                            class="modal-open absolute rounded-lg bg-blue-800 text-white bg-opacity-50 hover:bg-opacity-75 w-full h-full"  data-toggle="modal" data-target="img">
                                            Xem tất cả hình
                                        </button>
                                        <div class="rounded-lg w-full h-full bg-grey-dark bg-no-repeat bg-center bg-cover"
                                            style="background-image: url(<?= BASEURL?>/public/images/<?php echo $row['avatar']?>);">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-1/5 ml-2">
                <!-- review score -->
                <div class="w-full mb-4">
                    <div class="box py-4 px-6 rounded-lg border bg-white">
                        <div class="flex items-center mb-2">
                            <span class="p-4 rounded-lg bg-blue-600 font-black text-2xl text-white"><?php
                            $review = $row['review'];
                            $ouput = "";
                            if($review!=0){
                            $ouput .= number_format("$review",0,",",".")
                            ;
                            }else{
                            $ouput .= "0";
                            }
                            echo $ouput;
                            ?></span>
                            <div class="flex flex-col ml-2">
                            <?php if($ouput <=5 && $ouput >= 4){ ?>
                                <span class="text-xl text-black">Ấn tượng</span>
                            <?php }elseif($ouput <=4 && $ouput >= 3){?>
                                <span class="text-xl text-black">Tuyệt</span>
                            <?php }else{?>
                                <span class="text-xl text-black">Tốt</span>
                            <?php }?>
                                <p class="text-md text-blue-500"><span id="countReview"></span> review</p>
                            </div>
                        </div>
                        <a href="#review" class="text-orange-500 hover:underline">Xem tất cả đánh giá</a>
                    </div>
                </div>

                <!-- price -->
                <div class="w-ful relative">
                    <div class="box py-4 px-6 rounded-lg border-2 border-orange-400 bg-white">
                        <h3 class="text-xl text-black mb-2">
                            Giá mỗi đêm chỉ từ
                        </h3>
                        <!-- old price -->
                        <p class="tu-text-title text-xl font-semibold text-gray-400 mb-1 line-through">                    
                        <?php 
                        if($row['rate']==null){
                        $price = $row['pri'];
                        echo number_format("$price",0,",",".");
                        }else{
                        $price = $row['rate'];
                        echo number_format("$price",0,",",".");
                        }?>
                        <span>vnd</span> </p>

                        <!-- new price -->
                        <p class="tu-text-title text-2xl font-semibold text-orange-500 mb-2">        
                        <?php 
                        if($row['rate']==null){
                        $price = $row['pri'] - $row['pri']*0.1;
                        echo number_format("$price",0,",",".");
                        }else{
                        $price = $row['rate'] - $row['rate']*0.1;
                        echo number_format("$price",0,",",".");
                        }?>
                        <span>vnd</span>
                        </p>

                        <a href="#room-type" class="block text-center w-full py-2 bg-blue-400 hover:bg-blue-500 rounded-lg text-xl text-white">Chọn phòng</a>
                    </div>

                    <!-- discount (if have) -->
                    <div
                        class="h-12 rounded-full w-12 bg-red-600 flex items-center justify-center absolute tu-abs-saleicon">
                        <span class="text-white tu-text-title ">-10%</span>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- END HOTEL DETAIL -->
    <!-- HOTEL DESC -->
    <section id="hotel-desc" class="pb-8">
        <div class="mx-auto sm:px-8 py-2 max-w-screen-xl">
            <div class="flex p-4 rounded-lg border bg-white">
                <div class="w-1/2">
                    <div class="px-2">
                        <h3 class="text-black text-2xl font-semibold mb-2">Mô Tả</h3>
                        <!-- In mô tả ở đây -->
                        <?php echo $row['descript']?>
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="px-2">
                        <h3 class="text-black text-2xl font-semibold mb-2">Tiện nghi</h3>
                        <!-- In mô tả ở đây -->
                        <div class="grid grid-cols-4 gap-2">
                            <div class="flex flex-col justify-center items-center text-2xl">
                                <ion-icon name="wifi" class="text-blue-400"></ion-icon>
                                <p class="text-lg">Free Wifi</p>
                            </div>
                            <div class="flex flex-col justify-center items-center text-2xl">
                                <ion-icon name="barbell" class="text-blue-400"></ion-icon>
                                <p class="text-lg">Gym</p>
                            </div>
                            <div class="flex flex-col justify-center items-center text-2xl">
                                <ion-icon name="car-sport" class="text-blue-400"></ion-icon>
                                <p class="text-lg">Đậu xe</p>
                            </div>
                            <div class="flex flex-col justify-center items-center text-2xl">
                                <ion-icon name="restaurant" class="text-blue-400"></ion-icon>
                                <p class="text-lg">Nhà hàng</p>
                            </div>
                            <div class="flex flex-col justify-center items-center text-2xl">
                                <ion-icon name="receipt" class="text-blue-400"></ion-icon>
                                <p class="text-lg">Huỷ phòng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END HOTEL DESC -->
    <!-- GG MAPS -->
    <div id="hotel-maps" class="pb-8">
        <div class="mx-auto sm:px-8 py-2 max-w-screen-xl">
            <div class="p-4 rounded-lg border bg-white">
                <div class="px-2">
                    <h3 class="text-black text-2xl font-semibold mb-2">Thông tin địa điểm</h3>
                    <!-- address -->
                    <div class="flex items-center text-xl mb-4">
                        <i class="fa fa-map-marker text-red-700"></i>
                        <span class="pl-2 text-lg"><?php echo $row['hAddress']?>,<?php echo $row['wName']?>,<span id="state"><?php echo $row['dName']?>, </span> <span id="city"><?php echo $row['pName']?>, </span><span id="country">Việt Nam</span> - <span id="postal-code">550000</span></span>
                    </div>
                    <iframe 
                    class="rounded-lg pb-2"
                    <?php echo $row['map']?>
                    style="border:0;" allowfullscreen="true" aria-hidden="false" tabindex="0" width="100%"
                    height="450" frameborder="0">
                    </iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- END GG MAPS -->
    <?php }?>
    <!-- ROOM TYPE -->
    <?php foreach($showAllRoomChild as $showRoom){
        $imgRoom = $showRoom['img'];
         if($showRoom['rCount']===""){

        }else{
        ?>
    <section id="room-type" class="pb-8">
        <div class="mx-auto sm:px-8 py-2 max-w-screen-xl">
            <div class="p-4 rounded-lg border bg-white">
                <!-- Title -->
                <div class="flex justify-between items-center px-2">
                    <h3 class="text-black text-2xl font-semibold mb-2"><?php echo $showRoom['rName']?></h3>
                    <!-- <p class="text-blue-400 hover:underline cursor-pointer">Xem chi tiết</p> -->
                </div>
                <!-- Room child -->
                <div class="grid grid-cols-3 gap-2">
                    <!-- room type -->
                    <div class="w-full rounded-lg p-2">
                        <div class="w-full rounded-lg tu-bg-img h-64 mb-4" style="background-image: url(./public/images/<?php echo $showRoom['img']?>);"></div>
                        <!-- some info -->
                        <div class="flex flex-col mb-4">
                            <div class="flex items-center mb-2">
                                <ion-icon name="square" class="mr-2 text-xl"></ion-icon>
                                <p><?php echo $showRoom['spm']?> m<sup>2</sup> </p>
                            </div>
                            <div class="flex items-center mb-2">
                                <ion-icon name="bed" class="mr-2 text-xl"></ion-icon>
                                <p><?php echo $showRoom['bed']?></p>
                            </div>
                            <div class="flex items-center mb-2">
                                <ion-icon name="person" class="mr-2 text-xl"></ion-icon>
                                <p><?php echo $showRoom['guest'];?> người</p>
                            </div>
                        </div>

                        <!-- show all info -->
                        <button class="modal-open bg-blue-200 hover:bg-blue-300 text-blue-600 text-center p-2 w-full rounded-lg" data-toggle="modal" data-target="<?php echo $showRoom['id']?>">Xem tất cả thông tin</button>
                    </div>
                    <!-- room child -->
                    <div class="col-span-2 p-2">
                        <!-- #1 -->
                        <?php foreach($showRoom['rChild'] as $showChild){ ?>
                        <form action="" method="POST" id="process-form-<?php echo $showRoom['id'];?>">
                    <input type="hidden" name="room-id" id="room-id-<?php echo $showRoom['id'];?>" value="<?php echo $showRoom['id'];?>">
                    <input type="hidden" name="" id="check-in" value="<?php echo strtotime($_SESSION['check-in']);?>">
                    <input type="hidden" name="" id="check-out" value="<?php echo strtotime($_SESSION['check-out']);?>">
                        <div class="rounded-lg p-2 border px-4 hover:shadow-md transition duration-300 ease-in-out mb-4">
                            <!-- room name -->
                            <p class="text-black font-semibold text-xl"><?php
                       echo $showChild['rcName'];
                         ?></p>
                         <input type="hidden" name="idRchild" id="idRchild-<?php echo $showChild['id'];?>" value="<?php echo $showChild['id'];?>">
                            <!-- some info -->
                            <div class="grid grid-cols-3 mb-2">
                                <!-- bed -->
                                <div class="flex items-center">
                                    <ion-icon name="bed" class="mr-2 text-xl"></ion-icon>
                                    <p><?php echo $showRoom['bed']?></p>
                                </div>
                                <!-- limit people -->
                                <div class="flex items-center">
                                    <ion-icon name="person" class="mr-2 text-xl"></ion-icon>
                                    <p><?php echo $showRoom['guest'];?> người</p>
                                </div>
                                <!-- empty room -->
                                <div class="flex items-center text-orange-500">
                                    <ion-icon name="browsers" class="mr-2 text-xl"></ion-icon>
                                    <input type="hidden" name="" id="roomToTTal-<?php echo $showChild['id'];?>" value="<?php echo $showRoom['rCount'];?>">
                                    <p>còn <span id="roomCount-<?php echo $showRoom['id'];?>"> <?php echo $showRoom['rCount'];?> </span> phòng trống</p>
                                </div>
                            </div>
                            <hr class="my-4">
                            <!-- cột này là cố định -->
                            <!-- nếu thuộc tính này có (vd: có bữa sáng)
                            thì cho nó màu xanh lá (green-500)
                            còn không thì cho nó màu xám (gray-500) -->
                            <div class="grid grid-cols-3 gap-2">
                                <!-- for people -->
                                <div class="w-full flex flex-col">
                                <?php
                                foreach($showChild['rcPolicy'] as $showpolicy){
                                    if($showpolicy['rpId'] == '1'){
                                    ?>
                                    <div class="flex items-center text-green-500 mb-2">
                                        <ion-icon name="fast-food" class="mr-2 text-xl"></ion-icon>
                                        <?php echo $showpolicy['rpName']?>
                                    </div>
                                <?php }elseif($showpolicy['rpId'] == '7'){ ?>
                                    <div class="flex items-center text-gray-500 mb-2">
                                    <ion-icon name="receipt" class="mr-2 text-xl"></ion-icon>
                                    <?php echo $showpolicy['rpName']?>
                                </div>
                                <?php }}?>
                                    <div class="flex items-center text-green-500 mb-2">
                                        <ion-icon name="wifi" class="mr-2 text-xl"></ion-icon>
                                        <p>Wifi</p>
                                    </div>
                                </div>
                                <!-- for room -->
                                <div class="w-full flex flex-col">
                                <?php
                                foreach($showChild['rcPolicy'] as $showpolicy){
                                    if($showpolicy['rpId'] == '3'){
                                    ?>
                                    <div class="flex items-center text-green-500 mb-2">
                                        <ion-icon name="receipt" class="mr-2 text-xl"></ion-icon>
                                        <?php echo $showpolicy['rpName']?>
                                    </div>
                                <?php }elseif($showpolicy['rpId'] == '6'){ ?>
                                    <div class="flex items-center text-gray-500 mb-2">
                                    <ion-icon name="receipt" class="mr-2 text-xl"></ion-icon>
                                    <?php echo $showpolicy['rpName']?>
                                </div>
                                <?php }}?>
                                <?php
                                foreach($showChild['rcPolicy'] as $showpolicy){
                                    if($showpolicy['rpId'] == '4'){
                                    ?>
                                    <div class="flex items-center text-green-500 mb-2">
                                        <ion-icon name="today" class="mr-2 text-xl"></ion-icon>
                                        <?php echo $showpolicy['rpName']?>
                                    </div>
                                <?php }elseif($showpolicy['rpId'] == '5'){ ?>
                                    <div class="flex items-center text-gray-500 mb-2">
                                    <ion-icon name="today" class="mr-2 text-xl"></ion-icon>
                                    <?php echo $showpolicy['rpName']?>
                                </div>
                                <?php }}?>
                                </div>
                                <!-- price -->
                                <div class="w-full flex flex-col">
                                    <p id="old-price" class="text-gray-500 text-base line-through mb-2">
                                    <?php
                                    $price = "";
                                    if($showChild['rate']==0){
                                    $price = $showRoom['price'];
                                    }else{
                                    $price = $showChild['rate'];
                                    }
                                    echo number_format("$price",0,",",".");
                                    ?> vnd
                                    </p>
                                    <!-- new price -->
                                    <p id="new-price" class="text-orange-400 text-2xl font-semibold mb-4">
                                    <?php
                                    $price = "";
                                    if($showChild['rate']==0){
                                    $price = $showRoom['price'] - $showRoom['price']*0.1;
                                    }else{
                                    $price = $showChild['rate'] - $showChild['rate']*0.1;
                                    }
                                    echo number_format("$price",0,",",".");
                                    ?> vnd</p>
                                    <button class="w-full bg-orange-400 text-white text-center font-semibold-text-lg p-2 rounded-lg hover:bg-orange-500" name='submit'>Đặt ngay</button>
                                
                                </div>
                            </div>
                        </div>
                        <!-- #1 -->
                        </form>
                    <?php }?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- END ROOM TYPE -->
    <?php }}?>
    <!-- REVIEW -->
    <section id="review" class="pb-8">
        <div class="flex px-2 mx-auto sm:px-8 py-2 max-w-screen-xl">
            <!-- user review -->
            <div class="w-1/3 mr-2">
                <div class="w-full">
                    <div class="box py-4 px-6 rounded-lg border bg-white">
                        <div class="mb-1 tracking-wide">
                        <div id="getRating"></div>
                            <h2 class="text-gray-800 font-semibold mt-1"><span id="countUserReview"></span> người đánh giá</h2>
                            <div class=" -mx-8 px-8 pb-3" id="loadCurrent">
                            <input type="hidden" name="" id="tottalRatting" value="<?php echo $totalRating['countReview'];?>">
                                <!-- 5 sao -->
                                <div class="flex items-center mt-1" id="data-rating-5" data-index = "1">
                                    <div class=" w-1/5 text-blue-500 tracking-tighter">
                                        <span>5 sao</span>
                                    </div>
                                    <div class="w-3/5">
                                        <div class="bg-gray-300 w-full rounded-lg h-2" id="getPercenRating5">
                                        <input type="hidden" name="" id="rating5" value="<?php echo $rating5['totalRatingNumber'];?>">
                                        </div>
                                    </div>
                                    <div class="w-1/5 text-gray-700 pl-3">
                                        <span class="text-sm"><?php 
                                        if($rating5['totalRatingNumber'] == 0){
                                            echo $rating5['totalRatingNumber'] . '%';
                                        }else{
                                        $percent = $rating5['totalRatingNumber']/$totalRating['countReview'];
                                        echo number_format( $percent * 100, 1 ) . '%';
                                        }
                                        ?></span>
                                    </div>
                                </div>
                                <!-- 4 sao -->
                                <div class="flex items-center mt-1" id="data-rating-4" data-index = "2">
                                    <div class="w-1/5 text-blue-500 tracking-tighter">
                                    <input type="hidden" name="" id="rating4" value="<?php echo $rating4['totalRatingNumber'];?>">
                                        <span>4 sao</span>
                                    </div>
                                    <div class="w-3/5">
                                        <div class="bg-gray-300 w-full rounded-lg h-2" id="getPercenRating4">
                                        </div>
                                    </div>
                                    <div class="w-1/5 text-gray-700 pl-3">
                                        <span class="text-sm"><?php 
                                         if($rating4['totalRatingNumber'] == 0){
                                            echo $rating4['totalRatingNumber'] . '%';
                                        }else{
                                        $percent = $rating4['totalRatingNumber']/$totalRating['countReview'];
                                        echo number_format( $percent * 100, 1 ) . '%';
                                        }
                                        ?></span>
                                    </div>
                                </div>
                                <!-- 3 sao -->
                                <div class="flex items-center mt-1" id="data-rating-3" data-index = "3">
                                    <div class="w-1/5 text-blue-500 tracking-tighter">
                                    <input type="hidden" name="" id="rating3" value="<?php echo $rating3['totalRatingNumber'];?>">
                                        <span>3 sao</span>
                                    </div>
                                    <div class="w-3/5">
                                        <div class="bg-gray-300 w-full rounded-lg h-2" id="getPercenRating3">
                                        </div>
                                    </div>
                                    <div class="w-1/5 text-gray-700 pl-3">
                                        <span class="text-sm"><?php 
                                         if($rating3['totalRatingNumber'] == 0){
                                            echo $rating3['totalRatingNumber'] . '%';
                                        }else{
                                        $percent = $rating3['totalRatingNumber']/$totalRating['countReview'];
                                        echo number_format( $percent * 100, 1 ) . '%';
                                        }
                                        ?></span>
                                    </div>
                                </div>
                                <!-- 2 sao -->
                                <div class="flex items-center mt-1" id="data-rating-2" data-index = "4" >
                                    <div class=" w-1/5 text-blue-500 tracking-tighter">
                                    <input type="hidden" name="" id="rating2" value="<?php echo $rating2['totalRatingNumber'];?>">
                                        <span>2 sao</span>
                                    </div>
                                    <div class="w-3/5">
                                        <div class="bg-gray-300 w-full rounded-lg h-2" id="getPercenRating2">
                                        </div>
                                    </div>
                                    <div class="w-1/5 text-gray-700 pl-3">
                                        <span class="text-sm"><?php 
                                        if($rating2['totalRatingNumber'] == 0){
                                        echo $rating2['totalRatingNumber'] . '%';
                                        }else{
                                        $percent = $rating2['totalRatingNumber']/$totalRating['countReview'];
                                        echo number_format( $percent * 100, 1 ) . '%';
                                        }
                                        ?></span>
                                    </div>
                                </div>
                                <!-- 1 sao -->
                                <div class="flex items-center mt-1" id="data-rating-1" data-index = "5">
                                    <div class="w-1/5 text-blue-500 tracking-tighter">
                                    <input type="hidden" name="" id="rating1" value="<?php echo $rating1['totalRatingNumber'];?>">
                                        <span>1 sao</span>
                                    </div>
                                    <div class="w-3/5">
                                        <div class="bg-gray-300 w-full rounded-lg h-2" id="getPercenRating1">
                                        </div>
                                    </div>
                                    <div class="w-1/5 text-gray-700 pl-3">
                                        <span class="text-sm"><?php 
                                        if($rating1['totalRatingNumber'] == 0){
                                        echo $rating1['totalRatingNumber'] . '%';
                                        }else{
                                        $percent = $rating1['totalRatingNumber']/$totalRating['countReview'];
                                        echo number_format( $percent * 100, 1 ) . '%';
                                        }
                                        ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- comment -->
            <div class="w-2/3 ml-2">
                <div class="w-full">
                    <div class="box py-4 px-6 rounded-lg border bg-white max-h-1/4 overflow-scroll">
                       <!-- comment from user -->
                       <!-- item -->
                       <!-- limit 3 comment  -->
                       <form method="post" id="comment_form">
                       <input type="hidden" name="idHotel" id="idHotel" value="<?php echo $_GET['id']?>">
                       <?php if($showPostComment > 0){ ?>
                       <div class="my-2 w-full rounded-lg p-2 flex justify-center items-star">
                            <!-- user avatar -->
                            <div class="w-16 h-16 rounded-full mr-4">
                            <?php 
                            if($checkUser['avatar_img']==null){
                                $img = '<img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="'.$checkUser['fullname'].'" class="w-full rounded-full border">';
                            }else{
                                $img = $checkUser['avatar_img'];
                            }
                            echo $img;
                            ?>
                            </div>
                            <!-- user review -->
                            <div class="w-full flex flex-col">
                                <!-- user name -->
                                <p class="text-base text-black font-semibold">
                                    <?php echo $checkUser['fullname'];?>
                                </p>
                                <!-- user rating -->
                                <div id="rating" class="w-1/5 flex text-yellow-400 text-xl py-2 text-yellow-400 text-xl">
                                <span>
                                    <i class="fa fa-star-o rating" id="1" data-business_id="" data-index = "1" data-rating=""></i>
                                    <i class="fa fa-star-o rating" id="2" data-business_id="" data-index = "2" data-rating=""></i>
                                    <i class="fa fa-star-o rating" id="3" data-business_id="" data-index = "3" data-rating=""></i>
                                    <i class="fa fa-star-o rating" id="4" data-business_id="" data-index = "4" data-rating=""></i>
                                    <i class="fa fa-star-o rating" id="5" data-business_id="" data-index = "5" data-rating=""></i>
                                </span>
                                </div>
                                <!-- some comment -->
                                <textarea name="comment_content" id="user-review" cols="10" rows="5" class="w-full rounded-lg border p-2 mb-2" placeholder="Cảm nhận của bạn thế nào?"></textarea>
                                <button type="submit" class="w-1/3 p-2 bg-blue-400 hover:bg-blue-500 text-base rounded-lg text-white text-center focus:outline-none">Đăng đánh giá</button>
                            </div>
                       </div>
                       <?php } ?>
                       </form>
                       <div id="comment_message"></div>
                       <div id="display_comment">
                       </div>
                       <div id="buton_loadmore">
                       <button class="w-full p-2 mt-2 rounded-lg text-center text-white text-xl bg-blue-400 hover:bg-blue-500" id="loadMore">Xem nhiều đánh giá hơn</button>
                       </div>
                    </div>
                </div>
            </div>
    </section>
    <!-- END REVIEW -->

    <!-- MODAL -->
    <!-- Hotel Img -->
    <div id="img"
        class="modal opacity-0 pointer-events-none fixed w-full top-0 left-0 flex items-center justify-center overflow-scroll">
        <!-- overlay -->
        <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <!-- ESC button -->
            <div
                class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                    viewBox="0 0 18 18">
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                    </path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content py-4 text-left px-6">
                <!--Title-->
                <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Hình ảnh khách sạn</p>
                    <div class="modal-close-img cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <!-- main img -->
                <?php foreach($showDetail as $row){
                $img = helper::convertHotelNameToFolderName([$row['hName']]);
                   echo '<div class="w-full mb-4">
                    <img src="./public/uploads/hotel/'.implode('-',$img).'/'.$row['avatar'].'"
                        alt="" class="w-full h-full rounded-lg">
                </div>';
                }?>
                <!-- img list -->
                <div class="w-full">
                    <div class="grid grid-cols-4 gap-2">
                    <?php foreach($showAllImg as $showAll){
                        $img = helper::convertHotelNameToFolderName([$row['hName']]);
                        echo '<div class="w-full" >
                            <img src="./public/uploads/hotel/'.implode('-',$img).'/'.$showAll['Iname'].'"
                                alt="" class="rounded-lg" style="width:100%; height: 100px;">
                        </div>'; }?>
                    </div>
                </div>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <!-- <button
                        class="px-4 bg-transparent p-3 rounded-lg text-blue-500 hover:bg-gray-100 hover:text-blue-400 mr-2">Action</button>
                    <button
                        class="modal-close px-4 bg-blue-500 p-3 rounded-lg text-white hover:bg-blue-400">Close</button> -->
                </div>
            </div>
        </div>
    </div>

    <!-- ROOM TYPE MODAL -->
    <!-- #1 -->
        <!-- ROOM TYPE MODAL -->
    <!-- #1 -->
    <?php foreach($showAllRoomChild as $showRoom){ ?>
    <div id="<?php echo $showRoom['id'];?>" class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center overflow-scroll">
        <!-- overlay -->
        <div class="modal-overlay bg-black absolute w-full h-full opacity-50"></div>

        <div class="h-128 modal-container w-11/12 md:max-w-2xl mx-auto rounded shadow-lg z-50 overflow-y-auto">

            <!-- ESC button -->
            <div
                class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
                <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                    viewBox="0 0 18 18">
                    <path
                        d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                    </path>
                </svg>
                <span class="text-sm">(Esc)</span>
            </div>

            <!-- Add margin if you want to see some of the overlay behind the modal-->
            <div class="modal-content h-full py-2 text-left px-2 bg-gray-800">
                <!--Title-->
                <!-- <div class="flex justify-between items-center pb-3">
                    <p class="text-2xl font-bold">Hình ảnh khách sạn</p>
                    <div class="modal-close cursor-pointer z-50">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div> -->

                <!--Body-->
                <div class="w-full h-full p-2">
                    <div class="grid grid-cols-3 gap-4">
                        <!-- img gallery -->
                        <!-- wrapper -->
                        <div class="w-full h-full col-span-2 overflow-scroll" id="imgContent">
                            <!-- main img -->
                            <img id="mainImg" src="./public/uploads/hotel/<?php 
                            $img = helper::convertHotelNameToFolderName([$row['hName']]);
                            echo implode('-',$img);
                            ?>/<?php echo $showRoom['img'];?>" alt="" class="w-full rounded-lg h-64 object-cover mb-2">
                            <!-- img tile -->
                            <div class="grid grid-cols-3 gap-2">
                            <?php foreach($showRoom['rImg'] as $img){?>
                                <img src="./public/uploads/hotel/<?php 
                            $imgage = helper::convertHotelNameToFolderName([$row['hName']]);
                            echo implode('-',$imgage);
                            ?>/<?php echo $img['images'];?>" alt="" class="w-full rounded-lg object-cover mb-2"  style="width:100%; height: 100px;">
                            <?php }?>
                            </div>
                        </div>

                        <!-- info  -->
                        <div class="w-full h-full overflow-scroll relative bg-gray-200">
                            <!-- info -->
                            <div class="p-2">
                                <p class="text-md text-black font-semibold">
                                    Thông tin phòng
                                </p>
                                <ul class="text-sm">
                                    <li class="text-sm">
                                        Diện tích: <?php echo $showRoom['spm'];?>m <sup>2</sup>
                                    </li>
                                    <li class="text-sm">
                                        Khách: <span id="limit-people"><?php echo $showRoom['guest'];?> người</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="p-1">
                                <p class="text-md text-black font-semibold">
                                    Tiện ích phòng
                                </p>

                                <ul>
                                <?php foreach($showRoom['fRoom'] as $fRoom){ ?>
                                    <li class="text-sm">
                                    <?php echo $fRoom['fRoom'];?>
                                    </li>
                                <?php }?>
                                </ul>
                            </div>
                            <div class="p-1">
                                <p class="text-md text-black font-semibold">
                                    Tiện ích phòng Tắm
                                </p>

                                <ul>
                                <?php foreach($showRoom['fBathRoom'] as $fRoom){ ?>
                                    <li class="text-sm">
                                    <?php echo $fRoom['fBathRoom'];?>
                                    </li>
                                <?php }?>
                                </ul>
                            </div>
                            <!-- price -->
                            <div class="w-full p-2 absolute bottom-0 bg-white shadow-t-md left-0 z-10">
                                <p class="text-gray-600 text-md">Khởi điểm từ:</p>
                                <p class="text-orange-400 text-2xl font-bold"><?php
                                     $price = "";
                                     if($showChild['rate']==0){
                                     $price = $showRoom['price'] - $showRoom['price']*0.1;
                                     }else{
                                     $price = $showChild['rate'] - $showChild['rate']*0.1;
                                     }
                                     echo number_format("$price",0,",",".");
                                    ?> vnd</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Footer-->
                <div class="flex justify-end pt-2">
                    <!-- <button
                        class="px-4 bg-transparent p-3 rounded-lg text-blue-500 hover:bg-gray-100 hover:text-blue-400 mr-2">Action</button>
                    <button
                        class="modal-close px-4 bg-blue-500 p-3 rounded-lg text-white hover:bg-blue-400">Close</button> -->
                </div>
            </div>
        </div>
    </div>
    <?php }?>
    <!-- FOOTER -->
    <footer class="bg-gray-200 px-6 pt-12 tu-text-title">
        <div class="px-2">
            <div class="max-w-screen-xl mx-auto">
                <div class="flex flex-wrap justify-center py-8">
                    <!-- logo -->
                    <div class="p-3 w-full sm:w-full lg:w-1/5">
                        <div class="">
                            <img src="public/images/footer--color__logo-v-3.svg" alt="" class="w-3/4">
                        </div>
                    </div>

                    <!-- info -->
                    <div class="p-3 w-full sm:w-full lg:w-1/5 tu-text-title">
                        <div class="text-md uppercase text-black font-semibold tu-text-title">Dịch vụ</div>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Đặt phòng</a>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Đặt vé máy bay</a>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Đặt Homestay</a>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Combo <span
                                class="bg-orange-400 text-white p-1 rounded-lg px-3 font-semibold">-25%</span></a>
                    </div>

                    <!-- info -->
                    <div class="p-3 w-full sm:w-full lg:w-1/5">
                        <div class="text-md uppercase text-black font-semibold">Thông báo</div>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">FAQ</a>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Về dịch
                            Covid-19</a>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Trung tâm trợ
                            giúp</a>
                        <!-- <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Combo <span class="bg-orange-400 text-white p-1 rounded-lg px-3 font-semibold">-25%</span></a> -->
                    </div>

                    <!-- info -->
                    <div class="p-3 w-full sm:w-full lg:w-1/5">
                        <div class="text-md uppercase text-black font-semibold">Điều khoản dịch vụ</div>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Điều khoản</a>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Chính sách vận
                            chuyển</a>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Chính sách hoàn
                            tiền</a>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Chính sách bảo
                            mật</a>
                    </div>

                    <!-- info -->
                    <div class="p-3 w-full sm:w-full lg:w-1/5">
                        <div class="text-md uppercase text-black font-semibold">Newsletter</div>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Đăng ký để nhận ưu
                            đãi mỗi
                            ngày!</a>

                        <!--  -->
                        <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                            <input type="text"
                                class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-r-none px-3 relative"
                                placeholder="johndoe@gmail.com">
                            <!-- <div class="flex -mr-px">
                            <span
                                class="flex items-center hover:underline bg-orange-400 rounded rounded-l-none border border-l-0 px-3 whitespace-no-wrap text-white text-sm font-semibold">@gmail.com</span>
                        </div> -->
                        </div>

                        <!-- submit btn -->
                        <button
                            class="bg-orange-400 hover:bg-orange-500 font-semibold text-lg rounded text-white w-full p-2">Đăng
                            ký</button>
                    </div>
                </div>
                <div class="barchart_values"></div>                        
            </div>
        </div>
    </footer>

    <!-- subfooter -->
    <!-- social media -->
    <div class="bg-blue-600 pt-2 sm:px-6 md:px-6">
        <div class="flex pb-5 m-auto pt-5 text-gray-800 text-sm flex-col
       md:flex-row max-w-6xl">
            <div class="mt-2 text-white font-semibold"><span>&copy;</span> Copyright 2020. All Rights Reserved.</div>
            <div class="md:flex-auto md:flex-row-reverse mt-2 flex-row flex">
                <a href="/#" class="w-6 mx-1 text-lg">
                    <!-- <ion-icon name="logo-facebook" class="text-white text-2xl"></ion-icon> -->
                    <i class="fa fa-facebook-official text-white" aria-hidden="true"></i>
                </a>
                <a href="/#" class="w-6 mx-1 text-lg text-white">
                    <!-- <ion-icon name="logo-facebook" class="text-white text-2xl"></ion-icon> -->
                    <i class="fa fa-globe" aria-hidden="true"></i>
                </a>
                <a href="/#" class="w-6 mx-1 text-lg text-white">
                    <!-- <ion-icon name="logo-facebook" class="text-white text-2xl"></ion-icon> -->
                    <i class="fa fa-instagram" aria-hidden="true"></i>
                </a>
                <a href="/#" class="w-6 mx-1 text-lg text-white">
                    <!-- <ion-icon name="logo-facebook" class="text-white text-2xl"></ion-icon> -->
                    <i class="fa fa-youtube-play" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </div>
    
    <!-- END FOOTER -->
    <!-- IMPORT CORE PLUGIN -->
    <!-- LESS -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.11.1/less.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
    <script src="./public/js/modal/open_modal.js"></script>
   <script src="https://js.pusher.com/6.0/pusher.min.js"></script>
    <script src="./public/js/main/pusher.js"></script>
    <script src="./public/js/main/comment.js"></script>
    <script src="./public/js/main/loadPercen.js"></script>
    </body>
    </html>
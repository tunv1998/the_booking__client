<body class="antialiased bg-gray-100 dark-mode:bg-gray-900 relative">
    <!-- MENU -->


    <!-- PROMOTION BANNER -->
    <div class="w-100">
        <img src="https://ik.imagekit.io/tvlk/image/imageResource/2020/05/11/1589180453454-44bb9710e7ab20dadf65e352516edc14.png?tr=q-75"
            alt="" class="w-full">
    </div>

    <!-- SEARCH RESULT AT -->
    <section id="search-result" class="py-12">
        <div class="mx-auto px-4 sm:px-8 py-2 max-w-screen-xl">
            <!--  -->
            <div class="flex justify-between items-center mb-6">
                <div class="flex-col items-start">
                    <h1 class="text-2xl tu-text-title">
                        Kết quả tìm kiếm của bạn tại <span id="you-search-for"
                            class="font-semibold text-blue-500 tu-text-title"><?php
                            $id = "";
                            if(isset($_GET['id'])){
                                $id = $_GET['id'];
                            }else{
                                $id = $_SESSION['province'];
                            }
                            echo $id;
                            ?></span>
                    </h1>
                    <p class="text-lg text-gray-600"><span id="from-day">
                            <?php  if(isset($_SESSION['check-in'])){
                            $data = $_SESSION["check-in"];
                            $date=date_create("$data");  
                            echo date_format($date,"d-m-Y");
                            }?>
                            </span>
                            -
                            <span id="to-day">
                            <?php if(isset($_SESSION['check-out'])){
                            $data = $_SESSION["check-out"];
                            $date=date_create("$data");  
                            echo date_format($date,"d-m-Y");                            
                            }?>
                            </span>
                    </p>
                </div>
                <a href="./index.php">
                <button class="bg-orange-500 text-white font-semibold text-lg p-2 rounded-lg">Sửa tìm kiếm</button>
                </a>
            </div>
            <input type="hidden" name = "hname" id="hname" value="<?php 
                    $id = "";
                    if(isset($_GET['id'])){
                      $id = $_GET['id'];
                    }else{
                      $id = $_SESSION['province'];
                    }
                    echo $id;?>">
                    <input type="hidden" name = "hname" id="total-people" value="<?php $total_people = ""; if(isset($_SESSION['total-people'])){
                      $total_people= $_SESSION['total-people'];
                    }else{
                      $total_people = 1;
                    } 
                    echo $total_people;?>">
            <hr class="mb-4">

            <!--  -->
            <div class="flex justify-center">
                <div class="w-1/4 pr-2">
                    <!-- See map -->
                    <div class="w-full relative mb-4">
                        <img src="https://cdn6.agoda.net/images/MAPS-1213/default/bkg-map-entry.svg" alt=""
                            class="w-full rounded-lg shadow-sm">
                        <div class="absolute tu-abs-center text-center">
                            <ion-icon name="map" class="text-red-500 md hydrated p-2 rounded-lg bg-white"></ion-icon>
                            <p class="text-black text-xl">Xem bản đồ</p>
                        </div>
                    </div>

                    <!-- sort by price -->
                    <div class="w-full p-4 border rounded-lg bg-white mb-4">
                        <h3 class="text-md font-semibold text-black">Sắp xếp kết quả</h3>
                        <p class="text-gray-600">Sắp xếp kết quả theo lựa chọn</p>
                        <hr class="m-1">

                        <!--  -->
                        <div class="flex-col">
                            <label for="" class="inline-flex items-center mt-3">
                                <input type="radio" name="sort-by-price"
                                    class="form-checkbox h-5 w-5 price common_selector" value="desc" >
                                <span class="ml-2 text-gray-700">Giá cao nhất</span>
                            </label>
                            <label for="" class="inline-flex items-center mt-3">
                                <input type="radio" name="sort-by-price"
                                    class="form-checkbox h-5 w-5 price common_selector" value="asc">
                                <span class="ml-2 text-gray-700">Giá thấp nhất</span>
                            </label>
                            <label for="" class="inline-flex items-center mt-3">
                                <input type="radio" value="desc" name="sort-by-price" id="popular" class="form-checkbox h-5 w-5 review common_selector">
                                <span class="ml-2 text-gray-700">Độ phổ biến</span>
                            </label>
                            <label for="" class="inline-flex items-center mt-3">
                                <input type="radio" value="asc" name="sort-by-price" id="score" class="form-checkbox h-5 w-5 review common_selector">
                                <span class="ml-2 text-gray-700">Điểm đánh giá</span>
                            </label>
                        </div>
                    </div>

                    <!-- filter -->
                    <div class="w-full p-4 border rounded-lg bg-white">
                        <h3 class="text-md font-semibold text-black">Lọc kết quả</h3>
                        <p class="text-gray-600">Hiển thị phân loại theo</p>
                        <hr class="m-1">

                        <!-- booking policy -->
                        <div class="mt-4">
                            <h3 class="text-md font-semibold text-black">Chính sách đặt phòng</h3>
                            <label for="" class="inline-flex items-center mt-1">
                                <input type="checkbox" name="cancel-free" id="cancel-free"
                                    class="form-checkbox h-5 w-5">
                                <span class="ml-2 text-gray-700">Miễn phí huỷ phòng</span>
                            </label>
                        </div>

                        <!-- price range -->
                        <div class="mt-4">
                             <!-- # amount per night -->
                            <div id="amount-per-night">
                            <h3 class="text-md font-semibold text-black">Khoảng giá</h3>
                                <input type="hidden" id="hidden_minimum_price" value="0" />
                                <input type="hidden" id="hidden_maximum_price" value="10000000" />
                                <p id="price_show">10000 - 10000000</p>
                                <div id="price_range"></div>
                            </div>
                        </div>

                        <!-- hotel stars -->
                        <div class="mt-4">
                            <h3 class="text-md font-semibold text-black">Hạng sao</h3>

                            <div class="flex-col">

                                <!-- 1 sao -->
                                <label for="" class="flex items-center mt-1 items-center">
                                    <input type="checkbox" name="cancel-free" id="cancel-free"
                                        class="form-checkbox h-5 w-5 stars common_selector" value="1">
                                    <span class="ml-2 text-yellow-400 text-xl flex">
                                        <i class="fa fa-star mr-1"></i>
                                        <!-- <i class="fa fa-star mr-1"></i> -->
                                    </span>
                                </label>
                                <!-- 2 sao -->
                                <label for="" class="flex items-center mt-1 items-center">
                                    <input type="checkbox" name="cancel-free" id="cancel-free"
                                        class="form-checkbox h-5 w-5 stars common_selector" value="2">
                                    <span class="ml-2 text-yellow-400 text-xl flex">
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                    </span>
                                </label>
                                <!-- 3 sao -->
                                <label for="" class="flex items-center mt-1 items-center">
                                    <input type="checkbox" name="cancel-free" id="cancel-free"
                                        class="form-checkbox h-5 w-5 stars common_selector" value="3">
                                    <span class="ml-2 text-yellow-400 text-xl flex">
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                    </span>
                                </label>
                                <!-- 4 sao -->
                                <label for="" class="flex items-center mt-1 items-center">
                                    <input type="checkbox" name="cancel-free" id="cancel-free"
                                        class="form-checkbox h-5 w-5 stars common_selector" value="4">
                                    <span class="ml-2 text-yellow-400 text-xl flex">
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                    </span>
                                </label>
                                <!-- 5 sao -->
                                <label for="" class="flex items-center mt-1 items-center">
                                    <input type="checkbox" name="cancel-free" id="cancel-free"
                                        class="form-checkbox h-5 w-5 stars common_selector" value="5">
                                    <span class="ml-2 text-yellow-400 text-xl flex">
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                        <i class="fa fa-star mr-1"></i>
                                    </span>
                                </label>
                            </div>
                        </div>

                        <!-- type -->
                        <div class="mt-4">
                            <h3 class="text-md font-semibold text-black">Loại hình lưu trú</h3>

                            <!--  -->
                            <div class="flex flex-col">
                                <!-- hotel -->
                                <label for="" class="inline-flex items-center mt-1">
                                    <input type="checkbox" name="cancel-free" id="hotel" class="form-checkbox h-5 w-5">
                                    <span class="ml-2 text-gray-700">Khách sạn</span>
                                </label>
                                <!-- homestay -->
                                <label for="" class="inline-flex items-center mt-1 hover:cursor-not-allowed">
                                    <input type="checkbox" name="cancel-free" id="homestay"
                                        class="form-checkbox h-5 w-5" disabled>
                                    <span class="ml-2 text-gray-700">Homestay</span>
                                </label>
                                <!-- homestay -->
                                <label for="" class="inline-flex items-center mt-1">
                                    <input type="checkbox" name="cancel-free" id="resort" class="form-checkbox h-5 w-5"
                                        disabled>
                                    <span class="ml-2 text-gray-700">Resort</span>
                                </label>
                                <!-- homestay -->
                                <label for="" class="inline-flex items-center mt-1">
                                    <input type="checkbox" name="cancel-free" id="house" class="form-checkbox h-5 w-5"
                                        disabled>
                                    <span class="ml-2 text-gray-700">House</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="w-3/4 pl-2 relative">
                    <!-- info -->
                    <div class="w-full text-white py-2 px-4 mb-4 bg-blue-500 rounded-lg sticky top-0">
                        <div class="flex items-center justify-start">
                            <ion-icon name="wallet"></ion-icon>
                            <span class="pl-2 text-xl font-semibold">Giá cuối cùng, không chi phí ẩn</span>
                        </div>
                    </div>

                    <!-- hotel list -->
                    <div class="filter_data"></div>
                </div>
            </div>
        </div>
    </section>
    <!-- END SEARCH RESULT AT -->

    

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
                                    class="flex items-center bg-orange-400 rounded rounded-l-none border border-l-0 px-3 whitespace-no-wrap text-white text-sm font-semibold">@gmail.com</span>
                            </div> -->
                        </div>

                        <!-- submit btn -->
                        <button
                            class="bg-orange-400 hover:bg-orange-500 font-semibold text-lg rounded text-white w-full p-2">Đăng
                            ký</button>
                    </div>
                </div>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.js"></script>
    <script src="<?= BASEURL ?>/public/vendor/bootstrap/bootstrap.min.js"></script>
    <script src="<?= BASEURL ?>/public/vendor/jquery/jquery-1.10.2.min.js"></script>
    <script src="<?= BASEURL ?>/public/vendor/jquery/jquery-ui.js"></script>
    <link href = "<?= BASEURL ?>/public/css/jquery-ui.css" rel = "stylesheet">
    <script src="<?= BASEURL ?>/public/js/main/filter.js"></script>
</body>
</html>

<?php
$gethotelRating = $data['rating'];
?>
<section id="search-for-place" class="flex flex-col justify-center py-12 tu-bg-img" style="background-image: url('public/images/beach-bg.png');">
        <!-- title -->
        <div class="text-center mx-3">
            <h1 class="font-bold text-2xl lg:text-2xl uppercase  tu-text-title">Khách sạn, khu nghỉ dưỡng và nhiều hơn
                nữa
            </h1>
            <p class="font-semibold text-md lg:text-xl text-white">Nhận giá tốt nhất từ hơn 200.000 khách sạn</p>
        </div>

        <!-- Form -->
        <form action="" method="post">
        <div class="md:w-2/3 sm:w-full xl:w-1/2 mx-auto p-2">
            <!-- Location-->
            <div class="px-8 my-3 relative">
                <!-- input location  -->
                <div class="bg-white flex items-center rounded-full border">
                    <div class="p-2">
                        <span
                            class="bg-blue-500 text-white rounded-full p-2 w-12 h-12 flex items-center justify-center">
                            <ion-icon name="navigate"></ion-icon>
                            <!-- <ion-icon name="search" class="text-white"></ion-icon> -->
                        </span>
                    </div>
                    <input class="rounded-l-full w-2/3 py-4 px-4 text-gray-700 leading-tight focus:outline-none"
                        id="location" type="text" placeholder="Thử 'Đà Nẵng'" name="location">
                        <input type="hidden" name="hid" value="" id="hid">
                </div>

                <!-- suggest -->
                <div class="absolute top-14 left-0 w-full px-8 z-40 mx-1" id="suggesstion-box">
                    <div class="bg-white my-2 rounded-lg top-1 p-2" id="suggestion-box-search">
                       
                    </div>
                </div>
            </div>

            <!-- Day check in-out -->
            <div class="flex px-8 my-3 flex-col justify-between md:flex-row lg:flex-row lg:flex-row">
                <div class="w-full lg:w-2/3">
                    <div class="">
                        <div class="bg-white flex items-center rounded-full  border">
                            <div class="p-2">
                                <span
                                    class="bg-blue-500 text-white rounded-full p-2 w-12 h-12 flex items-center justify-center">
                                    <ion-icon name="calendar"></ion-icon>
                                </span>
                            </div>
                            <input class="rounded-l-full w-2/3 py-4 px-4 text-gray-700 leading-tight focus:outline-none"
                                id="check-in" name="check-in" type="text" onfocus="(this.type = 'date')" placeholder="Ngày đến">
                        </div>
                    </div>
                </div>
                <!-- gap -->
                <div class="m-2"></div>
                <!-- end gap -->
                <div class="w-full lg:w-2/3">
                    <div class="">
                        <div class="bg-white flex items-center rounded-full  border">
                            <div class="p-2">
                                <span
                                    class="bg-blue-500 text-white rounded-full p-2 w-12 h-12 flex items-center justify-center">
                                    <ion-icon name="calendar"></ion-icon>
                                </span>
                            </div>
                            <input class="rounded-l-full w-2/3 py-4 px-4 text-gray-700 leading-tight focus:outline-none"
                                id="check-out" name="check-out" type="text" onfocus="(this.type = 'date')" placeholder="Ngày đi">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Number of people -->
            <div class="flex px-8 my-3 flex-col justify-between md:flex-row lg:flex-row lg:flex-row">
                <!-- Number of people -->
                <div class="w-full lg:w-2/3">
                    <div class="bg-white flex items-center rounded-full border">
                        <div class="p-2">
                            <span
                                class="bg-blue-500 text-white rounded-full p-2 w-12 h-12 flex items-center justify-center">
                                <ion-icon name="person"></ion-icon>
                            </span>
                        </div>
                        <!-- <input class="rounded-l-full w-2/3 py-4 px-4 text-gray-700 leading-tight focus:outline-none" id="check-in" type="text" onfocus="(this.type = 'date')" placeholder="Ngày đến"> -->
                        <div class="relative w-2/3 lg:w-4/5 flex">
                            <!-- people -->
                            <div class="w-1/2 relative">
                                <select
                                class="block appearance-none w-full text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none"
                                id="grid-state" name="total-people">
                                    <option value="1">1 người</option>
                                    <option value="2">2 người</option>
                                    <option value="3">3 người</option>
                                    <option value="4">4 người</option>
                                </select>
                                <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                        <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                            <!-- room -->
                            <div class="w-1/2 relative">
                                <select
                                class="block appearance-none w-full text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none"
                                id="grid-state" name="roomCount">
                                    <option value="1">1 phòng</option>
                                    <option value="2">2 phòng</option>
                                    <option value="3">3 phòng</option>
                                    <option value="4">4 phòng</option>
                                </select>
                                <div
                                class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 20 20">
                                        <path
                                        d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- gap -->
                <div class="m-2"></div>
                <!-- Search btn -->
                <div class="w-full lg:w-1/3 ">
                    <div class="border border-orange-500 bg-orange-400 flex items-center rounded-full hover:bg-orange-500">
                        <div class="p-2">
                            <button
                                class="text-white rounded-full p-2 h-12 flex items-center justify-center uppercase font-semibold" name="submit">
                                <ion-icon name="search" class="w-12"></ion-icon>
                                Tìm Kiếm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
        <!-- End Form -->
        </div>
    </section>

    <!-- MORE MEMORABLES -->
    <section id="memories" class="bg-white sm:px-0 md:px-0 lg:px-8 xl:px-8 py-12">
        <div class="max-w-screen-xl mx-auto sm:px-0 md:px-0 lg:px-4 xl:px-4">
            <div class="px-2 py-8">
                <div class="grid grid-cols-4 gap-4">
                    <!-- Special Offer -->
                    <div class="col-span-2 py-4 border rounded-lg relative overflow-hidden relative h-96 tu-bg-img" style="background-image: url(https://static.asiawebdirect.com/m/bangkok/portals/vietnam/homepage/da-nang/top10/top10-da-nang-hotels-beach/pagePropertiesImage/danang-best-hotels.jpg.jpg);">    
                    </div>

                    <div class="col-span-2 px-4">
                        <p class="tu-text-title text-2xl font-semibold uppercase mb-2">Khám phá chuyến du lịch của bạn</p>
                        <p class="text-gray-500 text-lg mb-2">Since 2014, we've helped more than 500,000 people of all ages enjoy the best outdoor experience of their lives. Whether it's for one day or a two-week vacation, close to home or a foreign land.</p>

                        <!-- pros -->
                        <div class="grid grid-cols-3 gap-4 my-8">
                            <div class="flex flex-col items-center">
                                <ion-icon name="boat" class="text-2xl text-orange-400 mb-2"></ion-icon>
                                <p>Unique Atmosphere</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <ion-icon name="eye" class="text-2xl text-orange-400 mb-2"></ion-icon>
                                <p>Environment</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <ion-icon name="pin" class="text-2xl text-orange-400 mb-2"></ion-icon>
                                <p>Great Location</p>
                            </div>
                            
                        </div>
                    </div>

                    
                </div>
            </div>
        </div>
    </section>
    <!-- END MORE MEMORABLES -->

    <!-- SUGGEST -->
    <section id="suggest-place" class="my-12 mb-12">
        <div class="mx-auto px-4 sm:px-8 py-2 text-center max-w-screen-xl">
            <!-- title -->
            <div class="text-center max-w-xl mx-auto mt-6">
                <h2 class="mx-auto uppercase font-bold text-xl lg:text-2xl tu-text-title">
                    Gợi ý khách sạn cho bạn
                </h2>
            </div>

            <!-- room type -->
            <div class="grid grid-cols-6 gap-4 items-start mt-8 mx-auto px-6">
                <!--  -->
                <?php foreach($gethotelRating as $row){ ?>
                <div
                    class="col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-2 xl:col-span-2 border rounded-md hover:border-blue-400">
                    <!-- 1 -->
                    <div class="bg-white hover:  rounded-lg pb-4">
                        <div class="h-40 bg-gray-200 rounded-t-md rounded-b-none object-cover tu-bg-img mb-4"
                            style="background-image: url(./public/uploads/hotel/<?php 
                            $img = helper::convertHotelNameToFolderName([$row['hName']]);
                            echo implode('-',$img);
                            ?>/<?php echo $row['avatar']?>);">
                            <!-- <img src="https://cdn6.agoda.net/images/accommodation/other-property-types/entire-apartment.jpg" alt="" class="w-full"> -->
                        </div>
                        <!-- Hotel name -->
                        <a href='./index.php?controller=hotel&action=detail&id=<?php echo $row['hId'];?>' class="hover:underline text-2xl my-2 mt-8 font-semibold"><?php echo $row['hName'];?></a>
                        <!-- Address -->
                        <p class=" text-base my-2"><?php echo $row['wName']?>,<span id="state"><?php echo $row['dName']?></p>
                        <!-- stars -->
                        <div class="flex justify-center mt-2 text-yellow-400 text-lg">
                        <?php echo $star = helpers::showStar($row['hStar']);?>
                        </div>
                        <!-- price -->
                        <div class="flex justify-center items-center mt-4">
                            <p class="text-2xl text-blue-500 px-2"><span id="currency">VND</span> <span id="price"
                                    class="font-black"><?php 
                        if($row['rate']==null){
                        $price = $row['pri'];
                        echo number_format("$price",0,",",".");
                        }else{
                        $price = $row['rate'];
                        echo number_format("$price",0,",",".");
                        }?></span></p>

                            <!-- See more btn -->
                            <a href="./index.php?controller=hotel&action=detail&id=<?php echo $row['hId'];?>" class="rounded-md w-auto p-2 text-white bg-orange-400 hover:bg-orange-500">Xem
                                Thêm</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- SUGGEST PLACE -->
    <section id="suggest-place" class="py-12 px-8">
        <div class="mx-auto px-6 py-2 text-center max-w-screen-xl">
            <div class="text-center max-w-xl mx-auto mt-6 mb-4">
                <h1 class="mx-auto uppercase font-bold text-xl lg:text-2xl tu-text-title">Gợi ý điểm đến</h1>
            </div>

            <div class="grid grid-cols-6 gap-4">
            <a href="./index.php?controller=hotel&action=listHotel&id=Hà Nội">
                <div class="relative">
                    <img src="https://vhrpro.com/storage/most-popular/cau-long-bien-500x500.jpg" alt="" class="rounded-lg hover:border">
                    <!-- place -->
                    <div class="text-lg text-white bg-gray absolute top-0 left-0 w-full">
                        <div class="relative w-full">
                        <!-- overlay -->
                            <div class="absolute top-0 bg-black opacity-25 w-full h-10 rounded-t-lg"></div>
                            <p class="text-lg absolute p-2 text-white">Hà Nội</p>
                        </div>
                    </div>
                </div>
                </a>
                <a href="./index.php?controller=hotel&action=listHotel&id=Huế">
                <div class="relative">
                    <img src="https://imagesfb.tintuc.vn/upload/images/hue/20170821/thi%C3%AAn.jpg" alt="" class="rounded-lg">
                    <!-- place -->
                    <div class="text-lg text-white bg-gray absolute top-0 left-0 w-full">
                        <div class="relative w-full">
                        <!-- overlay -->
                            <div class="absolute top-0 bg-black opacity-25 w-full h-10 rounded-t-lg"></div>
                            <p class="text-lg absolute p-2 text-white">Huế</p>
                        </div>
                    </div>
                </div>
                </a>
                <a href="./index.php?controller=hotel&action=listHotel&id=Đà Nẵng">
                <div class="relative">
                    <img src="https://vhrpro.com/storage/services/vhrpro/anh-dang-bai/500x500/chua-linh-ung-500-x500.jpg" alt="" class="rounded-lg">
                    <!-- place -->
                    <div class="text-lg text-white bg-gray absolute top-0 left-0 w-full">
                        <div class="relative w-full">
                        <!-- overlay -->
                            <div class="absolute top-0 bg-black opacity-25 w-full h-10 rounded-t-lg"></div>
                            <p class="text-lg absolute p-2 text-white">Đà Nẵng</p>
                        </div>
                    </div>
                </div>
                </a>
                <a href="./index.php?controller=hotel&action=listHotel&id=Quảng Ngãi">
                <div class="relative">
                    <img src="https://lysontravel.vn/datafiles/5008/upload/images/1507354050_coppy_14776274953153_du-lich-binhba-5-500x500.jpg" alt="" class="rounded-lg">
                    <!-- place -->
                    <div class="text-lg text-white bg-gray absolute top-0 left-0 w-full">
                        <div class="relative w-full">
                        <!-- overlay -->
                            <div class="absolute top-0 bg-black opacity-25 w-full h-10 rounded-t-lg"></div>
                            <p class="text-lg absolute p-2 text-white">Quảng Ngãi</p>
                        </div>
                    </div>
                </div>
                </a>
                <a href="./index.php?controller=hotel&action=listHotel&id=Hồ Chí Minh">
                <div class="relative">
                    <img src="https://q-cf.bstatic.com/images/hotel/max500/241/241441595.jpg" alt="" class="rounded-lg">
                    <!-- place -->
                    <div class="text-lg text-white bg-gray absolute top-0 left-0 w-full">
                        <div class="relative w-full">
                        <!-- overlay -->
                            <div class="absolute top-0 bg-black opacity-25 w-full h-10 rounded-t-lg"></div>
                            <p class="text-lg absolute p-2 text-white">Hồ Chí Minh</p>
                        </div>
                    </div>
                </div>
                </a>
                <a href="./index.php?controller=hotel&action=listHotel&id=Cần Thơ">
                <div class="relative">
                    <img src="https://static.hotdeal.vn/images/1507/1507456/60x60/343928-tour-can-tho-2n1d--tieu-chuan-5--tat-muong-bat-ca--ben-ninh-kieu--cho-noi-cai-rang--nha-co-binh-thuy--ap-dung-le-tet.jpg" alt="" class="rounded-lg">
                    <!-- place -->
                    <div class="text-lg text-white bg-gray absolute top-0 left-0 w-full">
                        <div class="relative w-full">
                        <!-- overlay -->
                            <div class="absolute top-0 bg-black opacity-25 w-full h-10 rounded-t-lg"></div>
                            <p class="text-lg absolute p-2 text-white">Cần Thơ</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- STEPS -->
    <section id="step" class="mb-4 my-12 pb-10">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-8 py-2 text-center">
            <h1 class="mx-auto uppercase font-bold text-xl lg:text-2xl tu-text-title text-center mx-auto my-6">3 bước
                đặt phòng đơn giản</h1>
            <!-- location -->
            <div class="flex">
                <div class="sm:w-full lg:w-1/3 sm:w-full text-center px-6">
                    <div class="bg-blue-500 rounded-lg flex items-center justify-center">
                        <div
                            class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step text-2xl text-white">
                            <ion-icon name="search"></ion-icon>
                        </div>
                        <div
                            class="w-2/3 bg-white h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                            <h2 class="font-bold text-sm">Tìm kiếm địa điểm, khách sạn</h2>
                            <p class="text-xs text-gray-600">
                                Bạn dự tính đi đến đâu?
                            </p>
                        </div>
                    </div>
                </div>
                <!-- arrow -->
                <div class="flex-1 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M14 2h-7.229l7.014 7h-13.785v6h13.785l-7.014 7h7.229l10-10z" /></svg>
                </div>

                <!-- location -->
                <div class="w-1/3 lg:w-1/3 sm:w-full text-center px-6">
                    <div class="bg-blue-500 rounded-lg flex items-center justify-center">
                        <div
                            class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step text-2xl text-white">
                            <ion-icon name="create"></ion-icon>
                        </div>
                        <div
                            class="w-2/3 bg-white h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                            <h2 class="font-bold text-sm">Điền thông tin</h2>
                            <p class="text-xs text-gray-600">
                                Thông tin cá nhân, thanh toán
                            </p>
                        </div>
                    </div>
                </div>
                <!-- arrow -->
                <div class="flex-1 flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M14 2h-7.229l7.014 7h-13.785v6h13.785l-7.014 7h7.229l10-10z" /></svg>
                </div>

                <!-- location -->
                <div class="w-1/3 lg:w-1/3 sm:w-full text-center px-6">
                    <div class="bg-blue-500 rounded-lg flex items-center justify-center">
                        <div
                            class="w-1/3 bg-transparent h-20 flex items-center justify-center icon-step text-2xl text-white">
                            <ion-icon name="checkmark-circle"></ion-icon>
                        </div>
                        <div
                            class="w-2/3 bg-white h-24 flex flex-col items-center justify-center px-1 rounded-r-lg body-step">
                            <h2 class="font-bold text-sm">Hoàn thành</h2>
                            <p class="text-xs text-gray-600">
                                Giờ hãy chuẩn bị balo để đi nào!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

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
                        <div class="text-md uppercase text-black font-semibold tu-text-title">Thông báo</div>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">FAQ</a>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Về dịch
                            Covid-19</a>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Trung tâm trợ
                            giúp</a>
                        <!-- <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Combo <span class="bg-orange-400 text-white p-1 rounded-lg px-3 font-semibold">-25%</span></a> -->
                    </div>

                    <!-- info -->
                    <div class="p-3 w-full sm:w-full lg:w-1/5">
                        <div class="text-md uppercase text-black font-semibold tu-text-title">Điều khoản dịch vụ</div>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Điều khoản</a>
                        <!-- <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Chính sách vận -->
                            <!-- chuyển</a> -->
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Chính sách hoàn
                            tiền</a>
                        <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Chính sách bảo
                            mật</a>
                    </div>

                    <!-- info -->
                    <div class="p-3 w-full sm:w-full lg:w-1/5">
                        <div class="text-md uppercase text-black font-semibold tu-text-title">Newsletter</div>
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
    <script>
    $(document).ready(function(){
      var currentDate = new Date();
    var date = currentDate.getDate();
    var month = currentDate.getMonth();
    var year = currentDate.getFullYear();
    if(date < 10){
    var dateString =year + "-0" +(month + 1) + "-0" + date;
    }else{
        var dateString =year + "-0" +(month + 1) + "-" + date;
    }
    $("#check-in").attr("min",dateString);
    $("#check-in").change(function(){
    $("#check-out").attr("min",$(this).val());
    });
    })
    </script>
    <!-- LESS CDN -->
    <script src="<?= BASEURL ?>/public/js/main/autocomplete.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.11.1/less.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
</body>
</html>
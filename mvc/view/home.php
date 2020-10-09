
    <!-- SEARCH FOR PLACE -->
    <section id="search-for-place" class="flex flex-col justify-center py-12">
        <!-- title -->
        <div class="text-center mx-3">
            <h1 class="font-bold text-lg lg:text-xl uppercase  tu-text-title">Khách sạn, khu nghỉ dưỡng và nhiều hơn nữa
            </h1>
            <p class="font-semibold text-md lg:text-lg">Nhận giá tốt nhất từ hơn 200.000 khách sạn</p>
        </div>
        <!-- Form -->
        <form action="" method="post">
        <div class="md:w-2/3 sm:w-full xl:w-1/2 mx-auto p-2">
            <!-- Location-->
            <div class="px-8 my-3 relative">
                <!-- input location  -->
                <div class="bg-white flex items-center rounded-full shadow-xl">
                    <div class="p-2">
                        <span class="bg-blue-500 text-white rounded-full p-2 w-12 h-12 flex items-center justify-center">
                            <ion-icon name="navigate"></ion-icon>
                            <!-- <ion-icon name="search" class="text-white"></ion-icon> -->
                        </span>
                    </div>
                    <input class="rounded-l-full w-2/3 py-4 px-4 text-gray-700 leading-tight focus:outline-none" type="text" placeholder="Thử 'Đà Nẵng'" name="location" id="location">
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
                        <div class="bg-white flex items-center rounded-full shadow-xl">
                            <div class="p-2">
                                <span class="bg-blue-500 text-white rounded-full p-2 w-12 h-12 flex items-center justify-center">
                                    <ion-icon name="calendar"></ion-icon>
                                </span>
                            </div>
                            <input class="rounded-l-full w-2/3 py-4 px-4 text-gray-700 leading-tight focus:outline-none" id="check-in" type="text" name="check-in" onfocus="(this.type = 'date')" placeholder="Ngày đến">
                        </div>
                    </div>
                </div>
                <!-- gap -->
                <div class="m-2"></div>
                <!-- end gap -->
                <div class="w-full lg:w-2/3">
                    <div class="">
                        <div class="bg-white flex items-center rounded-full shadow-xl">
                            <div class="p-2">
                                <span class="bg-blue-500 text-white rounded-full p-2 w-12 h-12 flex items-center justify-center">
                                    <ion-icon name="calendar"></ion-icon>
                                </span>
                            </div>
                            <input class="rounded-l-full w-2/3 py-4 px-4 text-gray-700 leading-tight focus:outline-none" id="check-out"  type="text" name="check-out" onfocus="(this.type = 'date')" placeholder="Ngày đi">
                        </div>
                    </div>
                </div>
            </div>

               <!-- Number of people -->
               <div class="flex px-8 my-3 flex-col justify-between md:flex-row lg:flex-row lg:flex-row">
            <!-- Number of people -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white flex items-center rounded-full shadow-xl">
                    <div class="p-2">
                        <span class="bg-blue-500 text-white rounded-full p-2 w-12 h-12 flex items-center justify-center">
                            <ion-icon name="person"></ion-icon>
                        </span>
                    </div>
                    <!-- <input class="rounded-l-full w-2/3 py-4 px-4 text-gray-700 leading-tight focus:outline-none" id="check-in" type="text" onfocus="(this.type = 'date')" placeholder="Ngày đến"> -->
                    <div class="relative w-2/3 lg:w-4/5">
                        <select class="appearance-none w-4/5 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none" id="grid-state" name="total-people">
                            <option value="1">1 người</option>
                            <option value="2">2 người</option>
                            <option value="3">3 người</option>
                            <option value="4">4 người</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
            <!-- gap -->
            <div class="m-2"></div>
            <!-- Number of room -->
            <div class="w-full lg:w-2/3">
                <div class="bg-white flex items-center rounded-full shadow-xl">
                    <div class="p-2">
                        <span class="bg-blue-500 text-white rounded-full p-2 w-12 h-12 flex items-center justify-center">
                            <ion-icon name="albums"></ion-icon>
                        </span>
                    </div>
                    <!-- <input class="rounded-l-full w-2/3 py-4 px-4 text-gray-700 leading-tight focus:outline-none" id="check-in" type="text" onfocus="(this.type = 'date')" placeholder="Ngày đến"> -->
                    <div class="relative w-1/2 lg:w-4/5">
                        <select class="appearance-none w-4/5 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none" id="grid-state" name="roomCount">
                            <option value="1">1 phòng</option>
                            <option value="2">2 phòng</option>
                            <option value="3">3 phòng</option>
                            <option value="4">4 phòng</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- btn -->
        <div class="flex px-8 my-3 flex-col justify-between md:flex-row lg:flex-row lg:flex-row">
            <!-- Search btn -->
            <div class="w-full">
            <button class="w-full bg-orange-400 flex items-center rounded-full hover:bg-orange-500" name="submit">
                <div class="w-full text-white rounded-full p-2 h-12 flex items-center justify-center uppercase font-semibold text-center">
                    <div class="p-2 w-full text-center">
                            <!-- <ion-icon name="search" class="w-12"></ion-icon> -->
                            Tìm Kiếm
                    </div>
                </div>
                </button>
            </div>
        </div>
    </div>
              </form>
    <!-- End Form -->
    </div>
</section>
    <!-- MORE MEMORABLES -->
    <section id="memories" class="bg-white sm:px-0 md:px-0 lg:px-8 xl:px-8 my-12">
        <div class="max-w-screen-xl mx-auto sm:px-0 md:px-0 lg:px-4 xl:px-4">
            <div class="flex">
                <div class="sm:w-full md:w-full lg:w-1/3 xl:w-1/3">
                    <img src="https://images.unsplash.com/photo-1443181844940-9042ec79924b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1000&q=80"
                        alt="" class="w-full">
                </div>
                <div class="sm:w-full md:w-full lg:w-2/3 xl:w-2/3 p-8">
                    <h1
                        class="sm:text-2xl md:text-2xl lg:text-2xl xl:text-2xl font-semibold text-black tu-text-title uppercase mb-4">
                        Hãy tạo nên chuyến đi tuyệt vời của bạn
                    </h1>

                    <p class="text-gray-dark text-lg mb-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                        Illum explicabo praesentium nesciunt molestias tempore tenetur! Quos illum ipsam nesciunt
                        aliquid, iusto illo officiis accusantium architecto non temporibus earum libero. Unde!</p>

                    <button
                        class="bg-orange-400 hover:bg-orange-500 text-md font-semibold tu-text-title text-white px-6 py-4 rounded-md">Đặt
                        phòng ngay</button>
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
                <div
                    class="col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-2 xl:col-span-2 border rounded-md hover:border-blue-400">
                    <!-- 1 -->
                    <div class="bg-white hover:shadow-xl rounded-lg pb-4">
                        <div class="h-40 bg-gray-200 rounded-t-md rounded-b-none object-cover tu-bg-img mb-4"
                            style="background-image: url(https://pix6.agoda.net/hotelImages/323/-1/a724baedbcd4c25ef62b575b16088612.jpg);">
                            <!-- <img src="https://cdn6.agoda.net/images/accommodation/other-property-types/entire-apartment.jpg" alt="" class="w-full"> -->
                        </div>
                        <!-- Hotel name -->
                        <a href="#" class="hover:underline text-2xl my-2 mt-8 font-semibold">Hard Rock Hotel Pattaya</a>
                        <!-- Address -->
                        <p class=" text-base my-2">Pattaya Beach Road, Pattaya, Thailand</p>
                        <!-- stars -->
                        <div class="flex justify-center mt-2 text-yellow-400 text-lg">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <!-- price -->
                        <div class="flex justify-center items-center mt-4">
                            <p class="text-2xl text-blue-500 px-2"><span id="currency">VND</span> <span id="price"
                                    class="font-black">899.000</span></p>

                            <!-- See more btn -->
                            <a href="#" class="rounded-md w-auto p-2 text-white bg-orange-400 hover:bg-orange-500">Xem
                                Thêm</a>
                        </div>
                    </div>
                </div>
                <div
                    class="col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-2 xl:col-span-2 border rounded-md hover:border-blue-400">
                    <!-- 1 -->
                    <div class="bg-white hover:shadow-xl rounded-lg pb-4">
                        <div class="h-40 bg-gray-200 rounded-t-md rounded-b-none object-cover tu-bg-img mb-4"
                            style="background-image: url(https://pix6.agoda.net/hotelImages/323/-1/a724baedbcd4c25ef62b575b16088612.jpg);">
                            <!-- <img src="https://cdn6.agoda.net/images/accommodation/other-property-types/entire-apartment.jpg" alt="" class="w-full"> -->
                        </div>
                        <!-- Hotel name -->
                        <a href="#" class="hover:underline text-2xl my-2 mt-8 font-semibold">Hard Rock Hotel Pattaya</a>
                        <!-- Address -->
                        <p class=" text-base my-2">Pattaya Beach Road, Pattaya, Thailand</p>
                        <!-- stars -->
                        <div class="flex justify-center mt-2 text-yellow-400 text-lg">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <!-- price -->
                        <div class="flex justify-center items-center mt-4">
                            <p class="text-2xl text-blue-500 px-2"><span id="currency">VND</span> <span id="price"
                                    class="font-black">899.000</span></p>

                            <!-- See more btn -->
                            <a href="#" class="rounded-md w-auto p-2 text-white bg-orange-400 hover:bg-orange-500">Xem
                                Thêm</a>
                        </div>
                    </div>
                </div>
                <div
                    class="col-span-6 sm:col-span-6 md:col-span-3 lg:col-span-2 xl:col-span-2 border rounded-md hover:border-blue-400">
                    <!-- 1 -->
                    <div class="bg-white hover:shadow-xl rounded-lg pb-4">
                        <div class="h-40 bg-gray-200 rounded-t-md rounded-b-none object-cover tu-bg-img mb-4"
                            style="background-image: url(https://pix6.agoda.net/hotelImages/323/-1/a724baedbcd4c25ef62b575b16088612.jpg);">
                            <!-- <img src="https://cdn6.agoda.net/images/accommodation/other-property-types/entire-apartment.jpg" alt="" class="w-full"> -->
                        </div>
                        <!-- Hotel name -->
                        <a href="#" class="hover:underline text-2xl my-2 mt-8 font-semibold">Hard Rock Hotel Pattaya</a>
                        <!-- Address -->
                        <p class=" text-base my-2">Pattaya Beach Road, Pattaya, Thailand</p>
                        <!-- stars -->
                        <div class="flex justify-center mt-2 text-yellow-400 text-lg">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                            <i class="fa fa-star-o"></i>
                        </div>
                        <!-- price -->
                        <div class="flex justify-center items-center mt-4">
                            <p class="text-2xl text-blue-500 px-2"><span id="currency">VND</span> <span id="price"
                                    class="font-black">899.000</span></p>

                            <!-- See more btn -->
                            <a href="#" class="rounded-md w-auto p-2 text-white bg-orange-400 hover:bg-orange-500">Xem
                                Thêm</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- SUGGEST PLACE -->
    <section id="suggest-place" class="py-12 px-8">
        <div class="mx-auto px-4 sm:px-8 py-2 text-center max-w-screen-xl">
            <div class="text-center max-w-xl mx-auto mt-6 mb-4">
                <h1 class="mx-auto uppercase font-bold text-xl lg:text-2xl tu-text-title">Gợi ý điểm đến</h1>
            </div>

            <div class="flex text-left">
                <div class="w-1/4 rounded-lg p-2">
                    <div class="relative">
                        <img src="https://danang.fusion-suites.com/wp-content/uploads/sites/4/2019/08/Da-Nang-500x500.jpg"
                            alt="" class="w-full rounded-lg hover:shadow-xl">
                        <!-- location -->
                        <h1 class="absolute text-2xl font-semibold top-0 left-0 p-4">
                            Đà Nẵng
                        </h1>

                        <!-- num of hotel -->
                        <div class="absolute right-0 bottom-0 bg-orange-400 rounded-l-lg p-2 bg-gray-400 ">
                            <span class="font-semibold text-white">200.000+</span>
                        </div>
                    </div>
                </div>
                <div class="w-1/4 rounded-lg p-2">
                    <div class="relative">
                    <img src="https://vhrpro.com/storage/most-popular/cau-long-bien-500x500.jpg"
                            alt="" class="w-full rounded-lg hover:shadow-xl">
                        <!-- location -->
                        <h1 class="absolute text-2xl font-semibold top-0 left-0 p-4">
                            Hà Nội
                        </h1>
                        <!-- num of hotel -->
                        <div class="absolute right-0 bottom-0 bg-gray-600 rounded-l-lg p-2 bg-gray-400 hover:bg-orange-400">
                            <span class="font-semibold text-white">200.000+</span>
                        </div>
                    </div>
                </div>
                <div class="w-1/4 rounded-lg p-2">
                    <div class="relative">
                        <img src="https://hoianbudgetcarrental.com/wp-content/uploads/2019/08/IMG_2605-500x500.jpg"
                            alt="" class="w-full rounded-lg">
                        <!-- location -->
                        <h1 class="absolute text-2xl font-semibold top-0 left-0 p-4 hover:shadow-xl">
                            Huế
                        </h1>
                        <!-- num of hotel -->
                        <div class="absolute right-0 bottom-0 bg-gray-600 rounded-l-lg p-2 bg-gray-400 hover:bg-orange-400">
                            <span class="font-semibold text-white">200.000+</span>
                        </div>
                    </div>
                </div>
                <div class="w-1/4 rounded-lg p-2">
                    <div class="relative">
                        <img src="http://vietskytour.vn/wp-content/uploads/2019/07/da-lat-500x500.jpg"
                            alt="" class="w-full rounded-lg hover:shadow-xl">
                        <!-- location -->
                        <h1 class="absolute text-2xl font-semibold top-0 left-0 p-4">
                            Đà Lạt
                        </h1>
                        <!-- num of hotel -->
                        <div class="absolute right-0 bottom-0 bg-gray-600 rounded-l-lg p-2 bg-gray-400 hover:bg-orange-400">
                            <span class="font-semibold text-white">200.000+</span>
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
    <script src="<?= BASEURL ?>/public/js/autocomplete.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.11.1/less.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
  </body>
</html>

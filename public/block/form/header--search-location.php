<!-- SEARCH FOR PLACE -->
<section id="search-for-place" class="flex flex-col justify-center py-12">
    <!-- title -->
    <div class="text-center mx-3">
        <h1 class="font-bold text-lg lg:text-xl uppercase  tu-text-title">Khách sạn, khu nghỉ dưỡng và nhiều hơn nữa
        </h1>
        <p class="font-semibold text-md lg:text-lg">Nhận giá tốt nhất từ hơn 200.000 khách sạn</p>
    </div>

    <!-- Form -->
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
                <input class="rounded-l-full w-2/3 py-4 px-4 text-gray-700 leading-tight focus:outline-none" id="search" type="text" placeholder="Thử 'Đà Nẵng'">
            </div>

            <!-- suggest -->
            <div class="absolute top-14 left-0 w-full px-8 z-40 mx-1 hidden">
                <div class="bg-white my-2 rounded-lg top-1 p-2">
                    <ul>
                        <li class="border-b-2">
                            <div class="flex p-2 items-center">
                                <span class="bg-blue-500 text-white rounded-full p-2 w-6 h-6 flex items-center justify-center">
                                    <ion-icon name="navigate"></ion-icon>
                                    <!-- <ion-icon name="search" class="text-white"></ion-icon> -->
                                </span>
                                <p class="px-3 font-semibold">Đà nẵng</p>
                            </div>
                            <!-- <p>Hoi an, Quang Nam</p> -->
                        </li>
                        <li class="border-b-2">
                            <div class="flex p-2 items-center">
                                <span class="bg-green-500 text-white rounded-full p-2 w-6 h-6 flex items-center justify-center">
                                    <ion-icon name="bed"></ion-icon>
                                    <!-- <ion-icon name="search" class="text-white"></ion-icon> -->
                                </span>
                                <p class="px-3 font-semibold">Đà nẵng</p>
                            </div>
                        </li>
                        <li class="border-b-2">
                            <div class="flex p-2 items-center">
                                <span class="bg-blue-500 text-white rounded-full p-2 w-6 h-6 flex items-center justify-center">
                                    <ion-icon name="navigate"></ion-icon>
                                    <!-- <ion-icon name="search" class="text-white"></ion-icon> -->
                                </span>
                                <p class="px-3 font-semibold">Đà nẵng</p>
                            </div>
                        </li>

                    </ul>
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
                        <input class="rounded-l-full w-2/3 py-4 px-4 text-gray-700 leading-tight focus:outline-none" id="check-in" type="text" onfocus="(this.type = 'date')" placeholder="Ngày đến">
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
                        <input class="rounded-l-full w-2/3 py-4 px-4 text-gray-700 leading-tight focus:outline-none" id="check-out" type="text" onfocus="(this.type = 'date')" placeholder="Ngày đi">
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
                        <select class="block appearance-none w-full text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none" id="grid-state">
                            <option value="default">1 người, 1 phòng</option>
                            <option value="2p1r">2 người, 1 phòng</option>
                            <option value="3p1r">3 người, 1 phòng</option>
                            <option value="4p2r">4 người, 2 phòng</option>
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
            <!-- Search btn -->
            <div class="w-full lg:w-1/3 ">
                <div class="bg-orange-400 flex items-center rounded-full shadow-xl hover:bg-orange-500">
                    <div class="p-2">
                        <button class="text-white rounded-full p-2 h-12 flex items-center justify-center uppercase font-semibold">
                            <ion-icon name="search" class="w-12"></ion-icon>
                            Tìm Kiếm
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Form -->
    </div>
</section>
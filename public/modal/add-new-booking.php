<div class="modal opacity-0 pointer-events-none fixed w-full h-full top-0 left-0 flex items-center justify-center">
    <!-- Overlay     -->
    <div class="modal-overlay absolute w-full h-full bg-gray-900 opacity-50"></div>
    <!-- Modal -->
    <div class="modal-container bg-white w-2/5 mx-auto rounded shadow-lg z-50 overflow-y-auto">
        <!-- Exit btn -->
        <div class="modal-close absolute top-0 right-0 cursor-pointer flex flex-col items-center mt-4 mr-4 text-white text-sm z-50">
            <svg class="fill-current text-white" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
            </svg>
            <span class="text-sm">(Esc)</span>
        </div>
        <!-- Add margin if you want to see some of the overlay behind the modal-->
        <div class="modal-content py-4 text-left px-6">
            <!--Title-->
            <div class="flex justify-between items-center pb-3">
                <p class="text-2xl font-bold">Thêm đặt phòng mới</p>
                <div class="modal-close cursor-pointer z-50">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>

            <!--Body-->
            <form action=".?controller=booking&action=addBooking" method="post" enctype="multipart/form-data" id="addNewBookingForm">
                <div class="w-full">
                    <!-- CUSTOMER -->
                    <!-- Customer full name -->
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="name">
                            Tên khách hàng
                        </label>
                        <!-- 2 case -->
                        <!-- if error => border-red-500 -->
                        <!-- if success => border-green-500 -->
                        <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="name" type="text" placeholder="Nguyễn Văn Tú">

                        <!-- alert -->
                        <!-- error -->
                        <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
                        <!-- success -->
                        <!-- <p class="text-green-500 text-xs italic">Data valid</p> -->
                    </div>

                    <!-- Customer emil -->
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="email">
                            Email
                        </label>
                        <!-- 2 case -->
                        <!-- if error => border-red-500 -->
                        <!-- if success => border-green-500 -->
                        <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="email" type="email" placeholder="tunvps11094@fpt.edu.vn">

                        <!-- alert -->
                        <!-- error -->
                        <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
                        <!-- success -->
                        <!-- <p class="text-green-500 text-xs italic">Data valid</p> -->
                    </div>

                    <!-- Customer phone number -->
                    <div class="w-full px-3 mb-6 md:mb-0">
                        <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="phone">
                            Số điện thoại
                        </label>
                        <!-- 2 case -->
                        <!-- if error => border-red-500 -->
                        <!-- if success => border-green-500 -->
                        <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="phone" type="text" placeholder="0909xxxxxx">

                        <!-- alert -->
                        <!-- error -->
                        <!-- <p class="text-red-500 text-xs italic">Please fill out this field.</p> -->
                        <!-- success -->
                        <!-- <p class="text-green-500 text-xs italic">Data valid</p> -->
                    </div>

                    <!-- HOTEL -->
                    <div class="flex flex-wrap -mx-3 px-3 my-3">
                        <!-- Hotel -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="listHotel">
                                Khách sạn
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="listHotel">
                                    <!-- LOOP HOTEL DATA HERE -->
                                    <option disabled selected>Chọn khách sạn</option>
                                    <?php 
                                        foreach ($data['listHotel'] as $key => $value) {
                                            echo '<option value="'.$value['id'].'">'.$value['name'].'</option>';
                                        }
                                    ?>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Room type -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="listRoom">
                                Loại phòng
                            </label>
                            <div class="relative">
                                <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="listRoom">
                                    <!-- LOOP HOTEL DATA HERE -->
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" /></svg>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Status -->
                        <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="amount-of-room">
                                Số phòng đặt
                            </label>
                            <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="amount-of-room" type="number">
                        </div>

                    </div>

                    <!-- Time range -->
                    <div class="flex flex-wrap -mx-3 px-3 my-3">
                        <!-- Check in -->
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="dateFrom">
                                Ngày đến
                            </label>
                            <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="date_from" type="date">
                        </div>

                        <!-- Check out -->
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <label class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2" for="date_to">
                                Ngày đi
                            </label>
                            <input required class="appearance-none block w-full bg-gray-200 text-gray-700 border rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="date_to" type="date">
                        </div>
                    </div>
                </div>
                </form>

            <!-- Preview -->
            <div class="my-3 px-3 py-1">
                <h3 class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2">Xem trước</h3>

                <!-- content -->
                <div class="w-full h-32 overflow-scroll border rounded-lg bg-gray-200">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Customer -->
                        <div class="w-full p-2">
                            <p id="" class="text-base font-thin">Tên Khách Hàng: <span id="previewCustomerName" class="font-semibold"></span> </p>
                            <p id="" class="text-base font-thin">Email: <span id="previewCustomerEmail" class="font-semibold"></span> </p>
                            <p id="" class="text-base font-thin">SDT: <span id="previewCustomerPhone" class="font-semibold"> </span> </p>
                        </div>

                        <!-- hotel -->
                        <div class="w-full p-2">
                            <p id="" class="text-base font-thin">Tên Khách Sạn: <span id="previewCustomerHotel" class="font-semibold"></span> </p>
                            <p id="" class="text-base font-thin">Loại Phòng: <span id="previewCustomerRoom" class="font-semibold"></span> </p>
                            <p id="" class="text-base font-thin">Số ngày ở: <span id="previewCustomerDate" class="font-semibold"></span> </p>
                        </div>
                    </div>
                </div>
            </div>
            <!--Footer-->
            <footer class="flex justify-end pt-2">
                <button type="submit" class="px-4 bg-transparent p-3 rounded-lg bg-blue-400 text-white hover:bg-blue-500 hover:text-white mr-2" id=addBooking>Lưu</button>
                <button class="modal-close px-4 p-3 rounded-lg text-orange-400">Thoát</button>
            </footer>
            
        </div>
    </div>
</div>
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
                <p class="text-2xl font-bold">Thêm gói mới</p>
                <div class="modal-close cursor-pointer z-50">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>
            <!--Body-->
            <form action="" method="post" enctype="multipart/form-data" id="form">
            <div class="w-full">
                <div class="grid grid-cols-3 gap-4">
                    <!-- pack image -->
                    <div class="w-32 h-32 relative">
                        <img class="w-32 mx-auto h-32 rounded-full object-cover object-center border" src="https://i1.pngguru.com/preview/137/834/449/cartoon-cartoon-character-avatar-drawing-film-ecommerce-facial-expression-png-clipart.jpg" alt="Avatar Upload" id="packAvatar" />
                        <label for="sltAvatar" class="w-32 h-16 absolute bottom-0 left-0">
                            <div class="relative w-full h-full">
                                <ion-icon name="camera" class="text-4xl text-white z-10 top-50 left-50 transform-center absolute"></ion-icon>
                                <input type="file" name="sltAvatar" id="sltAvatar" :multiple="multiple" :accept="accept" id="file" style="display:none">
                                <!-- overlay -->
                                <div class="w-full h-full rounded-b-full bg-gray-900 opacity-50 absolute top-0 left-0"></div>
                            </div>
                        </label>
                        <div name="maid" id="error" style="color:red"></div>
                    </div>
                    <!-- pack require -->
                    <div class="col-span-2 w-full">
                        <!-- pack name -->
                        <div class="mb-4">
                            <label for="packDuration" class="text-sm font-semibold text-gray-600">Tên gói</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <!-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-600 sm:text-sm sm:leading-5">
                                    $
                                </span>
                            </div> -->
                                <input type="text" name="packName" class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 outline-none" placeholder="Nhập tên gói" required>
                            </div>
                        </div>
                        <!-- pack duration -->
                        <!-- pack price -->
                        <div class="mb-4">
                            <label for="packPrice" class="text-sm font-semibold text-gray-600">Giá</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <!-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-600 sm:text-sm sm:leading-5">
                                    $
                                </span>
                            </div> -->
                                <input name="price" value=0 class="form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 outline-none" placeholder="0.00" required>
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <select aria-label="Currency" class="form-select h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-orange-500 sm:text-sm sm:leading-5">
                                        <option value="vnd">VND</option>
                                        <option value="usd">USD</option>
                                        <option value="cad">CAD</option>
                                        <option value="eur">EUR</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- pack commission -->
                        <div class="mb-4">
                            <label for="packPrice" class="text-sm font-semibold text-gray-600">Phí dịch vụ</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <!-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-600 sm:text-sm sm:leading-5">
                                    $
                                </span>
                            </div> -->
                                <input name="revennue" value=0 type="number" class="form-input block w-full pl-7 pr-20 sm:text-sm sm:leading-5 outline-none" placeholder="0.00" required>
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <div class="text-sm font-semibold text-orange-500">%</div>
                                </div>
                            </div>
                        </div>
                        <!-- pack limit hotel -->
                        <div class="mb-4">
                            <label for="packPrice" class="text-sm font-semibold text-gray-600">Giới hạn khách sạn</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <!-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-600 sm:text-sm sm:leading-5">
                                    $
                                </span>
                            </div> -->
                                <input name="limitHotel" value=0 type="number" class="form-input block w-full pl-7 pr-20 sm:text-sm sm:leading-5 outline-none" placeholder="1" required>
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <div class="text-sm font-semibold text-orange-500">Khách sạn</div>
                                </div>
                            </div>
                        </div>
                        <!-- pack limit room -->
                        <div class="mb-4">
                            <label for="limitRoom" class="text-sm font-semibold text-gray-600">Giới hạn phòng</label>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <!-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-600 sm:text-sm sm:leading-5">
                                    $
                                </span>
                            </div> -->
                                <input name="limitRoom" value=0 type="number" class="form-input block w-full pl-7 pr-20 sm:text-sm sm:leading-5 outline-none" placeholder="1" required>
                                <div class="absolute inset-y-0 right-0 flex items-center">
                                    <div class="text-sm font-semibold text-orange-500">Phòng</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- pack props -->
                <div class="w-full max-h-48 overflow-scroll p-2 border">
                    <p class="text-sm font-semibold text-gray-700">Các chức năng</p>
                    <ul id="listProps">
                        <!-- loop here -->
                        <li class="my-2">
                            <input type="checkbox" name="prop" class="comment_selecter suport" id="1" value="6">
                            <label for="prop">Support 24/7</label>
                        </li>
                        <li class="my-2">
                            <input type="checkbox" name="prop" class="comment_selecter manager" id="4" value="4">
                            <label for="prop">Hệ thống quản trị phân quyền</label>
                        </li>
                        <li class="my-2">
                            <input type="checkbox" name="prop" class="comment_selecter chart" id="4" value="5">
                            <label for="prop">Báo cáo, thống kê</label>
                        </li>
                        <li class="my-2">
                            <input type="checkbox" name="prop" class="comment_selecter marketing" id="5" value="3">
                            <label for="prop">Hệ thống marketing</label>
                        </li>
                        <li class="my-2">
                            <input type="checkbox" name="prop" class="comment_selecter user" id="1" value="1">
                            <label for="prop">Quản lý khách hàng</label>
                        </li>
                        <li class="my-2">
                            <input type="checkbox" name="prop" class="comment_selecter service" id="2" value="2">
                            <label for="prop">Quản lí dịch vụ</label>
                        </li>
                    </ul>
                </div>
            </div>
            <!--Footer-->
            <div class="flex justify-end pt-2">
                <button type="submit" class="px-4 bg-transparent p-3 rounded-lg bg-blue-400 text-white hover:bg-blue-500 hover:text-white mr-2" id="addPack">Lưu</button>
                <button class="modal-close px-4 p-3 rounded-lg text-orange-400">Thoát</button>
            </div>
            </form>
        </div>
    </div>
</div>
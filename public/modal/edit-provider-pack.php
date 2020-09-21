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
                <p class="text-2xl font-bold">Sửa gói</p>
                <div class="modal-close cursor-pointer z-50">
                    <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18">
                        <path d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z"></path>
                    </svg>
                </div>
            </div>
            <!--Body-->
            <form action="" method="post">
            <div class="w-full">
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
                            <input type="text" id="packName" class="disabled:opacity-75 form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 outline-none" placeholder="Your awesome pack" required value="<?php echo $itempack['pack_name'] ?>" disabled>
                        </div>
                    </div>

                    <!-- pack duration -->
                    <div class="mb-4">
                        <label for="packDuration" class="text-sm font-semibold text-gray-600">Thời hạn</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <!-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-600 sm:text-sm sm:leading-5">
                                    $
                                </span>
                            </div> -->
                            <input id="packPrice" class="disabled:opacity-75 form-input block w-full pl-7 pr-12 sm:text-sm sm:leading-5 outline-none" placeholder="1" value="<?php echo $quantity;?>" required disabled>
                            <div class="absolute inset-y-0 right-0 flex items-center">
                                <select aria-label="Currency" class="form-select h-full py-0 pl-2 pr-7 border-transparent bg-transparent text-orange-500 sm:text-sm sm:leading-5">
                                    <option value="<?php $date;?>" selected><?php echo $messg;?></option>
                                    <option value="month">Tháng</option>
                                    <option value="year">Năm</option>
                                    <option value="day">Ngày</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="" id="packlog_id" value="<?php echo $itempack['id_pack'];?>">
                    <!-- pack fromday -->
                    <div class="mb-4">
                        <label for="limitRoom" class="text-sm font-semibold text-gray-600">Ngày kích hoạt</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <!-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-600 sm:text-sm sm:leading-5">
                                    $
                                </span>
                            </div> -->
                            <input id="from_day" type="date" class="form-input block w-full sm:text-sm sm:leading-5 outline-none" value="<?php
                             $data = $itempack['from_day'];
                             $date=date_create("$data");  
                             echo date_format($date,"Y-m-d");
                            ?>" required>
                            <!-- <div class="absolute inset-y-0 right-0 flex items-center">
                                <div class="text-sm font-semibold text-orange-500">Phòng</div>
                            </div> -->
                        </div>
                    </div>
                    <!-- pack today -->
                    <div class="mb-4">
                        <label for="limitRoom" class="text-sm font-semibold text-gray-600">Ngày hết hạn</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <!-- <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-600 sm:text-sm sm:leading-5">
                                    $
                                </span>
                            </div> -->
                            <input id="to_day" type="date" class="form-input block w-full sm:text-sm sm:leading-5 outline-none" value="<?php 
                            $data = $itempack['to_day'];
                            $date=date_create("$data");  
                            echo date_format($date,"Y-m-d");
                            ?>" required>
                            <!-- <div class="absolute inset-y-0 right-0 flex items-center">
                                <div class="text-sm font-semibold text-orange-500">Phòng</div>
                            </div> -->
                        </div>
                    </div>
                </div>

                <!-- pack props -->
                <div class="w-full max-h-48 overflow-scroll p-2 border">
                    <p class="text-sm font-semibold text-gray-700">Lý do</p>
                    <ul id="listProps">
                        <!-- loop here -->
                        <li class="my-2">
                            <input type="checkbox" class="reason_provider" name="prop" id="4" value="Sai ngày bắt đầu gói">
                            <label for="prop">Sai ngày bắt đầu gói</label>
                        </li>
                        <li class="my-2">
                            <input type="checkbox" class="reason_provider" name="prop" id="5" value="Sai ngày kết thúc gói">
                            <label for="prop">Sai ngày kết thúc gói</label>
                        </li>
                        <li class="my-2">
                            <input type="checkbox" class="reason_provider" name="prop" id="2" value="Sai thời gian">
                            <label for="prop">Sai thời gian</label>
                        </li>
                        <li class="my-2">
                            <input type="checkbox" class="reason_provider" name="prop" id="3" value="Khác">
                            <label for="prop">Khác</label>
                        </li>
                    </ul>
                </div>
            </div>
            <!--Footer-->
            <div class="flex justify-end pt-2">
                <button class="px-4 bg-transparent p-3 rounded-lg bg-blue-400 text-white hover:bg-blue-500 hover:text-white mr-2" id="update_button">Lưu</button>
                <button class="modal-close px-4 p-3 rounded-lg text-orange-400">Thoát</button>
            </div>
        </div>
    </div>
    </form>
</div>
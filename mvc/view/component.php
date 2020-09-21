<?php
function showHotel($img,$hId,$hName,$star,$address,$wName,$dName,$pName,$review,$pri,$nameHotel,$msg){
  $output = ' <a href = "./index.php?controller=hotel&action=detail&id='.$hId.'">
  <div class="my-4 w-full flex rounded-lg bg-white border hover:border-blue-400 hover:shadow-md h-60" style="cursor:pointer">
                        <!-- hotel avatar -->
                        <div class="w-1/5 h-60 rounded-l-lg tu-bg-img"
                            style="background-image: url(./public/uploads/hotel/'.$nameHotel.'/'.$img.');min-height: 200px;">
                        </div>

                        <!-- hotel info -->
                        <div class="w-3/5 p-4 border-r">
                            <!-- hotel name -->
                            <p class="text-black tu-text-title font-semibold text-2xl ellip">'.$hName.'</p>
                            <!-- hotel stars -->
                            <div class="flex text-yellow-400 text-xl py-2">
                            '.$star.'
                            </div>
                            <!-- hotel address -->
                            <div class="flex text-2xl py-2 items-center">
                                <i class="fa fa-map-marker text-red-500"></i>
                                <p class="ml-2 text-base">'.$address.', '.$wName.', '. $dName .', '.$pName.'</p>
                            </div>
                            <!-- score -->
                            <div class="flex items-center">
                                <i class="fa fa-superpowers text-blue-400"></i>
                                <p class="ml-2 text-sm"><span
                                        class="score tu-text-title font-semibold text-blue-500">'.$review.' '.$msg.'</p>
                            </div>
                        </div>

                        <!-- hotel price -->
                        <div class="p-4 w-1/5 flex flex-col">
                            <p class="text-xl">Giá cuối cùng</p>
                            <!-- <span class="currency p-2 mb-2 rounded-md bg-blue-400">vnd </span> -->
                            <span class="font-semibold text-orange-400">vnd</span>
                            <p class="price tu-text-title text-3xl font-semibold text-orange-400 mb-2">'. $pri .'</p>

                            <button
                                class="w-full py-2 px-4 bg-blue-400 hover:bg-blue-500 rounded-lg text-xl font-semibold text-white">Đặt
                                Ngay</button>
                        </div>
                    </div></a>
                    '
                ;
              echo $output;
}

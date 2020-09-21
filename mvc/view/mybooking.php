<?php
$mybooking = $data['userbooking'];
$user = $data['user'];
?>
    <!-- MY BOOKING -->
    <section id="my-booking" class="">
      <div class="mx-auto max-w-screen-xl p-3 rounded-lg my-8">
        <p class="text-xl text-black font-semibold">
          Đặt phòng của tôi
        </p>

        <!-- list of booking -->
        <?php foreach($mybooking as $row){ ?>
        <div class="flex flex-col">
          <!-- item -->
          <div class="my-4 rounded-lg border p-3 bg-white">
            <div class="grid grid-cols-5 gap-4">
              <!-- image -->
              <div
                class="w-full h-32 rounded-lg tu-bg-img mr-4"
                style="
                  background-image: url(./public/images/<?php echo $row['avatar'];?>);
                "
              ></div>

              <!-- info -->
              <div class="flex flex-col col-span-2">
                <p class="text-xl text-black font-semibold mb-2">
                  <?php echo $row['hName'];?>
                </p>
                <div class="flex mb-2">
                  <ion-icon
                    name="pin"
                    class="text-red-500 text-xl mr-2"
                  ></ion-icon>
                  <p class="text-md text-gray-500"><?php echo $row['hAddress']?>, <?php echo $row['wName']?>,<?php echo $row['pName']?></p>
                </div>
                <div class="flex mb-2">
                  <ion-icon name="bed" class="text-xl mr-2"></ion-icon>
                  <p class="text-md text-gray-500"><?php echo $row['bName'];?></p>
                </div>
                <div class="flex mb-2">
                  <ion-icon name="grid" class="text-xl mr-2"></ion-icon>
                  <p class="text-md text-gray-500"><?php echo $row['totalRoom'];?> phòng</p>
                </div>
              </div>
              <!-- info -->
              <div class="flex flex-col col-span-2">
                <div class="grid grid-cols-2 gap-4 mb-2">
                  <div class="flex flex-col">
                    <p class="font-semibold">
                      Ngày đến
                    </p>
                    <p class="font-semibold text-xl">
                    <?php
                        $data = $row["check_in"];
                        $date=date_create("$data");  
                        echo date_format($date,"d-m-Y");
                    ?>
                    </p>
                  </div>
                  <div class="flex flex-col">
                    <p class="font-semibold">
                      Ngày đi
                    </p>
                    <p class="font-semibold text-xl">
                    <?php
                        $data = $row["check_out"];
                        $date=date_create("$data");  
                        echo date_format($date,"d-m-Y");
                    ?>
                    </p>
                  </div>
                </div>
                <div class="flex">
                  <ion-icon
                    name="today"
                    class="text-blue-500 text-xl mr-2"
                  ></ion-icon>
                  <p class="text-md text-gray-500"><?php echo $row['totalDate'];?> đêm</p>
                </div>
                <div class="flex text-orange-500 items-center">
                  <ion-icon name="card" class="text-xl mr-2"></ion-icon>
                  <p class="text-2xl font-semibold"><?php 
                  $price = $row['price'];
                       echo number_format("$price",0,",",".");?> vnd</p>
                </div>
              </div>
            </div>
            <div class="grid grid-cols-5 gap-4 mt-2">
              <!-- status of booking -->
              <!-- da thanh toan: text-green-500
                            chua thanh toan: text-yellow-500 -->
              <?php if($row['status']==3){?>
              <div class="flex items-center">
                <ion-icon
                  name="ellipse"
                  class="text-green-500 text-xl mr-2"
                ></ion-icon>
                <p class="text-md text-gray-500">Đã thanh toán</p>
              </div>
              <div class="flex items-center">
              <a href='./index.php?controller=user&action=deleteBooking&id=<?php echo $row['bId'];?>'>
                  <button class="p-2 bg-red-500 hover:bg-red-600 text-center text-white rounded-lg">Huỷ phòng</button>
              </a>
              </div>
              <?php }elseif($row['status']==2){ ?>
                <div class="flex items-center">
                <ion-icon
                  name="ellipse"
                  class="text-yellow-500 text-xl mr-2"
                ></ion-icon>
                <p class="text-md text-gray-500">Chưa thanh toán</p>
              </div>
              <div class="flex items-center col-span-2">
              <a href='./index.php?controller=user&action=deleteBooking&id=<?php echo $row['bId'];?>'>
              <button class="p-2 bg-red-500 hover:bg-red-600 text-center text-white rounded-lg mr-2">Huỷ phòng</button></a>
              <a href='./index.php?controller=hotel&action=confirm&email=<?php echo $user['email']?>&id=<?php echo $row['bId'];?>'><button class="p-2 bg-blue-400 hover:bg-blue-500 text-center text-white rounded-lg">Thanh toán ngay</button></a>           
              </div>
              <?php }?>
            </div>
          </div>
        </div>
        <?php }?>
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
                <img
                  src="public/images/footer--color__logo-v-3.svg"
                  alt=""
                  class="w-3/4"
                />
              </div>
            </div>

            <!-- info -->
            <div class="p-3 w-full sm:w-full lg:w-1/5 tu-text-title">
              <div
                class="text-md uppercase text-black font-semibold tu-text-title"
              >
                Dịch vụ
              </div>
              <a
                class="my-3 block hover:underline text-gray-dark tu-text-title"
                href="/booking.html"
                >Đặt phòng</a
              >
              <a
                class="my-3 block hover:underline text-gray-dark tu-text-title"
                href="/#"
                >Đặt vé máy bay</a
              >
              <a
                class="my-3 block hover:underline text-gray-dark tu-text-title"
                href="/#"
                >Đặt Homestay</a
              >
              <a
                class="my-3 block hover:underline text-gray-dark tu-text-title"
                href="/#"
                >Combo
                <span
                  class="bg-orange-400 text-white p-1 rounded-lg px-3 font-semibold"
                  >-25%</span
                ></a
              >
            </div>

            <!-- info -->
            <div class="p-3 w-full sm:w-full lg:w-1/5">
              <div class="text-md uppercase text-black font-semibold">
                Thông báo
              </div>
              <a
                class="my-3 block hover:underline text-gray-dark tu-text-title"
                href="/#"
                >FAQ</a
              >
              <a
                class="my-3 block hover:underline text-gray-dark tu-text-title"
                href="/#"
                >Về dịch Covid-19</a
              >
              <a
                class="my-3 block hover:underline text-gray-dark tu-text-title"
                href="/#"
                >Trung tâm trợ giúp</a
              >
              <!-- <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Combo <span class="bg-orange-400 text-white p-1 rounded-lg px-3 font-semibold">-25%</span></a> -->
            </div>

            <!-- info -->
            <div class="p-3 w-full sm:w-full lg:w-1/5">
              <div class="text-md uppercase text-black font-semibold">
                Điều khoản dịch vụ
              </div>
              <a
                class="my-3 block hover:underline text-gray-dark tu-text-title"
                href="/#"
                >Điều khoản</a
              >
              <a
                class="my-3 block hover:underline text-gray-dark tu-text-title"
                href="/#"
                >Chính sách vận chuyển</a
              >
              <a
                class="my-3 block hover:underline text-gray-dark tu-text-title"
                href="/#"
                >Chính sách hoàn tiền</a
              >
              <a
                class="my-3 block hover:underline text-gray-dark tu-text-title"
                href="/#"
                >Chính sách bảo mật</a
              >
            </div>

            <!-- info -->
            <div class="p-3 w-full sm:w-full lg:w-1/5">
              <div class="text-md uppercase text-black font-semibold">
                Newsletter
              </div>
              <a
                class="my-3 block hover:underline text-gray-dark tu-text-title"
                href="/#"
                >Đăng ký để nhận ưu đãi mỗi ngày!</a
              >

              <!--  -->
              <div class="flex flex-wrap items-stretch w-full mb-4 relative">
                <input
                  type="text"
                  class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-r-none px-3 relative"
                  placeholder="johndoe@gmail.com"
                />
                <!-- <div class="flex -mr-px">
                                  <span
                                      class="flex items-center bg-orange-400 rounded rounded-l-none border border-l-0 px-3 whitespace-no-wrap text-white text-sm font-semibold">@gmail.com</span>
                              </div> -->
              </div>

              <!-- submit btn -->
              <button
                class="bg-orange-400 hover:bg-orange-500 font-semibold text-lg rounded text-white w-full p-2"
              >
                Đăng ký
              </button>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- subfooter -->
    <!-- social media -->
    <div class="bg-blue-600 pt-2 sm:px-6 md:px-6">
      <div
        class="flex pb-5 m-auto pt-5 text-gray-800 text-sm flex-col md:flex-row max-w-6xl"
      >
        <div class="mt-2 text-white font-semibold">
          <span>&copy;</span> Copyright 2020. All Rights Reserved.
        </div>
        <div class="md:flex-auto md:flex-row-reverse mt-2 flex-row flex">
          <a href="/#" class="w-6 mx-1 text-lg">
            <!-- <ion-icon name="logo-facebook" class="text-white text-2xl"></ion-icon> -->
            <i
              class="fa fa-facebook-official text-white"
              aria-hidden="true"
            ></i>
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
  </body>
</html>

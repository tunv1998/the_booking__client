    <!-- BOOKING FORM -->
    <?php $checkout = $data['checkOutDetail'];?>
    <section id="booking-form" class="bg-gray-100 overflow-scroll">
      <div class="mx-auto max-w-screen-xl p-4 border rounded-lg my-8">
        <div class="grid grid-cols-3 gap-4">
          <!-- #1 select your room -->
          <div class="w-full">
            <!-- title -->
            <div class="flex items-center mb-8">
              <div class="h-10 w-10 relative rounded-full bg-blue-500 mr-4">
                <span
                  class="absolute tu-abs-center text-lg font-semibold text-white"
                  >1</span
                >
              </div>
              <p class="text-xl font-semibold">Phòng đã chọn</p>
            </div>
            <!-- booking detail -->
            <div class="border border-blue-300 mb-4 rounded-lg">
              <!-- head -->
              <div class="p-2 px-4 bg-blue-200 rounded-t-lg">
                <p class="text-black font-semibold text-lg">
                  Chi tiết
                </p>
              </div>
              <!-- body -->
              <div class="p-2 px-4 bg-white rounded-b-lg">
                <div class="grid grid-cols-2 gap-4 mb-4">
                  <div class="flex-col">
                    <!-- checkin -->
                    <p class="text-black text-lg">Check in</p>
                    <p class="text-black text-xl font-semibold"><?php 
                    $data = $checkout['check_in'];
                    $date=date_create("$data");  
                    echo date_format($date,"d-m-Y");
                    ;?></p>
                  </div>
                  <div class="flex-col">
                    <!-- checkout -->
                    <p class="text-black text-lg">Check out</p>
                    <p class="text-black text-xl font-semibold"><?php 
                     $data = $checkout['check_out'];
                     $date=date_create("$data");  
                     echo date_format($date,"d-m-Y");
                    ?></p>
                  </div>
                </div>

                <p class="text-lg text-black">
                  <span class="font-semibold">Tổng số ngày: </span><?php echo $checkout['totalDate'];?>
                </p>

                <hr class="my-4" />
                <p class="text-lg text-black">
                  <span class="font-semibold">Bạn chọn phòng: </span><?php echo $checkout['rcName'];?>
                </p>
              </div>
            </div>
            <!-- price detail -->
            <div class="border border-blue-300 mb-4 rounded-lg">
              <!-- head -->
              <div class="p-2 px-4 bg-blue-200 rounded-t-lg">
                <p class="text-black font-semibold text-lg">
                  Tổng giá tiền
                </p>
              </div>
              <!-- body -->
              <div class="p-2 px-4 bg-white rounded-b-lg">
                <div class="flex flex-col text-lg">
                  <div class="grid grid-cols-2 mb-2">
                    <p class="text-black"><?php echo $checkout['rcName'];?></p>
                    <p class="font-semibold">
                    <?php
                    $total = $checkout['totalPrice'];
                    $totalRoom = $total/1.15; 
                    echo number_format("$totalRoom",0,",",".");?> <span id="currency">vnd</span>
                    </p>
                  </div>
                  <div class="grid grid-cols-2 mb-2">
                    <p class="text-black">10% VAT</p>
                    <p class="font-semibold">
                      <?php $vat = $totalRoom*0.1;
                      echo number_format("$vat",0,",","."); ?> <span id="currency">vnd</span>
                    </p>
                  </div>
                  <div class="grid grid-cols-2 mb-2">
                    <p class="text-black">5% phí dịch vụ</p>
                    <p class="font-semibold">
                    <?php $pdv = $totalRoom*0.05;
                      echo number_format("$pdv",0,",","."); ?>  <span id="currency">vnd</span>
                    </p>
                  </div>
                </div>
              </div>
              <!-- footer -->
              <div class="p-2 px-4 bg-blue-200 rounded-b-lg">
                <div class="grid grid-cols-2">
                  <p class="text-xl text-black">Giá:</p>
                  <p class="text-xl text-black font-semibold text-2xl">
                    <?php echo number_format("$total",0,",",".");?>
                  </p>
                </div>
              </div>
            </div>
            
          </div>

          <!-- #2 Enter detail -->
          <div class="w-full p-2 col-span-2 rounded-lg" id="showBooking">
            <!-- where to place -->
            <!-- title -->
            <form method="post" id="order_process_form" action="">
            <span id="error_card" class="text-red-500 font-semibold"></span>
            <input type="hidden" name="order" id="order" value="<?php echo $_GET['id'];?>">
            <input type="hidden" name="total-price" id="total-price" value="<?php echo $total;?>">
            <div class="flex items-center mb-8">
              <div class="h-10 w-10 relative rounded-full bg-blue-500 mr-4">
                <span
                  class="absolute tu-abs-center text-lg font-semibold text-white"
                  >2</span
                >
              </div>
              <p class="text-xl font-semibold">Thanh toán</p>
            </div>

            <!-- hotel chosen -->
            <div class="flex flex-col mb-8">
              <div class="mb-2 flex items-center">
                <ion-icon
                  name="checkmark-circle"
                  class="text-2xl text-green-500 mr-2"
                ></ion-icon>
                <a
                  href="#"
                  class="hover:text-blue-500 transition duration-200 ease-in-out hover:underline text-black text-2xl font-semibold"
                >
                  <?php echo $checkout['hName'];?>
                </a>
              </div>
              <div class="mb-2 flex items-center">
                <ion-icon
                  name="pin"
                  class="text-2xl text-red-500 mr-2"
                ></ion-icon>
                <p class="text-gray-600 text-base font-semibold">
                <span class="pl-2 text-lg"><?php echo $checkout['hAddress']?>, <?php echo $checkout['wName']?>, <?php echo $checkout['dName']?>, <?php echo $checkout['pName']?></span>
                </p>
              </div>
            </div>

            <div id="card mb-6">
              <p class="text-2xl mb-4">Thanh toán</p>
              <div class="border border-blue-500 rounded-lg">
                <div class="bg-blue-100 rounded-lg">
                  <!-- sign in opt -->
                  <div class="p-4 flex items-center">
                    <ion-icon name="person" class="text-xl mr-2"></ion-icon>
                    <p>
                      Bạn đang được giữ chỗ. <b>Thanh toán </b>ngay để không lỡ phòng
                    </p>
                  </div>
                  <hr class="mb-4 border-blue-500" />

                  <!-- personal infomation -->
                  <div class="p-4 mb-4">
                    <div class="grid grid-cols-2 gap-6">
                      <!-- name -->
                      <div class="flex flex-col justify-start col-span-2">
                        <p class="text-lg font-semibold mb-2">Tên chủ thẻ</p>
                        <!-- err notice -->
                        <p
                          class="text-md font-semibold text-red-500 mb-2 hidden"
                        >
                          vui lòng nhập tên của bạn
                        </p>
                        <input
                          type="text"
                          name="usernameCard"
                          id="usernameCard"
                          class="rounded-lg p-2"
                          placeholder="NGUYEN VAN A"
                        />
                      </div>

                      <!-- <div class="my-2"></div> -->
                      <!-- email -->
                      <div class="flex flex-col justify-start">
                        <div class="flex items-center mb-2">
                          <ion-icon
                            name="card"
                            class="text-xl text-red-500 mr-2"
                          ></ion-icon>
                          <p class="text-lg font-semibold">Số thẻ</p>
                        </div>
                        <p
                          class="text-md font-semibold text-red-500 mb-2 hidden"
                        >
                          vui lòng nhập số thẻ của bạn
                        </p>

                        <input
                          type="text"
                          name="card-number"
                          id="card_holder_number"
                          class="rounded-lg p-2"
                          placeholder="XXXX-XXXX-XXXX-XXXX"
                          onkeypress="return only_number(event);"
                        />
                      </div>
                      <!-- confirm email -->
                      <div class="flex flex-col justify-start">
                        <div class="flex items-center mb-2">
                          <ion-icon
                            name="today"
                            class="text-xl text-green-500 mr-2"
                          ></ion-icon>
                          <p class="text-lg font-semibold">Tháng</p>
                        </div>
                        <p
                          class="text-md font-semibold text-red-500 mb-2 hidden"
                        >
                          vui lòng chọn ngày của bạn
                        </p>

                        <input
                          type="text"
                          name="expiration-day"
                          id="card_expiry_month"
                          class="rounded-lg p-2"
                          placeholder="MM"
                          maxlength="2"
                          onkeypress="return only_number(event);"
                        />
                      </div>
                      <div class="flex flex-col justify-start">
                        <div class="flex items-center mb-2">
                          <ion-icon
                            name="today"
                            class="text-xl text-green-500 mr-2"
                          ></ion-icon>
                          <p class="text-lg font-semibold">Năm</p>
                        </div>
                        <p
                          class="text-md font-semibold text-red-500 mb-2 hidden"
                        >
                          vui lòng chọn ngày của bạn
                        </p>

                        <input
                          type="text"
                          name="expiration-day"
                          id="card_expiry_year"
                          class="rounded-lg p-2"
                          placeholder="YYYY"
                          maxlength="4"
                          onkeypress="return only_number(event);"
                        />
                      </div>
                      <!-- phone number -->
                      <div class="flex flex-col justify-start">
                        <div class="flex items-center mb-2">
                          <ion-icon
                            name="call"
                            class="text-xl text-green-500 mr-2"
                          ></ion-icon>
                          <p class="text-lg font-semibold">Mã CVC</p>
                        </div>
                        <p
                          class="text-md font-semibold text-red-500 mb-2 hidden"
                        >
                          vui lòng nhập mã của bạn
                        </p>

                        <input
                          type="text"
                          name="phone-num"
                          id="card_cvc"
                          class="rounded-lg p-2"
                          placeholder="1234"
                          maxlength="4"
                        />
                      </div>
                      <!-- <div class="flex flex-col justify-end">
                        <button class="p-2 text-white font-semibold bg-orange-400 rounded-lg hover:bg-orange-500 transition duration-200 ease-in">Đặt ngay</button>
                      </div> -->
                    </div>
                  </div>

                  <!-- booking for? -->
                  <div class="p-4">
                    <button
                    type="button"
                    name="button_action" id="button_action" data-secret="<?= $intent->client_secret ?>" onclick="stripePay(event)"
                    class="block w-1/3 rounded-lg text-center  mt-4 p-4 text-white text-xl font-semibold bg-blue-400"
                    >Hoàn thành đặt phòng</button
                  >
                  </div>
                </div>
              </div>
            </div>
          </div>
          </form>
        </div>
      </div>
    </section>

    <script>
      var guestForm = document.getElementById("so-form");
      var isGuest = document.querySelectorAll("input[name=whoBook]");

      function openForm() {
        guestForm.classList.remove("hidden");
      }

      function closeForm() {
        guestForm.classList.add("hidden");
      }
    </script>

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
    <script src="https://js.stripe.com/v2/"></script>
    <script src="./public/vendor/jquery/jquery.creditCardValidator.js"></script>
    <script src="<?= BASEURL ?>/public/js/main/stripe.js" rel="stylesheet"></script>
    <script src="<?= BASEURL ?>/public/js/main/comment.js" rel="stylesheet"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.11.1/less.min.js"></script>
  </body>
</html>
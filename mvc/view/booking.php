<?php   
$showBooking = $data['showBooking'];
$price = "";
$checkUser = $data['checkUser'];
if($showBooking['rtPrice']==0){
    $price = $showBooking['rPrice'];
    }else{
    $price = $showBooking['rtPrice'];
    };
    $price = $price - $price * 0.1;
$total_date = (strtotime($_SESSION['check-out']) - strtotime($_SESSION['check-in']))/86400;
if($total_date==0){
  $total_date = 1;
}
$total = $price * $total_date;
// unset($_SESSION['orderid']);
?>
  <script src="https://js.stripe.com/v2/"></script>
  <script src="./public/vendor/jquery/jquery.creditCardValidator.js"></script>
    <!-- BOOKING FORM -->
<section id="booking-form" class="bg-gray-100 overflow-scroll">
    <input type="hidden" name="check-in" id="check-in" value="<?php echo $_SESSION['check-in']?>">
    <input type="hidden" name="check-out" id="check-out" value="<?php echo $_SESSION['check-out']?>">
    <input type="hidden" name="rcId" id="rcId" value="<?php echo $_SESSION['booking']?>">
    <input type="hidden" name="rId" id="rId" value="<?php echo $showBooking['rId']?>">
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
                    $data = $_SESSION["check-in"];
                    $date=date_create("$data");  
                    echo date_format($date,"d-m-Y");?></p>
                  </div>
                  <div class="flex-col">
                    <!-- checkout -->
                    <p class="text-black text-lg">Check out</p>
                    <p class="text-black text-xl font-semibold"><?php  $data = $_SESSION["check-out"];
                    $date=date_create("$data");  
                    echo date_format($date,"d-m-Y");?></p>
                  </div>
                </div>

                <p class="text-lg text-black">
                  <span class="font-semibold">Tổng số ngày: </span> <?php echo $total_date?>
                </p>
                <hr class="my-4" />
                <p class="text-lg text-black">
                  <span class="font-semibold">Tổng số phòng: </span> <?php echo $_SESSION['roomCount'];?>
                </p>
                <input type="hidden" name="total-date" id="total_date" value="<?php echo $total_date;?>">
                <hr class="my-4" />
                <p class="text-lg text-black">
                  <span class="font-semibold">Bạn chọn phòng: </span>
                  <?php
                  
                   echo $showBooking['rcName'];?>
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
                    <p class="text-black">
                    <?php
                    echo $showBooking['rcName'];
                    ?>:
                    </p>
                    <p class="font-semibold">
                    <?php
                    echo number_format("$price",0,",",".");?> <span id="currency">vnd</span>
                    </p>
                    <p class="text-black">
                    Tổng Số Ngày:
                    </p>
                    <p class="font-semibold">
                    <?php echo $total_date;?> Ngày<span id="currency"></span>
                    </p>
                    <p class="text-black">
                    Tổng Số Phòng:
                    </p>
                    <p class="font-semibold">
                    <?php echo $_SESSION['roomCount'];?> Phòng<span id="currency"></span>
                    </p>
                  </div>
                </div>
              </div>
              <!-- footer -->
              <div class="p-2 px-4 bg-blue-200 rounded-b-lg">
                <div class="grid grid-cols-2">
                  <p class="text-xl text-black">Giá:</p>
                  <p class="text-xl text-black font-semibold text-2xl">
                   <?php $total_price = $total*$_SESSION['roomCount'];
                   echo number_format("$total_price",0,",",".")
                   ?> vnd
                  </p>
                  <input type="hidden" name="total-price" id="total-price" value="<?php echo $total_price;?>">
                </div>
              </div>
            </div>
            <!-- cost to cancel -->
          </div>
          <!-- #2 Enter detail -->
          <div class="w-full p-2 col-span-2 rounded-lg" id="showDetail">
            <!-- where to place -->
            <!-- title -->
            <div class="flex items-center mb-8">
              <div class="h-10 w-10 relative rounded-full bg-blue-500 mr-4">
                <span
                  class="absolute tu-abs-center text-lg font-semibold text-white"
                  >2</span
                >
              </div>
              <p class="text-xl font-semibold">Điền thông tin</p>
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
                  <?php echo $showBooking['hName'];?>
                </a>
              </div>
              <div class="mb-2 flex items-center">
                <ion-icon
                  name="pin"
                  class="text-2xl text-red-500 mr-2"
                ></ion-icon>
                <p class="text-gray-600 text-base font-semibold">
                <span class="pl-2 text-lg"><?php echo $showBooking['hAddress']?>, <?php echo $showBooking['wName']?>, <?php echo $showBooking['dName']?>, <?php echo $showBooking['pName']?></span>
                </p>
              </div>
            </div>
            <div id="card mb-6">
              <p class="text-2xl mb-4">Nhập thông tin của bạn</p>
              <h3 id="message" class="text-red-500 font-semibold"></h3>
              <div class="border border-blue-500 rounded-lg">
                <div class="bg-blue-100 rounded-lg">
                  <!-- sign in opt -->
                  <input type="hidden" name="total-room" value="<?php echo $_SESSION['roomCount'];?>" id="total-room">
                  <input type="hidden" name="total-date" value="<?php echo $total_date;?>" id="total-date">
                  <input type="hidden" name="total-people" value="<?php echo $_SESSION['total_people'];?>" id="total-people">
                  <?php if(!isset($_SESSION['isLogin'])){?>
                  <div class="p-4 flex items-center">
                    <ion-icon name="person" class="text-xl mr-2"></ion-icon>
                    <p>
                      <a href="" class="underline text-blue-500 font-semibold"
                        >Đăng nhập</a
                      >
                      để đặt phòng với giá ưu đãi hoặc
                      <a href="#" class="underline text-blue-500 font-semibold"
                        >đăng ký</a
                      >
                      để quản lí chuyến đi của bạn
                    </p>
                  </div>
                  <?php }else{ ?>
                    <div class="p-4 flex items-center">
                    <ion-icon name="person" class="text-xl mr-2"></ion-icon>
                    <p> Chào 
                      <?php if(isset($checkUser['fullname'])){
                              echo $checkUser['fullname'];
                        };
                      ?>
                    </p>
                    <input type="hidden" name="user_acount" id='user_acount' value="<?php if(isset($checkUser['id'])){
                              echo $checkUser['id'];
                        };; ?>">
                    </div>
                  <?php }?>
                  <hr class="mb-4 border-blue-500" />
                  <!-- personal infomation -->
                  <div class="p-4 mb-4">
                    <div class="grid grid-cols-2 gap-6">
                      <!-- name -->
                      <div class="flex flex-col justify-start col-span-2">
                        <p class="text-lg font-semibold mb-2">Họ và tên</p>
                        <!-- err notice -->
                        <p
                          class="text-md font-semibold text-red-500 mb-2 hidden"
                        >
                          vui lòng nhập tên của bạn
                        </p>
                        <input
                          type="text"
                          name="username"
                          id="fullname"
                          class="rounded-lg p-2"
                          placeholder="Nhập họ của bạn"
                          value ="<?php if(isset($checkUser['fullname'])){
                              echo $checkUser['fullname'];
                              };?>"
                        />
                      </div>

                      <!-- <div class="my-2"></div> -->
                      <!-- email -->
                      <div class="flex flex-col justify-start">
                        <div class="flex items-center mb-2">
                          <ion-icon
                            name="mail"
                            class="text-xl text-red-500 mr-2"
                          ></ion-icon>
                          <p class="text-lg font-semibold">Email</p>
                        </div>
                        <p
                          class="text-md font-semibold text-red-500 mb-2 hidden"
                        >
                          vui lòng nhập email của bạn
                        </p>

                        <input
                          type="email"
                          name="email"
                          id="email"
                          class="rounded-lg p-2"
                          placeholder="Nhập email của bạn"
                          value ="<?php if(isset($checkUser['email'])){
                              echo $checkUser['email'];
                              };?>"
                        />
                      </div>
                      <!-- confirm email -->
                      <div class="flex flex-col justify-start">
                        <div class="flex items-center mb-2">
                          <ion-icon
                            name="mail"
                            class="text-xl text-red-500 mr-2"
                          ></ion-icon>
                          <p class="text-lg font-semibold">Nhập lại Email</p>
                        </div>
                        <p
                          class="text-md font-semibold text-red-500 mb-2 hidden"
                        >
                          vui lòng nhập email của bạn
                        </p>

                        <input
                          type="email"
                          name="re-email"
                          id="re-email"
                          class="rounded-lg p-2"
                          placeholder="Nhập email của bạn"
                          value ="<?php if(isset($checkUser['email'])){
                              echo $checkUser['email'];
                              };?>"
                        />
                      </div>
                      <!-- phone number -->
                      <div class="flex flex-col justify-start">
                        <div class="flex items-center mb-2">
                          <ion-icon
                            name="call"
                            class="text-xl text-green-500 mr-2"
                          ></ion-icon>
                          <p class="text-lg font-semibold">Số điện thoại</p>
                        </div>
                        <p
                          class="text-md font-semibold text-red-500 mb-2 hidden"
                        >
                          vui lòng nhập số điện thoại của bạn
                        </p>

                        <input
                          type="text"
                          name="phone-num"
                          id="phone-num"
                          class="rounded-lg p-2"
                          placeholder="Nhập số điện thoại của bạn"
                          value ="<?php if(isset($checkUser['phone_number'])){
                              echo $checkUser['phone_number'];
                              };?>"
                        />
                      </div>
                      <!-- <div class="flex flex-col justify-end">
                        <button class="p-2 text-white font-semibold bg-orange-400 rounded-lg hover:bg-orange-500 transition duration-200 ease-in">Đặt ngay</button>
                      </div> -->
                    </div>
                  </div>

                  <!-- booking for? -->
                  <div class="p-4">
                    <p class="text-blakc font-semibold mb-2">
                      Bạn đặt phòng cho?
                    </p>
                    <!-- personal -->
                    <label class="inline-flex items-center mr-4">
                      <input
                        type="radio"
                        class="form-radio"
                        name="whoBook"
                        value="personal"
                        id="check-main-guest"
                        onclick="closeForm()"
                      />
                      <span class="ml-2">Cá nhân</span>
                    </label>
                    <!-- so else -->
                    <label class="inline-flex items-center">
                      <input
                        type="radio"
                        class="form-radio guestCheck"
                        name="whoBook"
                        value="soElse"
                        id="check-so-else"
                        onclick="openForm()"
                      />
                      <span class="ml-2">Người khác</span>
                    </label>

                    <!-- so else info form -->
                    <div
                      class="grid grid-cols-2 gap-4 my-4 p-4 border border-orange-500 rounded-lg hidden"
                      id="so-form"
                    >
                      <div class="flex flex-col">
                        <p class="text-lg font-semibold text-black mb-2">
                          Nhập họ và tên của khách
                        </p>
                        <p
                          class="text-md font-semibold text-red-500 mb-2 hidden"
                        >
                          vui lòng nhập tên của khách
                        </p>
                        <input
                          type="text"
                          name="guest-name"
                          id="guest-name"
                          class="rounded-lg p-2"
                          placeholder="Nhập họ và tên của khách"
                        />
                      </div>
                      <div class="flex flex-col">
                        <p class="text-lg font-semibold text-black mb-2">
                          Nhập email của khách
                        </p>
                        <p
                          class="text-md font-semibold text-red-500 mb-2 hidden"
                        >
                          vui lòng nhập email của khách
                        </p>
                        <input
                          type="text"
                          name="guest-email"
                          id="guest-email"
                          class="rounded-lg p-2"
                          placeholder="Nhập email của khách"
                        />
                      </div>
                    </div>
                    <button class="block w-1/3 rounded-lg text-center  mt-4 p-4 text-white text-xl font-semibold bg-blue-400" id="submitCheckout" name='submitCheckout'>
                    Bước cuối cùng
                  </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="w-full p-2 col-span-2 rounded-lg" id="showBooking">
            <!-- where to place -->
            <!-- title -->
            <form method="post" id="order_process_form" action="">
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
                <?php echo $showBooking['hName'];?>
                </a>
              </div>
              <div class="mb-2 flex items-center">
                <ion-icon
                  name="pin"
                  class="text-2xl text-red-500 mr-2"
                ></ion-icon>
                <p class="text-gray-600 text-base font-semibold">
                <span class="pl-2 text-lg"><?php echo $showBooking['hAddress']?>, <?php echo $showBooking['wName']?>, <?php echo $showBooking['dName']?>, <?php echo $showBooking['pName']?></span>
                </p>
              </div>
            </div>

            <div id="card mb-6">
              <p class="text-2xl mb-4">Thanh toán</p>
              <span id="error_card" class="text-red-500 font-semibold"></span>
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
    <script src="<?= BASEURL ?>/public/js/main/stripe.js" rel="stylesheet"></script>
  <script src="<?= BASEURL ?>/public/js/main/checkBooking.js" rel="stylesheet"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.11.1/less.min.js"></script>
  </body>
</html>
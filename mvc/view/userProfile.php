<?php 
$user = $data['user'];
$userBooking = $data['userbooking'];
?>
  <section id="suggest-place" class="py-12 px-8">
    <div class="mx-auto px-6 py-2 text-center max-w-screen-xl">
      <div class="flex flex-col lg:flex-row xl:flex-row">
        <div class="w-full xl:w-1/3 lg:w-1/3 rounded-lg border mb-4 lg:mr-4 xl:mb-4 bg-white p-4 flex flex-col">
          <!-- avatar -->
          <div class="mx-auto w-full mb-2 relative">
          <?php if($user['avatar_img'] == null){?>
            <img src="https://m.photos.timesofindia.com/thumb.cms?msid=48484778&width=500&resizemode=4" alt="<?php echo $user['fullname']; ?>"
              class="w-1/2 mx-auto rounded-full" />
          <?php }else{ ?>
            <img src="./public/images/<?php echo $user['avatar_img']; ?>" alt="<?php echo $user['fullname']; ?>"
              class="w-1/2 mx-auto rounded-full" />
          <?php }?>
            <!-- Neu da xác minh bằng mail -->
            <div class="absolute top-0 right-0 text-green-400 text-xl">
              <ion-icon name="shield-checkmark" class=""></ion-icon>
            </div>
            <!-- Neu chưa -->
            <!-- <div class="absolute top-0 right-0 text-gray-400 text-xl">
                <ion-icon name="shield" class=""></ion-icon>
              </div> -->
          </div>
          <div class="flex flex-col items-center justify-center mx-auto w-full mb-2">
            <!-- <p class="text-lg font-semibold mr-2">Tim Cook</p> -->
            <input type="text" name="username" id="username"
              class="text-2xl text-center bg-transparent font-semibold p-2" value="<?php echo $user['fullname']; ?>" disabled />
            <!-- <ion-icon name="create" class="hover:bg-white p-2 rounded-lg"></ion-icon> -->
            <!-- <input type="text" name="bio" id="bio" class="text-base w-full bg-transparent text-gray-500 p-2 text-center" value="Think Different" disabled> -->

            <!-- archive -->
            <!-- 3 level -->
            <!-- Bronze: #cd7f32 (0-100p)
                        Silver: #C0C0C0 (100-500p)
                        Gold: #D4AF37 (< 500p) -->
            <div class="flex text-xl justify-center items-center mb-4" style="color: #cd7f32;">
              <ion-icon name="trophy"></ion-icon>
              <div class="mr-2"></div>
              <p class="text-base">Rockie on the way</p>
            </div>

            <!-- point -->
            <!-- (0-100p)
              tính số điểm hiện tại / 100 -> width -->
            <div class="border rounded-lg w-full">
              <div class="bg-blue-500 text-xs leading-none py-1 text-center text-white rounded-l-lg"
                style="width: 45%;">
                45 điểm
              </div>
            </div>
          </div>
        </div>
        <div class="w-full lg:w-2/3 rounded-lg bg-white border p-4">
          <div x-data="{ openTab: 1 }" class="p-6">
            <ul class="flex border-b">
              <li @click="openTab = 1" :class="{ '-mb-px': openTab === 1 }" class="-mb-px mr-1">
                <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-blue-700' : 'text-blue-500 hover:text-blue-800'"
                  class="bg-white inline-block py-2 px-4 font-semibold" href="#">
                  Thông tin cá nhân
                </a>
              </li>
              <li @click="openTab = 2" :class="{ '-mb-px': openTab === 2 }" class="mr-1">
                <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-blue-700' : 'text-blue-500 hover:text-blue-800'"
                  class="bg-white inline-block py-2 px-4 font-semibold" href="#">Lịch sử đặt phòng</a>
              </li>
            </ul>
            <div class="w-full pt-4">
              <!-- Thông tin cá nhân -->
              <div x-show="openTab === 1">
                <!-- day of birth -->
                <div class="flex items-center mb-2">
                  <ion-icon name="today" class="mr-2 text-blue-400 text-xl"></ion-icon>
                  <input type="date" name="user-dob" id="user-dob" class="p-2 w-full bg-transparent" value="<?php
                  echo $user['dob'];
                  ?>"
                    disabled />
                </div>
                <!-- phone number -->
                <div class="flex items-center mb-2">
                  <ion-icon name="call" class="mr-2 text-blue-400 text-xl"></ion-icon>
                  <input type="text" name="user-phone-number" id="user-phone-number" class="p-2 w-full bg-transparent"
                    value="<?php echo $user['phone_number']?>" disabled />
                </div>
                <!-- email -->
                <div class="flex items-center mb-2">
                  <ion-icon name="mail" class="mr-2 text-blue-400 text-xl"></ion-icon>
                  <input type="email" name="user-email" id="user-email" class="p-2 w-full bg-transparent"
                    value="<?php echo $user['email']?>" disabled />
                </div>
                <!-- CMND -->
                <div class="flex items-center mb-2">
                  <ion-icon name="tablet-landscape" class="mr-2 text-blue-400 text-xl"></ion-icon>
                  <input type="number" name="user-cmnd" id="user-cmnd" class="p-2 w-full bg-transparent"
                    value="212412123" disabled />
                </div>
                <input type="hidden" name="" id="iduser" value="<?php echo $user['id'];?>">
                <!-- EDIT FIELD -->
                <div class="flex items-center my-2">
                  <button class="px-4 py-2 bg-blue-400 border border-blue-500 hover:bg-blue-500 rounded-lg text-white mr-4" id="edit-info">Sửa thông tin</button>
                  <button class="px-4 py-2 bg-green-400 border border-green-500 hover:bg-green-500 rounded-lg text-white hidden" id="save-info" type="button" id="button_save">Lưu</button>
                </div>
              </div>
              <!-- Lịch sử đặt phòng -->
              <div x-show="openTab === 2">
              <?php foreach($userBooking as $row){?>
                <div class="my-2 rounded-lg border" x-data="{open: false}">
                  <!-- card -->
                  <div class="flex items-center bg-gray-200 rounded-t-lg p-2">
                  <?php if($row['status']==3){ 
                    $status = '<p class="text-green-400 text-white text-sm rounded-lg"><b>Trạng thái: </b>Thành Công<?php echo $status;?></p>';
                    ?>
                    <ion-icon name="checkmark-circle" class="mr-4 text-xl text-green-400"></ion-icon>
                  <?php }elseif($row['status']==2){
                    $status = '<p class="text-yellow-400 text-white text-sm rounded-lg"><b>Trạng thái: </b>Chưa Thanh Toán<?php echo $status;?></p>';
                    ?>
                    <ion-icon name="alert-circle" class="mr-4 text-xl text-yellow-400"></ion-icon>
                  <?php }elseif($row['status']==4){ 
                    $status = '<p class="text-red-400 text-white text-sm rounded-lg"><b>Trạng thái: </b>Đã Hủy<?php echo $status;?></p>';  
                    ?>
                    <ion-icon name="close-circle" class="mr-4 text-xl text-red-500"></ion-icon>
                  <?php }?>
                    <!-- <div class="flex flex-col justify-end items-start mr-4"><div x-data="{ show: false }">
                      <button @click="show = !show" :aria-expanded="show ? 'true' : 'false'" :class="{ 'active': show }">
                      Toggle Show
                      </button>
                      <div x-show="show">Hello world</div> -->
                    <!-- hotel name -->
                    <p class="text-xl text-black w-full text-left"><?php echo $row['hName']?></p>
                    <ion-icon name="add-circle" class="text-xl text-gray-400" @click="open = true"></ion-icon>
                  </div>
                  <!-- Booking info -->
                  <div class="w-full p-2 flex justify-between" x-show="open" @click.away="open = false" x-transition:enter="transition ease-out duration-100"
                  x-transition:enter-start="transform opacity-0 scale-95"
                  x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75"
                  x-transition:leave-start="transform opacity-100 scale-100"
                  x-transition:leave-end="transform opacity-0 scale-95">
                    <!-- st 1 -->                     
                    <div class="">
                      <div class="p-2 flex items-center mb-2">
                        <ion-icon name="pin" class="mr-2"></ion-icon>
                        <p><?php echo $row['hAddress']?>, <?php echo $row['wName']?>,<?php echo $row['pName']?></p>
                      </div>
                      <div class="p-2 flex items-center mb-2">
                        <ion-icon name="today" class="mr-2"></ion-icon>
                        <p><b> Ngày Đến: </b><?php
                        $data = $row["check_in"];
                        $date=date_create("$data");  
                        echo date_format($date,"d-m-Y");
                        ?></p>
                      </div>
                      <div class="p-2 flex items-center mb-2">
                        <ion-icon name="today" class="mr-2"></ion-icon>
                        <p><b> Ngày Đi: </b><?php
                        $data = $row["check_out"];
                        $date=date_create("$data");  
                        echo date_format($date,"d-m-Y");
                        ?></p>
                      </div>
                    </div>
                    <!-- st 2 -->
                    <div class="">
                      <div class="p-2 flex items-center justify-end mb-2">
                        <?php echo $status;?>
                      </div>
                      <div class="p-2 flex items-center mb-2" style="font-size:14px;">
                        <ion-icon name="bed" class="mr-2"></ion-icon>
                        <p><b> Loại Phòng: </b><?php echo $row['rcName'];?></p>
                      </div>
                      <div class="p-2 flex items-center justify-end mb-2 text-lg text-orange-400">
                        <ion-icon name="wallet" class="mr-2" class="text-xl"></ion-icon>
                        <p><b> Giá: </b><?php $price = $row['price'];
                       echo number_format("$price",0,",",".");?> vnd</p>
                      </div>
                    </div>
                  </div>
                </div>
                <?php }?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>

  <!-- JS FOR USER PROFILE -->
  <script>
    // when edit
    $("#edit-info").click(function (e) {
      e.preventDefault();
      //remove disabled property in input
      $("input").prop("disabled", false);
      //adding class for highlight
      $("input").addClass("border border-gray-400 rounded-lg");
      //hide edit btn
      $("#edit-info").addClass("hidden");
      //show save btn
      $("#save-info").removeClass("hidden");
    });

    //when save
    $("#save-info").click(function (e) {
      $("input").prop("disabled", true);
      //remove class to highlight
      $("input").removeClass("border border-gray-400 rounded-lg");
      //show edit btn
      $("#edit-info").removeClass("hidden");
      //hide save btn
      $("#save-info").addClass("hidden");
    })
  </script>

  <!-- FOOTER -->
  <footer class="bg-gray-200 px-6 pt-12 tu-text-title">
    <div class="px-2">
      <div class="max-w-screen-xl mx-auto">
        <div class="flex flex-wrap justify-center py-8">
          <!-- logo -->
          <div class="p-3 w-full sm:w-full lg:w-1/5">
            <div class="">
              <img src="public/images/footer--color__logo-v-3.svg" alt="" class="w-3/4" />
            </div>
          </div>

          <!-- info -->
          <div class="p-3 w-full sm:w-full lg:w-1/5 tu-text-title">
            <div class="text-md uppercase text-black font-semibold tu-text-title">
              Dịch vụ
            </div>
            <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/booking.html">Đặt phòng</a>
            <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Đặt vé máy bay</a>
            <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Đặt Homestay</a>
            <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Combo
              <span class="bg-orange-400 text-white p-1 rounded-lg px-3 font-semibold">-25%</span></a>
          </div>

          <!-- info -->
          <div class="p-3 w-full sm:w-full lg:w-1/5">
            <div class="text-md uppercase text-black font-semibold">
              Thông báo
            </div>
            <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">FAQ</a>
            <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Về dịch Covid-19</a>
            <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Trung tâm trợ giúp</a>
            <!-- <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Combo <span class="bg-orange-400 text-white p-1 rounded-lg px-3 font-semibold">-25%</span></a> -->
          </div>

          <!-- info -->
          <div class="p-3 w-full sm:w-full lg:w-1/5">
            <div class="text-md uppercase text-black font-semibold">
              Điều khoản dịch vụ
            </div>
            <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Điều khoản</a>
            <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Chính sách vận chuyển</a>
            <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Chính sách hoàn tiền</a>
            <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Chính sách bảo mật</a>
          </div>

          <!-- info -->
          <div class="p-3 w-full sm:w-full lg:w-1/5">
            <div class="text-md uppercase text-black font-semibold">
              Newsletter
            </div>
            <a class="my-3 block hover:underline text-gray-dark tu-text-title" href="/#">Đăng ký để nhận ưu đãi mỗi
              ngày!</a>

            <!--  -->
            <div class="flex flex-wrap items-stretch w-full mb-4 relative">
              <input type="text"
                class="flex-shrink flex-grow flex-auto leading-normal w-px flex-1 border h-10 border-grey-light rounded rounded-r-none px-3 relative"
                placeholder="johndoe@gmail.com" />
              <!-- <div class="flex -mr-px">
                                <span
                                    class="flex items-center bg-orange-400 rounded rounded-l-none border border-l-0 px-3 whitespace-no-wrap text-white text-sm font-semibold">@gmail.com</span>
                            </div> -->
            </div>

            <!-- submit btn -->
            <button class="bg-orange-400 hover:bg-orange-500 font-semibold text-lg rounded text-white w-full p-2">
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
    <div class="flex pb-5 m-auto pt-5 text-gray-800 text-sm flex-col md:flex-row max-w-6xl">
      <div class="mt-2 text-white font-semibold">
        <span>&copy;</span> Copyright 2020. All Rights Reserved.
      </div>
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
  <script src="//cdnjs.cloudflare.com/ajax/libs/less.js/3.11.1/less.min.js"></script>
  <script src = "./public/js/main/edituser.js"></script>
</body>

</html>
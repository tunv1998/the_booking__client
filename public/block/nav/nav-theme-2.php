<div class="w-full text-gray-700 bg-white dark-mode:text-gray-200 dark-mode:bg-gray-800">
    <div x-data="{ open: false }" class="flex flex-col max-w-screen-xl px-4 mx-auto md:items-center md:justify-between md:flex-row md:px-6 lg:px-8">
        <div class="flex flex-row items-center justify-between p-3">
            <a href="#" class="text-lg font-bold text-gray-900 uppercase rounded-lg dark-mode:text-white focus:outline-none ">
                <div class="flex row items-center">
                    <img src="public/images/header--color__logo-v-3.svg" alt="" class="h-8 sm:w-8 lg:w-auto object-cover object-left">
                    <span></span>
                </div>
            </a>

            <!-- Hambuger Bar -->
            <button class="rounded-lg md:hidden focus:outline-none" @click="open = !open">
                <svg fill="currentColor" viewBox="0 0 20 20" class="w-6 h-6">
                    <!-- open -->
                    <path x-show="!open" fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM9 15a1 1 0 011-1h6a1 1 0 110 2h-6a1 1 0 01-1-1z" clip-rule="evenodd"></path>
                    <!-- close -->
                    <path x-show="open" fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>

        <!-- MENU -->
        <!-- isActive -> icon: white, text: white, bg: blue-500 -->
        <!-- notActive -> icon: gray-400, text: gray-400, bg: none -->
        <!-- isHover -> icon: white, text: white, bg: blue-300 -->
        <nav :class="{'flex': open, 'hidden': !open}" class="flex-col flex-grow hidden pb-4 md:pb-0 md:flex md:justify-end md:flex-row">
            <!-- Home -->
            <a class="px-4 py-2 md:ml-4 text-base font-semibold flex row items-center rounded-lg bg-transparent text-black text-blue-500" href="#">
                <ion-icon name="home"></ion-icon>

                <div class="ml-2">
                    <p>Trang Chủ</p>
                </div>
            </a>

            <!-- Co-op -->
            <a class="px-4 py-2 md:ml-4 text-base font-semibold flex row items-center rounded-lg bg-transparent hover:text-blue-300" href="#">
                <ion-icon name="ribbon"></ion-icon>

                <div class="ml-2">
                    <p>Trở thành nhà cung cấp</p>
                </div>
            </a>

            <!-- Sale-off -->
            <a class="px-4 py-2 md:ml-4 text-base font-semibold flex row items-center rounded-lg bg-transparent hover:text-blue-400" href="#">
                <!-- <ion-icon class="hover:text-white" name="flash"></ion-icon> -->
                <ion-icon name="flash"></ion-icon>
                <div class="ml-2">
                    <p>Khuyến mãi</p>
                </div>
            </a>

            <!-- CHECK LOGIN -->
            <!-- Check Sesion -->
            <!-- Nếu chưa đăng nhập -->
            <!-- Login -->
            <?php
            if (!isset($_SESSION['isLogin'])) {
                // echo 1;
                require_once 'public/block/nav/is-login.php';
            } else {
                // echo 0;
                require_once 'public/block/nav/isnot-login.php';
            }
            ?>
        </nav>
    </div>
</div>
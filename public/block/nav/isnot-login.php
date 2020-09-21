<div @click.away="open = false" class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="w-full px-4 py-2 text-sm font-semibold text-left bg-transparent rounded-lg md:w-auto md:inline md:mt-0 md:ml-4 text-white bg-orange-500 hover:bg-orange-600 focus:outline-none focus:shadow-outline">
        <div class="flex row items-center">
            <ion-icon name="person-circle" class="text-lg pr-1"></ion-icon>
            <span>Đăng nhập</span>
            <!-- <svg fill="currentColor" viewBox="0 0 20 20"
                                :class="{'rotate-180': open, 'rotate-0': !open}"
                                class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd">
                                </path>
                            </svg> -->
        </div>
    </button>
    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md md:w-64 z-30">
        <div class="w-auto max-w-xs">
            <form class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4" method="post">
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Tên đăng nhập
                    </label>
                    <input id="username" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                </div>
                <div class="mb-6">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="password">
                        Mật khẩu
                    </label>
                    <input id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                    <!-- Thong bao neu co loi xay ra -->
                    <!-- <p class="text-red-500 text-xs italic">Please choose a password.</p> -->
                </div>
                <div class="flex items-center flex-col">
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full" type="button" id="login">
                        Đăng nhập
                    </button>
                    <a class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800" href="<?= BASEURL ?>/index.php?controller=user&action=forgot">
                        Quên mật khẩu?
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Register -->
<a class="px-4 py-2 md:ml-4 text-sm font-semibold flex row items-center rounded-lg bg-transparent hover:text-white focus:text-white hover:bg-blue-300 focus:bg-blue-300 focus:outline-none focus:shadow-outline text-gray-600" href="<?= BASEURL ?>/index.php?controller=user&action=register">
    <!-- <ion-icon class="hover:text-white" name="infinite"></ion-icon> -->
    <ion-icon name="add-circle" class="text-lg"></ion-icon>
    <div class="ml-2">
        <p>Đăng ký</p>
    </div>
</a>
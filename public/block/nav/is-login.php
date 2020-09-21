<!-- Neu da dang nhap -->
<div @click.away="open = false" class="relative" x-data="{ open: false }">
    <button @click="open = !open" class="flex flex-row items-center w-full px-2 py-1 mt-1 text-sm font-semibold text-left bg-transparent rounded-lg md:w-auto md:inline md:mt-0 md:ml-4 border-blue-300 hover:border-blue-400 p-2">
        <div class="flex justify-center items-center">
            <!-- avatar -->
            <img class="h-8 w-8 rounded-full" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="" />
            <!-- username    -->
            <p class="text-md text-black ml-2"><?php echo $_SESSION['isLogin'];?></p>
        </div>

        <!-- <span>Tên của User</span>
        <svg fill="currentColor" viewBox="0 0 20 20" :class="{'rotate-180': open, 'rotate-0': !open}" class="inline w-4 h-4 mt-1 ml-1 transition-transform duration-200 transform md:-mt-1">
            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
        </svg> -->
    </button>

    <!-- Content -->
    <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full mt-2 origin-top-right rounded-md shadow-lg md:w-48 z-30">
        <div class="px-2 py-2 bg-white rounded-md shadow dark-mode:bg-gray-700">
            <!-- profile -->
            <a class="block px-2 py-1 mt-1 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200  focus:outline-none " href="./index.php?controller=user&action=profile">
                <div class="flex row items-center">
                    <ion-icon name="person" class="text-blue-600"></ion-icon>
                    <span class="ml-1">Profile</span>
                </div>
            </a>
            <!-- love -->
            <a class="block px-2 py-1 mt-1 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200  focus:outline-none " href="#">
                <div class="flex row items-center">
                    <ion-icon name="heart" class="text-red-600"></ion-icon>
                    <span class="ml-1">Yêu thích</span>
                </div>
            </a>
            <!-- bookmark -->
            <a class="block px-2 py-1 mt-1 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200  focus:outline-none " href="./index.php?controller=user&action=myBooking">
                <div class="flex row items-center">
                    <ion-icon name="bookmark" class="text-green-600"></ion-icon>
                    <span class="ml-1">Đặt phòng</span>
                </div>
            </a>
            <hr class="mx-1 my-1">
            <!-- bookmark -->
            <a class="block px-2 py-1 mt-1 text-sm font-semibold bg-transparent rounded-lg md:mt-0 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200  focus:outline-none " href="<?=BASEURL?>/index.php?controller=user&action=logout">
                <div class="flex row items-center">
                    <ion-icon name="log-out" class="text-red-600"></ion-icon>
                    <span class="ml-1 text-red-600">Đăng xuất</span>
                </div>
            </a>
        </div>
    </div>
    <!-- <div x-show="open" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute right-0 w-full md:max-w-screen-sm md:w-screen mt-2 origin-top-right z-30">
        <div class="px-2 pt-2 pb-4 bg-white rounded-md shadow-lg dark-mode:bg-gray-700">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <a class="flex flex row items-start rounded-lg bg-transparent p-2 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200  focus:outline-none " href="#">
                    <div class="bg-teal-500 text-white rounded-lg p-3">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4">
                            <path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold">Appearance</p>
                        <p class="text-sm">Easy customization</p>
                    </div>
                </a>

                <a class="flex flex row items-start rounded-lg bg-transparent p-2 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200  focus:outline-none " href="#">
                    <div class="bg-teal-500 text-white rounded-lg p-3">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4">
                            <path d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold">Comments</p>
                        <p class="text-sm">Check your latest comments</p>
                    </div>
                </a>

                <a class="flex flex row items-start rounded-lg bg-transparent p-2 dark-mode:hover:bg-gray-600 dark-mode:focus:bg-gray-600 dark-mode:focus:text-white dark-mode:hover:text-white dark-mode:text-gray-200 hover:text-gray-900 focus:text-gray-900 hover:bg-gray-200  focus:outline-none " href="#">
                    <div class="bg-teal-500 text-white rounded-lg p-3">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" class="md:h-6 md:w-6 h-4 w-4">
                            <path d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"></path>
                            <path d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="font-semibold">Analytics</p>
                        <p class="text-sm">Take a look at your statistics</p>
                    </div>
                </a>
            </div>
        </div>
    </div> -->
</div>
<?php
function showComent($avatar,$username,$rating,$content,$iconIsLike,$totalLike){
    $output = '<div class="my-2 w-full rounded-lg p-2 flex justify-center items-star">
    <!-- user avatar -->
    <div class="w-16 h-16 rounded-full mr-4">
    '.$avatar.'
    </div>
    <!-- user comment -->
    <div class="w-full flex flex-col">
        <!-- user name -->
        <p class="text-base text-black font-semibold">
            '.$username.'
        </p>
        <!-- user rating -->
        <div id="rating" class="w-1/5 flex text-yellow-400 text-xl py-2 text-yellow-400 text-xl">
            '.$rating.'
        </div>
        <!-- some comment -->
        <p class="text-base text-gray-500">
            '.$content.'
        </p>

        <!-- react -->
        <div class="flex my-2 items-center">
            <!-- <ion-icon name="thumbs-up-outline" class="text-xl mr-2"></ion-icon> -->
            '.$iconIsLike.'            
            <p class="text-blue-400">'.$totalLike.'</p>
        </div>
    </div>
</div>
<hr>';
echo $output;
}
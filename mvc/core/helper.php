<?php 
    use PHPMailer\PHPMailer\PHPMailer;
    require_once "./public/PHPMailer/PHPMailer.php";
    require_once "./public/PHPMailer/SMTP.php";
    require_once "./public/PHPMailer/Exception.php";

    class helpers{
        public static function replaceSpecialCharacter($text){
            $regex = ['/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'];
            if(!preg_replace($regex,"",$text)){
                echo "<script>alert('Tài khoản có chứa ký tự đặt biệt')</script>";
                return false;
            }
                return $text;
        }
        public static function emailValidation($email) 
        {
            $regex = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,10})$/";
            $email = strtolower($email);
            if(!preg_match ($regex, $email)){
                return false;
            }
                return $email;
        }
        public static function start_with($needle, $haystack) {
            $length = strlen($needle);
            return (substr($haystack, 0, $length) === $needle);
        }
        
        public static function regitsPhoneNumber($number){
            $GLOBALS["carriers_number"] = [
                '096' => 'Viettel',
                '097' => 'Viettel',
                '098' => 'Viettel',
                '032' => 'Viettel',
                '033' => 'Viettel',
                '034' => 'Viettel',
                '035' => 'Viettel',
                '036' => 'Viettel',
                '037' => 'Viettel',
                '038' => 'Viettel',
                '039' => 'Viettel',
            
                '090' => 'Mobifone',
                '093' => 'Mobifone',
                '070' => 'Mobifone',
                '071' => 'Mobifone',
                '072' => 'Mobifone',
                '076' => 'Mobifone',
                '078' => 'Mobifone',
            
                '091' => 'Vinaphone',
                '094' => 'Vinaphone',
                '083' => 'Vinaphone',
                '084' => 'Vinaphone',
                '085' => 'Vinaphone',
                '087' => 'Vinaphone',
                '089' => 'Vinaphone',
            
                '099' => 'Gmobile',
            
                '092' => 'Vietnamobile',
                '056' => 'Vietnamobile',
                '058' => 'Vietnamobile',
            
                '095'  => 'SFone'
            ];
                $number = str_replace(array('-', '.', ' '), '', $number);
            
                if (!preg_match('/^0[0-9]{9,10}$/', $number)) return false;
            
                $start_numbers = array_keys($GLOBALS["carriers_number"]);
                foreach ($start_numbers as $start_number) {
                    $check = helpers::start_with($start_number, $number);
                    if ($check) {
                        return $number;
                    }
                }
                return false;
        }
        public static function isLogin(){
            if(isset($_SESSION['isLogin'])){
                return true;
            }
            else{
                return false;
            }
        }
        public static function checkPostExist($arr){
            for ($i=0; $i < count($arr); $i++) { 
                if(isset($_POST[$arr[$i]])){
                    if(empty($_POST[$arr[$i]])){
                        return false;
                    }
                }
                else{
                    return false;
                }
            }
            return true;
        }
        public static function returnMessage($result,$successMess,$failMess,$success){
            if($result){
                echo "<script>alert('".$successMess."')</script>";
                header("location:".self::BASE_URL."$success");
            }
            else{
                echo "<script>alert('".$failMess."')</script>"; 
            }
        }
        public static function showStar($star){
            $star = floatval($star);
            $color = '';
            $starHotel = '
            <span class="list-inline" data-rating="'.$star.'" title="Average Rating - '.$star.'">';
            $realStar = 5 - $star;
            if(round($realStar) - $realStar == 0){
                for ($i=0; $i < 5; $i++) { 
                    if($i<$star){
                    // $color = 'color:#ffcc00;';
                    // $starHotel .= '<i class="fa fa-star" style="cursor:pointer; '.$color.' font-size:15px;"></i>';
                    $starHotel .= '<i class="fa fa-star mr-1"></i>';
                    }else{
                    $color = 'color:#ccc;';
                    // $starHotel .= '<i class="fa fa-star" style="cursor:pointer; '.$color.' font-size:15px;"></i>';
                    $starHotel .= '<i class="fa fa-star-o mr-1"></i>';
                    }
                }
                }else{
                for($i=1; $i< 5; $i++)
                    {
                    if($i <= $star)
                    {
                        // $color = 'color:#ffcc00;';
                        $starHotel .= '<i class="fa fa-star mr-1"></i>';
                        if($i == floor($star)){
                            // $color = 'color:#ffcc00;';
                            $starHotel .= '<i class="fa fa-star-half-o  mr-1"></i>';
                        }
                    }
                    else{
                    // $color = 'color:#ccc;';
                    $starHotel .= '<i class="fa fa-star-o mr-1"></i>';
                    }
                }
            }
            $starHotel .= '
                    </span>';
                return $starHotel;
        }
        public static function formatMoney($number, $fractional=false) {  
            if ($fractional) {  
                $number = sprintf('%.2f', $number);  
            }  
            while (true) {  
                $replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number);  
                if ($replaced != $number) {  
                    $number = $replaced;  
                } else {  
                    break;  
                }  
            }  
            return $number;  
      }
      public static function sendMail($pass,$email,$name,$to,$subject,$body){
        $mail = new PHPMailer();
        //SMTP Settings
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPAuth = true;
       //  cau hinh trong php.ini va sendemail.ini POST USERName And PASSword Email
        $mail->Username = $email;  
        // Lien He T Lay Passs
        $mail->Password = $pass;
        $mail->Port = 587; //587
        // phuong thuc post
        $mail->SMTPSecure = "tls"; //tls
        //Email Settings
        $mail->isHTML(true);
        $mail->setFrom($email, $name);
        // dia chi gui toi
        $mail->addAddress($to);
        $mail->Subject = $subject;
        // layout cua mail
        $mail->Body = $body;
       
        if ($mail->send()) {
            return true;
        } else {
            return false;
        }
      }
      public static function paginationLink($page,$total_data,$limit){
        $total_links = ceil($total_data/$limit);
        $previous_link = '';
        $next_link = '';
        $page_link = '';
        $output = '';
        // echo $total_data;
        if($total_links > 5)
        {
          if($page < 5)
          {
            for($count = 1; $count <= 5; $count++)
            {
              $page_array[] = $count;
            }
            $page_array[] = '...';
            $page_array[] = $total_links;
          }
          else
          {
            $end_limit = $total_links - 5;
            if($page > $end_limit)
            {
              $page_array[] = 1;
              $page_array[] = '...';
              for($count = $end_limit; $count <= $total_links; $count++)
              {
                $page_array[] = $count;
              }
            }
            else
            {
              $page_array[] = 1;
              $page_array[] = '...';
              for($count = $page - 1; $count <= $page + 1; $count++)
              {
                $page_array[] = $count;
              }
              $page_array[] = '...';
              $page_array[] = $total_links;
            }
          }
        }
        else
        {
          for($count = 1; $count <= $total_links; $count++)
          {
            $page_array[] = $count;
          }
        }
        for($count = 0; $count < count($page_array); $count++)
        {
          if($page == $page_array[$count])
          {
            $page_link .= '
            <li class="m-2">
              <a class="page-link border border-blue-500 rounded py-2 px-4 bg-blue-500 hover:bg-blue-700 text-white" href="#" data-page_number="'.$page_array[$count].'">'.$page_array[$count].' <span class="sr-only">(current)</span></a>
            </li>
            ';
        
            $previous_id = $page_array[$count] - 1;
            if($previous_id > 0)
            {
              $previous_link = '<li class="page-item"><a class="page-link text-center block border border-white rounded hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-2 px-4" href="javascript:void(0)" data-page_number="'.$previous_id.'">Previous</a></li>';
            }
            else
            {
              $previous_link = '
              <li class="" style="">
                <a class="border border-gray-500 block py-2 px-4 text-gray-400 cursor-not-allowed" href="#">Previous</a>
              </li>
              ';
            }
            $next_id = $page_array[$count] + 1;
            if($next_id > $total_links)
            {
              $next_link = '
              <li class="page-item">
                <a class="border border-gray-500 block py-2 px-4 text-gray-400 cursor-not-allowed" href="#">Next</a>
              </li>
                ';
            }
            else
            {
              $next_link = '<li class="page-item"><a class="page-link text-center block border border-white rounded hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-2 px-4" href="javascript:void(0)" data-page_number="'.$next_id.'">Next</a></li>';
            }
          }
          else
          {
            if($page_array[$count] == '...')
            {
              $page_link .= '
              <li class="page-item disabled">
                  <a class="py-2 px-4 text-gray-400 cursor-not-allowed" href="#">...</a>
              </li>
              ';
            }
            else
            {
              $page_link .= '
              <li class="page-item m-2"><a class="page-link text-center border border-white rounded hover:border-gray-200 text-blue-500 hover:bg-gray-200 py-2 px-4" href="javascript:void(0)" data-page_number="'.$page_array[$count].'">'.$page_array[$count].'</a></li>
              ';
            }
          }
        }
        $output .= '<div align="center">
        <ul class="flex justify-center">';
        $output .= $previous_link . $page_link . $next_link;
        $output .= '
        </ul>
        
        </div>
        ';
        
        echo $output;
      }
    }
?>
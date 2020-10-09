<?php
  require_once './mvc/view/component.php';
  require_once './vendor/autoload.php';
  \Stripe\Stripe::setApiKey('sk_test_51H05WIHUnhuR2nRIW99iOpWwZrnXJNqNOKOwBEnK6w43AvULBtgujsh04fCzlP2Bsbk8oBXh1xD9k0sBovqtJ9No00CvovuzS3');
class hotelModel extends DB{
        //    tao function querySearch de goi autocomplete
  public function checkHotel($id,$guest){
    $sql = " WHERE (hotel.name) IN ('$id')";
    $where = " AND a.guest_limit >= $guest";
    $search = $this->queryCheck($sql,$where);
    $result = $this->QueryAll($search);
        // $total_row = $stmt->rowCount();
        if($result){
          foreach($result as $row){
            echo "<script>window.onload =
            location.href = './index.php?controller=hotel&action=detail&id=".$row['hId']."';</script>";
        }}else{
          echo "<script>window.onload =
          location.href = './index.php?controller=hotel&action=listHotel';</script>";
        }
  }
    public function gethotelHighReview(){
      $sql = "ORDER BY review DESC LIMIT 3";
      $where = "";
      $query = $this->queryCheck($sql,$where);
      $result = $this->QueryAll($query);
      return $result;
    }
    public function search($searchteam){
    $sql = $this->querySearch($searchteam);
    $result = $this->QueryAll($sql);
    $output = "";
    if($result){
    ?>
    <ul id="country-list">  
    <?php
        foreach($result as $country) {
    ?>
    <li class="border-b-2" onClick="selectCountry('<?php echo $country["_name"]; ?>','<?php echo $country["_name"]; ?>');">
    <div class="flex p-2 items-center">
        <span class="bg-green-400 text-white rounded-full p-2 w-6 h-6 flex items-center justify-center">
          <ion-icon name="navigate" style="color:green;"></ion-icon>
          <!-- <ion-icon name="search" class="text-white"></ion-icon> -->
        </span>
        <p class="px-3 font-semibold"><?php echo $country["_name"];?></p>
      </div>
    </li>
        <?php }?>
    </ul>
    <?php
    }else{
        $query = "SELECT DISTINCT(province.id) as id,
        province._name as pName,district._name as dName
        FROM province
        inner join district on province.id = district._province_id
        INNER JOIN hotel ON hotel.city_id = province.id
        WHERE
        (province.id) IN (SELECT  hotel.city_id FROM hotel)
        AND
        (district.id) IN (SELECT hotel.district_id FROM hotel)";
        $result = $this->QueryAll($query);
        ?>
        <ul id="country-list">  
        <?php
        foreach($result as $country) {
        ?>
        <li class="border-b-2" onClick="selectCountry('<?php echo $country["pName"]; ?>','<?php echo $country["pName"]; ?>');">
    <div class="flex p-2 items-center">
        <span class="bg-green-400 text-white rounded-full p-2 w-6 h-6 flex items-center justify-center">
          <ion-icon name="navigate"></ion-icon>
          <!-- <ion-icon name="search" class="text-white"></ion-icon> -->
        </span>
        <p class="px-3 font-semibold"><?php echo $country["pName"];?></p>
      </div>
    </li>
        <?php }
    }
    }
    // filter page search-Filter
    public function filter($id,$guest,$highPrice,$lowPrice,$rating,$review_hotel,$price,$page,$start,$limit){
          $sql = " WHERE (province._name) IN ('$id') ";
          $sql1 = " WHERE CONCAT(district._prefix,' ',district._name) IN ('$id') ";
          $sql2 = " WHERE CONCAT(ward._prefix,' ',ward._name) IN ('$id') ";
          $where = " ";
          $order = "";
          $search = "";
          if(isset($lowPrice)&&isset($highPrice)){
            $where .= " AND (a.dePrice BETWEEN '".$lowPrice."' AND '".$highPrice."')
            ";
            $search = $this->queryCheck($sql,$where);
            $search .= " UNION ";
            $search .= $this->queryCheck($sql1,$where);
            $search .= " UNION ";
            $search .= $this->queryCheck($sql2,$where);
            $result = $this->QueryAll($search);
            if(!$result){
              $where .= " AND (room_rate.rate BETWEEN '".$lowPrice."' AND '".$highPrice."')
            ";
            }
            }
          if(isset($rating))
          {
            $rating = implode("','", $rating);
              if($rating >=5){
                $where .= " AND hotel.stars IN ('".$rating."')";
              }elseif(str_word_count($rating)>1){
               $where .= " AND hotel.stars IN ('".$rating."')";
              }else{
                $where .= " AND (hotel.stars BETWEEN $rating AND ($rating + 0.5))";
              }
          }
          $order = " ORDER BY hId ASC";
            if(isset($review_hotel))
            {
                $review_hotel = implode("','", $review_hotel);
                if(str_word_count($review_hotel)==1){
                  $order = " ORDER BY review ".$review_hotel."";
              }else{
                $review_hotel = "";
                $order = "";
              }
            }
            if(isset($price))
            {
              $price = implode("','", $price);
              if(str_word_count($price)==1){
                $order = " ORDER BY (rate) ".$price."";
            }else{
              $price = "";
              $order = "";
            }
            }
            $search = $this->queryCheck($sql,$where);
            $search .= " UNION ";
            $search .= $this->queryCheck($sql1,$where);
            $search .= " UNION ";
            $search .= $this->queryCheck($sql2,$where);
            $search .= $order;
            // echo $search;

            if($page > 1)
            {
              $start = (($page - 1) * $limit);
              $page = $page;
            }
            else
            {
              $start = 0;
            }
            $total_data = $this->QueryAll($search);
            $search .= " LIMIT ".$start.",".$limit."
            ";
            $result = $this->QueryAll($search);
            $showHotel ="";
            if($total_data==false){
              $where = "";
              $order = "";
              $search = $this->queryCheck($sql,$where,$order);
              $search .= " UNION ";
              $search .= $this->queryCheck($sql1,$where,$order);
              $result = $this->QueryAll($search);
             echo '<div class="w-full text-white py-2 text-center px-4 mb-4 bg-red-500 rounded-lg sticky top-0">
             <div class="flex items-center justify-start text-center">
                 <span class="pl-2 text-xl font-semibold">Dữ Liệu Bạn Chọn Không Có Vui Lòng Chọn Lại</span>
             </div>
         </div>';
            }
        foreach($result as $row)
                {
                if($row['rate']==null){
                    $pri = $row['pri'];
                }else{
                    $pri = $row['rate'];
                }
                $pri = helpers::formatMoney($pri);
                $star = helpers::showStar($row['hStar']);
                $hname = helper::convertHotelNameToFolderName([$row['hName']]);
                $nameHotel = implode('-',$hname);
                $img = $row['img'];
                $hId = $row['hId'];
                $address = $row['hAddress'];
                $wName = $row['wName'];
                $hName = $row['hName'];
                $dName = $row['dName'];
                $pName = $row['pName'];
                if($row['review'] != null){
                  $review=round($row['review']);
                  }else{
                  $review="";
                  }
                  if($review <=5 && $review >= 4){
                    $msg = "Ấn tượng";
                  }elseif($review <=4 && $review >= 3){
                    $msg = "Tuyệt";
                  }else{
                    $msg = "Tốt";
                  }                
                 $showHotel .= showHotel($img,$hId,$hName,$star,$address,$wName,$dName,$pName,$review,$pri,$nameHotel,$msg);
              }
              $total_data = count($total_data);
              if($total_data>0){
              $showHotel .= helpers::paginationLink($page,$total_data,$limit);
              }
            echo $showHotel;
}

public function getRoomChildById($id){
  $showOrder = $this->getRchildByid($id);
  $result = $this->queryOne($showOrder);
  if(!$result){
    return false;
  }
  return $result;
}
public function checkUser($id){
  $query = $this->getUserByid($id);
  $result = $this->queryOne($query);
  if(!$result){
    return false;
  }
  return $result;
}
public function getCountRoomBooked($rooms_id,$check_in,$check_out){
  $query = "SELECT sum(booking.room_total) as roomBooked,rooms.id as id,rooms.count as roomTotal FROM booking 
  INNER JOIN room_child ON room_child.id = booking.room_child_id
  INNER JOIN rooms ON rooms.id = room_child.room_parent
  WHERE room_child.room_parent = ".$rooms_id." AND (booking.check_in BETWEEN '".$check_in."' AND '".$check_out."') AND (booking.check_out BETWEEN '".$check_in."' AND '".$check_out."')
  AND (booking.status_id = 1 OR booking.status_id = 2 OR booking.status_id = 3)";
  return $query;
}
public function createBooking($username,$phone_number,$email,$guestName,$total_date,$total_people,$user_account,$roomCount,$check_in,$check_out,$room_child_id,$total_price,$rooms_id){
  $getRoom = $this->getCountRoomBooked($rooms_id,$check_in,$check_out);
  $result = $this->queryOne($getRoom);
  $totalRoom = $result['roomTotal'] - $result['roomBooked'];
  if($totalRoom>=$roomCount){
  if($user_account!=null){
  $query ="INSERT INTO `booking`(`customer_name`, `customer_phone_number`, `customer_email`, `guest_name`, `total_guest`, `total_date`, `check_in`, `check_out`, `room_total`, `room_child_id`, `status_id`, `user_account_id`)
  VALUES ('$username','$phone_number','$email','$guestName','$total_people','$total_date','$check_in','$check_out','$roomCount','$room_child_id','2','$user_account')";
  }else{
    $query ="INSERT INTO `booking`(`customer_name`, `customer_phone_number`, `customer_email`, `guest_name`, `total_guest`, `total_date`, `check_in`, `check_out`, `room_total`, `room_child_id`, `status_id`)
    VALUES ('$username','$phone_number','$email','$guestName','$total_people','$total_date','$check_in','$check_out','$roomCount','$room_child_id','2')";
  }
  $options = array(
    'cluster' => 'ap1',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '45b71145f0bd5981bebb',
    '75b65983b3a7032bdd79',
    '1030181',
    $options
  );
  $error = "";
  $stmt = $this->conn->prepare($query);
  if($stmt->execute()===true){
  $data['roomCount'] = $roomCount;
  $data['roomId'] = $result['id'];
  $data['roomChildId'] = $room_child_id;
  $data['formday'] =  strtotime($check_in);
  $data['today'] = strtotime($check_out);
  $pusher->trigger('my-channel', 'my-event', $data);
  $madh = $this->conn->lastInsertId();
  $subject = "theBooking";
  $body = "
  Please click on the link to Pay order:<br><br>
  <a href='http://localhost/PROJECT-ONE/index.php?controller=hotel&action=confirm&email=$email&id=$madh'>Click Here</a>
  ";	
  $sendmail = helpers::sendMail('thanhdai2295','thanhdai220595@gmail.com','theBooking',$email,$subject,$body);
  return $madh;
  }else{
    return false;
  }
}else{
  return false;
}

}
public function checkOut($id,$token,$email,$name,$total_price){
    if(isset($token)){
  $customer = \Stripe\Customer::create(array(
   'email'   => $email,
   'source'  => $token,
   'name'   => $name,
   'address'  => array(
    'line1'   => 'AAAAA',
    'postal_code' => '0365',
    'city'   => 'TPHCM',
    'state'   => 'HCM',
    'country'  => 'US'
   )
  ));
  $order_number = rand(100000,999999);
  $charge = \Stripe\Charge::create(array(
   'customer'  => $customer->id,
   'amount'  => $total_price,
   'currency'  => 'VND',
   'description' => 'Heloo',
   'metadata'  => array(
    'order_id'  => $order_number
   )
  ));
  $response = $charge->jsonSerialize();
  // dữ liệu trả về từ API striper.
  if($response["amount_refunded"] == 0 && empty($response["failure_code"]) && $response['paid'] == 1 && $response["captured"] == 1 && $response['status'] == 'succeeded')
  {
    $query = "UPDATE `booking` SET`status_id`='3' WHERE booking.id = ".$id."";
    $stmt = $this->conn->prepare($query);
    if($stmt->execute()){
      unset($_SESSION["booking"]);
      echo "<script>alert('Thanh toán thành công vui lòng check mail để xem chi tiết đơn hàng')</script>";
      $subject = "theBooking";
      $body = "
      Cảm ơn bạn đã cùng đồng hành với chúng tôi!!
      ";	
      $sendmail = helpers::sendMail('thanhdai2295','thanhdai220595@gmail.com','theBooking',$email,$subject,$body);
      $_SESSION["success_message"] = "Payment is completed successfully. The TXN ID is " . $response["balance_transaction"] . "";
      echo "<script>window.onload =
                location.href = './index.php';</script>";
    }
  }else{
    echo "<script>alert('Thanh toán không thành công')</script>";
    return false;
  }
}
}
public function checkOutDetail($id){
  $query = "SELECT hotel.name as hName,rooms.name AS rName,room_child.name AS rcName,booking.check_in as check_in,booking.check_out AS check_out,booking.room_total as room_total,booking.total_price as totalPrice,booking.total_date as totalDate,hotel.address_line as hAddress,
  province._name as pName, CONCAT(district._prefix,' ',district._name) as dName,CONCAT(ward._prefix,' ',ward._name) as wName
  FROM `booking` 
  INNER JOIN room_child ON room_child.id = booking.room_child_id
  INNER JOIN rooms ON rooms.id =  room_child.room_parent
  INNER JOIn hotel ON rooms.hotel_id = hotel.id
  inner join province on province.id = hotel.city_id 
  inner join district on district.id = hotel.district_id 
  inner join ward on ward.id = hotel.wards_id 
  WHERE booking.id = $id AND booking.status_id = 2";
  $result = $this->queryOne($query);
  if(!$result){
    echo "<script>alert('Mã đơn hàng của bạn sai hoặc đơn hàng của bạn đã quá thời hạn cho phép')</script>";
    echo "<script>window.onload =
    location.href = './index.php';</script>";
    return false;
  }
  return $result;
}
}

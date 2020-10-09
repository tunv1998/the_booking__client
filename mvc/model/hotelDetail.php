<?php
  require_once './mvc/view/showComment.php';
  class hotelDetail extends DB{
        //    tao function query de check bien
      //  Tao Ham query check HInh Anh
      public function queryCheckImg($id,$sql){
        $query = "SELECT DISTINCT hotel_images.name as Iname FROM hotel_images WHERE hotel_images.hotel_id = ".$id." ".$sql."";
        return $query;
      }
    public function getAllImageHotelById($id){
        $sql = " ";
        $checkImg = $this->queryCheckImg($id,$sql);  
        $result = $this->queryAll($checkImg);
        if(!$result){
          return false;
        }
        return $result;
      }
      public function getImageHotelById($id){
        $sql = " LIMIT 2 ";
        $checkImg = $this->queryCheckImg($id,$sql);  
        $result = $this->queryAll($checkImg);
        if(!$result){
          return false;
        }
        return $result;
      }
      public function getHotelById($id){
        $sql= " WHERE hotel.id = ".$id."";
        $where = " ";
        $showDetail = $this->queryCheck($sql,$where);
        $result = $this->queryAll($showDetail);
        if(!$result){
          return false;
        }
        return $result;
      }
    public function getRoomByIdHotel($id,$guest){
        $query = "SELECT  DISTINCT p.name AS rImg ,rooms.id as rId, rooms.name AS rName, rooms.guest_limit as guest,rooms.dePrice as price,room_rate.rate as rate FROM rooms
        inner join hotel_images AS p ON p.id =
        ( SELECT id FROM hotel_images AS p2 WHERE p2.room_id = rooms.id ORDER BY p2.name DESC LIMIT 1)
        INNER JOIN hotel ON hotel.id = rooms.hotel_id
        INNER JOIN room_child ON room_child.room_parent = rooms.id
        left join room_rate on room_rate.room_child_id = room_child.id and now() between room_rate.date_from and room_rate.date_to and room_rate.status_id = 1
        WHERE hotel.id =".$id."  AND rooms.guest_limit >= ".$guest." AND rooms.count >= ".$_SESSION['roomCount']." AND room_child.status_id = 1 
        ";
        $result = $this->queryAll($query);
        if(!$result){
          return false;
        }
        return $result;
      }
      public function getRoomChildByRoom($id,$guest,$check_in,$check_out){
        $queryRoom = "SELECT  DISTINCT p.name AS rImg ,rooms.id as rId,rooms.guest_limit as guest, beds.name as bed,rooms.sqm as spm,rooms.dePrice as price,rooms.count as rCount, rooms.name AS rName FROM rooms
        inner join hotel_images AS p ON p.id =
        ( SELECT id FROM hotel_images AS p2 WHERE p2.room_id = rooms.id ORDER BY p2.name DESC LIMIT 1)
        INNER JOIN hotel ON hotel.id = rooms.hotel_id
        INNER JOIN beds ON rooms.bed_id = beds.id
        WHERE hotel.id =".$id." AND rooms.guest_limit >= ".$guest."";
        $stmtRoom = $this->conn->query($queryRoom);
        $resultRoom = $stmtRoom->fetchAll();
        $mangBu = array();
        foreach($resultRoom as $show){
            $queryRoomChild = "SELECT rooms.name as rName,room_child.id as id,rooms.id as rid, room_child.name as rcName,rooms.sqm as spm,room_rate.rate as rate, rooms.dePrice as price
            FROM rooms
            INNER JOIN beds ON rooms.bed_id = beds.id
            INNER JOIN room_child ON room_child.room_parent = rooms.id
            left join room_rate on room_rate.room_child_id = room_child.id and now() between room_rate.date_from and room_rate.date_to and room_rate.status_id = 1      
            WHERE rooms.id = ".$show['rId']." 
            ";
          $stmtRoomChild = $this->conn->prepare($queryRoomChild);
          $stmtRoomChild->execute();
          $resultRoomChild = $stmtRoomChild->fetchAll(PDO::FETCH_ASSOC);
          $mangCap2=[];
          foreach($resultRoomChild as $row){
            $queryPolicy = "SELECT policy.id as id,policy.name as name
            FROM policy
            INNER JOIN room_policy ON policy.id = room_policy.policy_id
            INNER JOIN room_child ON room_child.id = room_policy.room_child_id
            WHERE room_child.room_parent = ".$show['rId']." AND room_child.id = ".$row['id']." AND room_child.status_id = 1 ";
                $stmtPolicy = $this->conn->prepare($queryPolicy);
                $stmtPolicy->execute();
                $resultPolicy = $stmtPolicy->fetchAll(PDO::FETCH_ASSOC);
                $mangCap3 = [];
                foreach($resultPolicy as $push){
                  array_push($mangCap3,new Cap3($push['id'],$push['name']));
                }
            array_push($mangCap2, new Cap2($row["id"], $row["rcName"],$row['rate'],$mangCap3));
          }
          $queryHinh = "SELECT hotel_images.id as id,hotel_images.name as name FROM hotel_images 
          LEFT JOIN rooms ON rooms.id = hotel_images.room_id
          WHERE rooms.id = ".$show['rId']."";
          $stmtHinh = $this->conn->prepare($queryHinh);
          $stmtHinh->execute();
          $resultHinh = $stmtHinh->fetchAll(PDO::FETCH_ASSOC);
          $hinh=[];
          foreach($resultHinh as $m){
            array_push($hinh, new hinh($m['name']));
          }
          $queryfBathRoom = $this->getFacelistRoom(5,$show['rId']);
          $stmtBathRoom = $this->conn->prepare($queryfBathRoom);
          $stmtBathRoom->execute();
          $resultBathRoom = $stmtBathRoom->fetchAll(PDO::FETCH_ASSOC);
          $bathRoom = [];
          foreach($resultBathRoom as $showBathRoom){
            array_push($bathRoom, new getFacelistBathRoom($showBathRoom['fname']));
          }   
          $queryfRoom = $this->getFacelistRoom(4,$show['rId']);
          $stmtfRoom = $this->conn->prepare($queryfRoom);
          $stmtfRoom->execute();
          $resultfRoom = $stmtfRoom->fetchAll(PDO::FETCH_ASSOC);
          $fRoom = [];
          foreach($resultfRoom as $showfRoom){
            array_push($fRoom, new getFacelistRoom($showfRoom['fname']));
          }
          $test = "SELECT sum(booking.room_total) as roomBooked FROM booking
          INNER JOIN room_child ON room_child.id = booking.room_child_id
          INNER JOIN rooms ON rooms.id = room_child.room_parent
          WHERE rooms.id = ".$row['rid']." AND (booking.check_in BETWEEN '".$check_in."' AND '".$check_out."') AND (booking.check_out BETWEEN '".$check_in."' AND '".$check_out."')
          AND (booking.status_id = 1 OR booking.status_id = 2 OR booking.status_id = 3) AND room_child.status_id = 1 
          ";
          $stmtfRoom = $this->conn->prepare($test);
          $stmtfRoom->execute();
          $resultfRoom = $stmtfRoom->fetchAll(PDO::FETCH_ASSOC);
          $count = "";
          $rId = "";
          foreach($resultfRoom as $rCount){
            $roomnoBooked = $show['rCount'] - $rCount['roomBooked'];
            if($rCount['roomBooked']==0){
              $rId = $show['rId'];
              $count = $show['rCount'];
            }elseif($show['rCount'] - $rCount['roomBooked']==0){
              $count = "";
            }elseif($_SESSION['roomCount']>$roomnoBooked){
              $count = "";
            }
            else{
              $rId = $show['rId'];
              $count = $show['rCount'] - $rCount['roomBooked'];
            }
            $cap1 = new Cap1(
              $rId,
              $show["rName"],
              $show["spm"],
              $count,
              $show['rImg'],
              $show["price"],
              $mangCap2,
              $hinh,
              $bathRoom,
              $fRoom,
              $show['bed'],
              $show['guest']
        
          );
          }
        array_push($mangBu,$cap1);
        }
        $a =  json_encode($mangBu);
        // echo $a;
        $json = json_decode($a,true);
        return $json;
      }
      public function checkUserIsComment($idUser,$idHotel){
        $query = $this->checkUserIsbooking($idUser,$idHotel);
        $stmt = $this->conn->query($query);
        $row = $stmt->rowCount();
        return $row;
      }
      public function checkUserisLike($idUser,$idHotel){
        $query = $this->checkUserLike($idUser,$idHotel);
        $stmt = $this->conn->query($query);
        $row = $stmt->rowCount();
        return $row;
      }
      public function showComment($id,$limit){
        $showComment = "";
        $user_account = "";
        if(isset($_SESSION['isLogin'])){
        $getUser = $this->getUserByid($_SESSION['isLogin']);
        $result = $this->queryOne($getUser);
        $user_account = $result['id'];
        }
        $query = "SELECT hotel_review.id as id,user_account.fullname as name,user_account.avatar_img as avatar,hotel_review.id as id, hotel_review.rating as rating,hotel_review.content as content
        FROM hotel_review 
        INNER JOIN hotel ON hotel_review.hotel_id = hotel.id
        INNER JOIN user_account ON user_account.id = hotel_review.user_account_id
        WHERE hotel.id = $id ORDER BY rating DESC Limit $limit";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $row){
          if($row['avatar']==null){
            $avatar = '<img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt="'.$row['name'].'" class="w-full rounded-full border">';
            ;
          }else{
            $img = "<img src = './public/images/".$row['avatar']."' alt='".$row['name']."'>";
            $avatar = $img;
          }
          $rating =  helpers::showStar($row['rating']);
          $getCountLike = "SELECT COUNT(reaction.id) as countLike FROM reaction WHERE reaction.react=1 AND reaction.review_hotel_id = ".$row['id']."";
          $result = $this->queryOne($getCountLike);
          $checkIsLike = $this->checkUserisLike($user_account,$row['id']);
          $iconIsLike="";
          if($checkIsLike>0){
           $iconIsLike = '<i class="fa fa-heart text-red-500 text-xl mr-2 cursor-pointer dislike_button" data-content_id="'.$row['id'].'"></i>';
          }else{
            $iconIsLike = '<i class="fa fa-heart-o text-red-500 text-xl mr-2 cursor-pointer like_button" data-content_id="'.$row['id'].'"></i>';
          }
          if($row['content']!=""){
          $showComment = showComent($avatar,$row['name'],$rating,$row['content'],$iconIsLike,$result['countLike']);
        }
      }
      }
      public function userComment($idHotel,$comment_content,$userRating){
        $query = "UPDATE `hotel_review` SET `status_id`=1,`content`='".$comment_content."' WHERE hotel_review.id=$userRating";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
          return true;
        }else{
          return false;
        };
      }
      public function userRating($id,$index){
        $user_account = "";
        if(isset($_SESSION['isLogin'])){
        $getUser = $this->getUserByid($_SESSION['isLogin']);
        $result = $this->queryOne($getUser);
        $user_account = $result['id'];
        }
        $query = "INSERT INTO `hotel_review`(`user_account_id`, `hotel_id`, `rating`) 
        VALUES ($user_account,$id,'$index')";
        $stmt = $this->conn->prepare($query);
        $madh="";
        if($stmt->execute()){
          $madh = $this->conn->lastInsertId();
        }
        return $madh;
      }
      public function userLike($content_id,$idHotel){
        $user_account = "";
        if(isset($_SESSION['isLogin'])){
        $getUser = $this->getUserByid($_SESSION['isLogin']);
        $result = $this->queryOne($getUser);
        $user_account = $result['id'];
        }
        $query = "INSERT INTO `reaction`(`user_account_id`, `review_hotel_id`, `react`) 
        VALUES ($user_account,$content_id,1)";
         $stmt = $this->conn->prepare($query);
         if($stmt->execute())
         {
          echo 'done';
         }
      }
      public function userDisLike($content_id,$idHotel){
        $user_account = "";
        if(isset($_SESSION['isLogin'])){
        $getUser = $this->getUserByid($_SESSION['isLogin']);
        $result = $this->queryOne($getUser);
        $user_account = $result['id'];
        }
        $query = "DELETE FROM `reaction` WHERE reaction.user_account_id= ".$user_account." AND reaction.review_hotel_id= ".$content_id."";
         $stmt = $this->conn->prepare($query);
         if($stmt->execute())
         {
          echo 'done';
         }
      }
      public function loadReview($idHotel){
        $query = "SELECT COUNT(hotel_review.id) as countReview FROM hotel_review WHERE hotel_review.hotel_id = $idHotel";
        $result = $this->queryOne($query);
        return $result;
      }
      public function loadRatingByNummber($id,$number){
        $query = "SELECT COUNT(id) as totalRatingNumber FROM hotel_review WHERE hotel_review.hotel_id=$id AND hotel_review.rating = $number";
        $result = $this->queryOne($query);
        return $result;
      }
}
class Cap1{
    public $id;
    public $rName;
    public $spm;
    public $img;
    public $rChild;
    public $rCount;
    public $rImg;
    public $fBathRoom;
    public $fRoom;
    public $bed;
    public $guest;
    function __construct($Id, $Name,$spm,$rCount,$img,$price, $Mang,$hinh,$fBathRoom,$fRoom,$bed,$guest){
        $this->id = $Id;
        $this->rName = $Name;
        $this->spm = $spm;
        $this->price = $price;
        $this->rCount = $rCount;
        $this->img = $img;
        $this->rChild = $Mang;
        $this->rImg = $hinh;
        $this->fBathRoom = $fBathRoom;
        $this->fRoom = $fRoom;
        $this->bed = $bed;
        $this->guest = $guest;
  
    }
  }
  class Cap2{
    public $id;
    public $rcName;
    public $rate;
    public $rcPolicy;
    function __construct($Id, $Name,$price,$mang){
        $this->id = $Id;
        $this->rcName = $Name;
        $this->rate = $price;
        $this->rcPolicy = $mang;
    }
  }
  class Cap3{
    public $rpName;
    public $rpId;
    function __construct($rpId,$Name){
      $this->rpId = $rpId;
      $this->rpName = $Name;
    }
  }
  class hinh{
    public $images;
    function __construct($Name){
        $this->images = $Name;
    }
  }
  class getFacelistRoom{
    public $fRoom;
    function __construct($Name){
      $this->fRoom = $Name;
    }
  }
  class getFacelistBathRoom{
    public $fBathRoom;
    function __construct($Name){
      $this->fBathRoom = $Name;
    }
  }
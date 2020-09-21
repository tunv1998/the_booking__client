<?php 
class DB{
    protected $server = "localhost";
    protected $username = "root";
    protected $password = "";
    protected $dbName = "projectone";
    public $conn;
   public function __construct()
   {
       try{
           $this->conn = new PDO("mysql:host=$this->server;dbname=$this->dbName",$this->username,$this->password);
           $this->conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
       }
       catch(PDOException $e){
           echo "Error: ". $e->getMessage();
       }
       return $this->conn;
   }
   public function QueryAll($sql){
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
  }
  public function queryOne($sql){
    $stmt = $this->conn->query($sql);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    $stmt = null;
    return $result;
}
    public function querySearch($searchteam){
        $query = "SELECT province.id ,province._name FROM province 
        INNER JOIN district ON province.id = district._province_id
        INNER JOIN hotel ON hotel.city_id = province.id
        WHERE 
        MATCH (province._name) AGAINST ('$searchteam' IN BOOLEAN MODE)
        AND district.id IN (hotel.district_id)
        AND province.id IN (hotel.city_id)
        UNION
        SELECT district.id ,district._name FROM district 
        INNER JOIN hotel ON hotel.district_id = district.id
        INNER JOIN province ON province.id = district._province_id
        WHERE 
        MATCH (district._name) AGAINST ('$searchteam' IN BOOLEAN MODE)
        AND district.id IN (hotel.district_id)
        AND province.id IN (hotel.city_id)
        UNION
        SELECT hotel.id ,hotel.name FROM hotel 
        INNER JOIN district ON hotel.district_id = district.id
        INNER JOIN province ON hotel.city_id = province.id
        WHERE 
        MATCH (hotel.name) AGAINST ('$searchteam' IN BOOLEAN MODE)
        AND district.id IN (hotel.district_id)
        AND province.id IN (hotel.city_id)";
        return $query;
    }
    public function queryCheck($sql,$where){
        $query = "SELECT DISTINCT hotel.id as hId, hotel.name as hName, hotel.stars as hStar, hotel.address_line as hAddress,hotel.hotel_avatar AS avatar,hotel.hotel_map as map,province.id as pId,
        province._name as pName,hotel.description as descript, CONCAT(district._prefix,' ',district._name) as dName, a.guest_limit as guest,
        CONCAT(ward._prefix,' ',ward._name) as wName, p.name as img, room_rate.rate as rate, a.dePrice as pri,(SELECT AVG(hotel_review.rating) AS rated FROM hotel_review WHERE hotel_review.hotel_id = hotel.id) AS review
        FROM hotel  
        inner join province on province.id = hotel.city_id 
        inner join district on district.id = hotel.district_id 
        inner join ward on ward.id = hotel.wards_id 
        inner join hotel_images AS p ON p.id = 
        ( SELECT id FROM hotel_images AS p2 WHERE p2.hotel_id = hotel.id ORDER BY p2.name DESC LIMIT 1)
        inner join rooms AS a ON a.id = 
        ( SELECT id FROM rooms AS a2 WHERE a2.hotel_id = hotel.id ORDER BY (SELECT room_rate.rate FROM room_rate ORDER BY room_rate.rate DESC LIMIT 1) DESC LIMIT 1)
        INNER JOIN room_child ON a.id = room_child.room_parent 
        left join room_rate on room_rate.room_child_id = (SELECT room_child.id from room_child where room_child.room_parent = a.id ORDER BY room_rate.rate DESC limit 1) and now() between room_rate.date_from and room_rate.date_to and room_rate.status_id = 1
        LEFT JOIN hotel_review ON (SELECT DISTINCT hotel_review.hotel_id FROM hotel_review WHERE hotel_review.hotel_id = hotel.id) = hotel.id
        ".$sql." ".$where."";
        return $query;
    }
    public function getFacelistRoom($fid,$rid){
        $queryfRoom = "SELECT hotel_facilities.name as fname FROM hotel_facilities
        INNER JOIN hotel_facilities_detail ON hotel_facilities_detail.hotel_facilities_id = hotel_facilities.id
        INNER JOIN rooms ON rooms.id = hotel_facilities_detail.room_id
        INNER JOIN facilities_list ON facilities_list.id = hotel_facilities.facilities_list_id
        WHERE facilities_list.id = ".$fid." AND rooms.id = ".$rid."";
        return $queryfRoom;
      }
    public function checkUserIsbooking($idUser,$idHotel){
        $sql = "SELECT hotel.id FROM user_account 
        INNER JOIN booking ON user_account.id = booking.user_account_id
        INNER JOIN room_child ON room_child.id = booking.room_child_id
        INNER JOIN rooms ON rooms.id = room_child.room_parent
        INNER JOIN hotel ON rooms.hotel_id = hotel.id 
        WHERE user_account.id=".$idUser." AND hotel.id=".$idHotel." AND (booking.status_id=3 OR booking.status_id=5)";
        return $sql;
    }
    public function checkUserLike($userId,$IdComment){
        $query = "SELECT * FROM reaction 
        WHERE reaction.react=1 AND reaction.user_account_id IN ('$userId') AND reaction.review_hotel_id=$IdComment";
        return $query;
    }
    public function getRchildByid($id){
        $sql = "SELECT hotel.name as hName,hotel.address_line as hAddress,room_child.name as rcName,rooms.count as rCount,
        province._name as pName, CONCAT(district._prefix,' ',district._name) as dName, rooms.guest_limit as guest,rooms.id as rId,
        CONCAT(ward._prefix,' ',ward._name) as wName,rooms.dePrice as rPrice,room_rate.rate as rtPrice,beds.name as bName FROM rooms 
        INNER JOIN room_child ON room_child.room_parent = rooms.id
        INNER JOIN hotel on rooms.hotel_id = hotel.id
        inner join province on province.id = hotel.city_id 
        inner join district on district.id = hotel.district_id 
        inner join ward on ward.id = hotel.wards_id 
        INNER JOIN beds ON rooms.bed_id = beds.id
        left join room_rate on room_rate.room_child_id = (SELECT room_child.id from room_child where room_child.id = ".$id.") and now() between room_rate.date_from and room_rate.date_to and room_rate.status_id = 1
        WHERE room_child.id=".$id."";
        return $sql;
    }
    public function getUserByid($idUser){
        $sql="SELECT * FROM `user_account` WHERE user_account.username in ('".$idUser."')";
        return $sql;
    }
    // public function Event(){
    //     DELIMITER $$
    //     CREATE EVENT IF NOT EXISTS e_5m_changeHotelStatus ON SCHEDULE EVERY 30 SECOND
    //     DO 
    //     BEGIN
    //     DECLARE i INT DEFAULT 0;
    //     DECLARE a INT DEFAULT 0;
    //     DECLARE expired INT;
    //     WHILE (i = 0) DO
    //         SET expired = (SELECT id FROM booking where status_id = 2 and ADDTIME(create_date,"00:30:00") limit 1);
    //         IF  ISNULL(expired) = 0 THEN 
    //         UPDATE booking SET status_id = 4 where id = expired;
    //         ELSE 
    //         SET i = 1;
    //         END IF;
    //     END WHILE;
    //     END;$$
    //     DELIMITER ;
    // }
}
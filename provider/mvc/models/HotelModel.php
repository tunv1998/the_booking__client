<?php

class HotelModel extends DB
{
    // Model xử lý khách sạn
    public function ListHotel($username)
    {
        $sql = "SELECT hotel.id as hotel_id, hotel.name as hotel_name, hotel.phone_number as h_phone, hotel.email as h_email, hotel.website as h_website ,hotel.stars as hotel_star, hotel.status_id as hotel_status, general_status.name as status_name, hotel.address_line as hotel_address, hotel.hotel_avatar as hotel_avatar, province._name as city_name, CONCAT(district._prefix,' ',district._name) as district_name, CONCAT(ward._prefix,' ',ward._name) as ward_name, manager_account.id as m_id, manager_account.username as m_username FROM hotel
        inner join general_status on general_status.id = hotel.status_id
        inner join province on province.id = hotel.city_id
        inner join district on district.id = hotel.district_id
        inner join ward on ward.id = hotel.wards_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '" . $username . "' and hotel.status_id = 1
        ";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function GetOneHotel($username, $hotelId)
    {
        $sql = "SELECT hotel.id as hotel_id, hotel.name as hotel_name, hotel.phone_number as hotel_phone, hotel.email as hotel_email, hotel.website as hotel_website, hotel.description as hotel_des ,hotel.stars as hotel_star, hotel.status_id as hotel_status, general_status.name as status_name, hotel.address_line as hotel_address, hotel.hotel_avatar as hotel_avatar, province.id as city_id, district.id as district_id, ward.id as ward_id, province._name as city_name, CONCAT(district._prefix,' ',district._name) as district_name, CONCAT(ward._prefix,' ',ward._name) as ward_name, manager_account.id as m_id, manager_account.username as m_username FROM hotel
        inner join general_status on general_status.id = hotel.status_id
        inner join province on province.id = hotel.city_id
        inner join district on district.id = hotel.district_id
        inner join ward on ward.id = hotel.wards_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '" . $username . "' and hotel.status_id = 1 and hotel.id = $hotelId";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function UpdateHotelInfor($arr = [])
    {
        $sql = "UPDATE hotel
        inner join manager_account on manager_account.id = hotel.manager_id
        SET hotel.name = '" . $arr[0] . "', hotel.phone_number = '" . $arr[1] . "', hotel.email = '" . $arr[2] . "', hotel.website = '" . $arr[3] . "',hotel.description = '" . $arr[4] . "', hotel.address_line = '" . $arr[5] . "',
        hotel.wards_id = " . $arr[6] . ", hotel.district_id = " . $arr[7] . ", hotel.city_id = " . $arr['8'] . ", hotel.stars = " . $arr['9'] . "
        where manager_account.username = '" . $arr['10'] . "' and hotel.id = " . $arr['11'] . "";
        return $this->update($sql);
    }
    public function changeHotelStatus($id, $username)
    {
        $sql = "UPDATE hotel
        inner join manager_account on manager_account.id = hotel.manager_id
        set hotel.status_id = 4
        where manager_account.username = '" . $username . "' and hotel.id = $id 
        ";
        return  $this->update($sql);
    }
    // Tạo mới khách sạn
    public function createNewHotel($arr)
    {
        $sql = "INSERT INTO  hotel(name,city_id,district_id,wards_id,address_line,phone_number,email,website,stars,description,manager_id,hotel_avatar)
        VALUES('" . $arr[0] . "',$arr[1],$arr[2],$arr[3],'" . $arr[4] . "','" . $arr[5] . "','" . $arr[6] . "','" . $arr[7] . "'," . $arr[8] . ",'" . $arr[9] . "',(select id from manager_account where username = '" . $arr[11] . "'), '" . $arr[10] . "')";
        return $this->insert($sql);
    }
    public function isAllowCreateHotel($username){
        $sql = "select if(count(hotel.id) >= package.hotel_quantity,0,1) as result from hotel
        inner join package_history_buy on package_history_buy.manager_account_id = hotel.manager_id and package_history_buy.status_id = 1
        inner join package on package.id = package_history_buy.package_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '".$username."' and hotel.status_id = 1 group by(hotel.manager_id)";
        $result = $this->queryOne($sql);
        if($result['result']== 0){
            return false;
        }
        else{
            return true;
        }
    }
    public function isAllowCreateRoom($hotelId, $username){
        $sql = "select if(count(rooms.id) >= package.room_quantity,0,1) as result from rooms
        inner join hotel on hotel.id = rooms.hotel_id
        inner join package_history_buy on package_history_buy.manager_account_id = hotel.manager_id and package_history_buy.status_id = 1
        inner join package on package.id = package_history_buy.package_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '".$username."' and hotel.status_id = 1 and hotel.id = $hotelId group by(hotel.manager_id)";
        $result = $this->queryOne($sql);
        if($result['result']== 0){
            return false;
        }
        else{
            return true;
        }
    }
    // Lấy ảnh của toàn bộ một khách sạn
    public function getAllImageByHotelId($id, $username)
    {
        $sql = "SELECT hotel_images.id as hi_id, hotel_images.name as hi_name FROM hotel_images
        inner join hotel on hotel.id = hotel_images.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '" . $username . "' and hotel.status_id = 1 and hotel_images.status_id = 1 and hotel_images.hotel_id = $id and isNUll(room_id)";
        $result =  $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function delHotelImage($arr, $username)
    {
        $sql = "";
        foreach ($arr as $key => $value) {
            if (!empty($value)) {
                $sql .= "UPDATE hotel_images
            inner join hotel on hotel.id = hotel_images.hotel_id
            inner join manager_account on manager_account.id = hotel.manager_id
            SET hotel_images.status_id = 4
            where manager_account.username = '" . $username . "' and hotel.status_id = 1 and hotel_images.id = $key;";
            }
        }
        return  $this->update($sql);
    }
    public function addNewImage($type, $hId, $arr, $rId)
    {
        $sql = "";
        if ($type == 1) {
            foreach ($arr as $key => $value) {
                $sql .= "INSERT INTO hotel_images(hotel_id,name) VALUE($hId,'" . $value . "');";
            }
        } elseif ($type == 2) {
            foreach ($arr as $key => $value) {
                $sql .= "INSERT INTO hotel_images(hotel_id,name,room_id) VALUE($hId,'" . $value . "',$rId);";
            }
        } else {
        }
        return $this->insert($sql);
    }
    public function countRatingMonth($id, $username, $year)
    {
        $filYear = "";
        if (is_numeric($year)) {
            $filYear = "and year(hotel_review.create_date) = $year";
        }
        $sql = "select count(hotel_review.id) as count, month(hotel_review.create_date) as create_date from hotel_review
        inner join hotel on hotel.id = hotel_review.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where hotel_review.hotel_id = $id and manager_account.username = '" . $username . "' $filYear group by(create_date)";
        $result =  $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function getRatingDetail($hotelId)
    {
        $sql = "SELECT user_account.fullname as name, user_account.username as username, hotel_review.content as content, hotel_review.rating as rating, hotel_review.create_date as create_date FROM hotel_review
        inner join user_account on user_account.id = hotel_review.user_account_id
        where hotel_review.hotel_id = $hotelId";
        $result =  $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function getAvgRating($hotelId)
    {
        $sql = "SELECT avg(rating) as rating FROM hotel_review
        where hotel_id = $hotelId";
        $result =  $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function getAvgRatingByProvider($username){
        $sql = "SELECT avg(rating) as rating, hotel.id as h_id, hotel.name as h_name FROM hotel_review
        inner join hotel on hotel.id = hotel_review.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '".$username."' group by(hotel.id)";
        $result =  $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // End Model quản lý khách sạn
    // Bắt đầu Model quản lý phòng
    public function GetListRoom($id, $username)
    {
        $sql = "SELECT rooms.id as r_id, rooms.name as r_name, rooms.count as r_count, rooms.guest_limit as r_guestLimit, rooms.sqm as r_sqm, rooms.dePrice as r_dePrice, general_status.name as status_name, rooms.bed_id as r_bedId, beds.name as b_name, rooms.hotel_id as r_hotelId FROM rooms
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        inner join general_status on general_status.id = rooms.status_id
        inner join beds on beds.id = rooms.bed_id
        where rooms.hotel_id = $id and manager_account.username = '" . $username . "' and rooms.status_id = 1";
        $result =  $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function GetOneRoom($roomId, $username)
    {
        $sql = "SELECT rooms.id as r_id, rooms.name as r_name, rooms.count as r_count ,rooms.guest_limit as r_guestLimit, rooms.sqm as r_sqm, rooms.bed_id as r_bedId, beds.name as b_name ,rooms.dePrice as r_dePrice FROM rooms
        inner join hotel on hotel.id = rooms.hotel_id
        inner join beds on beds.id = rooms.bed_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '" . $username . "' and rooms.id = $roomId  and rooms.status_id = 1
        ";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // Lấy tất cả ảnh trong một phòng
    public function getRoomImage($id, $username)
    {
        $sql = "SELECT hotel_images.room_id as hi_roomId, hotel_images.name as hi_name,hotel_images.id as hi_id FROM hotel_images
        inner join hotel on hotel.id = hotel_images.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '" . $username . "' and hotel_images.status_id = 1 and hotel_images.room_id = $id";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function getIdRoomByHotelId($username, $hotelId)
    {
        $sql = "SELECT rooms.id, rooms.name as r_name FROM rooms 
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where rooms.hotel_id = $hotelId and manager_account.username = '" . $username . "'";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function getAllRoomInforByHotelId($username, $hotelId)
    {
        $sql = "SELECT rooms.id as r_id, rooms.name as r_name, rooms.count as r_count ,rooms.guest_limit as r_guestLimit, rooms.sqm as r_sqm, rooms.bed_id as r_bedId, beds.name as b_name ,rooms.dePrice as r_dePrice FROM rooms
        inner join hotel on hotel.id = rooms.hotel_id
        inner join beds on beds.id = rooms.bed_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '" . $username . "' and hotel.id = $hotelId and rooms.status_id = 1";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // facilities
    public function getFacilitiesByHotelId($username, $hotelId, $type)
    {
        $sql = "SELECT hotel_facilities.name as hf_name, hotel_facilities_detail.room_id as hfd_roomId FROM hotel_facilities_detail
        inner join hotel on hotel.id = hotel_facilities_detail.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        inner join hotel_facilities on hotel_facilities.id = hotel_facilities_detail.hotel_facilities_id
        inner join facilities_list on facilities_list.id = hotel_facilities.facilities_list_id
        where hotel.id = $hotelId and facilities_list.id = $type and hotel_facilities.status_id = 1 and manager_account.username = '" . $username . "' order by hotel_facilities_detail.room_id asc";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function getAllHotelFacilities($cond = "")
    {
        $sql = "SELECT hotel_facilities.id as hf_id, hotel_facilities.name as hf_name FROM hotel_facilities
        inner join facilities_list on facilities_list.id = hotel_facilities.facilities_list_id
        where facilities_list.id != 4 and facilities_list.id != 5 and hotel_facilities.status_id = 1 $cond";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // count room by provider
    public function countRoomByProvider($username){
        $sql = "select count(rooms.id) as count from rooms
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '".$username."'";
        $result = $this->queryOne($sql);
        return $result ? $result : $result = [];
    }
    public function getAllRoomFacilities($cond = "")
    {
        $sql = "SELECT hotel_facilities.id as hf_id, hotel_facilities.name as hf_name FROM hotel_facilities
        inner join facilities_list on facilities_list.id = hotel_facilities.facilities_list_id
        where facilities_list.id = 4 or  facilities_list.id = 5 and hotel_facilities.status_id = 1 $cond";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function getFacilitiesIdByHotel($username, $hotelId, $cond = "")
    {
        if (empty($cond)) {
            $room = "and isnull(hotel_facilities_detail.room_id)";
        } else {
            $room = "and hotel_facilities_detail.room_id = $cond";
        }
        $sql = "SELECT hotel_facilities_detail.id as hfd_id, hotel_facilities_detail.hotel_facilities_id as f_id FROM hotel_facilities_detail
        inner join hotel_facilities on hotel_facilities.id = hotel_facilities_detail.hotel_facilities_id
        inner join facilities_list on facilities_list.id = hotel_facilities.facilities_list_id
        inner join hotel on hotel.id = hotel_facilities_detail.hotel_id 
        inner join manager_account on manager_account.id = hotel.manager_id
        where hotel_facilities_detail.hotel_id = $hotelId and manager_account.username = '" . $username . "' $room  and hotel_facilities_detail.status_id = 1";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // 
    public function changeHotelFacilities($username, $id, $update, $insert, $cond = "")
    {
        $updateQuery = "";
        $insertQuery = "";
        empty($cond) ? $room = 'null' : $room = $cond;
        if (count($update) > 0) {
            for ($i = 0; $i < count($update); $i++) {
                $updateQuery .= "update hotel_facilities_detail
                inner join hotel on hotel.id = hotel_facilities_detail.hotel_id
                inner join manager_account on manager_account.id = hotel.manager_id
                set hotel_facilities_detail.status_id = 4
                where hotel_facilities_detail.id = $update[$i] and hotel.id = $id and manager_account.username = '" . $username . "';";
            }
            $this->update($updateQuery);
        }
        if (count($insert) > 0) {
            for ($i = 0; $i < count($insert); $i++) {
                $insertQuery .= "insert into hotel_facilities_detail(hotel_id,hotel_facilities_id,room_id)
                value($id,$insert[$i],$room);";
            }
            $this->insert($insertQuery);
        }
        return true;
    }
    // 
    public function getAllRoomImageByHotelId($username, $hotelId)
    {
        $sql = "SELECT hotel_images.room_id as hi_roomId, hotel_images.name as hi_name FROM hotel_images
        inner join hotel on hotel.id = hotel_images.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '" . $username . "' and hotel.id = $hotelId and hotel_images.status_id = 1 order by hotel_images.room_id asc";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function getOneRoomImageByHotelId($username, $hotelId)
    {
        $sql = "SELECT hotel_images.room_id as hi_roomId, hotel_images.name as hi_name FROM hotel_images
        inner join hotel on hotel.id = hotel_images.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '" . $username . "' and hotel.id = $hotelId and hotel_images.status_id = 1 group by (hotel_images.room_id) order by hotel_images.room_id asc";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function UpdateRoomInfor($arr)
    {
        $sql = "UPDATE rooms SET name = '" . $arr[0] . "', count = '" . $arr[1] . "', guest_limit = '" . $arr[2] . "', sqm = '" . $arr[3] . "', bed_id = $arr[4], dePrice = $arr[5]
        where id = $arr[6]";
        return $this->update($sql);
    }
    public function createRoomType($arr)
    {
        $checkIsHotel = "select hotel.id from hotel 
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '" . $arr[7] . "' and hotel.id = $arr[6]";
        $stmt = $this->conn->query($checkIsHotel);
        $countResult = $stmt->rowcount();
        if ($countResult == 0) {
            return false;
        } else {
            $sql = "INSERT INTO rooms(name,count,guest_limit,sqm,dePrice,bed_id,hotel_id) 
            VALUES('" . $arr[0] . "',$arr[1],$arr[2],$arr[3],$arr[4],$arr[5],$arr[6])";
            return $this->insert($sql);
        }
    }
    public function changeRoomStatus($id, $username)
    {
        $sql = "UPDATE rooms
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        set rooms.status_id = 4
        where rooms.id = $id and manager_account.username = '" . $username . "'";
        return  $this->update($sql);
    }
    public function changeRoomChildStatus($id, $username)
    {
        $sql = "UPDATE room_child
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        set room_child.status_id = 4
        where room_child.id = $id and manager_account.username = '" . $username . "'";
        return  $this->update($sql);
    }
    public function getRoomChildInforByRoomTypeId($username, $id)
    {
        $sql = "SELECT room_child.id as rc_id, room_child.name as rc_name, room_child.room_parent as rc_roomParentId, room_rate.rate as rr_rate FROM room_child
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        left join room_rate on room_rate.room_child_id = room_child.id and now() between room_rate.date_from and room_rate.date_to and room_rate.status_id = 1
        where room_child.room_parent = $id and manager_account.username = '" . $username . "' and room_child.status_id = 1";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function getPolicyRoomChildByRoomParentId($username, $id)
    {
        $sql = "SELECT rooms.id as r_id, room_child.id as rc_id, policy.name as p_name FROM room_policy
        inner join room_child on room_child.id = room_policy.room_child_id
        inner join policy on policy.id = room_policy.policy_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where room_child.room_parent = $id and manager_account.username = '" . $username . "' and room_child.status_id = 1";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // Tạo room_child
    public function createRoomChild($name, $policy, $price, $username, $parentId)
    {
        $checkUsername = "SELECT rooms.id FROM rooms
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where rooms.id = $parentId and manager_account.username = '" . $username . "'";
        $stmt = $this->conn->query($checkUsername);
        $count = $stmt->rowCount();
        if ($count == 0) {
            return false;
        } else {
            $sql = "";
            $policySql = "INSERT INTO room_policy(room_child_id,policy_id) VALUES ";
            $priceSql = "INSERT INTO room_rate(rate,date_from,date_to,room_child_id) VALUES";
            $addRoomChild = "INSERT INTO room_child(name,room_parent) VALUES('" . $name . "',$parentId)";
            if ($this->conn->query($addRoomChild)) {
                $lastId = $this->conn->lastInsertId();
            } else {
                return false;
            }
            foreach ($policy as $key => $value) {
                $policySql .= "($lastId,$value),";
            }
            foreach ($price as $key => $value) {
                $priceSql .= "(" . $value[2] . ",'" . $value[0] . "','" . $value[1] . "',$lastId),";
            }
            if (strrpos($priceSql, ",") == strlen($priceSql) - 1) {
                $priceSql =  substr($priceSql, 0, strlen($priceSql) - 1);
            }
            if (strrpos($policySql, ",") == strlen($policySql) - 1) {
                $policySql =  substr($policySql, 0, strlen($policySql) - 1);
            }
            $sql = $policySql . ";" . $priceSql;
            return $this->insert($sql);
        }
    }
    // Sửa room_child
    public function roomChildEdit($arr)
    {
        foreach ($arr as $key => $value) {
            if (!empty($value)) {
                $this->conn->exec($value);
            }
        }
        return true;
    }
    // Lấy thông tin 1 romm_child theo username,id room child
    public function getOneRoomChild($username, $id)
    {
        $sql = "select room_child.id as rc_id, room_child.name as rc_name, room_child.room_parent as rc_roomParent from room_child
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where room_child.id = $id and manager_account.username = '" . $username . "'";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function getPolicyOneRoom($username, $id)
    {
        $sql = "SELECT room_policy.id as rp_id, room_policy.room_child_id as rp_roomChildId, room_policy.policy_id as rp_policyId, policy.group_id as p_group,policy.name as p_name FROM room_policy
        inner join policy on policy.id = room_policy.policy_id
        inner join room_child on room_child.id = room_policy.room_child_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where room_policy.room_child_id = $id and manager_account.username = '" . $username . "'";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function getRoomRateByRoomChildId($username, $id)
    {
        $sql = "select room_rate.id as rr_id, room_rate.rate as rr_rate, room_rate.date_from as rr_dateFrom, room_rate.date_to as rr_dateTo from room_rate
        inner join room_child on room_child.id = room_rate.room_child_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where room_child.id = $id and manager_account.username = '" . $username . "' and room_rate.status_id != 4";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // 
    public function deleteRateOneRoomChild($username, $id)
    {
        $sql = "UPDATE room_rate 
        inner join room_child on room_child.id = room_rate.room_child_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        SET room_rate.status_id = 4 
        where room_rate.id = $id and manager_account.username = '" . $username . "'";
        return $this->update($sql);
    }
    // 
    public function delRoomImage($arr, $username)
    {
        $sql = "";
        foreach ($arr as $key => $value) {
            if (!empty($value)) {
                $sql .= "UPDATE hotel_images
            inner join hotel on hotel.id = hotel_images.hotel_id
            inner join manager_account on manager_account.id = hotel.manager_id
            SET hotel_images.status_id = 4
            where manager_account.username = '" . $username . "' and hotel.status_id = 1 and hotel_images.id = $key;";
            }
        }
        return  $this->update($sql);
    }
    public function getAllRoomChild($username,$hotelId){
        $sql = "select room_child.id as rc_id, room_child.name as rc_name, room_child.room_parent as rc_parent from room_child
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where hotel.id = $hotelId and manager_account.username = '".$username."' and room_child.status_id = 1";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result =[];
    }
    public function getRoomChildInfo($username, $hotelId){
        $sql = "select room_child.id as rc_id, room_child.name as rc_name, room_child.room_parent as rc_parent, policy.name as p_name, hotel.name as h_name ,room_rate.rate as rr_rate from room_child
        inner join rooms on rooms.id = room_child.room_parent
        inner join room_policy on room_policy.room_child_id = room_child.id
        inner join policy on policy.id = room_policy.policy_id
        left join room_rate on room_rate.room_child_id = room_child.id and curdate() between room_rate.date_from and room_rate.date_to
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where hotel.id = $hotelId and manager_account.username = '".$username."' and room_child.status_id = 1 and room_rate.status_id = 1";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result =[];
    }
    // End model quản lý phòng
    // Model khác
    // Danh sách địa chỉ
    public function GetListAddress($type)
    {
        $table = "";
        if ($type == 1) {
            $table = "ward";
        } elseif ($type == 2) {
            $table = "district";
        } elseif ($type == 3) {
            $table = "province";
        } else {
            return false;
        }
        $sql = "SELECT * FROM " . $table;
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // danh sách loại giường
    public function getListBed()
    {
        $sql = "SELECT * FROM beds";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // Danh sách chính sách
    public function getListPolicy()
    {
        $sql = "SELECT * FROM policy where status_id = 1 order by (group_id)";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // End model khác



}

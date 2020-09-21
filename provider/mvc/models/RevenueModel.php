<?php
class RevenueModel extends DB
{

    public function revenueProvider($username, $arr = [])
    {
        $filter = "";
        $month = date("M");
        $year = date("Y");
        if (count($arr) == 2) {
            if (is_numeric($arr[0]) && is_numeric($arr[1])) {
                if ($arr[0] > 0 && $arr[0] < 12) {
                    $month = $arr[0];
                    $year = $arr[1];
                    $filter = "and month(booking.create_date) = $month and year(booking.create_date) = $year";
                }
            }
        } elseif (count($arr) == 1) {
            if (is_numeric($arr[0])) {
                $year = $arr[0];
                $filter = "and year(booking.create_date) = $year";
            }
        } else {
        }

        $sql = "SELECT hotel.name as h_name, sum(booking.total_price) as tong FROM booking
        inner join room_child on room_child.id = booking.room_child_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id 
        where manager_account.username = '" . $username . "' $filter group by(hotel.id)";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function totalRevenueByYear($username, $year = "", $hotelId = "")
    {
        $hotel = "";
        if(empty($year) || !is_numeric($year)){
            $year = date("Y");
        }
        if(!empty($hotelId) && is_numeric($hotelId)){
           $hotel = "and hotel.id = $hotelId";
        }
        $sql = "SELECT month(booking.create_date) as create_date, sum(booking.total_price) as tong FROM booking
        inner join room_child on room_child.id = booking.room_child_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id 
        where manager_account.username = '".$username."' $hotel  and year(booking.create_date) = $year group by(create_date)";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // Lấy doanh thu theo 30 ngày của một khách sạn
    public function hotelRevenueMonth($username,$month,$year,$hotelId){

        $sql = "SELECT day(booking.create_date) as create_date, sum(booking.total_price) as tong FROM booking
        inner join room_child on room_child.id = booking.room_child_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id 
        where manager_account.username = '".$username."' and hotel.id = $hotelId and year(booking.create_date) = $year and month(booking.create_date) = $month group by(create_date)";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
}

<?php
class BookingModel extends DB
{
    // Đếm lượt đặt phòng theo provider
    public function countAllBooking($username)
    {
        $sql = "SELECT hotel.name as h_name, countBookingHotel(hotel.id,manager_account.username) as countNum FROM booking 
        inner join room_child on room_child.id = booking.room_child_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '" . $username . "' group by (h_name)";
        $result =  $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // Đếm lượt đặt phòng của một provider trong tháng hiện tại
    public function countAllBookingMonth($username)
    {
        $sql = "SELECT hotel.name as h_name, countBookingHotelMonth(hotel.id,manager_account.username) as countNum FROM booking 
        inner join room_child on room_child.id = booking.room_child_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where manager_account.username = '" . $username . "' group by (h_name)";
        $result =  $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // Đếm lượt đặt phòng của một khách sạn trong 12 tháng
    public function countBookingHotel($id)
    {
        $arr = [];
        for ($i = 1; $i <= 12; $i++) {
            $sql = "SELECT count(booking.id) as num FROM booking
        inner join room_child on room_child.id = booking.room_child_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id 
        where hotel.id = $id and MONTH(booking.create_date) = $i";
            $result = $this->queryMulti($sql);
            array_push($arr, $result[0]['num']);
        }
        return $arr;
    }
    // 
    public function getBooking($id, $username)
    {
        $sql = "SELECT booking.id, booking.customer_name as b_name, booking.customer_phone_number as b_phone, booking.customer_email as b_email,
        booking.total_guest as b_totalGuest, booking.room_total as b_totalRoom,
        room_child.name as rc_name, booking.total_date as b_totalDate, booking.check_in as b_checkIn, booking.check_out as b_checkOut, booking.create_date as b_created, booking_status.name as bs_name, booking.total_price as b_price FROM booking
        inner join booking_status on booking_status.id = booking.status_id
        inner join room_child on room_child.id = booking.room_child_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id
        where hotel.id = $id and manager_account.username = '" . $username . "' ";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function countRoomTypeBooked($id, $arr = [])
    {
        $filter = "";
        $month = date("M");
        $year = date("Y");
        if (count($arr) > 0) {
            if (is_numeric($arr[0]) && is_numeric($arr[1])) {
                if ($arr[0] > 0 & $arr[0] < 12) {
                    $month = $arr[0];
                    $year = $arr[1];
                    $filter = "and month(booking.create_date) = $month and year(booking.create_date) = $year";
                }
            }
        }
        $sql = "SELECT count(room_child.name) as count, room_child.name as name FROM booking
        inner join room_child on room_child.id = booking.room_child_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id 
        where hotel.id = $id $filter group by (room_child.name)";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    // Tổng lượt đặt phòng, tổng lượt khách, trung bình số ngày ở
    public function totalBookingDetail($id, $username)
    {
        $sql = "SELECT avg(total_date) as avg_stayed, sum(booking.total_guest) as total_guest, count(booking.id) as countBooked FROM booking
        inner join room_child on room_child.id = booking.room_child_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id 
        where hotel.id = $id and manager_account.username = '" . $username . "'";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function countBookingYear($year,$username){
        $sql = "
        SELECT count(booking.id) as num, month(booking.create_date) as create_date FROM booking
        inner join room_child on room_child.id = booking.room_child_id
        inner join rooms on rooms.id = room_child.room_parent
        inner join hotel on hotel.id = rooms.hotel_id
        inner join manager_account on manager_account.id = hotel.manager_id 
        where manager_account.username = '".$username."' and year(booking.create_date) = $year group by(create_date)";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
}

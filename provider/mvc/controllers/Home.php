<?php

class Home extends Controller
{
    public $RevenueModel;
    public $HotelModel;
    public $UserName;
    public $BookingModel;
    public function __construct()
    {
        if (isset($_SESSION['isProvider'])) {
            $this->UserName = $_SESSION['isProvider'];
            $this->RevenueModel = $this->model('RevenueModel');
            $this->HotelModel = $this->model('HotelModel');
            $this->BookingModel = $this->model('BookingModel');
        } else {
            header('location: ./?ctrl=user');
        }
    }
    public function
    Default()
    {
        $page = 'dashboard';
        $hotelRevenue = $this->RevenueModel->revenueProvider($this->UserName);
        $listHotel = $this->HotelModel->ListHotel($this->UserName);
        $countRoom = $this->HotelModel->countRoomByProvider($this->UserName);
        $listBooking = $this->BookingModel->countAllBooking($this->UserName);
        $allRevenue = 0;
        $allBooking = 0;
        $countHotel = count($listHotel);
        foreach ($hotelRevenue as $key => $value) {
            $allRevenue += $value['tong'];
        }
        foreach ($listBooking as $key => $value) {
            $allBooking += $value['countNum'];
        }
        $allRevenue = number_format($allRevenue, 0, '', ',');
        $view = $this->view("master-view", [
            'title' => "Trang chủ",
            'page' => $page,
            'allRevenue' => $allRevenue,
            'countBooking' => $allBooking,
            'countHotel' => $countHotel,
            'countRoom' => $countRoom['count'],
        ]);
    }
}

<?php
class Booking extends Controller
{
    public $UserName;
    public $BookingModel;
    public $hotelModel;
    public function __construct()
    {
        $this->hotelModel = $this->model('HotelModel');
        $this->BookingModel = $this->model('BookingModel');
        if (isset($_SESSION['isProvider'])) {
            $this->UserName = $_SESSION['isProvider'];
        } else {
            header('location: ./?ctrl=user');
        }
    }
    public function
    Default()
    {
        $this->bookingOverView();
    }
    public function bookingOverView()
    {
        $listHotel = $this->hotelModel->ListHotel($this->UserName);
        $page = 'statistic-overview';
        $view = $this->view("master-view", [
            'title' => 'Tổng quan đặt phòng',
            'page' => $page,
            'hotel' => $listHotel,
        ]);
    }
    public function countAllBooking()
    {
        $result = $this->BookingModel->countAllBooking($this->UserName);
        echo json_encode($result);
    }
    public function countAllBookingMonth()
    {
        $result = $this->BookingModel->countAllBookingMonth($this->UserName);
        echo json_encode($result);
    }
    public function countBookingHotel()
    {
        if (helper::checkPostExist(['id'])) {
            $id = $_POST['id'];
            $result = $this->BookingModel->countBookingHotel($id);
            foreach ($result as $key => $value) {
                if ($value == 0) {
                    $result[$key] = 0;
                }
            }
            echo json_encode($result);
        } else {
            echo -1;
        }
    }
    public function bookingDetail()
    {
        $page = 'bookingDetail';
        $listHotel = $this->hotelModel->ListHotel($this->UserName);
        $view = $this->view("master-view", [
            'title' => 'Tổng quan đặt phòng',
            'page' => $page,
            'hotel' => $listHotel
        ]);
    }
   
}

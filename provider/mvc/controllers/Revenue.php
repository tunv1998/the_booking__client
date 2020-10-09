<?php
class Revenue extends Controller
{
    public $AjaxModel;
    public $UserName;
    public $HotelModel;
    public $BookingModel;
    public $RevenueModel;
    function __construct()
    {
        if (isset($_SESSION['isProvider'])) {
            $this->UserName = $_SESSION['isProvider'];
        } else {
            header('location: ./?ctrl=user');
        }
        $this->HotelModel = $this->model('HotelModel');
        $this->BookingModel = $this->model('BookingModel');
        $this->RevenueModel = $this->model('RevenueModel');
    }
    public function
    default()
    {
        $this->overView();
    }
    public function overView()
    {
        $view = $this->view("master-view", [
            'page' => 'revenue',
            'title' => 'Thống kê doanh thu',
        ]);
    }
    public function totalRevenueYear()
    {
        isset($_POST['year']) ? $year = $_POST['year'] : $year = "";
        isset($_POST['hotelId']) ? $hotelId = $_POST['hotelId'] : $hotelId = "";
        $result = $this->RevenueModel->totalRevenueByYear($this->UserName, $year,$hotelId);
        $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
        if ($result) {
            foreach ($result as $key => $value) {
                for ($i = 0; $i < 12; $i++) {
                    if ($value['create_date'] == $i + 1) {
                        $data[$i] = $value['tong'];
                    }
                }
            }
            echo json_encode($data);
        } else {
            echo -1;
        }
    }
    public function hotelRevenueMonth(){
        if(helper::checkPostExist(['month','year','hotelId'])){
            $month = $_POST['month'];
            $year = $_POST['year'];
            $hotelId = $_POST['hotelId'];
            $data = [];
            for ($i=0; $i < 30; $i++) { 
                array_push($data,0);
            }
            $result = $this->RevenueModel->hotelRevenueMonth($this->UserName,$month,$year,$hotelId);
            if ($result) {
                foreach ($result as $key => $value) {
                    for ($i = 0; $i < 30; $i++) {
                        if ($value['create_date'] == $i + 1) {
                            $data[$i] = $value['tong'];
                        }
                    }
                }
                echo json_encode($data);
            } else {
                echo -1;
            }

        }
        else{
            echo -1;
        }
    }
    public function revenueDetail(){
        $listHotel =$this->HotelModel->ListHotel($this->UserName);
        $view = $this->view("master-view", [
            'page' => 'revenue-detail',
            'title' => 'Thống kê chi tiết',
            'listHotel' => $listHotel
        ]);
    }
}

<?php
class hotel extends Controller
{
    public $hotelModal;
    public $userModel;
        public function __construct()
        {
            $this->hotelModal = $this->model("hotelModel");
            $this->userModel = $this->model('userRegis');
            $this->hotelDetail = $this->model('hotelDetail');
            if(isset($_COOKIE['autologin'])){
              $autoLogin = $this->userModel->autologin($_COOKIE['autologin']);
            }
        }
    public function show()
    {
        // echo "Hello from Home";
        $check = "";
        $title = "Home";  
        $search = "";
        $_SESSION['total_people'] = 1;
        $_SESSION['roomCount'] = 1;
        $_SESSION['check-in'] = date("d-m-Y");
        $_SESSION['check-out'] = date("d-m-Y");      
        if(isset($_POST['submit'])){
            $_SESSION['province'] = $_POST['hid'];
            $_SESSION['total_people'] = $_POST['total-people'];
            $_SESSION['roomCount'] = $_POST['roomCount']; 
            if($_POST['check-in']=="" || $_POST['check-out']==null){
                echo "<script>alert('Mời bạn chọn thời gian check-in và check-out')</script>";
                echo "<script> window.location = window.location</script>";
            }
            $_SESSION['check-in'] = $_POST['check-in'];
            $_SESSION['check-out'] = $_POST['check-out'];
            if($_SESSION['province']==""){
                echo "<script>alert('Mời bạn chọn nơi chốn')</script>";
                echo "<script>window.onload =
                location.href = './index.php';</script>";
            }
            if(strtotime($_SESSION['check-out'])<strtotime($_SESSION['check-in'])){
                echo "<script>alert('Mời bạn chọn lại ngày đi')</script>";
                echo "<script>window.onload =
                location.href = './index.php';</script>";
            }
            $check =$this->hotelModal->checkHotel($_SESSION['province'],$_SESSION['total_people']);
        }
        $gethotelByRating = $this->hotelModal->gethotelHighReview();
        $this->view('header',['title' => $title]);
        $view = $this->view('homeDefault', [
            'check'=> $check,
            'rating'=>$gethotelByRating
            ]);
    }
    public function detail()
        {
            if(empty($_GET['id'])){
                echo "<script>window.onload =
                location.href = './index.php';</script>";
            }else{
            $title = "hotelDetail";
            $showUserIsComment = "";
            $checkuser = "";
            $id = $_GET['id'];
            if($_SESSION['total_people']==""){
                $_SESSION['total_people']=1;
            }
            $guest = $_SESSION['total_people'];
            $check_in = $_SESSION['check-in'];
            $check_out = $_SESSION['check-out'];
            $showHotel = $this->hotelDetail->getHotelById($id);
            $showImgHotel = $this->hotelDetail->getImageHotelById($id);
            $showAllImgHotel = $this->hotelDetail->getAllImageHotelById($id);
            $showAllRoom = $this->hotelDetail->getRoomByIdHotel($id,$guest);
            $showAllRoomChild = $this->hotelDetail->getRoomChildByRoom($id,$guest,$check_in,$check_out);
            $iduser="";
            if(isset($_SESSION['isLogin'])){
                $checkuser = $this->hotelModal->checkUser($_SESSION['isLogin']);
                if($checkuser){
                $iduser = $checkuser['id'];
                $showUserIsComment = $this->hotelDetail->checkUserIsComment($iduser,$id);
            }
            }
            // echo $iduser;
            $totalRating= $this->hotelDetail->loadReview($id);
            $rating1 = $this->hotelDetail->loadRatingByNummber($id,1);
            $rating2= $this->hotelDetail->loadRatingByNummber($id,2);
            $rating3 = $this->hotelDetail->loadRatingByNummber($id,3);
            $rating4 = $this->hotelDetail->loadRatingByNummber($id,4);
            $rating5 = $this->hotelDetail->loadRatingByNummber($id,5);
            $this->view('header',['title' => $title]);
            $view = $this->view('detailHotel', [
                'show'=>$showHotel,
                'showImg'=>$showImgHotel,
                'showAllImg'=>$showAllImgHotel,
                'showAllRoom'=>$showAllRoom,
                'showAllRoomChild'=>$showAllRoomChild,
                'checkisBooking'=>$showUserIsComment,
                'checkUser'=>$checkuser,
                'totalRating'=>$totalRating,
                'rating1'=>$rating1,
                'rating2'=>$rating2,
                'rating3'=>$rating3,
                'rating4'=>$rating4,
                'rating5'=>$rating5
                ]);
        }
        if(isset($_POST['submit'])){
            $rcId = $_POST['idRchild'];
            $_SESSION['booking'] = $rcId;
            echo "<script>alert('Mời thanh toán trước khi đặt phòng')</script>";
            echo "<script>window.onload =
            location.href = './index.php?controller=hotel&action=booking';</script>";
        }
    }
    public function listHotel()
    {
        // echo "Hello from Home";
        $title = "Search Result";
        $this->view('header',['title' => $title]);
        $view = $this->view('serch-result');
    }
    public function booking(){
         // echo "Hello from Home";
         $title = "Booking";
         $checkuser = "";
        //  $this->view('header',['title' => $title]);
        if(isset($_SESSION['booking'])){
            $id = $_SESSION['booking'];
        if(isset($_SESSION['isLogin'])){
            $checkuser = $this->hotelModal->checkUser($_SESSION['isLogin']);
        }
            $checkBooking = "";
            $showBooking = $this->hotelModal->getRoomChildById($id);
            $successCheckout = "";
            if(isset($_POST['orderid'])){
                $orderid = $_POST['orderid'];
                $_SESSION['orderid'] = $orderid;
                $username = $_POST['usernameCard'];
                $email = 'sdadsdasdas@gmail.com';
                $total_price = $_POST['total-price'];
                $token = $_POST['token'];
                $successCheckout = $this->hotelModal->checkOut($orderid,$token,$email,$username,$total_price);
            }
            $this->view('header',['title' => $title]);
            $view = $this->view('booking',[
                'showBooking' =>$showBooking,
                'checkUser'=>$checkuser,
                'successCheckout'=>$successCheckout
            ]);
        }else{
            echo "<script>window.onload =
            location.href = './index.php';</script>";
        }
    }
    public function confirm(){  
        $title="CheckOut";
        $this->view('header',['title' => $title]);
        if(isset($_GET['id'])){
        $successCheckout = "";
        $getOrder = $this->hotelModal->checkOutDetail($_GET['id']);
        if(isset($_POST['token'])){
        $orderid = $_GET['id'];
        $email = $_GET['email'];
        $username = $_POST['usernameCard'];
        $total_price = $_POST['total-price'];
        $token = $_POST['token'];
        $successCheckout = $this->hotelModal->checkOut($orderid,$token,$email,$username,$total_price);
        }
        $view = $this->view('checkout',
            [
                'checkOutDetail'=>$getOrder,
                'successCheckout'=>$successCheckout
            ]
    );
        }else{
            echo "<script>window.onload =
            location.href = './index.php';</script>";
        }
    }
}

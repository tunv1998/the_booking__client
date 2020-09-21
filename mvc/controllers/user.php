<?php

    class User extends Controller{
        public $UserModel;
        public function __construct()
        {
            $this->UserRegis = $this->model("UserRegis");
            $this->hotelModal = $this->model("hotelModel");
        }
        public function show(){
            // Gọi class 'helpers' method 'isLogin'
            // Kiểm tra có đăng nhập hay chưa
            if(helpers::isLogin()){
                // Nếu đã đăng nhập, chuyển hướng sang Home
                echo "<script>window.onload =
            location.href = './index.php';</script>";
            }
            else{
                // Chuyển sang phần đăng nhập
                $this->view("login");
            }
        }
        public function login(){
            $result = "";
            // Tạo list Post cần check
            $listPost = ['username','password'];
            // Kiểm tra khi nhấn nút submit
            if(isset($_POST['login'])){
                // Gọi class 'helpers' function 'checkPostExist' kiểm ra POST truyền vào
                if(helpers::checkPostExist($listPost)){
                    // Gọi hàm xóa ký tự đặc biệt
                    $username = helpers::replaceSpecialCharacter($_POST['username']);
                    $password = helpers::replaceSpecialCharacter($_POST['password']);
                    $result = $this->UserRegis->login($username,$password);
                    $userhash = password_hash($username, PASSWORD_BCRYPT);
                    setcookie('autologin',$userhash,time() + 3600);
                    if(!empty($_POST["remember"])) {
                        setcookie ("username",$username,time()+ 3600);
                        setcookie ("password",$password,time()+ 3600);
                        // echo "Cookies Set Successfuly";
                    } 
                    else {
                        setcookie("username","");
                        setcookie("password","");
                        // echo "Cookies Not Set";
                    }
                    
                    if($result){
                        echo "<script>alert('Đăng nhập thành công')</script>";
                        echo "<script>window.onload =
            location.href = './index.php';</script>";
                    }
                    else{
                        echo "<script>alert('Sai tài khoản hoặc mật khẩu')</script>";
                        echo "<script>window.onload =
            location.href = './index.php?controller=user&action=login';</script>";
                    }
                }             
            }
            $this->view('login',[
                'login'=>$result
              ]);
        }
        public function logout(){
            $result = $this->UserRegis->logout();
        }
        public function register(){
            $result = "";
            $listPost = ['username','phone','des','email','pass','pass1'];
            if(isset($_POST['register'])){
                if(helpers::checkPostExist($listPost)){
                $name = helpers::replaceSpecialCharacter($_POST['username']);
                $phone = helpers::regitsPhoneNumber($_POST['phone']);
                $des = helpers::replaceSpecialCharacter($_POST['des']);
                $pass1 = helpers::replaceSpecialCharacter($_POST['pass1']);
                $email = helpers::emailValidation($_POST['email']);
                $pass = helpers::replaceSpecialCharacter($_POST['pass']);
                $cpass = password_hash($pass, PASSWORD_BCRYPT);
                if($pass!=$pass1||$email==false||$phone==false||$des==false){
                    echo "<script>alert('Đăng ký thất bại')</script>";
                }else{
                $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789!$/()*';
				$token = str_shuffle($token);
                $token = substr($token, 0, 10);
                $now = strtotime("now");
                $result = $this->UserRegis->register($name,$email,$cpass,$phone,$des,$token,$now);
                if($result){
                    echo "<script>alert('Đăng Ký thành công vui long xac nhan email')</script>";
                    echo "<script>window.onload =
            location.href = './index.php?controller=user&action=login';</script>";
                }else{
                    echo "<script>alert('Đăng Ký không thành công')</script>";
                    echo "<script>window.onload =
            location.href = './index.php?controller=user&action=register';</script>";
                }
            }
            }
            }
            $this->view('register',[
                'register'=>$result
              ]);
}
        public function forgot(){
            $result = "";
            $listPost = ['email'];
            if(isset($_POST['forgot'])){
            if(helpers::checkPostExist($listPost)){
              $email = $_POST['email'];
              $_SESSION['email']=$email;
              echo $result = $this->UserRegis->updateUserByID($email);
            }
        }
              $this->view('forgot',[
                'forgot'=>$result
              ]);
          }
        public function chagepass(){
            $result = "";
            $listPost = ['pass','email'];
            if(isset($_POST['update'])){
                if(helpers::checkPostExist($listPost)){
                $pass = helpers::replaceSpecialCharacter($_POST['pass']);
                $email = $_SESSION['email'];
                $pass = password_hash($pass, PASSWORD_BCRYPT);
                $result = $this->UserRegis->getUserByEmail($email,$pass);
                if($result){
                    echo "<script>alert('Success Change Passworld')</script>";
                    echo "<script>window.onload =
                    location.href = './index.php?controller=user&action=login';</script>";
                }else{
                    echo "<script>alert('False Change Passworld')</script>";
                    echo "<script>window.onload =
                    location.href = './index.php?controller=user&action=chagepass';</script>";
                }
                }
              }
              $this->view('loken',[
                'pass'=>$result
              ]);     
        }
        public function confirm(){
            if (isset($_GET['email']) || isset($_GET['token'])) {
                $time = strtotime("now");        
                $email = $_GET['email'];
                $token = $_GET['token'];
                $now = $_GET['now'];
                $now1 = $now + 3600;
                $type = "";
                if($time>=$now1)
                {
                    $type="delete";
                }else{
                    $type="update";
                }
                $this->UserRegis->verifireEmail($email,$type);
        }
        }
        public function profile(){
            $title="Profile";
            if(isset($_SESSION['isLogin'])){
            $this->view('header',['title' => $title]);
            $checkuser = $this->hotelModal->checkUser($_SESSION['isLogin']);
            $userisBooking = $this->UserRegis->checkUserBooking($checkuser['id']);
            $this->view('userProfile',
        [
            'user'=>$checkuser,
            'userbooking'=>$userisBooking
        ]);
            }else{
                echo "<script>window.onload =
                location.href = './index.php';</script>";
            }
        }
        public function myBooking(){
            $title="myBooking";
            $this->view('header',['title' => $title]);
            if(isset($_SESSION['isLogin'])){
                $this->view('header',['title' => $title]);
                $checkuser = $this->hotelModal->checkUser($_SESSION['isLogin']);
                $userisBooking = $this->UserRegis->checkUserBooking($checkuser['id']);
                $this->view('mybooking',
            [
                'user'=>$checkuser,
                'userbooking'=>$userisBooking
            ]);
                }else{
                    echo "<script>window.onload =
                    location.href = './index.php';</script>";
                }
        }
        public function deleteBooking(){
            $id = $_GET['id'];
            $delete = $this->UserRegis->deleteBoking($id);
            if($delete){
                echo "<script>alert('Bạn Đã Hủy Phòng Của Bạn Thành Công')</script>";
                echo "<script>window.onload =
                location.href = './index.php?controller=user&action=myBooking';</script>
                ";
            }else{
                echo "<script>alert('Sai')</script>";
                echo "<script>window.onload =
                location.href = './index.php?controller=user&action=myBooking';</script>";
            }
        }
    }


?>
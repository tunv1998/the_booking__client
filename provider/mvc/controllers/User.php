<?php

    class User extends Controller{
        public $UserModel;
        public $username;
        public function __construct()
        {
            $this->UserModel = $this->model("UserModel");
            $this->username = @$_SESSION['isProvider'];
        }
        public function Default(){
            // Gọi class 'helper' method 'isLogin'
            // Kiểm tra có đăng nhập hay chưa
            if(helper::isLogin()){
                // Nếu đã đăng nhập, chuyển hướng sang Home
                header("location: ./?ctrl=home");
            }
            else{
                // Chuyển sang phần đăng nhập
                $this->view("login-view",[
                    'title' => 'Đăng nhập',

                ]);
            }
        }
        public function Login(){
            // Tạo list Post cần check
            $listPost = ['username','password'];
            // Kiểm tra khi nhấn nút submit
            if(isset($_POST['login'])){
                // Gọi class 'helper' function 'checkPostExist' kiểm ra POST truyền vào
                if(helper::checkPostExist($listPost)){
                    // Gọi hàm xóa ký tự đặc biệt
                    $username = helper::replaceSpecialCharacter($_POST['username']);
                    $password = helper::replaceSpecialCharacter($_POST['password']);
                    // Gọi model 'UserModel' phương thức 'login'
                    $result = $this->UserModel->login($username,$password);
                    // Kiểm tra kết quả
                    if($result){
                        // Đăng nhập thành công tạo session
                        $_SESSION['isProvider'] = $username;
                        echo "<script>alert('Đăng nhập thành công')</script>";
                    }
                    else{
                        echo "<script>alert('Sai tài khoản hoặc mật khẩu')</script>";
                    }
                }
                else{
                    echo "Rỗng";
                }
                // Chuyển hướng sang controller 'User'
                header("Refresh:0; url=./?ctrl=user"); 
                
            }
            else{

            }
            
        }
        public function register(){
            if(helper::isLogin()){
                // Nếu đã đăng nhập, chuyển hướng sang Home
                header("location: ".helper::BASE_URL."/?ctrl=home");
            }
            else{
                if(isset($_POST['register'])){
                    $checkPost = ['FullName','phoneNumber','username','password','Email'];
                    if(helper::checkPostExist($checkPost)){
                        $fullname = $_POST['FullName'];
                        $phoneNumber = helper::replaceSpecialCharacter($_POST['phoneNumber']);
                        $username = helper::replaceSpecialCharacter($_POST['username']); 
                        $password = password_hash(helper::replaceSpecialCharacter($_POST['password']),PASSWORD_DEFAULT);   
                        $email = $_POST['Email'];
                        $result = $this->UserModel->register($fullname,$phoneNumber,$username,$password,$email);
                        if($result){
                            echo "<script>alert('Đăng ký thành công')</script>";
                        }
                        else{
                            echo "<script>alert('Vui lòng kiểm tra dữ liệu nhập vào')</script>";
                        }
                        header("Refresh:0; url=./?ctrl=user"); 
                    }
                    else{
                        echo "<script>alert('Dữ liệu không thể rỗng')</script>";
                    }
                }
                else{
                    $view = $this->view('register-view',[
                        'title' => 'Đăng ký',
                    ]);
                }
            }
        }
        public function logout(){
            unset($_SESSION['isProvider']);
            header("location: ./?ctrl=home");
        }
        public function userInfo(){
            $userInfo = $this->UserModel->getUserInfo($this->username);
            $packOri = $this->UserModel->getPackInfo($this->username);
            !empty($packOri) ? $packInfo = $packOri[0] : $packInfo = [];
            $packBenifit = [];
            unset($packInfo['option_name']);
            foreach ($packOri as $key => $value) {
                array_push($packBenifit,$value['option_name']);
            }
            $view = $this->view("master-view",[
                'page' => "user-info",
                'title' => "Thông tin tài khoản",
                'userInfo' => $userInfo,
                'packInfo' => $packInfo,
                'packBenifit' => $packBenifit,
            ]);
        }
        public function package(){
            $providerPack = $this->UserModel->getCurrentPack($this->username);
            $allPack = $this->UserModel->getAllPack();
            $view = $this->view("master-view",[
                'page' => "package",
                'title' => "Quản lý gói",
                'packInfo' => $providerPack,
                'allPack' => $allPack,
            ]);
        }
       
    }

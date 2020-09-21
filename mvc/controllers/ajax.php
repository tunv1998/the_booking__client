<?php
class Ajax extends Controller{
    public $country;
    public $checkUser;
   public function __construct(){
       $this->country=$this->model("hotelModel");
       $this->checkUser =$this->model("userRegis");
       $this->hotelDetail =$this->model("hotelDetail");

    }
    public function show(){
        if(!empty($_POST["keyword"])) {
        $term = $_POST['keyword'];
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $term = str_replace($reservedSymbols, '', $term);
        $words = explode(' ', $term);
        foreach ($words as $key => $word) {
           /*
            * applying + operator (required word) only big words
            * because smaller ones are not indexed by mysql
            */
           if (strlen($word) >= 1) {
               $words[$key] = '' . $word  . '*';
           }
        }
        $searchteam = implode(' ', $words); 
        if($searchteam!=""){
        echo $this->country->search($searchteam);
        }else{
        return false;
        }
    }
}
public function filterHotel(){
    $price = "";
    if(isset($_POST['action'])){
        $id = $_POST['hid'];
        $guest = $_POST['totalPeople'];
        $highPrice = $_POST['maximum_price'];
        $lowPrice = $_POST['minimum_price'];
        $star=null;
        $limit = '9';
        $page = 1;
        $review_hotel=null;
        $price = null;
        if(!empty($_POST["star"]))
        {
            $star = $_POST['star'];
        }else{
            $star = null;
        }
        if(!empty($_POST["review_hotel"]))
        {
            $review_hotel = $_POST["review_hotel"];
        }else{
            $review_hotel = null;
        }
        if(!empty($_POST["price"]))
        {
            $price = $_POST["price"];
        }else{
            $price = null;
        }
        if($_POST['page'] > 1)
            {
              $start = (($_POST['page'] - 1) * $limit);
              $page = $_POST['page'];
            }
            else
            {
              $start = 0;
            }
        echo $this->country->filter($id,$guest,$highPrice,$lowPrice,$star,$review_hotel,$price,$page,$start,$limit);
}
}
public function checkUsername(){
    if(!empty($_POST['username'])){
        $user = $_POST['username'];
        $reservedSymbols = ['-', '+', '<', '>', '@', '(', ')', '~'];
        $user = str_replace($reservedSymbols, '', $user);    
        if($user!=""){
        echo $this->checkUser->checkUserName($user);
    }else{
        return false;
    }
    }
}
public function checkEmail(){
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
    if($email!=""){
        echo $this->checkUser->checkEmail($email);
    }else{
        return false;
    }
    }
}
public function editUser(){
    if(!empty($_POST['email'])){
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $phone = $_POST['phone'];
        $id = $_POST['id'];
    if($email!=""){
        echo $this->checkUser->editUser($email,$dob,$phone,$id);
    }else{
        return false;
    }
    }
}
public function checkPhone(){
    if(!empty($_POST['phone'])){
        $user = $_POST['phone'];
    if($user!=""){
        echo $this->checkUser->checkPhone($user);
    }else{
        return false;
    }
    }
}
public function login(){
    if(!empty($_POST['login'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        if($username != "" && $password != ""){
            echo $this->checkUser->login($username,$password);
        }else{
            return false;
        }
    }
}
public function logout(){
    if(!empty($_POST['logout'])){
            echo $this->checkUser->logout();
    }
}
public function checkBooking(){
    if(isset($_POST['action'])){
        $username = "";
        $email = "";
        $re_email = "";
        $phone_number = "";
        $error = "";
        $data = "";
    if(helpers::replaceSpecialCharacter($_POST['username'])==false){
        $error .= "<div>Vui Lòng kiểm tra lại Tên của bạn</div> </br>";
    }else{
        $username = $_POST['username'];
    }
    if(helpers::emailValidation($_POST['email'])==false){
        $error .= "<div>Emai Xác nhận không đúng định dạng</div> </br>";

    }else{
        $email = $_POST['email'];
    }
    if(helpers::emailValidation($_POST['re_email'])==false && $_POST['email']!=$_POST['re_email']){
        $error .= "<div>Emai không đúng định dạng</div> </br>";
    }else{
        $re_email = $_POST['re_email'];
    }
    if(helpers::regitsPhoneNumber($_POST['phone_num'])==false){
        $error .= "<div>Số Điện Thoại không đúng định dạng</div>";

    }else{
        $phone_number = $_POST['phone_num'];
    }
        $guestName = $_POST['guestName'];
        $total_price = $_POST['total_price'];
        $datacheckIn = $_SESSION['check-in'];
        $date=date_create("$datacheckIn");  
        $check_in = date_format($date,"Y-m-d");
        // $token = $_POST['token'];
        $datacheckOut = $_SESSION['check-out'];
        $date=date_create("$datacheckOut");  
        $check_out = date_format($date,"Y-m-d");
        $room_child_id = $_POST['room_child_id'];
        $total_date = $_POST['total_date'];
        $total_people = $_POST['total_people'];
        $rooms_id = $_POST['rooms_id'];
        if(isset($_POST['user_account'])){
        $user_account = $_POST['user_account'];
        }else{
            $user_account=null;
        }
        $roomCount = $_POST['roomCount'];
        if($email == $re_email && $username !="" && $guestName !="" && $phone_number !=""){
        $data = $this->country->createBooking($username,$phone_number,$email,$guestName,$total_date,$total_people,$user_account,$roomCount,$check_in,$check_out,$room_child_id,$total_price,$rooms_id);
        }else{
        $error .= "làm ơn kiểm tra lại dữ liệu nhập vào";
        }
        $result = array(
            'error' => $error,
            'data' => $data
        );
        echo json_encode($result);
        }
    }
    public function showComment(){
        if(isset($_POST['id'])){
        $id = $_POST['id'];
        $limit = $_POST['limit'];
       echo $this->hotelDetail->showComment($id,$limit);
    }
    }
    public function comment(){
        $error = '';
        $comment_content = '';
        if(empty($_POST["comment_content"]))
        {
        $error .= '<p class="text-danger">Comment is required</p>';
        }
        else
        {
        $comment_content = $_POST["comment_content"];
        }
        if($error == ""){
            $userRating = $_POST['userrating'];
            $idHotel = $_POST['idHotel'];
            $check = $this->hotelDetail->userComment($idHotel,$comment_content,$userRating);
            if($check){
            $error .= '<label class="text-success">Comment is Success</label>';
        }
    }
        $data = array(
          'error'  => $error
        );      
        echo json_encode($data);
    }
    public function rating(){
        if(isset($_POST['index'])){
            $id = $_POST['id'];
            $index = $_POST['index'];
            echo  $this->hotelDetail->userRating($id,$index);
        }
    }
    public function like(){
        if(isset($_POST['content_id'])){
            $content_id = $_POST['content_id'];
            $idHotel = $_POST['id'];
            echo  $this->hotelDetail->userLike($content_id,$idHotel);
        }
    }
    public function dislike(){
        if(isset($_POST['content_id'])){
            $content_id = $_POST['content_id'];
            $idHotel = $_POST['id'];
            echo  $this->hotelDetail->userDisLike($content_id,$idHotel);
        }
    }
    public function countReview(){
        if(isset($_POST['id'])){
            $idHotel = $_POST['id'];
            $check=$this->hotelDetail->loadReview($idHotel);
            echo $check['countReview'];
        }
    }
    public function loadMore(){
        if(isset($_POST['id'])){
            $idHotel = $_POST['id'];
            $limit = $_POST['limit'];
            echo $this->hotelDetail->showComment($idHotel,$limit);
        }
    }
}
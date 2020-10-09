<?php 
    class UserRegis extends DB{
        public function login($username,$password){            
            $sql = "SELECT username,password FROM user_account
            where username = '".$username."'  and status_id = 1";
            $stmt = $this->conn->query($sql);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            $hash = $result['password'];
            if($result){
                $password_hashed = password_verify($password, $hash);
                if($password_hashed){
                    $_SESSION['isLogin'] = $username;
                    return true;
                }
                else{
                    return false;
                }
            }
            else{
                return false;
            }
        }
        public function logout(){
            unset($_SESSION["isLogin"]);
            setcookie("autologin","");
            echo "<script>alert('Success Logout!')</script>";
            echo "<script>window.onload =
            location.href = './index.php';</script>";
        }
        public function autologin($username){
            $sql = "SELECT username from user_account";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach($result as $row){
                $password_hashed = password_verify($row['username'],$username);
                if($password_hashed){
                    $_SESSION['isLogin']=$row['username'];
                    return true;
                }else{
                    return false;
                }
            }

        }
        public function register($name,$email,$pass,$phone,$des,$token,$now){
            $stmt = [];
            $query = "INSERT INTO `user_account`(`username`, `password`, `dob`, `phone_number`, `email`, `status_id`, `token`, `time_verify`) VALUES  
            ('$name','$pass','$des','$phone','$email','3','$token',$now)";
            // echo $query;
            $stmt = $this->conn->prepare($query);
            $result = $stmt->execute();
            if(!$result){
                return false;
            }else{
            // return true;
            $subject = "Verifire Email";
            $body = "
            Please click on the link below:<br><br>
            <a href='http://localhost/PROJECT-ONE/index.php?controller=user&action=confirm&email=$email&token=$token&now=$now'>Click Here</a>
        ";	
            $sendmail = helpers::sendMail('thanhdai2295','thanhdai220595@gmail.com','Dai',$email,$subject,$body);
            if($sendmail){
                return true;
            }else{
                return false;
              }
              return true;
        }
    }
        public function verifireEmail($email,$type){
            if($type=="delete"){
                echo $query = 'DELETE FROM user_account WHERE email="'.$email.'"';
                $stmt = $this->conn->prepare($query);
                if($stmt->execute()){
                    echo 'Ban Da Het Han Dang Ky Vui Long Dang Ky Lai';
                }
            }
           if($type=="update"){
                $query = "UPDATE user_account SET status_id= 1, token='',time_verify='' WHERE email='$email'";
                $stmt = $this->conn->prepare($query);
                if($stmt->execute()){
                    echo 'Your email has been verified! You can log in now!';
                }
            }
            
        }
        public function getUserByEmail($email,$password){
            $query="UPDATE `user_account` SET `password`=$password WHERE `email`='$email'";
            $result = $this->conn->prepare($query);
            if($result){
                return true;
            }else{
                return false;
            }
    }
    public function editUser($email,$dob,$phone,$id){
        $query = "UPDATE `user_account` SET 
        `dob`='$dob',`phone_number`='$phone',`email`='$email' WHERE id = $id";
        $stmt = $this->conn->prepare($query);
        if($stmt->execute()){
            echo 1;
        }else{
            echo 0;
        }
    }
    public function checkUserBooking($iduser){
        $query = "SELECT hotel.name as hName,hotel.address_line as hAddress,booking.status_id as status,room_child.name as rcName,booking.id as bId,
        province._name as pName, CONCAT(district._prefix,' ',district._name) as dName,hotel.hotel_avatar as avatar,booking.room_total as totalRoom,booking.total_date as totalDate,
        CONCAT(ward._prefix,' ',ward._name) as wName, booking.check_in as check_in,booking.check_out as check_out,beds.name as bName, booking.total_price as price FROM user_account 
        INNER JOIN booking ON user_account.id = booking.user_account_id
        INNER JOIN room_child ON room_child.id = booking.room_child_id
        INNER JOIN rooms ON rooms.id = room_child.room_parent
        INNER JOIN hotel ON rooms.hotel_id = hotel.id 
        inner join province on province.id = hotel.city_id 
        inner join district on district.id = hotel.district_id 
        inner join ward on ward.id = hotel.wards_id 
        inner join beds on beds.id = rooms.bed_id
        WHERE user_account.id=".$iduser." AND (booking.status_id=3 OR booking.status_id=2 OR booking.status_id=1 OR booking.status_id=5) ORDER BY booking.id DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
    public function deleteBoking($id){
        $query = "DELETE FROM `booking` WHERE id = $id";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute();
    }
    public function updateUserByID($email){
        $query = "SELECT * FROM `user_account` WHERE email='$email'";
        $result = $this->conn->prepare($query);
        $result->execute();
        $no = $result->rowCount();
        if($no<1){
            return false;
        }else{
               
                $subject = "Change Pass";
                $body = "
                Please click on the link below:<br><br>
                <a href='http://localhost/PROJECT-ONE/index.php?controller=user&action=chagepass'>Click Here</a>";	
                $sendmail = helpers::sendMail('thanhdai2295','thanhdai220595@gmail.com','Dai',$email,$subject,$body);
                if($sendmail){
                    echo "<script>alert('Vui lòng check mail để nhận tạo lại password')</script>";
                  }else{
                    echo "<script>alert('False Your Recovered Password')</script>";
                  }
                return true;
    }
    }
    public function checkUser($sql){
        $query = "SELECT id from user_account $sql";
        return $query;
    }
    public function checkUserName($username){
        $sql = " WHERE username = '".$username."'";
        $checkUsername = $this->checkUser($sql);
        $result = $this->conn->prepare($checkUsername);
        $result->execute();
        $row = $result->rowCount();
        $output = "";
        $color = "";
        if($row>0){
            $color = "color:red;";
            $output .='<div style=" '.$color.' font-size:12px; margin:5px;">Tài khoản đã tồn tại</div>';
        }else{
            $color = "color:green;";
            $output = '<div style=" '.$color.' font-size:12px;margin:5px;">Tài khoản hợp lệ</div>';
        }
        echo $output;
    }
    public function checkEmail($email){
        $email = helpers::emailValidation($email);
        $output = "";
        $color = "";
        if($email==false){
            $color = "color:red;";
            $output .= '<div style=" '.$color.' font-size:12px;margin:5px;">Email sai định dạng</div>';
        }else{
        $sql = " WHERE email = '".$email."'";
        $checkEmail = $this->checkUser($sql);
        $result = $this->conn->prepare($checkEmail);
        $result->execute();
        $row = $result->rowCount();
        if($row>0){
            $color = "color:red;";
            $output .= '<div style=" '.$color.' font-size:12px;margin:5px;">Email đã tồn tại</div>';
        }else{
            $color = "color:green;";
            $output .= '<div style=" '.$color.' font-size:12px;margin:5px;">Email hợp lệ</div>';
        }
    }
        echo $output;
    }

    public function checkPhone($phone){
        $output = "";
        $phone = helpers::regitsPhoneNumber($phone);
        if($phone == false){
        $color = "color:red;";
        $output .= '<div style=" '.$color.' font-size:12px;margin:5px;">Số điện thoại định dạng sai</div>';
        }else{
        $sql = " WHERE phone_number = $phone";
        $checkPhone = $this->checkUser($sql);
        $result = $this->conn->prepare($checkPhone);
        $result->execute();
        $row = $result->rowCount();
        $color = "";
        if($row>0){
            $color = "color:red;";
            $output .= '<div style=" '.$color.' font-size:12px;margin:5px;">Số điện thoại đã tồn tại</div>';
        }else{
            $color = "color:green;";
            $output .= '<div style=" '.$color.' font-size:12px;margin:5px;">Số điện thoại hợp lệ</div>';
        }
    }
        echo $output;
    }
}
?>
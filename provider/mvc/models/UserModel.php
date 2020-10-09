<?php
class UserModel extends DB
{
    public function login($username, $password)
    {
        $sql = "SELECT id,username,password FROM manager_account
            where username = '" . $username . "' and role = 2 and status_id = 1";
        $result = $this->queryOne($sql);
        if ($result) {
            $password_hashed = password_verify($password, $result['password']);
            if ($password_hashed) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function register($fullname, $phoneNumber, $username, $password, $email)
    {
        $sql = "INSERT INTO manager_account(email,fullname,phone_number,username,password,role)
            VALUE('" . $email . "','" . $fullname . "','" . $phoneNumber . "','" . $username . "','" . $password . "',2)";
        return $this->insert($sql);
    }
    public function getUserInfo($username)
    {
        $sql = "SELECT * FROM manager_account where username = '" . $username . "'";
        $result =  $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function changeUserInfo($data)
    {
        $sql = "update manager_account set fullname = '" . $data[2] . "', phone_number = '" . $data[4] . "', email = '" . $data[3] . "' 
            where username = '" . $data[1] . "' and id = $data[0]";
        return $this->update($sql);
    }
    public function uploadUserImg($name, $username)
    {
        $sql = "update manager_account set avatar_img = '" . $name . "'
            where username = '" . $username . "'";
        return $this->update($sql);
    }
    public function getPackInfo($username)
    {
        $sql = "select package.name as name, package.hotel_quantity as hotel_num, package.room_quantity as room_num, package.booking_fee as fee, package_option.name as option_name, package_history_buy.date_from as date_from, package_history_buy.date_to as date_to from package
            left join package_detail on package_detail.package_id = package.id
            left join package_option on package_option.id = package_detail.package_option_id
            inner join package_history_buy on package_history_buy.package_id = package.id
            inner join manager_account on manager_account.id = package_history_buy.manager_account_id
            where manager_account.username = '" . $username . "' and package_history_buy.status_id = 1";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function getCurrentPack($username){
        $sql = "select package_history_buy.id as pack_h_id, package.id as pack_id, package.name as pack_name , date(package_history_buy.date_from) as date_from, date(package_history_buy.date_to) as date_to, package.price as price, package.level as level from package_history_buy
        inner join manager_account on manager_account.id = package_history_buy.manager_account_id
        inner join package on package.id = package_history_buy.package_id
        where manager_account.username = '".$username."' and package_history_buy.status_id = 1";
        $result = $this->queryMulti($sql);
        return $result ? $result : $result = [];
    }
    public function packExtend($data,$username){
        $updateOldPack = "update package_history_buy
        inner join manager_account on manager_account.id = package_history_buy.manager_account_id
        set package_history_buy.status_id = 4
        where package_history_buy.id = ".$data['packHId']." and manager_account.username = '".$username."'";
        if($this->update($updateOldPack)){
            $price = $data['month'] * $data['price'];
            $createNewPack = "INSERT INTO package_history_buy(manager_account_id,package_id,date_from,date_to,price)
            value((select manager_account.id from manager_account where manager_account.username = '".$username."'),".$data['packId'].",'".$data['dateFrom']."','".$data['dateTo']."',$price)";
            if($this->insert($createNewPack)){
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
    public function getAllPack(){
        $pack = "select * from package where status_id = 1 and id != 4";
        $option = "select package.id as pack_id, package_option.name as pack_op_name from package_detail
        inner join package_option on package_option.id = package_detail.package_option_id
        inner join package on package.id = package_detail.package_id";
        $qr1 = $this->queryMulti($pack);
        $qr2 = $this->queryMulti($option);
        return ['pack' => $qr1,"option" => $qr2];
    }
    public function isAllowUpPackage($level,$id){
        $sql = "select * from package where level > $level and id = $id";
        $result = $this->queryMulti($sql);
        echo $sql;
        return $result ? $result : $result = [];
    }
}

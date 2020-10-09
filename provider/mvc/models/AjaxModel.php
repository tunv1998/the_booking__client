<?php 
    class AjaxModel extends DB{

        public function GetOneDistrict($id){
            $sql = "SELECT * FROM district where _province_id = $id";
            $result = $this->queryMulti($sql);
            if($result){
                return $result;
            }
            else{
                return false;
            }
        }
        public function GetOneWard($id){
            $sql = "SELECT * FROM ward where _district_id = $id";
            $result = $this->queryMulti($sql);
            if($result){
                return $result;
            }
            else{
                return false;
            }
        }
    }





?>
<?php
class Ajax extends Controller
{
    public $AjaxModel;
    public $UserName;
    public $HotelModel;
    public $BookingModel;
    public $RevenueModel;
    public $UserModel;
    function __construct()
    {
        $this->AjaxModel = $this->model('AjaxModel');
        $this->HotelModel = $this->model('HotelModel');
        $this->BookingModel = $this->model('BookingModel');
        $this->RevenueModel = $this->model('RevenueModel');
        $this->UserModel = $this->model('UserModel');
        $_SESSION['isProvider'] ? $this->UserName = $_SESSION['isProvider'] : $this->UserName;
    }
    public function
    Default()
    {
    }
    public function GetOneDistrict()
    {
        if (helper::checkPostExist(['id'])) {
            $result = $this->AjaxModel->GetOneDistrict($_POST['id']);
            if ($result) {
                echo json_encode($result);
            } else {
            }
        } else {
        }
    }
    public function GetOneWard()
    {
        if (helper::checkPostExist(['id'])) {
            $result = $this->AjaxModel->GetOneWard($_POST['id']);
            if ($result) {
                echo json_encode($result);
            } else {
            }
        } else {
        }
    }
    public function createRoomChild()
    {
        if (helper::checkGetExist(['param'])) {
            $parentId = $_GET['param'];
            $checkPost = ['name', 'policy', 'price'];
            if (helper::checkPostExist($checkPost)) {
                $result =  $this->HotelModel->createRoomChild($_POST['name'], $_POST['policy'], $_POST['price'], $this->UserName, $parentId);
                if ($result) {
                    echo 0;
                } else {
                    echo -1;
                }
            } else {
                echo -1;
            }
        } else {
            echo -1;
        }
    }
    public function deleteRateOneRoomChild()
    {
        if (helper::checkGetExist(['param'])) {
            $parentId = $_GET['param'];
            if (helper::checkPostExist(['id'])) {
                $rateId = $_POST['id'];
                $result = $this->HotelModel->deleteRateOneRoomChild($this->UserName, $rateId);
                if ($result) {
                    echo 0;
                } else {
                    echo -1;
                }
            } else {
                echo -1;
            }
        } else {
            echo -1;
        }
    }
    public function editRoomChild()
    {
        if (helper::checkGetExist(['param'])) {
            $id = $_GET['param'];
            $checkPost = ['name', 'room_policy_id'];
            if (helper::checkPostExist($checkPost)) {
                $roomPolicyId = $_POST['room_policy_id'];
                $policy = isset($_POST['policy']) ?  $_POST['policy'] : "";
                $updatePrice = isset($_POST['update_price']) ? $_POST['update_price'] : "";
                $name = $_POST['name'];
                $insertPrice = "INSERT into room_rate(rate,date_from,date_to,room_child_id) VALUES ";
                $updatePriceSql = "";
                $policySql = "";
                $insertPriceSql = "";
                if (helper::checkPostExist(['insert_price'])) {
                    foreach ($_POST['insert_price'] as $key => $value) {
                        $insertPriceSql .= "($value[3],'" . $value[1] . "','" . $value[2] . "',$id),";
                    }
                    if (strrpos($insertPriceSql, ",") == strlen($insertPriceSql) - 1) {
                        $insertPriceSql =  substr($insertPriceSql, 0, strlen($insertPriceSql) - 1);
                    }
                }
                // 
                if (!empty($policy)) {
                    for ($i = 0; $i < count($roomPolicyId); $i++) {
                        for ($j = 0; $j < count($policy); $j++) {
                            if ($i == $j) {
                                $policySql .= "UPDATE room_policy SET room_child_id = $id,policy_id = $policy[$j] where id = $roomPolicyId[$i];";
                            }
                        }
                    }
                }
                if (!empty($updatePrice)) {
                    foreach ($updatePrice as $key => $value) {
                        $updatePriceSql .= "UPDATE room_rate SET rate = $value[3],date_from = '" . $value[1] . "', date_to = '" . $value[2] . "', room_child_id = $id where id = $value[0];";
                    }
                }
                if (empty($insertPriceSql)) {
                    $insertPrice = "";
                } else {
                    $insertPrice = $insertPrice . $insertPriceSql;
                }
                $updateName = "UPDATE room_child SET name = '" . $name . "' where id = $id";
                $arr = [$updateName, $policySql, $updatePriceSql, $insertPrice];
                $result = $this->HotelModel->roomChildEdit($arr);
                if ($result) {
                    echo 0;
                } else {
                    echo -1;
                }
            } else {
                echo -1;
            }
        } else {
            echo -1;
        }
    }
    public function getAllImageByHotelName()
    {
        if (helper::checkPostExist(['hotelName', 'hotelId'])) {
            $arr = [];
            $allDbHotelImage = [];
            $hotelId = $_POST['hotelId'];
            $hotelName = helper::convertHotelNameToFolderName([$_POST['hotelName']]);
            $listRoom = $this->HotelModel->GetListRoom($hotelId, $this->UserName);
            $listDbHotelName = $this->HotelModel->getAllImageByHotelId($hotelId, $this->UserName);
            $allImage = file_handl::findAllFileInFolder('..\public\uploads\hotel/', [$hotelName[array_key_first($hotelName)]]);
            // Tất cả ảnh trong folder một khách sạn
            if (empty($allImage)) {
                echo -1;
                return;
            }

            // Thông tin room
            $roomInfor = "";
            foreach ($listRoom as $roomKey => $roomValue) {
                $roomInfor .= "<option value='" . $roomValue['r_id'] . "'>" . $roomValue['r_name'] . "</option>";
            }
            // Hình ảnh đang active của khách sạn
            $hotelFImageActive = [];
            foreach ($allImage['fileName'] as $imgKey => $imgValue) {
                foreach ($listDbHotelName as $key => $value) {
                    if ($imgValue === $value['hi_name']) {
                        array_push($hotelFImageActive, $allImage['filePath'][$imgKey]);
                    }
                }
            }
            $hotelFImageActive = array_unique($hotelFImageActive);
            // 
            $hotelImageActive = "";
            foreach ($hotelFImageActive as $key => $value) {
                foreach ($listDbHotelName as $dbNameKey => $dbNameValue) {
                    if (strpos($value, $dbNameValue['hi_name']) !== false) {
                        $hotelImageActive .= "<div class=' nopad text-center position-relative' style='flex-basis: 25%;max-width: 25%;'> <label for='hotelImage-" . $dbNameValue['hi_id'] . "'>  <img class='img-responsive mw-100 mb-3' h-id='" . $dbNameValue['hi_id'] . "' src='" . $value . "' style='width: 120px;height: 100px' /><input type='checkbox' name='hotelName[]'' class='hotelName' value='" . $dbNameValue['hi_id'] . "' id='hotelImage-" . $dbNameValue['hi_id'] . "'></label></div> ";
                    }
                }
            }
            // 'allImage' => $allFImage,
            $arr = ['listRoom' => $roomInfor, 'hotelActive' => $hotelImageActive];
            echo json_encode($arr);
        } else {
        }
    }
    public function getRoomImage()
    {
        if (helper::checkPostExist(['roomId', 'hotelName'])) {
            $arr = [];
            $id = $_POST['roomId'];
            $listRoomImage = $this->HotelModel->getRoomImage($id, $this->UserName);
            $hotelName = helper::convertHotelNameToFolderName([$_POST['hotelName']]);
            $allImage = file_handl::findAllFileInFolder('..\public\uploads\hotel/', [$hotelName[array_key_first($hotelName)]]);
            if (!empty($allImage)) {
                foreach ($allImage['fileName'] as $allImgKey => $allImgValue) {
                    foreach ($listRoomImage as $listDbImgKey => $listDbImgValue) {
                        if ($allImgValue === $listDbImgValue['hi_name']) {
                            array_push($arr, $allImage['filePath'][$allImgKey]);
                        }
                    }
                }
                $arr = array_unique($arr);
                $result = "";
                foreach ($arr as $key => $value) {
                    foreach ($listRoomImage as $roomImgKey => $roomImgValue) {
                        if (strpos($value, $roomImgValue['hi_name']) !== false) {
                            $result .= "<div class=' nopad text-center position-relative' style='flex-basis: 25%;max-width: 25%;'><label for='roomImg-" . $roomImgValue['hi_id'] . "'> <img class='img-responsive mw-100 mb-3' src='" . $value . "' style='width: 120px;height: 100px' /><input type='checkbox' class='roomName' value='" . $roomImgValue['hi_id'] . "' id='roomImg-" . $roomImgValue['hi_id'] . "'></label></div>";
                        }
                    }
                }
                echo $result;
            }
        } elseif (helper::checkPostExist(['id', 'hotelN'])) {
            $arr = [];
            $result = "";
            $roomId = $_POST['id'];
            $hotelName = $_POST['hotelN'];
            $listRoomImage = $this->HotelModel->getRoomImage($roomId, $this->UserName);
            // print_r($listRoomImage);
            $hotelName = helper::convertHotelNameToFolderName([$hotelName]);
            $allImage = file_handl::findAllFileInFolder('..\public\uploads\hotel/', [$hotelName[array_key_first($hotelName)]]);
            if (!empty($allImage)) {
                foreach ($allImage['fileName'] as $allImgKey => $allImgValue) {
                    foreach ($listRoomImage as $listDbImgKey => $listDbImgValue) {
                        if ($allImgValue == $listDbImgValue['hi_name']) {
                            unset($allImage['filePath'][$allImgKey]);
                        } else {
                        }
                    }
                }
                foreach ($allImage['filePath'] as $key => $value) {
                    $name = helper::getLastContentInUrl($value);
                    $result .= "<div class=' nopad text-center position-relative mr-3' style='flex-basis: 10%;max-width: 10%;'><label for='roomImg-" . $key . "'> <img class='img-responsive mw-100 mb-3' src='" . $value . "' style='width: 120px;height: 100px' /><input type='checkbox' class='image-gallery' value='" . $name . "' id='roomImg-" . $key . "'></label></div>";
                }
            }
            echo $result;
        } else {
            
        }
    }
    // Show ảnh khách sạn có trong csdl
    public function getHotelImage()
    {
        if (helper::checkPostExist(['id', 'name'])) {
            $id = $_POST['id'];
            $hotelName = helper::convertHotelNameToFolderName([$_POST['name']]);
            $listDbHotelName = $this->HotelModel->getAllImageByHotelId($id, $this->UserName);
            $allImage = file_handl::findAllFileInFolder('..\public\uploads\hotel/', [$hotelName[array_key_first($hotelName)]]);
            $allFImage = "";
            if (!empty($allImage)) {
                foreach ($allImage['fileName'] as $imgKey => $imgValue) {
                    $name = helper::getLastContentInUrl($imgValue);
                    foreach ($listDbHotelName as $key => $value) {
                        if ($imgValue === $value['hi_name']) {
                            unset($allImage['filePath'][$imgKey]);
                        }
                    }
                }
                foreach ($allImage['filePath'] as $key => $value) {
                    $name = helper::getLastContentInUrl($value);
                    $allFImage .= "<div class=' nopad text-center position-relative mr-3' style='flex-basis: 10%;max-width: 10%;'><label for='roomImg-" . $key . "'> <img class='img-responsive mw-100 mb-3' src='" . $value . "' style='width: 120px;height: 100px' /><input type='checkbox' class='image-gallery' value='" . $name . "' id='roomImg-" . $key . "'></label></div>";
                }
            }
            echo $allFImage;
        } else {
            echo -1;
        }
    }
    public function getAllHotelImageInFolder()
    {
        if (helper::checkPostExist(['hotelName'])) {
            $name = helper::convertHotelNameToFolderName([$_POST['hotelName']]);
            $allImage = file_handl::findAllFileInFolder('..\public\uploads\hotel/', [$name[0]]);
            if (!empty($allImage)) {
                foreach ($allImage['filePath'] as $key => $value) {
                    echo  "<div class=' nopad text-center position-relative mr-3'>";
                    echo "<label for='hotelImage-$key'> ";
                    echo "<img class='img-responsive mw-100 mb-3 hotelImg' src='$value' style='width: 120px;height: 100px' />";
                    echo "<input type='checkbox' name='' class='galHotelImage' id='hotelImage-$key'/>";
                    echo "</label>";
                    echo  "</div>";
                }
            }
        } else {
            echo -1;
        }
    }
    public function delHotelImg()
    {
        if (helper::checkPostExist(['data'])) {
            $arr = $_POST['data'];
            $result = $this->HotelModel->delHotelImage($arr, $this->UserName);
            if ($result) {
                echo 1;
            } else {
                echo -1;
            }
        } else {
            echo -1;
        }
    }
    public function delRoomImg()
    {
        if (helper::checkPostExist(['data'])) {
            $arr = $_POST['data'];
            $result = $this->HotelModel->delRoomImage($arr, $this->UserName);
            if ($result) {
                echo 1;
            } else {
                echo -1;
            }
        } else {
            echo -1;
        }
    }
    public function addImageToHotel()
    {
        if (helper::checkPostExist(['data', 'hotelId'])) {
            $arr = $_POST['data'];
            $id = $_POST['hotelId'];
            $result = $this->HotelModel->addNewImage(1, $id, $arr, "");
            echo $result;
        } else {
            echo -1;
        }
    }
    public function addImageToRoom()
    {
        if (helper::checkPostExist(['data', 'hotelId', 'roomId'])) {
            $arr = $_POST['data'];
            $hotelId = $_POST['hotelId'];
            $roomId = $_POST['roomId'];
            $result = $this->HotelModel->addNewImage(2, $hotelId, $arr, $roomId);
            echo $result;
        } else {
            echo -1;
        }
    }
    public function delHotelImgInFolder()
    {
        if (helper::checkPostExist(['data'])) {
            $arr = $_POST['data'];
            $flag = true;
            foreach ($arr as $key => $value) {
                if (!file_exists($value)) {
                    $flag = false;
                } else {
                }
            }
            if ($flag) {
                foreach ($arr as $key => $value) {
                    unlink($value);
                }
                echo 1;
            } else {
            }
        } else {
            echo -1;
        }
    }
    public function getBooking()
    {
        if (helper::checkPostExist(['hotelId'])) {
            $id = $_POST['hotelId'];
            $result = $this->BookingModel->getBooking($id, $this->UserName);
            echo json_encode($result);
        }
    }
    // Lấy mấy cái đếm ở tab chart, bookingDetail
    public function totalBookingDetail()
    {
        if (isset($_POST['id'])) {
            $result = $this->BookingModel->totalBookingDetail($_POST['id'], $this->UserName);
            echo json_encode($result);
        } else {
            echo -1;
        }
    }
    public function countRoomTypeBooked()
    {
        if (isset($_POST['id'])) {
            isset($_POST['filter']) ? $filter = $_POST['filter'] : $filter = [];
            $result = $this->BookingModel->countRoomTypeBooked($_POST['id'], $filter);
            echo json_encode($result);
        } else {
            echo -1;
        }
    }
    // Tính doanh thu
    public function totalRevenue()
    {
        isset($_POST['filter']) ? $filter = $_POST['filter'] : $filter = [];
        $result = $this->RevenueModel->revenueProvider($this->UserName, $filter);
        if (!empty($result)) {
            echo json_encode($result);
        } else {
            echo -1;
        }
    }
    public function countBookingYear()
    {
        if (isset($_POST['year'])) {
            $year = $_POST['year'];
            if ($year > 0 && is_numeric($year)) {
                $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                $result = $this->BookingModel->countBookingYear($year, $this->UserName);
                if ($result) {
                    foreach ($result as $key => $value) {
                        for ($i = 0; $i < 12; $i++) {
                            if ($value['create_date'] == $i + 1) {
                                $data[$i] = $value['num'];
                            }
                        }
                    }
                    echo json_encode($data);
                } else {
                    echo -1;
                }
            } else {
                echo -1;
            }
        } else {
            echo -1;
        }
    }
    public function changeUserInfo()
    {
        if (helper::checkPostExist(['data'])) {
            $data = $_POST['data'];
            $result = $this->UserModel->changeUserInfo($data);
        } else {
            echo -1;
        }
    }
    public function uploadAvatar($name = "")
    {
        if (isset($_FILES['file'])) {
            $file = $_FILES['file'];
            $target_dir = '..\public\uploads\avatar\\';
            $imageFileType = pathinfo($file['name'], PATHINFO_EXTENSION);
            if ($name == "") {
                $newName = $file['name'];
            } else {
                $newName = $name . "-avatar-" . strtotime("now") . "." . $imageFileType;
            }
            if (move_uploaded_file($file['tmp_name'], $target_dir . $newName)) {
                return $newName;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    public function uploadProviderAvatar()
    {
        $upload = $this->uploadAvatar($this->UserName);
        if ($upload) {
            $result = $this->UserModel->uploadUserImg($upload, $this->UserName);
            if ($result) {
                echo 1;
            } else {
                echo -1;
            }
        } else {
            echo -1;
        }
    }
    public function packExtend()
    {
        if (helper::checkPostExist(['data'])) {
            $data = $_POST['data'];
            $result = $this->UserModel->packExtend($data, $this->UserName);
            if ($result) {
                echo 1;
            } else {
                echo -1;
            }
        }
    }
    public function isAllowUpPackage()
    {
        if (isset($_POST['data'])) {
            $data = $_POST['data'];
            if (!empty($data)) {
                if (empty($data['level'])) {
                    $data['level'] = 0;
                }
                $check = $this->UserModel->isAllowUpPackage($data['level'], $data['id']);
                if ($check) {
                    $upData = $data['upPack'];
                    $upPack = $this->UserModel->packExtend($upData, $this->UserName);
                    if ($upPack) {
                        echo 1;
                    } else {
                        echo -1;
                    }
                } else {
                    echo -1;
                }
            }
        } else {
            echo -1;
        }
    }
    public function getHotelFacilitiesById()
    {
        if (isset($_POST['data'])) {
            $data = $_POST['data'];
            if (!empty($data['id'])) {
                isset($data['roomId']) ? $room = $data['roomId'] : $room = "";
                $result = $this->HotelModel->getFacilitiesIdByHotel($this->UserName, $data['id'], $room);
                if ($result || !empty($result)) {
                    echo json_encode($result);
                } else {
                    echo -1;
                }
            } else {
                echo -1;
            }
        } else {
            echo -1;
        }
    }
    public function changeHotelFacilities()
    {
        if (helper::checkPostExist(['hotelId'])) {
            $id = $_POST['hotelId'];
            isset($_POST['update']) ? $update = $_POST['update'] : $update = [];
            isset($_POST['insert']) ? $insert = $_POST['insert'] : $insert = [];
            isset($_POST['room']) ? $room = $_POST['room'] : $room = "";
            $result = $this->HotelModel->changeHotelFacilities($this->UserName, $id, $update, $insert, $room);
            echo 1;
        } else {
            echo -1;
        }
    }
    public function getListRoom()
    {
        if (helper::checkPostExist(['data'])) {
            $data = $_POST['data'];
            $result = $this->HotelModel->GetListRoom($data['id'], $this->UserName);
            echo json_encode($result);
        }
    }
    public function createHotel()
    {
        $data = $_POST['data'];
        $hotelImg = helper::convertHotelNameToFolderName([$data['hotelName']])[0];
        $hotelInfor = [$data['hotelName'], $data['city_name'], $data['district_name'], $data['ward_name'], $data['hotelAddress'], $data['hotelPhoneNum'], $data['hotelEmail'], $data['hotelWebsite'], $data['HotelStar'], $data['HotelDes'], $hotelImg . "." . $data['fileEx'], $this->UserName];
        $result = $this->HotelModel->createNewHotel($hotelInfor);
        if ($result) {
            mkdir("../public/uploads/hotel/" . $hotelImg, 0700);
            echo $hotelImg;
        } else {
            echo -1;
        }
        header("Refresh:0; url=./?ctrl=hotel");
    }
    public function isCreateHotel()
    {
        $result = $this->HotelModel->isAllowCreateHotel($this->UserName);
        if ($result) {
            echo 1;
        } else {
            echo -1;
        }
    }
    public function isAllowCreateRoom()
    {
        if (helper::checkPostExist(['param'])) {
            $result = $this->HotelModel->isAllowCreateRoom($_POST['param'], $this->UserName);
            if ($result) {
                echo 1;
            } else {
                echo -1;
            }
        } else {
            echo -1;
        }
    }
}

<?php

class Hotel extends Controller
{
    public $HotelModel;
    public $UserName;
    public $AjaxModel;
    public $upload;
    public function __construct()
    {
        // Khởi tạo model
        $this->HotelModel = $this->model("HotelModel");
        $this->AjaxModel = $this->model("AjaxModel");
        $this->upload = $this->callClass("upload");
        if (isset($_SESSION['isProvider'])) {
            $this->UserName = $_SESSION['isProvider'];
        } else {
            header('location: ./?ctrl=user');
        }
    }
    // Nếu không truyền act thì gọi hàm 'ListHotel'
    public function
    Default()
    {
        $this->ListHotel();
    }
    // Xem danh sách khách sạn của người quản lý
    public function ListHotel()
    {
        // Gọi view, truyền data từ Model 'HotelModel' và phương thức 'ListHotel'
        $page = 'all-hotel';
        $hotelRating = $this->HotelModel->getAvgRatingByProvider($this->UserName);
        $view = $this->view("master-view", [
            'title' => 'Khách sạn',
            'page' => $page,
            'list' => $this->HotelModel->ListHotel($this->UserName),
            'hotelRating' => $hotelRating,
        ]);
    }

    // Sửa thông tin khách sạn
    public function hotelEdit()
    {
        if (isset($_POST['HotelEdit'])) {
            // Gán tất cả $_POST nhận vào, vào cùng mảng $arr
            $arr = [
                "hotelName", "hotelPhoneNum", "hotelEmail",
                "hotelWebsite", "hotelDes", "hotelAddress", "ward_name", "district_name", "city_name", "HotelStar", "HotelId"
            ];
            if (helper::checkPostExist($arr)) {
                // Gán tất cả giá trị POST tồn tại vào mảng $infor
                $infor = [
                    $_POST['hotelName'], $_POST['hotelPhoneNum'], $_POST['hotelEmail'],
                    $_POST['hotelWebsite'], $_POST['hotelDes'], $_POST['hotelAddress'], $_POST['ward_name'],
                    $_POST['district_name'], $_POST['city_name'], $_POST['HotelStar'], $this->UserName, $_POST['HotelId']
                ];
                // Truyền $infor vào model 'HotelModel' phương thức 'UpdateHotelInfor'
                // Kiểm tra giá trị trả về, nếu đúng thông báo thành công
                // Ngược lại thông báo lỗi
                if ($this->HotelModel->UpdateHotelInfor($infor)) {

                    echo "<script>alert('Cập nhật thành công');</script>";
                } else {
                    echo "<script>alert('Dữ liệu không thay đổi');</script>";
                }
            } else {
                echo "<script>alert('Dữ liệu không thể rỗng');</script>";
            }
            $url = "./?ctrl=hotel&act=hotelEdit&param=" . $_POST['HotelId'];
            header("Refresh:0; url=$url");
        } elseif (helper::checkGetExist(["param"]) && is_numeric($_GET['param'])) {
            // Gán biến
            $hotelId = $_GET['param'];
            // Gọi Model 'HotelModel' và phương thức 'GetOneHotel'
            // Truyên $UserName và $hotelId
            // Lấy tất cả dữ liệu của khách sạn đó, show vào input ở VIEW
            $HotelInfor = $this->HotelModel->GetOneHotel($this->UserName, $hotelId);
            $city_list = $this->HotelModel->GetListAddress(3);
            // Kiểm tra kết quả trả về
            // Gọi view 'Hotel_Edit', truyền vào $data['HotelInfor']
            $page = 'edit-hotel';
            $title = 'Thay đổi thông tin khách sạn';

            $view = $this->view('master-view', [
                'title' => $title,
                'page' => $page,
                "hotel_infor" => $HotelInfor,
                'city' => $city_list
            ]);
        } else {
            header("location: ./?ctrl=hotel");
        }
    }
    // Tạo khách sạn mới
    public function createHotel()
    {
        $page = 'create-hotel';
        $title = 'Tạo khách sạn mới';
        $city_list = $this->HotelModel->GetListAddress(3);
        $view = $this->view('master-view', [
            'title' => $title,
            'page' => $page,
            "city" => $city_list,
        ]);
    }
    // Tạo loại phòng mới
    public function createRoomType()
    {
        if (isset($_POST['createRoomType'])) {
            $checkPost = ['roomtype_name', 'roomtype_count', 'roomtype_guest_limit', 'roomtype_sqm', 'roomtype_dePrice', 'bed_name'];
            if (helper::checkPostExist($checkPost)) {
                $roomInfor = [$_POST['roomtype_name'], $_POST['roomtype_count'], $_POST['roomtype_guest_limit'], $_POST['roomtype_sqm'], $_POST['roomtype_dePrice'], $_POST['bed_name'], $_GET['param'], $this->UserName];
                $result = $this->HotelModel->createRoomType($roomInfor);
                if ($result) {
                    echo "<script>alert('Thêm thành công');</script>";
                } else {
                    echo "<script>alert('Dữ liệu nhập vào lỗi, vui lòng kiểm tra lại');</script>";
                }
            } else {
                echo "<script>alert('Dữ liệu không thể rỗng');</script>";
            }
            header("Refresh:0; url=./?ctrl=hotel&act=listroom&param=" . $_GET['param']);
        } elseif (helper::checkGetExist(['param']) && is_numeric($_GET['param'])) {
            $page = 'create-room-type';
            $title = 'Tạo loại phòng sạn mới';
            $bed_list = $this->HotelModel->getListBed();
            $view = $this->view('master-view', [
                'title' => $title,
                'page' => $page,
                "bed_list" => $bed_list,
            ]);
        } else {
            header("location: ./?ctrl=hotel");
        }
    }
    // Xem danh sách phòng của một khách sạn
    public function ListRoom()
    {
        // Kiểm tra $_GET['param] có tồn tại, set $_GET['param'] là id khách sạn
        if (helper::checkGetExist(["param"]) && is_numeric($_GET['param'])) {
            $HotelId = $_GET['param'];
        }
        // Ngược lại chuyển hướng sang ctrl=hotel
        else {
            header("location: ./?ctrl=hotel");
        }
        // Gọi model 'HotelModel', phương thức 'GetListRoom'
        // Lấy danh sách phòng của một khách sạn có id cho trước
        $result = $this->HotelModel->GetListRoom($HotelId, $this->UserName);
        $getIdRoomByHotelId = $this->HotelModel->getIdRoomByHotelId($this->UserName, $HotelId);
        $getAllRoomInforByHotelId = $this->HotelModel->getAllRoomInforByHotelId($this->UserName, $HotelId);
        $getFacilities4OneHotel = $this->HotelModel->getFacilitiesByHotelId($this->UserName, $HotelId, 4);
        $getFacilities5OneHotel = $this->HotelModel->getFacilitiesByHotelId($this->UserName, $HotelId, 5);
        $getAllRoomImageByHotelId = $this->HotelModel->getAllRoomImageByHotelId($this->UserName, $HotelId);
        $getOneRoomImageByHotelId = $this->HotelModel->getOneRoomImageByHotelId($this->UserName, $HotelId);
        $allRoomChild = $this->HotelModel->getAllRoomChild($this->UserName, $HotelId);
        $allRoomChildInfo = $this->HotelModel->getRoomChildInfo($this->UserName, $HotelId);
        if (isset($allRoomChildInfo[0]['h_name'])) {
            $hotelName = $allRoomChildInfo[0]['h_name'];
            $hotelName = helper::convertHotelNameToFolderName([$hotelName]);
        }
        $page = 'all-room-type';
        $title = 'Loại phòng';
        $view = $this->view('master-view', [
            'page' => $page,
            'title' => $title,
            'room_list' => $result,
            'hotel_id' => $HotelId,
            'list_id_room' => $getIdRoomByHotelId,
            'list_general_infor' => $getAllRoomInforByHotelId,
            'facilities4' => $getFacilities4OneHotel,
            'facilities5' => $getFacilities5OneHotel,
            'all_image' => $getAllRoomImageByHotelId,
            'one_room_image' => $getOneRoomImageByHotelId,
            'allRoomChild' => $allRoomChild,
            'roomChildInfo' => $allRoomChildInfo,
            'hotelName' => @$hotelName[0],

        ]);
    }
    // Sửa thông tin phòng của một khách sạn
    public function RoomEdit()
    {
        if (isset($_POST['RoomEdit'])) {
            // Gán tất cả $_POST nhận vào, vào cùng mảng $arr
            $arr = [
                "RoomName", "RoomCount", "GuestLimit",
                "RoomSqm", "BedName", "DefaultPrice", "id"
            ];
            // Gọi class 'helper' phương thức 'checkPostExist' để kiểm tra giá trị
            // Nếu tất cả POST tồn tại và không rỗng thì tiếp tục
            // Ngược lại báo dữ liệu rỗng và chuyển hướng ngược lại trang sửa thông tin
            if (helper::checkPostExist($arr)) {
                // Gán tất cả giá trị POST tồn tại vào mảng $infor
                $infor = [
                    $_POST['RoomName'], $_POST['RoomCount'], $_POST['GuestLimit'],
                    $_POST['RoomSqm'], $_POST['BedName'], $_POST['DefaultPrice'], $_POST['id'], $this->UserName
                ];
                // Truyền $infor vào model 'HotelModel' phương thức 'UpdateHotelInfor'
                // Kiểm tra giá trị trả về, nếu đúng thông báo thành công
                // Ngược lại thông báo lỗi
                if ($this->HotelModel->UpdateRoomInfor($infor)) {
                    echo "<script>alert('Cập nhật thành công');</script>";
                } else {
                    echo "<script>alert('Dữ liệu không thay đổi');</script>";
                }
            } else {
                echo "<script>alert('Dữ liệu không thể rỗng');</script>";
            }
            // Sau khi kiểm tra chuyển hướng ngược về trang ban đầu
            $url = "./?ctrl=hotel&act=roomedit&param=" . $_POST['id'];
            header("Refresh:0; url=$url");
        } elseif (helper::checkGetExist(["param"]) && is_numeric($_GET['param'])) {
            $roomId = $_GET['param'];
            $result = $this->HotelModel->GetOneRoom($roomId, $this->UserName);
            $bed_list = $this->HotelModel->getListBed();
            $page = 'edit-room-type-form';
            $title = 'Sửa thông tin loại phòng';
            $view = $this->view('master-view', [
                'page' => $page,
                'title' => $title,
                'bed_list' => $bed_list,
                'room_infor' => $result,
            ]);
        }
        // Ngược lại chuyển hướng sang ctrl=hotel
        else {
            header("location: ./?ctrl=hotel");
        }
    }
    public function changeStatus()
    {
        if (helper::checkGetExist(['param'])) {
            $id = helper::separateNumberFromText($_GET['param']);
            $type = helper::separateLetterFromText($_GET['param']);
            if ($type === 'hotel') {
                $result = $this->HotelModel->changeHotelStatus($id, $this->UserName);
            } elseif ($type === 'room') {
                $result = $this->HotelModel->changeRoomStatus($id, $this->UserName);
            } elseif ($type === 'roomchild') {
                $result = $this->HotelModel->changeRoomChildStatus($id, $this->UserName);
            } else {
                header("location: ./?ctrl=hotel");
            }
            if (!empty($result)) {
                echo true;
            } else {
                echo false;
            }
        } else {
            header("location: ./?ctrl=hotel");
        }
    }
    // Room child
    public function listRoomChild()
    {
        if (helper::checkGetExist(['param']) && is_numeric($_GET['param'])) {
            $id = $_GET['param'];
            $page = 'all-room-child';
            $getRoomChildInforByRoomTypeId = $this->HotelModel->getRoomChildInforByRoomTypeId($this->UserName, $id);
            $getPolicyRoomChildByRoomParentId = $this->HotelModel->getPolicyRoomChildByRoomParentId($this->UserName, $id);
            $view = $this->view('master-view', [
                'title' => 'Loại phòng con',
                'page' => $page,
                'room_parent_id' => $id,
                'rc_infor' => $getRoomChildInforByRoomTypeId,
                'rc_policy' => $getPolicyRoomChildByRoomParentId
            ]);
        } else {
            header("location: ./?ctrl=hotel");
        }
    }
    // Create room child
    public function createRoomChild()
    {
        if (isset($_POST['createRoomChild'])) {
        } elseif (helper::checkGetExist(['param'])) {
            $listPoicy = $this->HotelModel->getListPolicy();
            $parentId = helper::getIdParent($listPoicy);
            $view = $this->view('master-view', [
                'title' => "Thêm loại phòng con",
                'page' => "create-room-child",
                'list_policy' => $listPoicy,
                'id_group' => $parentId
            ]);
        } else {
            header("location: ./?ctrl=hotel");
        }
    }
    public function roomChildEdit()
    {
        if (helper::checkGetExist(['param']) && is_numeric($_GET['param'])) {
            $id = $_GET['param'];
            $page = "edit-room-child-form";
            $listPoicy = $this->HotelModel->getListPolicy();
            $parentId = helper::getIdParent($listPoicy);
            $roomChildInfor = $this->HotelModel->getOneRoomChild($this->UserName, $id);
            $roomPolicy = $this->HotelModel->getPolicyOneRoom($this->UserName, $id);
            $roomRate = $this->HotelModel->getRoomRateByRoomChildId($this->UserName, $id);
            $title = "Sửa thông tin loại phòng con";
            $view = $this->view("master-view", [
                'title' => $title,
                'page' => $page,
                'list_policy' => $listPoicy,
                'id_group' => $parentId,
                'room_infor' => $roomChildInfor,
                'room_policy' => $roomPolicy,
                'room_rate' => $roomRate
            ]);
        } else {
            header("location: ./?ctrl=hotel");
        }
    }
    public function ratingOverView()
    {
        $title = "Tổng quan đánh giá";
        $page = "rating-overview";
        $listHotel = $this->HotelModel->ListHotel($this->UserName);
        $view = $this->view("master-view", [
            'title' => $title,
            'page' => $page,
            'listHotel' => $listHotel,
        ]);
    }
    public function countRating()
    {
        if (isset($_POST['id'])) {
            $hotelId = $_POST['id'];
            $data = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
            isset($_POST['year']) ? $year = $_POST['year'] : $year = "";
            $result = $this->HotelModel->countRatingMonth($hotelId, $this->UserName, $year);
            if ($result) {
                foreach ($result as $key => $value) {
                    for ($i = 0; $i < 12; $i++) {
                        if ($value['create_date'] == $i + 1) {
                            $data[$i] = $value['count'];
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
    }
    public function getRatingDetail()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $result = $this->HotelModel->getRatingDetail($id);
            echo json_encode($result);
        } else {
            echo -1;
        }
    }
    public function getAvgRating()
    {
        if (isset($_POST['id'])) {
            $id = $_POST['id'];
            $result = $this->HotelModel->getAvgRating($id);
            echo json_encode($result);
        } else {
            echo -1;
        }
    }
    public function facilities()
    {
        $title = "Quản lý tiện nghi";
        $page = "facilities";
        $listHotel = $this->HotelModel->ListHotel($this->UserName);
        $allHotelFacilities = $this->HotelModel->getAllHotelFacilities();
        $allRoomFacilities = $this->HotelModel->getAllRoomFacilities();
        $view = $this->view("master-view", [
            'title' => $title,
            'page' => $page,
            'allHotelFacilities' => $allHotelFacilities,
            'allRoomFacilities' => $allRoomFacilities,
            'listHotel' => $listHotel
        ]);
    }
}

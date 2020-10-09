<?php
class Media extends Controller
{
    public $HotelModel;
    public $UserName;
    public $AjaxModel;
    public $upload;
    public $rootFile;
    public function __construct()
    {
        // Khởi tạo model
        $this->HotelModel = $this->model("HotelModel");
        $this->AjaxModel = $this->model("AjaxModel");
        $this->upload = $this->callClass("upload");
        $this->rootFile = helper::ROOTF;
        // Gán 'UserName' là SESSION 'isLogin'
        // Nếu không tồn tại SESSION == không đăng nhập --> Chuyển hướng sang trang đăng nhập
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
        $this->managerPhoto();
    }
    public function managerPhoto()
    {
        $page = 'media';
        $allDbHotelImage = [];
        $allDbRoomImage = [];
        $listHotelName = $this->HotelModel->ListHotel($this->UserName);
        if ($listHotelName) {
            $listRoom = $this->HotelModel->GetListRoom(@$listHotelName[array_key_first($listHotelName)]['hotel_id'], $this->UserName);
            $listDbHotelName = $this->HotelModel->getAllImageByHotelId(@$listHotelName[array_key_first($listHotelName)]['hotel_id'], $this->UserName);
            // $listDbRoomName = $this->HotelModel->getRoomImage($listRoom[array_key_first($listRoom)]['r_id'], $this->UserName);
            // Chuyển tên khách sạn sang tên folder
            $imgFName = array_column($listHotelName, "hotel_name");
            $imgFName = helper::convertHotelNameToFolderName($imgFName);
            // Lấy đường dẫn ảnh theo folder một khách sạn
            $allFHotelImage = file_handl::findAllFileInFolder('..\public\uploads\hotel/', [$imgFName[array_key_first($imgFName)]]);
            // kiểm tra và hiện ra những ảnh đang được sử dụng trong csdl
            if (!empty($allFHotelImage['fileName'])) {
                foreach ($allFHotelImage['fileName'] as $allImgKey => $allImgValue) {
                    foreach ($listDbHotelName as $listDbImgKey => $listDbImgValue) {
                        if ($allImgValue === $listDbImgValue['hi_name']) {
                            $allDbHotelImage[$listDbImgValue['hi_id']] =  $allFHotelImage['filePath'][$allImgKey];
                        }
                    }
                }
            }
            $allDbHotelImage = array_unique($allDbHotelImage);
            $view = $this->view("master-view", [
                'title' => 'Quản lý hình ảnh',
                'page' => $page,
                'allHotelImageActive' => $allDbHotelImage,
                'listHotel' => $listHotelName,
                'listRoom' => $listRoom,
            ]);
        } else {
            $view = $this->view("master-view", [
                'title' => 'Quản lý hình ảnh',
                'page' => 'nothing',
            ]);
        }
    }
    public function managerGallery()
    {
        $listHotel = $this->HotelModel->ListHotel($this->UserName);
        if ($listHotel) {
            $imgFName = helper::convertHotelNameToFolderName([$listHotel[0]['hotel_name']]);
            $allFHotelImage = file_handl::findAllFileInFolder('..\public\uploads\hotel/', [$imgFName[0]]);
            $page = "gallery";
            $view = $this->view("master-view", [
                'title' => 'Quản lý lý bộ sưu tập',
                'page' => $page,
                'listHotel' => $listHotel,
                'hotelImage' => $allFHotelImage
            ]);
        }
        else{
            $view = $this->view("master-view", [
                'title' => 'Quản lý hình ảnh',
                'page' => 'nothing',
            ]);
        }
    }
    public function uploadToStore()
    {
        if (isset($_FILES['fileUpload'])) {
            $files = $_FILES['fileUpload'];
            $hotelName = $_POST['hotelName'];
            $hotelName = helper::convertHotelNameToFolderName([$hotelName])[0];
            $target_dir = '..\public\uploads\hotel\\' . $hotelName . "\\";
            for ($i = 0; $i < count($files['name']); $i++) {
                $tmpFile = $files['tmp_name'];
                $name = $files['name'];
                $fileType = pathinfo($name[$i], PATHINFO_EXTENSION);
                $newName = strtotime("now").$i . "_" . $hotelName . '.' . $fileType;
                move_uploaded_file($tmpFile[$i], $target_dir . $newName);
            }
            echo "<script>Tải lên thành công</script>";
        } else {
            echo "<script>Không tìm thấy file</script>";
        }
        header("Refresh:0; url=./?ctrl=media&act=managerGallery");
    }
}

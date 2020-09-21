<?php
class upload
{
    public $rootFile;
    function __construct()
    {
        $this->rootFile = helper::ROOTF;
    }
    public function
    Default()
    {
    }
    public function uploadAvatarHotel($file, $hotelName)
    {
        if (isset($file)) {
            $target_dir = $this->rootFile . '\public\uploads\avatar\\';
            $target_file = $target_dir . basename($file['name']);
            $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
            $maxFileSize = 200000;
            $allowType = ['png', 'jpg', 'jpeg'];
            if (!getimagesize($file['tmp_name'])) {
                return -1;
            }
            if ($file['size'] > $maxFileSize) {
                return -1;
            }
            if (!in_array($imageFileType, $allowType)) {
                return -1;
            }
            $hotelName = helper::replaceOneLetter("-", strtolower($hotelName));
            $newName = strtotime("now") . "_" . $hotelName . '.' . $imageFileType;
            move_uploaded_file($file['tmp_name'], $target_dir . $newName);
            return $newName;
        } else {
            return -1;
        }
    }
    public function isAllowUpload($file)
    {
        $allowType = ['png', 'jpg', 'jpeg'];
        $maxFileSize = 200000;
        // Check name
        for ($i = 0; $i < count($file['name']); $i++) {
            $name = $file['name'];
            $size = $file['size'];
            $error = $file['error'];
            if (!in_array(pathinfo($name[$i], PATHINFO_EXTENSION), $allowType)) {
                return false;
            }
            if ($size[$i] > $maxFileSize) {
                return false;
            }
            if ($error[$i] != 0) {
                return false;
            }
        }
        return true;
    }
}

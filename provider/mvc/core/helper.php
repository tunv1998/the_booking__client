<?php

class helper
{

    const ROOTF = 'D:\xampp\htdocs\provider';
    const BASE_URL = 'http://127.0.0.1/provider';

    public static function replaceSpecialCharacter($text)
    {
        $regex = ['/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'];
        return preg_replace($regex, "", $text);
    }
    public static function getLastContentInUrl($text)
    {
        $repUrl = str_replace("\\", "/", $text);
        $loca = strripos($repUrl, "/");
        $name = substr($text, $loca + 1, strlen($text));
        return $name;
    }
    public static function replaceOneLetter($replace, $string)
    {
        return preg_replace('/\s+/', $replace, $string);
    }
    public static function isLogin()
    {
        if (isset($_SESSION['isProvider'])) {
            return true;
        } else {
            return false;
        }
    }
    public static function checkPostExist($arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            if (isset($_POST[$arr[$i]])) {
                if (empty($_POST[$arr[$i]])) {
                    return false;
                }
            } else {
                return false;
            }
        }
        return true;
    }
    public static function checkGetExist($arr)
    {
        for ($i = 0; $i < count($arr); $i++) {
            if (isset($_GET[$arr[$i]])) {
                if (empty($_GET[$arr[$i]])) {
                    return false;
                }
            } else {
                return false;
            }
        }
        return true;
    }
    public static function getCurrentURL()
    {
        $url = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
        $validURL = str_replace("&", "&amp", $url);
        return $validURL;
    }
    public static function showStar($star)
    {
        $star = floatval($star);
        if (round($star) - $star == 0) {
            for ($i = 0; $i < 5; $i++) {
                if ($i < $star) {
                    echo ' <span class="icon text-warning"><i class="fas fa-star"></i></span>';
                } else {
                    echo ' <span class="icon text-warning"><i class="far fa-star"></i></span>';
                }
            }
        } else {
            for ($i = 1; $i <= 5; $i++) {
                if ($i < $star) {
                    echo ' <span class="icon text-warning"><i class="fas fa-star"></i></span>';
                } else if ($i == round($star)) {
                    echo '<span class="icon text-warning"><i class="fas fa-star-half-alt"></i></span>';
                }
                else{
                    echo ' <span class="icon text-warning"><i class="far fa-star"></i></span>';
                }
            }
        }
    }
    public static function getIdParent($arr)
    {
        $result = [];
        foreach ($arr as $key => $value) {
            array_push($result, $value['group_id']);
        }
        return array_unique($result);
    }
    public static function separateNumberFromText($text)
    {
        return preg_replace('/[^0-9]/', '', $text);
    }
    public static function separateLetterFromText($text)
    {
        return preg_replace('/[^a-zA-Z]/', '', $text);
    }
    public static function checkImageExist($data)
    {
        if (empty($data)) {
            echo "<img class='image rounded mw-100' src='https://www.yourrooms.com/onlineshop/store_00002/image/cache/data/h4-500x500.jpg' alt=''>";
            return true;
        } else {
            return false;
        }
    }
    public static function parseDateTimeToDate($date)
    {
        return date("Y-m-d", strtotime($date));
    }
    public static function convertDateToTextDate($date)
    {
        $arr = explode("-", $date);
        if (substr($arr[1], 0, 1) == 0) {
            $arr[1] = substr($arr[1], 1, 2);
        }
        if (substr($arr[2], 0, 1) == 0) {
            $arr[2] = substr($arr[2], 1, 2);
        }
        return $arr[2] . " tháng " . $arr[1] . " năm " . $arr[0];
    }
    // 

    public static function convertAccentsAndSpecialToNormal($string)
    {
        $table = array(
            'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Ă' => 'A', 'Ā' => 'A', 'Ą' => 'A', 'Æ' => 'A', 'Ǽ' => 'A',
            'à' => 'a', 'á' => 'a', 'ả' => 'a', 'ã' => 'a', 'ạ' => 'a', 'â' => 'a', 'â' => 'a', 'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a', 'ä' => 'a', 'å' => 'a', 'ă' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a', 'ẵ' => 'a', 'ặ' => 'a', 'ā' => 'a', 'ą' => 'a', 'æ' => 'a', 'ǽ' => 'a',

            'Þ' => 'B', 'þ' => 'b', 'ß' => 'Ss',

            'Ç' => 'C', 'Č' => 'C', 'Ć' => 'C', 'Ĉ' => 'C', 'Ċ' => 'C',
            'ç' => 'c', 'č' => 'c', 'ć' => 'c', 'ĉ' => 'c', 'ċ' => 'c',

            'Đ' => 'Dj', 'Ď' => 'D',
            'đ' => 'dj', 'ď' => 'd',

            'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ĕ' => 'E', 'Ē' => 'E', 'Ę' => 'E', 'Ė' => 'E',
            'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ĕ' => 'e', 'ē' => 'e', 'ę' => 'e', 'ė' => 'e',

            'Ĝ' => 'G', 'Ğ' => 'G', 'Ġ' => 'G', 'Ģ' => 'G',
            'ĝ' => 'g', 'ğ' => 'g', 'ġ' => 'g', 'ģ' => 'g',

            'Ĥ' => 'H', 'Ħ' => 'H',
            'ĥ' => 'h', 'ħ' => 'h',

            'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 'İ' => 'I', 'Ĩ' => 'I', 'Ī' => 'I', 'Ĭ' => 'I', 'Į' => 'I',
            'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 'į' => 'i', 'ĩ' => 'i', 'ī' => 'i', 'ĭ' => 'i', 'ı' => 'i',

            'Ĵ' => 'J',
            'ĵ' => 'j',

            'Ķ' => 'K',
            'ķ' => 'k', 'ĸ' => 'k',

            'Ĺ' => 'L', 'Ļ' => 'L', 'Ľ' => 'L', 'Ŀ' => 'L', 'Ł' => 'L',
            'ĺ' => 'l', 'ļ' => 'l', 'ľ' => 'l', 'ŀ' => 'l', 'ł' => 'l',

            'Ñ' => 'N', 'Ń' => 'N', 'Ň' => 'N', 'Ņ' => 'N', 'Ŋ' => 'N',
            'ñ' => 'n', 'ń' => 'n', 'ň' => 'n', 'ņ' => 'n', 'ŋ' => 'n', 'ŉ' => 'n',

            'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ō' => 'O', 'Ŏ' => 'O', 'Ő' => 'O', 'Œ' => 'O',
            'ò' => 'o', 'ó' => 'o', 'ỏ' => 'o', 'õ' => 'o', 'ọ' => 'o', 'ô' => 'o', 'ồ' => 'o', 'ố' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o',  'ờ' => 'o', 'ớ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'ơ' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ō' => 'o', 'ŏ' => 'o', 'ő' => 'o', 'œ' => 'o', 'ð' => 'o',

            'Ŕ' => 'R', 'Ř' => 'R',
            'ŕ' => 'r', 'ř' => 'r', 'ŗ' => 'r',

            'Š' => 'S', 'Ŝ' => 'S', 'Ś' => 'S', 'Ş' => 'S',
            'š' => 's', 'ŝ' => 's', 'ś' => 's', 'ş' => 's',

            'Ŧ' => 'T', 'Ţ' => 'T', 'Ť' => 'T',
            'ŧ' => 't', 'ţ' => 't', 'ť' => 't',

            'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ũ' => 'U', 'Ū' => 'U', 'Ŭ' => 'U', 'Ů' => 'U', 'Ű' => 'U', 'Ų' => 'U',
            'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ũ' => 'u', 'ư' => 'u', 'ứ' => 'u', 'ừ' => 'u', 'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'ū' => 'u', 'ŭ' => 'u', 'ů' => 'u', 'ű' => 'u', 'ų' => 'u',

            'Ŵ' => 'W', 'Ẁ' => 'W', 'Ẃ' => 'W', 'Ẅ' => 'W',
            'ŵ' => 'w', 'ẁ' => 'w', 'ẃ' => 'w', 'ẅ' => 'w',

            'Ý' => 'Y', 'Ÿ' => 'Y', 'Ŷ' => 'Y',
            'ý' => 'y', 'ÿ' => 'y', 'ŷ' => 'y',

            'Ž' => 'Z', 'Ź' => 'Z', 'Ż' => 'Z',
            'ž' => 'z', 'ź' => 'z', 'ż' => 'z',

            '“' => '"', '”' => '"', '‘' => "'", '’' => "'", '•' => '-', '…' => '...', '—' => '-', '–' => '-', '¿' => '?', '¡' => '!', '°' => ' degrees ',
            '¼' => ' 1/4 ', '½' => ' 1/2 ', '¾' => ' 3/4 ', '⅓' => ' 1/3 ', '⅔' => ' 2/3 ', '⅛' => ' 1/8 ', '⅜' => ' 3/8 ', '⅝' => ' 5/8 ', '⅞' => ' 7/8 ',
            '÷' => ' divided by ', '×' => ' times ', '±' => ' plus-minus ', '√' => ' square root ', '∞' => ' infinity ',
            '≈' => ' almost equal to ', '≠' => ' not equal to ', '≡' => ' identical to ', '≤' => ' less than or equal to ', '≥' => ' greater than or equal to ',
            '←' => ' left ', '→' => ' right ', '↑' => ' up ', '↓' => ' down ', '↔' => ' left and right ', '↕' => ' up and down ',
            '℅' => ' care of ', '℮' => ' estimated ',
            'Ω' => ' ohm ',
            '♀' => ' female ', '♂' => ' male ',
            '©' => ' Copyright ', '®' => ' Registered ', '™' => ' Trademark ',
        );
        $string = strtr($string, $table);
        // Currency symbols: £¤¥€  - we dont bother with them for now
        $string = preg_replace("/[^\x9\xA\xD\x20-\x7F]/u", "", $string);
        return $string;
    }
    public static function convertHotelNameToFolderName($arrName)
    {
        for ($i = 0; $i < count($arrName); $i++) {
            $arrName[$i] = strtolower(self::convertAccentsAndSpecialToNormal($arrName[$i]));
            $arrName[$i] = self::replaceOneLetter("-", $arrName[$i]);
        }
        return $arrName;
    }
}

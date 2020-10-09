<?php
class file_handl
{
    public static function findAllFileInFolder($path,$arr2)
    {
        $dir  = new \RecursiveDirectoryIterator($path);
        $dir = new \RecursiveIteratorIterator($dir);
        $arr = [];
        $i = 0;
        foreach ($dir as $key => $value) {
            $file_name = $value->getFilename();
            $file_sub_path = $dir->getSubPath();
            $file_path = $value->getPathname();
            if ($file_name[0] === '.') {
                continue;
            }
            if (in_array($file_sub_path, $arr2)) {
                $arr['fileName'][$i] = $file_name;
                $arr['subPath'][$i] = $file_sub_path;
                $arr['filePath'][$i] = $file_path;
            } else {
            }
            $i++;
        }
        return $arr;
    }
}

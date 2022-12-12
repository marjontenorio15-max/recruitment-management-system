<?php
namespace App\Helpers;

class helper{

    public  static function  fileNameChange($path, $fileName){
        if ($pos==strpos($fileName, '.')){
            $name=substr($fileName,0,$pos);
            $extension=substr($fileName, $pos);
        }else{
            $name=$fileName;
        }
        $new_path=$path."/".$name;
        $new_name=$name;
        $counter=0;
        while (file_exists($new_path)){
            $new_name=name."_".$counter.$extension;
            $new_path=$path."/".$new_name;
            $counter++;
        }
        return $new_name;
    }
}

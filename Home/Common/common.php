<?php
function cut_str($sourcestr, $cutlength, $suffix = true)
{
    $returnstr = '';
    $i = 0;
    $n = 0;
    $str_length = strlen($sourcestr); //The number of bytes of the string
    $str_length2 = (strlen($sourcestr) + mb_strlen($sourcestr, 'UTF8')) / 2;
    while (($n < $cutlength) and ($i <= $str_length)) {
        $temp_str = substr($sourcestr, $i, 1);
        $ascnum = ord($temp_str); //Get the ascii code of the $i character in the string
        if ($ascnum >= 224) //If the ASCII bit is higher than 224，
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 3); //根据UTF-8编码规范，将3个连续的字符计为单个字符
            $i = $i + 3; //Actual Byte counts as 3
            $n++; //String length meter 1
        } elseif ($ascnum >= 192) //If the ASCII bit is higher than 192，
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 2); //According to the UTF-8 encoding specification, two consecutive characters are counted as a single character
            $i = $i + 2; //Actual Byte counts as 2
            $n++; //String length meter 1
        } elseif ($ascnum >= 65 && $ascnum <= 90) //If it is a capital letter，
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 1);
            $i = $i + 1; //The actual number of Bytes still counts as 1
            $n++; //But considering the overall aesthetics, capital letters are counted as a high character
        } else //In other cases, including lowercase letters and half-width punctuation,
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 1);
            $i = $i + 1; //The actual number of Bytes is 1
            $n = $n + 0.5; //Lowercase letters and half-width punctuation, etc. are as wide as half a high character...
        }
    }
    $cutlength = $cutlength * 2;
    if ($str_length2 > $cutlength) {
        $returnstr = substr($returnstr, 0, -3);
        if ($suffix) {
            $returnstr = $returnstr . '...'; //Add an ellipsis at the end when it exceeds the length
        }
    }
    return $returnstr;
}

/*Get file path and price（url,point,coin）*/
function parse_price($priceInfo)
{
    $arr = explode(',', $priceInfo);
    $tmpFile = $arr[0];
    $tmpPrice1 = $arr[1];
    $tmpPrice2 = $arr[2];
    $tmpStr = '';
    if ($tmpPrice1) {
        $tmpStr = $tmpPrice1 . "Integral";
    } else if ($tmpPrice2) {
        $tmpStr = $tmpPrice2 . "Gold";
    } else {
        $tmpStr = "Free";
    }

    return $tmpStr;
}
//Get price numbers
function parse_price_num($priceInfo)
{
    $arr = explode(',', $priceInfo);
    $tmpPrice1 = $arr[1];
    $tmpPrice2 = $arr[2];
    $tmpStr = '';
    if ($tmpPrice1) {
        $tmpStr = $tmpPrice1;
    } else if ($tmpPrice2) {
        $tmpStr = $tmpPrice2;
    } else {
        $tmpStr = $tmpPrice1;
    }

    return $tmpStr;
}

//Get price array
function parse_price_arr($priceInfo){

    $arr = explode(',', $priceInfo);
    $tmpPrice1 = $arr[1] ? $arr[1] : 0;
    $tmpPrice2 = $arr[2] ? $arr[2] : 0;

    return array($tmpPrice1, $tmpPrice2);
}

//Get url from priceInfo
function get_priceinfo_url($priceInfo)
{
    $arr = explode(',', $priceInfo);
    $tmpFile = $arr[0];
    return $tmpFile;
}

//Get software classification
function get_soft_cate($id)
{

    $softCate = array(
        '1' => 'AE template',
        '2' => 'Picture Sound and Picture Shadow',
        '3' => 'Edius',
        '4' => 'Vegas',
        '5' => 'Cinema 4D',
        '6' => 'other'
    );

    if(isset($softCate[$id])){
        return $softCate[$id];
    }else{
        return $softCate[1];
    }
}

function get_catename_by_path($cateList, $path){
    $name = 'template';
    foreach($cateList as $cate){
        if($path == $cate['path'] . '-' . $cate['cid']){
            $name = $cate['name'];
        }
    }

    return $name;
}






 




?>
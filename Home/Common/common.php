<?php
function cut_str($sourcestr, $cutlength, $suffix = true)
{
    $returnstr = '';
    $i = 0;
    $n = 0;
    $str_length = strlen($sourcestr); //字符串的字节数
    $str_length2 = (strlen($sourcestr) + mb_strlen($sourcestr, 'UTF8')) / 2;
    while (($n < $cutlength) and ($i <= $str_length)) {
        $temp_str = substr($sourcestr, $i, 1);
        $ascnum = ord($temp_str); //得到字符串中第$i位字符的ascii码
        if ($ascnum >= 224) //如果ASCII位高与224，
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 3); //根据UTF-8编码规范，将3个连续的字符计为单个字符
            $i = $i + 3; //实际Byte计为3
            $n++; //字串长度计1
        } elseif ($ascnum >= 192) //如果ASCII位高与192，
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 2); //根据UTF-8编码规范，将2个连续的字符计为单个字符
            $i = $i + 2; //实际Byte计为2
            $n++; //字串长度计1
        } elseif ($ascnum >= 65 && $ascnum <= 90) //如果是大写字母，
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 1);
            $i = $i + 1; //实际的Byte数仍计1个
            $n++; //但考虑整体美观，大写字母计成一个高位字符
        } else //其他情况下，包括小写字母和半角标点符号，
        {
            $returnstr = $returnstr . substr($sourcestr, $i, 1);
            $i = $i + 1; //实际的Byte数计1个
            $n = $n + 0.5; //小写字母和半角标点等与半个高位字符宽...
        }
    }
    $cutlength = $cutlength * 2;
    if ($str_length2 > $cutlength) {
        $returnstr = substr($returnstr, 0, -3);
        if ($suffix) {
            $returnstr = $returnstr . '...'; //超过长度时在尾处加上省略号
        }
    }
    return $returnstr;
}

/*获取文件路径和价格（url,point,coin）*/
function parse_price($priceInfo)
{
    $arr = explode(',', $priceInfo);
    $tmpFile = $arr[0];
    $tmpPrice1 = $arr[1];
    $tmpPrice2 = $arr[2];
    $tmpStr = '';
    if ($tmpPrice1) {
        $tmpStr = $tmpPrice1 . "积分";
    } else if ($tmpPrice2) {
        $tmpStr = $tmpPrice2 . "金币";
    } else {
        $tmpStr = "免费";
    }

    return $tmpStr;
}
//获取价格数字
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

//获取价格数组
function parse_price_arr($priceInfo){

    $arr = explode(',', $priceInfo);
    $tmpPrice1 = $arr[1] ? $arr[1] : 0;
    $tmpPrice2 = $arr[2] ? $arr[2] : 0;

    return array($tmpPrice1, $tmpPrice2);
}

//从priceInfo中获取url
function get_priceinfo_url($priceInfo)
{
    $arr = explode(',', $priceInfo);
    $tmpFile = $arr[0];
    return $tmpFile;
}

//获取软件分类
function get_soft_cate($id)
{

    $softCate = array(
        '1' => 'AE模板',
        '2' => '绘声绘影',
        '3' => 'Edius',
        '4' => 'Vegas',
        '5' => 'Cinema 4D',
        '6' => '其他'
    );

    if(isset($softCate[$id])){
        return $softCate[$id];
    }else{
        return $softCate[1];
    }
}

function get_catename_by_path($cateList, $path){
    $name = '模板';
    foreach($cateList as $cate){
        if($path == $cate['path'] . '-' . $cate['cid']){
            $name = $cate['name'];
        }
    }

    return $name;
}






 




?>
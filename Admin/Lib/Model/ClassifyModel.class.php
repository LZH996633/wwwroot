<?php

class ClassifyModel extends Model{
   static $Classify;

public function __construct()
{
    self::$Classify = M('classify');

}

    public function getCateList(){
      $cate = self::$Classify->select();

      $list =  $this->erwei($cate);

      return $list;

    }
    Public function erwei($cate,$pid=0){
        $arr=array();
        foreach($cate as $v){
            if($v['pid'] == $pid){
                $v['child']=self::erwei($cate,$v['cid']);
                $arr[]=$v;
            }
        }
        return $arr;

    }

    /**
     * Generate column navigation
     * @return false|mixed|PDOStatement|string|\think\Collection
     */
    public function CreateCate(){
        $where['pid'] = 1;
        //$where['location'] = array('neq',0);
        //Get first-level column information
        $cates = self::$Classify->where($where)->order('location')->select();
       //return value

        return $cates;
    }
    public function getCateName($cid,$cate=array()){

        $where['cid'] = $cid;
        $cates = self::$Classify->where($where)->find();
        $cate[] = $cates['name'];

        if ($cates['pid']=='1'){

            $id = $_COOKIE['cateid'];

            if ($cid!=$id){
                array_pop($cate);
                $cates = self::$Classify->where('cid='.$_COOKIE['cateid'])->find();
                $cate[] = $cates['name'];

                return $cate;
            }else{

                return $cate;
            }

        }else{

            //var_dump($cate);

            return $this->getCateName($cates['pid'],$cate);
        }
        
    }
    
    public function get_hot(){
         $where['pid'] = array('NEQ','1');
         $where['location']='1';
        $hot = self::$Classify->where($where)->select();
       foreach ($hot as $key1=>$value1){
           $pos['pid']=$value1['cid'];
           $hots = self::$Classify->where($pos)->select();
           $hot[$key1][]=$hots;
       }
        return $hot;
     }

    public function getPath($cid){

        //Create query conditions
        $path = self::$Classify->getFieldByCid($cid,'path');

        $result = self::$Classify->where('cid='.$cid)->find();

        if($result['type']=='half'){
            $whole['type'] = 'whole';
            $whole =  self::$Classify->where($whole)->find();
            $cid = $whole['cid'];
        }

        //Work path
        $path = $path.'-'.$cid;

        return $path;
    }
   
    public function getThirdCate($cid){

        $where['cid']=$cid;
        $cate = self::$Classify->where($where)->find();


        if($cate['type']=='half'){

            //Half-price template call full-price template
            $whole['type'] = 'whole';
            $cate = self::$Classify->where($whole)->find();
        }

        if ($cate['pid']=='1'){
            //var_dump($cate['pid']);
            $cateList= self::$Classify->where('pid='.$cate['cid'])->select();
            //var_dump($cateList);
            foreach ($cateList as $key1=>$value1){
                $cateSort= self::$Classify->where('pid='.$value1['cid'])->select();
                $cateList[$key1]['third']=$cateSort;
            }
            return $cateList;
        }
       else{
            //var_dump($cate['pid']);
           return $this->getThirdCate($cid=$cate['pid']);
        }

       

    }
    public function findOne($where){

        $info = self::$Classify->where($where)->find();
        return $info;

    }



}
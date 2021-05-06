<?php
// 本类由系统自动生成，仅供测试用途
class ClassifyAction extends CommonAction {
    /**
     * 栏目显示
     */
    public function index(){
		$Class = new ClassifyModel();

		$List = $Class->getCateList($pid='0');

		$this->assign('list',$List);
		$this->display();
	}

    /**
     * 添加栏目
     */
	public function addclass(){
      $Class = M('classify');
        if ($_POST['name']){
            $cid = $_POST['cid'];
            $name= $_POST['name'];

            $path = $Class->where(array('cid'=>$cid))->getField('path');

            $path = $path.'-'.$cid;

            $data = array(
                'pid'=>$cid,
                'name'=>$name,
                'type'=>'com',
                'path'=>$path
            );

            $result =$Class->data($data)->add();
            if($result){
                $this->redirect('Classify/index');
            }else{
                $this->redirect('Classify/index','','2','添加失败');
            }
        }else{
            $this->redirect('Classify/index');
        }

		
	}

    /**
     * 修改栏目
     */
	public function updateclass(){
        $Class = M('classify');
        if ($_POST['name']){
            $cid = $_POST['cid'];
            $name= $_POST['name'];

            $data = array(
               'name'=>$name,

            );
         $result =$Class->where(array('cid'=>$cid))->data($data)->save();
            if($result){
                $this->redirect('Classify/index');
            }else{
                $this->redirect('Classify/index','','2','修改失败');
            }
        }else{
            $this->redirect('Classify/index');
        }
	}

    /**
     * 删除栏目
     */
	function delclass(){
	    if($_POST['cid']){
	        var_dump($_POST);

	        $Class = M('classify');
	        $Opus = M('opus');

            $cid = $_POST['cid'];
            $path = $Class->where(array('cid'=>$cid))->getField('path');
            $path_o = $path.'-'.$cid;

              $where['path'] = array('like',$path_o.'%');
              $where['cid'] = $cid;
              //var_dump($where);
              $where_o['opus_sort'] =  array('like',$path_o.'%');var_dump($where_o);
            // var_dump($where);
             $Opus->where($where_o)->delete();


            $result = $Class->where($where)->delete();

            if($result){
                $this->redirect('Classify/index');
            }else{
                $this->redirect('Classify/index','','2','删除失败');
            }
        }else{
            $this->redirect('Classify/index');
        }

	}

    Public function erwei($cate,$pid=0){
        $arr=array();
        foreach($cate as $v){
            if($v['pid'] == $pid){
                $v['child']=self::erwei($cate,$v['id']);
                $arr[]=$v;
            }
        }
        return $arr;

    }
     public function sort_index(){
          $Sort = M('sort');
           $list = $Sort->select();

           $arr = $this->erwei($list,$pid=0);

           $list_sort = array();
           $list_other = array();
           foreach ($arr as $key=>$value){
            if(strpos($value['kind'],"ort_")){
                $list_sort[] = $value;
            };
            if(strpos($value['kind'],"ther_")){
                $list_other[] = $value;
            };
    }

         $this->assign(array('list_sort'=>$list_sort,'list_other'=>$list_other));
          //var_dump($list);
         $this->display('Classify/sort');
     }

    /**
     * 删除分类
     */
     public function sort_del(){
         if($_POST){
             $Sort = M('sort');
             $id = $_POST['id'];
             $where_del['id|pid'] = $id;
             $result =  $Sort->where($where_del)->delete();
             if($result){
                 $this->redirect('Classify/sort_index');
             }else{
                 $this->redirect('Classify/sort_index','','2','删除失败！');
             }
         }
     }

    /**
     * 修改分类
     */
     public function sort_update(){
        // var_dump($_POST);
         if($_POST){
             $Sort = M('sort');
             $id = $_POST['id'];
             $name = $_POST['name'];
             $data = array(
                 'name'=>$name
             );
            $result =  $Sort->where(array('id'=>$id))->save($data);

             if($result){
                 $this->redirect('Classify/sort_index');
             }else{
                 $this->redirect('Classify/sort_index','','2','修改失败！');
             }
         }
     }

    /**
     * 添加分类
     */
     public function sort_add(){
         if($_POST){
             $Sort = M('sort');
             $id = $_POST['id'];
             $name = $_POST['name'];
             $kind = $Sort->where(array('id'=>$id))->getField('kind');
             preg_match ('/_([a-zA-Z]+)/',$kind,$need);
             $kind = $need[1];

             $data = array(
                 'name'=>$name,
                 'pid'=>$id,
                 'kind'=>$kind
             );

             $result = $Sort->data($data)->add();

             if($result){
                 $this->redirect('Classify/sort_index');
             }else{
                 $this->redirect('Classify/sort_index','','2','添加失败！');
             }
          }

     }

}
<?php
// 本类由系统自动生成，仅供测试用途
class AdAction extends CommonAction {
    /**
     * Ad Image
     */
    public function index(){

        $Ad = new SysAdsModel();

         if($_GET['p']){
             $p = $_GET['p'];
         }else{
             $p = 1;
         }
        $where['ad_type'] = 2;
        $List = $Ad->getAdList($where,$num='50',$p);

        $this->assign($List);
    	$this->display();
	}
    public function adUpload(){

    	$this->display();
	}

    /**
     * Add to
     */
    public function add(){

      if($this->isPost()){
            $ad = M('sys_ads');
            $data = $_POST;
            $type = $_POST['ad_type'];
            $ret = $ad->add($data);
            if($ret){
                $this->redirect('Ad/add?type='.$type);
            }else{
                $this->redirect('Ad/add?type='.$type,'','2','add failed');
            }
        }else{
          $type = $_GET['type'];
          if($type==1){
              $select = array(
                  array(
                      'value'=>'station_banner',
                      'html'=>'Site-Homepage Carousel Picture (5)'
                  ),
                  array(
                      'value'=>'station_logo',
                      'html'=>'Site-logo(1)'
                  ),
                  array(
                      'value'=>'station_jump',
                      'html'=>'Site-Jump page (1)'
                  ),

              );

          }elseif($type==2){
              $select = array(
                  array(
                      'value'=>'ad_user',
                      'html'=>'Site-Jump page (3)'
                  ),
                  array(
                      'value'=>'ad_down',
                      'html'=>'Site-Jump page (3)'
                  )
              );
          }

          $this->assign(array('ad_type'=>$type,'select'=>$select));
          $this->display();
        }

    }

    /**
     * edit
     */
    public function edit(){
        $ad = M('sys_ads');
        $id = $_GET['id'];
        //var_dump($id);
        if($id){

            $info = $ad->where('ad_id='.$id)->find();
        }

            if($_POST){
               // var_dump($_POST);die;
                $id = $_POST['ad_id'];
                $new_url =$_POST['ad_pic'];
                $url = $ad->where(array('ad_id'=>$id))->getField('ad_pic');
                if($new_url!=$url){
                    $path = $_SERVER['DOCUMENT_ROOT'].$url;

                    unlink($path);
                }

                $ret = $ad->where('ad_id='.$id)->save($_POST);
                if($ret){
                    $this->redirect('Ad/edit?id='.$id);
                }else{
                    $this->redirect('Ad/edit?id='.$id,'','2','Edit failed');
                }
            }else{
                $this->assign('ad', $info);
                $this->display();
            }

    }
    public function del(){
        //var_dump($_POST);die;
        if($_POST){
            $Ad = M('sys_ads');
            $select = $_POST['select'];
            $where['ad_id'] = array('in',$select);

            $filelist = $Ad->where($where)->select();
            foreach ($filelist as $key=>$value) {
                $file_list[] = $value['ad_pic'];
            }
            foreach ($file_list as $key=>$value){
                $path = $_SERVER['DOCUMENT_ROOT'].$value;
                unlink($path);
            }

          $result = $Ad->where($where)->delete();
           //var_dump($Ad->_sql());die;
            if($result){
                if($_POST['type']=='2'){
                    $this->redirect('Ad/index');
                }elseif($_POST['type']=='1'){
                    $this->redirect('Ad/station');
                }

            }else{
                if($_POST['type']=='2'){
                    $this->redirect('Ad/index','','2','Failed to delete');
                }elseif($_POST['type']=='1'){
                    $this->redirect('Ad/station','','2','Failed to delete');
                }
            }

       }
     }

    /**
     * Site pictures
     */
    public function station(){
        $Ad = new SysAdsModel();

        if($_GET['p']){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
        $where['ad_type'] = 1;
        $List = $Ad->getAdList($where,$num='60',$p);

        $this->assign($List);
        $this->display();

    }
}
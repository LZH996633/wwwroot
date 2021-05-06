<?php
// 本类由系统自动生成，仅供测试用途
class AdAction extends CommonAction {
    /**
     * 广告图片
     */
    public function index(){

        $Ad = new SysAdsModel();

         if($_GET['p']){
             $p = $_GET['p'];
         }else{
             $p = 1;
         }
        $where['ad_type'] = 2;
        $List = $Ad->getAdList($where,$num='5',$p);

        $this->assign($List);
    	$this->display();
	}
    public function adUpload(){

    	$this->display();
	}

    /**
     * 添加
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
                $this->redirect('Ad/add?type='.$type,'','2','添加失败');
            }
        }else{
          $type = $_GET['type'];
          if($type==1){
              $select = array(
                  array(
                      'value'=>'station_banner',
                      'html'=>'站点-首页轮播图（5）'
                  ),
                  array(
                      'value'=>'station_logo',
                      'html'=>'站点-logo（1）'
                  ),
                  array(
                      'value'=>'station_jump',
                      'html'=>'站点-跳转页面（1）'
                  ),

              );

          }elseif($type==2){
              $select = array(
                  array(
                      'value'=>'ad_user',
                      'html'=>'广告-用户中心（3）'
                  ),
                  array(
                      'value'=>'ad_down',
                      'html'=>'广告-下载页面（1）'
                  )
              );
          }

          $this->assign(array('ad_type'=>$type,'select'=>$select));
          $this->display();
        }

    }

    /**
     * 编辑
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
                    $this->redirect('Ad/edit?id='.$id,'','2','编辑失败');
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
                    $this->redirect('Ad/index','','2','删除失败');
                }elseif($_POST['type']=='1'){
                    $this->redirect('Ad/station','','2','删除失败');
                }
            }

       }
     }

    /**
     * 站点图片
     */
    public function station(){
        $Ad = new SysAdsModel();

        if($_GET['p']){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }
        $where['ad_type'] = 1;
        $List = $Ad->getAdList($where,$num='6',$p);

        $this->assign($List);
        $this->display();

    }
}
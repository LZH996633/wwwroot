<?php
class SingleAction extends CommonAction{







    /**
     * 关于我们
     */
    public function aboutUS(){

        /*公共头尾引用*/
        $Public = new PublicAction();
        $Public->header();
        $Public->footer();
        /*公共头尾引用结束*/
        $index =I('show');
       
        if($index==''){
            $index = '0';
        }
      $this->assign(array('index'=>$index));
        
        $about=M('single')-> where(array('name'=>'about')) -> getField('content');
        $this->assign('about',$about);
        
        
        
        
        $this->display('Single/about');
    }



    
    /**
     * 开店
     */
    public function shopUS(){

        /*公共头尾引用*/
        $Public = new PublicAction();
        $Public->header();
        $Public->footer();
        /*公共头尾引用结束*/
        $index =I('shop');
       
        if($index==''){
            $index = '0';
        }
      $this->assign(array('index'=>$index));
        
        $about=M('single')-> where(array('name'=>'about')) -> getField('content');
        $this->assign('about',$about);
        
        
        
        
        $this->display('Single/shop');
    }









    /**
     * 个人主页
     */
    public function personal(){
        /*公共头尾引用*/
        $Public = new PublicAction();
        $Public->header();
        $Public->footer();

        //获取传值
        $user_id = I('user_id');

        //实例化模型
        $User = new UserModel();
        $Opus = new OpusModel();

        //查询操作
        /*分页*/
        if($_GET['p']==''){
            $p = 1;
        }else{
            $p = $_GET['p'];
        }
        /*查询条件*/
        $where['user_id'] = $user_id;
        /*个人信息*/
        $user_info = $User->getUserInfo(array('user_id'=>$user_id));
        
        /*作品信息*/
        $opus_list_show = $Opus->getOpusList($path='',$order='',$where,$num='8',$p);
        
        $count = $opus_list_show['count'];
        $page = $opus_list_show['page'];
        $opus_list = $opus_list_show['list'];

             
        $this->assign(array('user_info'=>$user_info,'count'=>$count,'page'=>$page,'opus_list'=>$opus_list));

        $this->display('Single/personal');
    }

    /**
     * 协议
     */
    public function agreement(){
        /*公共头尾引用*/
        $Public = new PublicAction();
        $Public->header();
        $Public->footer();
        $agreement=M('single')-> where(array('name'=>'agreement')) -> getField('content');

        
        $this->assign('agreement',$agreement);
        $this->display('Single/agreement');
    }
    
}
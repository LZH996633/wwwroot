<?php
class SingleAction extends CommonAction{







    /**
     * about Us
     */
    public function aboutUS(){

        /*Public citation*/
        $Public = new PublicAction();
        $Public->header();
        $Public->footer();
        /*End of common head and tail reference*/
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
     * Become a seller
     */
    public function shopUS(){

        /*Public citation*/
        $Public = new PublicAction();
        $Public->header();
        $Public->footer();
        /*End of common head and tail reference*/
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
     * Homepage
     */
    public function personal(){
        /*Public citation*/
        $Public = new PublicAction();
        $Public->header();
        $Public->footer();

        //Get pass value
        $user_id = I('user_id');

        //Instantiate model
        $User = new UserModel();
        $Opus = new OpusModel();

        //Query operation
        /*Pagination*/
        if($_GET['p']==''){
            $p = 1;
        }else{
            $p = $_GET['p'];
        }
        /*Query conditions*/
        $where['user_id'] = $user_id;
        /*Personal information*/
        $user_info = $User->getUserInfo(array('user_id'=>$user_id));
        
        /*Work information*/
        $opus_list_show = $Opus->getOpusList($path='',$order='',$where,$num='50',$p);
        
        $count = $opus_list_show['count'];
        $page = $opus_list_show['page'];
        $opus_list = $opus_list_show['list'];

             
        $this->assign(array('user_info'=>$user_info,'count'=>$count,'page'=>$page,'opus_list'=>$opus_list));

        $this->display('Single/personal');
    }

    /**
     * protocol
     */
    public function agreement(){
        /*Public citation*/
        $Public = new PublicAction();
        $Public->header();
        $Public->footer();
        $agreement=M('single')-> where(array('name'=>'agreement')) -> getField('content');

        
        $this->assign('agreement',$agreement);
        $this->display('Single/agreement');
    }
    
}
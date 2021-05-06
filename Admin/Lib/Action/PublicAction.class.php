
<?php
// 本类由系统自动生成，仅供测试用途
class PublicAction extends CommonAction {
    public function top(){
        Load('extend');

        $Chat = M('chat');
        $where['chat_from'] = '2';
        $where['chat_state'] = '1';
        $num = $Chat->where($where)->count();

        $where_back['chat_from']='1';
        $where_back['chat_state'] = '1';

        $num_back = $Chat->where($where_back)->count();

        $this->assign('num_back',$num_back);$this->assign('num',$num);
    	$this->display();
	 }
	public function left(){

    	$this->display();
    }
    public function search(){

        $this->display();
    }

	public function footer(){		

    	$this->display();
    }

    /**
    * 管理员登录
    */  
    public function login() {
        if (session('admin_id')){
            $this->redirect('Index/index');
        }

        $reurl =urlencode($_GET['reurl']); //地址加密 
        $this->assign('reurl',$reurl);
        $this->display();
    }

    public function dologin() {

        session('admin_name',null);
        session('admin_id',null);
        cookie('admin_pic',null);
        $reurl = $_GET['reurl'];

        $map['admin_username']= I('admin_name');
        $map['admin_password']= md5(I('pwd'));
        
        $useruid = M('sys_admin')->where($map)->find();

    // echo "<pre>";
    // print_r($useruid);
    // //echo $Services->getLastSql();
    // exit();

        if($useruid){
            //管理员登录成功
            session('admin_name',$useruid["admin_username"]);
            session('admin_id',$useruid["admin_id"]); 
            cookie('admin_pic',$useruid["admin_pic"]);

            $data = array(
                'lasttime' => time(),
                'lastip' => get_client_ip(),
            );
            M('sys_admin')->where("admin_id=".session('admin_id'))->save($data);
            
            header("location:?m=Index&a=index");
            // header("location:".$reurl);
        } else {
            // $this->redirect('Public/login', array('cate_id' => 2), 3, '错误！页面跳转中...');
            $this->error('用户名或密码不对！',U('Public/login'));
        }        
    }       

    /**
    * 管理员退出
    */  
    public function logout(){
        session_destroy();
        cookie('admin_pic',null);

        $this->redirect("Public/login");
    }
 

}
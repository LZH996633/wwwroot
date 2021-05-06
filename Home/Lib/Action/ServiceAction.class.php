<?php
header('Content-Type:text/html;charset=UTF-8');
// 本类由系统自动生成，仅供测试用途
class ServiceAction extends CommonAction {

	public $action=null;
	public function _initialize() {
		parent::_initialize();
        //加载扩展函数库 上传
        vendor('sliver.upload');
    }
	public function show(){
		var_dump(cookie('de'));
	}


	/**
	 * 页面切换请求
	 */
	public function Ajax(){
		$site = M('sys_config');
		$SiteUrl = $site->where('id=3')->getField('value');

        $action = $_GET['action'];
		$p = $_GET['p'];
		$show = $_GET['show'];

		$order = $_GET['order'];
		$start = $_GET['start'];
		$end = $_GET['end'];
        $opus_id = $_GET['opus_id'];

        
		//$this->$action($_COOKIE['user_id']);
		$show = file_get_contents($SiteUrl."/index.php/Service/".$action."?user_id=".$_COOKIE['user_id'].'&p='.$p.'&show='.$show.'&start='.$start.'&end='.$end.'&order='.$order.'&opus_id='.$opus_id);

		echo "$show";
		//echo "$a";


	}

	/**
	 * 用户中心首页
	 */
    public function index(){



		if (!isset($_COOKIE['user_id'])){
			$this->error('尚未登录！',U('Public/loginShow'));
		}

         if(cookie('action_status')== 1 ){
			 $action = cookie('action');
			 	echo "
				<script type='text/javascript'>
				document.cookie='action_status=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
				document.cookie='action=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
                </script>";
			 //echo cookie('action_status');
		 }else{
             $action=null;
         }

		$this->assign(array('action'=> $action));

		$Public = new PublicAction();
		$Public->header();
		$Public->footer();

		$user_id = $_COOKIE['user_id'];
		$where['user_id'] = $user_id;

        $Chat = M('chat');
        $where_chat = array(
            'user_id'=>$user_id,
            'chat_state'=>'1',
            'chat_from'=>'0'
        );
        $msg = $Chat->where($where_chat)->count();

 
        $list1 =  $Chat->where($where_chat)->order('chat_time DESC')->limit(1)->select();		 //倒序显示最新 消息提示
 //   $list1 =  $Chat->where($where_chat,$orderNew)->limit(1)->select();		
		//dump($list1);
	$this->assign(array('list1'=>$list1,'msg'=>$msg));	
	

 //$this->assign(array('msg'=>$msg));

		//获取用户信息
		$User = new UserModel();
		$UserInfo = $User->getUserInfo($where);
		$nickname = $UserInfo['user_nickname'];
		$user_name = $UserInfo['user_name'];
		$gold_coins = $UserInfo['gold_coins'];   //用户中心  L币显示
		$user_veri = $UserInfo['user_veri'];   //用户中心  体现判断	
		$idcard_sta = $UserInfo['idcard_sta'];   //用户中心  实名判断			
		if ($nickname==null){
			$nickname = $user_name;
		}
		$user_pic = $UserInfo['user_pic'];
		//获取用户账户信息
		$UserAccount = new UserAccountModel();
		$UserAcount = $UserAccount->getAcountInfo($where);
		$gold_coin = $UserAcount['gold_coin'];
		//模板赋值
        $this->assign(array('acc_info'=>$UserAcount));
		$this->assign(array('nickname'=>$nickname,'user_name'=>$user_name,'gold_coin'=>$gold_coin,'gold_coins'=>$gold_coins,'idcard_sta'=>$idcard_sta,'user_veri'=>$user_veri,'user_pic'=>$user_pic));
		//用户下载数信息
		$OpusDown = new OpusDownloadModel();
		$DownCount = $OpusDown->getDownCount($where);
		//用户收藏数信息
		$OpusFavor = new OpusFavoriteModel();
		$FavorCount = $OpusFavor->getFavorCount($where);

		$this->assign(array('DownCount'=>$DownCount,'FavorCount'=>$FavorCount));
		
       $Ad = M('sys_ads');
       $ad_list = $Ad->where(array('ad_locationpic'=>'ad_user'))->select();

       $this->assign(array('ad_list'=>$ad_list));
    	$this->display('Service/index');
	 }




	/**
	 * 卖家中心首页
	 */
    public function main(){



		if (!isset($_COOKIE['user_id'])){
			$this->error('尚未登录！',U('Public/loginShow'));
		}

         if(cookie('action_status')== 1 ){
			 $action = cookie('action');
			 	echo "
				<script type='text/javascript'>
				document.cookie='action_status=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
				document.cookie='action=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
                </script>";
			 //echo cookie('action_status');
		 }else{
             $action=null;
         }

		$this->assign(array('action'=> $action));

		$Public = new PublicAction();
		$Public->header();
		$Public->footer();

		$user_id = $_COOKIE['user_id'];
		$where['user_id'] = $user_id;

        $Chat = M('chat');
		$orderNew = 'chat_time DESC';
        $where_chat = array(
            'user_id'=>$user_id,
            'chat_state'=>'1',
            'chat_from'=>'0'
        );
        $msg = $Chat->where($where_chat)->count();
//$query = "select * from userlist where username = '$lune' ORDER BY id DESC LIMIT 1";
        
        $list1 =  $Chat->where($where_chat)->order('chat_time DESC')->limit(1)->select();		 //倒序显示最新 消息提示
 //   $list1 =  $Chat->where($where_chat,$orderNew)->limit(1)->select();		
		//dump($list1);
	$this->assign(array('list1'=>$list1,'msg'=>$msg));	
	

		//获取用户信息
		$User = new UserModel();
		$UserInfo = $User->getUserInfo($where);
		$nickname = $UserInfo['user_nickname'];
		$user_name = $UserInfo['user_name'];
		$gold_coins = $UserInfo['gold_coins'];   //用户中心  L币显示
		$user_veri = $UserInfo['user_veri'];   //用户中心  L币显示	
		$idcard_sta = $UserInfo['idcard_sta'];   //用户中心  L币显示			
		if ($nickname==null){
			$nickname = $user_name;
		}
		$user_pic = $UserInfo['user_pic'];
		//获取用户账户信息
		$UserAccount = new UserAccountModel();
		$UserAcount = $UserAccount->getAcountInfo($where);
		$gold_coin = $UserAcount['gold_coin'];
		//模板赋值
        $this->assign(array('acc_info'=>$UserAcount));
		$this->assign(array('nickname'=>$nickname,'user_name'=>$user_name,'gold_coin'=>$gold_coin,'gold_coins'=>$gold_coins,'user_veri'=>$user_veri,'idcard_sta'=>$idcard_sta,'user_pic'=>$user_pic));

		//用户下载数信息
		$OpusDown = new OpusDownloadModel();
		$DownCount = $OpusDown->getDownCount($where);
		//用户收藏数信息
		$OpusFavor = new OpusFavoriteModel();
		$FavorCount = $OpusFavor->getFavorCount($where);

		$this->assign(array('DownCount'=>$DownCount,'FavorCount'=>$FavorCount));
		
       $Ad = M('sys_ads');
       $ad_list = $Ad->where(array('ad_locationpic'=>'ad_user'))->select();
	   
	   
	   

	   
		          $user = M('user');
		   
		    $SameList = $user->where('user_nickj=0')->limit('0,5')->select();
			
		
		$a=date ( 'Y-m-d H:i:s');
		$d=date ( 'Y-m-d H:i:s',time()-3600*24*30);
		$where = array($d,$a);
		$opus = M('opus');
	   $SameList1 = $opus->where(array('opus_createtime'=>array('between',$where),'opus_verify'=>'1')) ->find();  //近30天更新作品数查询
    $SameList1 = count($SameList1);
		//dump(count($SameList1));
     //   return $SameList1;   
	//    $this->assign(array('SameList'=>$SameList,'SameList1'=>$SameList1));   
	   
	   
	   
	   

       $this->assign(array('ad_list'=>$ad_list,'SameList'=>$SameList,'SameList1'=>$SameList1));
    	$this->display('Service/main');
	 }
	 
	 


/**
	 * 用户中心首页 导航
	 */
    public function userheader(){



		if (!isset($_COOKIE['user_id'])){
			$this->error('尚未登录！',U('Public/loginShow'));
		}

         if(cookie('action_status')== 1 ){
			 $action = cookie('action');
			 	echo "
				<script type='text/javascript'>
				document.cookie='action_status=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
				document.cookie='action=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
                </script>";
			 //echo cookie('action_status');
		 }else{
             $action=null;
         }

		$this->assign(array('action'=> $action));

		$Public = new PublicAction();
		$Public->header();
		$Public->userheader();
		$Public->footer();

		$user_id = $_COOKIE['user_id'];
		$where['user_id'] = $user_id;

        $Chat = M('chat');
        $where_chat = array(
            'user_id'=>$user_id,
            'chat_state'=>'1',
            'chat_from'=>'0'
        );
        $msg = $Chat->where($where_chat)->count();

        $this->assign(array('msg'=>$msg));

		//获取用户信息
		$User = new UserModel();
		$UserInfo = $User->getUserInfo($where);
		$nickname = $UserInfo['user_nickname'];
		$user_name = $UserInfo['user_name'];
		$gold_coins = $UserInfo['gold_coins'];   //用户中心  L币显示
		$user_veri = $UserInfo['user_veri'];   //用户中心  体现判断	
		$idcard_sta = $UserInfo['idcard_sta'];   //用户中心  实名判断			
		if ($nickname==null){
			$nickname = $user_name;
		}
		$user_pic = $UserInfo['user_pic'];
		//获取用户账户信息
		$UserAccount = new UserAccountModel();
		$UserAcount = $UserAccount->getAcountInfo($where);
		$gold_coin = $UserAcount['gold_coin'];
		//模板赋值
        $this->assign(array('acc_info'=>$UserAcount));
		$this->assign(array('nickname'=>$nickname,'user_name'=>$user_name,'gold_coin'=>$gold_coin,'gold_coins'=>$gold_coins,'idcard_sta'=>$idcard_sta,'user_veri'=>$user_veri,'user_pic'=>$user_pic));

		//用户下载数信息
		$OpusDown = new OpusDownloadModel();
		$DownCount = $OpusDown->getDownCount($where);
		//用户收藏数信息
		$OpusFavor = new OpusFavoriteModel();
		$FavorCount = $OpusFavor->getFavorCount($where);

		$this->assign(array('DownCount'=>$DownCount,'FavorCount'=>$FavorCount));
		
       $Ad = M('sys_ads');
       $ad_list = $Ad->where(array('ad_locationpic'=>'ad_user'))->select();

       $this->assign(array('ad_list'=>$ad_list));
    	$this->display('Public/userheader');
	 }	 
	 
	 


 
	/**
	 * 卖家中心首页中心首页 导航

	 */
    public function mainheader(){



		if (!isset($_COOKIE['user_id'])){
			$this->error('尚未登录！',U('Public/loginShow'));
		}

         if(cookie('action_status')== 1 ){
			 $action = cookie('action');
			 	echo "
				<script type='text/javascript'>
				document.cookie='action_status=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
				document.cookie='action=;expires=Thu, 01 Jan 1970 00:00:00 GMT;path=/';
                </script>";
			 //echo cookie('action_status');
		 }else{
             $action=null;
         }

		$this->assign(array('action'=> $action));

		$Public = new PublicAction();
		$Public->header();
		$Public->userheader();
		$Public->footer();

		$user_id = $_COOKIE['user_id'];
		$where['user_id'] = $user_id;

        $Chat = M('chat');
        $where_chat = array(
            'user_id'=>$user_id,
            'chat_state'=>'1',
            'chat_from'=>'0'
        );
        $msg = $Chat->where($where_chat)->count();

        $this->assign(array('msg'=>$msg));

		//获取用户信息
		$User = new UserModel();
		$UserInfo = $User->getUserInfo($where);
		$nickname = $UserInfo['user_nickname'];
		$user_name = $UserInfo['user_name'];
		$gold_coins = $UserInfo['gold_coins'];   //用户中心  L币显示
		$user_veri = $UserInfo['user_veri'];   //用户中心  体现判断	
		$idcard_sta = $UserInfo['idcard_sta'];   //用户中心  实名判断			
		if ($nickname==null){
			$nickname = $user_name;
		}
		$user_pic = $UserInfo['user_pic'];
		//获取用户账户信息
		$UserAccount = new UserAccountModel();
		$UserAcount = $UserAccount->getAcountInfo($where);
		$gold_coin = $UserAcount['gold_coin'];
		//模板赋值
        $this->assign(array('acc_info'=>$UserAcount));
		$this->assign(array('nickname'=>$nickname,'user_name'=>$user_name,'gold_coin'=>$gold_coin,'gold_coins'=>$gold_coins,'idcard_sta'=>$idcard_sta,'user_veri'=>$user_veri,'user_pic'=>$user_pic));

		//用户下载数信息
		$OpusDown = new OpusDownloadModel();
		$DownCount = $OpusDown->getDownCount($where);
		//用户收藏数信息
		$OpusFavor = new OpusFavoriteModel();
		$FavorCount = $OpusFavor->getFavorCount($where);

		$this->assign(array('DownCount'=>$DownCount,'FavorCount'=>$FavorCount));
		
       $Ad = M('sys_ads');
       $ad_list = $Ad->where(array('ad_locationpic'=>'ad_user'))->select();

       $this->assign(array('ad_list'=>$ad_list));
    	$this->display('Public/mainheader');
	 }	 
	 















	/**
	 * 页码链接URL修改
	 * @param $page
	 * @return string
	 */
    public function getPageUrl($page){
		//将html转为string
		$page = htmlentities($page);

		//拆分为数组
		$arr = explode(';a',$page);
		//遍历
		foreach ($arr as $key=>$value){
			if ($key!='0'){
				//获取a链接页码
				preg_match("/p\\/([0-9])[\\/\\.]/",$value,$match);
				$page_num = $match[1];

				//替换a链接的href属性
				$rule = "/\\/index.php(\\/((\\w+)|((\\w+)*\\-(\\w+)*\\-(\\w+)*)))*\\.html/";
				$replace = "javascript:change_page($page_num)";
				$arr[$key] = preg_replace($rule,$replace,$value);
			}
		}
		//合并为字符串
		$page = implode(';a',$arr);

		$page = html_entity_decode($page);

		return $page;

}

	/**
	 * 日期查询
	 * @param $data
	 * @param $field
	 * @return mixed
	 */
	public function getDateTime($data,$field){
		$time = explode(',',$data);

		$start_time = $time[0];
		$end_time = $time[1];

		if ($start_time=='' && $end_time==''){

		}
		elseif ($start_time!='' && $end_time==''){
			$where[$field] = array('egt',$start_time);
		}
		elseif ($start_time=='' && $end_time!=''){
			$where[$field] = array('elt',$start_time);
		}
		elseif($start_time!='' && $end_time!=''){
			if ($end_time>$start_time){
				$where[$field] = array('between',$data);
			}elseif($end_time<$start_time){
				$where[$field] = $end_time;
			}else{
				$where[$field] = $start_time;
			}
		}


        return $where;
	}


	/**
	 * 收藏操作
	 * @param $user_id
	 * @param $p
	 */
	public function Collect($user_id,$p){

		$where['user_id'] = $user_id;
        //查询收藏信息
		$Favorite = new OpusFavoriteModel();
		$FavorList = $Favorite->getFavorList($where);

		//获取收藏作品的opus_id
		$id_array =array();
		foreach($FavorList as $key=>$value ){
			$id_array[]=$value['opus_id'];
		}

		//获取收藏作品的详情信息
		$where = null;
		$where['opus_id'] = array('in',$id_array);

		$Opus = new OpusModel();
		$ListShow =$Opus->getOpusList($path='',$oder='',$where,$num='8',$p);

		$page = $ListShow['page'];
		$page = $this->getPageUrl($page);

		$count = $ListShow['count'];
		$FavorList = $ListShow['list'];


		$this->assign(array('page_collect'=>$page,'FavorList'=>$FavorList,'count_collect'=>$count));

}

	/**
	 * 关注操作
	 * @param $user_id
	 * @param $p
	 */
	public function Focus($user_id,$p){
		$where['user_id'] = $user_id;
		//查询关注信息
		$Focus = new UserFocusModel();
		$FocusList = $Focus->getFocusList($where);

		$id_array = array();
		foreach ($FocusList as $key=>$value){
			$id_array[] = $value['befocus_id'];
		}
		//获取关注用户信息
		$where = null;
		$where['user_id'] = array('in',$id_array);

		$User = new UserModel();
		$ListShow = $User->getUserList($where,$num='10',$p);

		$page = $ListShow['page'];
		$page = $this->getPageUrl($page);

		$count = $ListShow['count'];
		$FocusList = $ListShow['list'];

		$this->assign(array('page_focus'=>$page,'FocusList'=>$FocusList,'count_focus'=>$count));
	}

	/**
	 * 收藏关注页面显示
	 */
	public function CollectFocus(){

        //获取传值
		$user_id = $_GET['user_id'];

		$show = $_GET['show'];
		//页码
		if ($_GET['p']=='') {
			$p = 1;
		} else {
			$p = $_GET['p'];
		}
        
	   if ($show=='1'){
			//显示关注
			$this->Focus($user_id,$p);

		}elseif ($show=='0'){

		   $this->Collect($user_id,$p);

	   }else{
		   $p =1;
		   $show = '0';
		   //显示关注和收藏

		   $this->Collect($user_id,$p);
	   }
		
		//显示表识
      $this->assign('show_project',$show);
		
	  $this->display('Service/Content/collect_focus');
	}


	/**
	 * 下载操作
	 * @param $user_id
	 * @param $p
	 * @param $where
	 */
	public function Download($user_id,$p,$data){
		$time = explode(',',$data);

		$start_time = $time[0];
		$end_time = $time[1];

		//赋值查询时间范围
		$this->assign(array('down_start'=>$start_time,'down_end'=>$end_time));


		$where = $this->getDateTime($data,$field='down_time');

		$where['user_id'] = $user_id;

		$OpusDown = new OpusDownloadModel();

		$DownListShow = $OpusDown->getDownList($where,$num='5',$p);
		//URL转换
		$page = $DownListShow['page'];
		$page = $this->getPageUrl($page);


		$count = $DownListShow['count'];
		$DownList = $DownListShow['list'];

		$this->assign(array('count_download'=>$count,'DownList'=>$DownList,'page_download'=>$page));
		
	}

	/**
	 * 上传操作
	 * @param $user_id
	 * @param $p
	 * @param $where
	 * @param $order
	 */
	public function Upload($user_id,$p,$data,$order){

		$time = explode(',',$data);

		 $start_time = $time[0];
		 $end_time = $time[1];

		//赋值查询时间范围
		 $this->assign(array('up_start'=>$start_time,'up_end'=>$end_time,'up_order'=>$order));

		//构建查询时间条件
		 $where = $this->getDateTime($data,$field='opus_createtime');

         $where['user_id'] = $user_id;
		
		 $Opus = new OpusModel();
//var_dump($$UpList);
		 $OpusList = $Opus->getOpusList($path='',$order,$where,$num=5,$p);
		
		$count = $OpusList['count'];
		$UpList = $OpusList['list'];
		
		$page = $OpusList['page'];
		//var_dump($page);
		$page = $this->getPageUrl($page);
		//dump($page);
		//var_dump($user_id);
		
		$this->assign(array('page_upload'=>$page,'count_upload'=>$count,'UpList'=>$UpList));
		

		
	}

	/**
	 * 下载上传页面显示
	 */
	public function Down_Upload(){

	//	$user_id = $_GET['user_id'];
	
		$show = $_GET['show'];
		$user_id = $_COOKIE['user_id'];
		
		$start_time = $_GET['start'];
		$end_time = $_GET['end'];
		
		$sort = $start_time.','.$end_time;

		$order = $_GET['order'];
		
		//页码
		if ($_GET['p']=='') {
			$p = 1;
		} else {
			$p = $_GET['p'];
		}

		if ($show=='1'){
			//显示上传
			$this->Upload($user_id,$p,$sort,$order);

		}elseif ($show=='0'){
			//显示下载
			$this->Download($user_id,$p,$sort);
		}
		else{
			$show = '0';
			//默认显示下载
			$p =1;
			$this->Download($user_id,$p,$sort);
		}

		//赋值显示标识
		$this->assign('show_project',$show);
		
		$this->display('Service/Content/down_upload');
	}


	public function Ppt_custom($user_id,$p,$sort,$order){
		$time = explode(',',$sort);

		$start_time = $time[0];
		$end_time = $time[1];

		//赋值查询时间范围
		$this->assign(array('start'=>$start_time,'end'=>$end_time,'order'=>$order));

		//构建查询时间条件
		$where = $this->getDateTime($sort,$field='custom_time');
		$where['custom_type'] = '0';
		$where['custom_buyer'] = $user_id;
		if ($order!=''){
			$where['custom_state'] = $order;
		}


		$Custom = new TradeCustomModel();

		$CustomList = $Custom->getCustomList($where,$num=5,$p);

		$count = $CustomList['count'];
		$PptList = $CustomList['list'];
		
		$page = $CustomList['page'];
		$page = $this->getPageUrl($page);
		$this->assign(array('count_ppt'=>$count,'list_ppt'=>$PptList,'page_ppt'=>$page));
	}
	public function Cartoon_custom($user_id,$p,$sort,$order){
		$time = explode(',',$sort);

		$start_time = $time[0];
		$end_time = $time[1];

		//赋值查询时间范围
		$this->assign(array('start'=>$start_time,'end'=>$end_time,'order'=>$order));

		//构建查询时间条件
		$where = $this->getDateTime($sort,$field='custom_time');
		$where['custom_type'] = '1';
		$where['custom_buyer'] =$user_id;
		if ($order!=''){
			$where['custom_state'] = $order;
		}

		$Custom = new TradeCustomModel();

		$CustomList = $Custom->getCustomList($where,$num=5,$p);


		$count = $CustomList['count'];
		$PptList = $CustomList['list'];

		$page = $CustomList['page'];
		$page = $this->getPageUrl($page);
		$this->assign(array('count_car'=>$count,'list_car'=>$PptList,'page_car'=>$page));
	}
	/**
	 * 我的定制页面显示
	 */
	public function MyCustom(){
	//	$user_id = $_GET['user_id'];

		$show = $_GET['show'];

		$user_id = $_COOKIE['user_id'];
		$start_time = $_GET['start'];
		$end_time = $_GET['end'];

		$sort = $start_time.','.$end_time;

		$order = $_GET['order'];

		//页码
		if ($_GET['p']=='') {
			$p = 1;
		} else {
			$p = $_GET['p'];
		}

		if ($show=='1'){
			//显示上传
			$this->Cartoon_custom($user_id,$p,$sort,$order);

		}elseif ($show=='0'){
			//显示下载
			$this->Ppt_custom($user_id,$p,$sort,$order);
		}
		else{
			//默认显示下载
			$p =1;
			$show =  '0';
			$this->Ppt_custom($user_id,$p,$sort,$order);
		}

		//赋值显示标识
		$this->assign('show_project',$show);

      $this->display('Service/Content/my_custom');
	}

	//账户充值
	public function Recharge(){

		$user_id = $_GET['user_id'];
		//账户信息
		$where['user_id'] = $user_id;
		$UserAcc = new UserAccountModel();
		$AccInfo = $UserAcc->getAcountInfo($where);
		$this->assign(array('AccInfo'=>$AccInfo));

		//银行账户显示
        $Admin_account = M('admin_account');
        $ac_list = $Admin_account->select();
        $this->assign(array('ac_list'=>$ac_list));

		$this->display('Service/Account/recharge');
	}

	/**
	 * 入账记录操作
	 * @param $user_id
	 * @param $p
	 * @param $sort
	 * @param $order
	 */
	public function DetailRecharge($user_id,$p,$sort,$order){
		$time = explode(',',$sort);

		$start_time = $time[0];
		$end_time = $time[1];


		//赋值查询时间范围
		$this->assign(array('recharge_start'=>$start_time,'recharge_end'=>$end_time,'order'=>$order));

		//构建查询时间条件
		$where = $this->getDateTime($sort,$field='acct_time');
		$where['user_id'] = $user_id;
		if ($order!=''){
			$where['acct_status'] = $order;
		}

		$UserRecharge = new UserRechargeModel();

		$RechargeListShow = $UserRecharge->getRechargeList($where,$num=5,$p);

		$count = $RechargeListShow['count'];
		$RechargeList = $RechargeListShow['list'];
		$complete = 0;$sum = 0;

		foreach ($RechargeList as $key=>$value){
			$sum = $sum + $value['acct_money'];
			if ($value['acct_status']==3){
				$complete = $complete+$value['acct_money'];
			}
		}
		

		$unfinished = $sum-$complete;
		$page = $RechargeListShow['page'];
		$page = $this->getPageUrl($page);
		


		$this->assign(array('count_recharge'=>$count,'page_recharge'=>$page,'RechargeList'=>$RechargeList,'sum_recharge'=>$sum,'unfinished_recharge'=>$unfinished,'complete_recharge'=>$complete));

		
	}

	public function DetailConsume($user_id,$p,$sort){
		$time = explode(',',$sort);

		$start_time = $time[0];
		$end_time = $time[1];


		//赋值查询时间范围
		$this->assign(array('con_start'=>$start_time,'con_end'=>$end_time));

		//构建查询时间条件
		$where = $this->getDateTime($sort,$field='time');
		$where['user_id'] = $user_id;
		$where['method_status'] = '0';
        $where['method'] = '2';
        $where['over'] = '1';
 
		$Consume = new UserConsumeModel();
		$ConsumeShowList = $Consume->getConsumeList($where,$num=5,$p);
		$count = $ConsumeShowList['count'];

		$ConsumeList = $ConsumeShowList['list'];
		$num_con = 0;
		foreach($ConsumeList as $key=>$value){
			$num_con = $value['money'] + $num_con;
		}

		$page = $ConsumeShowList['page'];
		$page = $this->getPageUrl($page);

		$this->assign(array('count_con'=>$count,'page_con'=>$page,'ConsumeList'=>$ConsumeList,'num_con'=>$num_con));
	}
	public function DetailTotal($user_id,$p,$sort,$order){
		$time = explode(',',$sort);

		$start_time = $time[0];
		$end_time = $time[1];


		//赋值查询时间范围
		$this->assign(array('total_start'=>$start_time,'total_end'=>$end_time,'order'=>$order));

		//构建查询时间条件
		$where = $this->getDateTime($sort,$field='time');
		$where['user_id'] = $user_id;
        $where['over'] = '1';
		if ($order!=''){
			$where['method'] = $order;
		}

		$Consume = new UserConsumeModel();
		$ConsumeShowList = $Consume->getConsumeList($where,$num=5,$p);
		$count = $ConsumeShowList['count'];

		$ConsumeList = $ConsumeShowList['list'];

		$num_income = 0;
		$num_spend = 0;
		$num_total = 0;
		foreach($ConsumeList as $key=>$value){
			if($value['method_status']=='0'){
				$num_spend = $value['money'] + $num_spend;
			}elseif($value['method_status']=='1'){
				$num_income = $value['money'] + $num_income;
			}
			$num_total = $num_total + $value['money'];

		}

		$page = $ConsumeShowList['page'];
		$page = $this->getPageUrl($page);

		$this->assign(array('count_total'=>$count,'page_total'=>$page,'ConsumeTotal'=>$ConsumeList,'num_total'=>$num_total,'income'=>$num_income,'spend'=>$num_spend));
	}
	/**
	 * 账户明细显示
	 */
	public function AccountDetail(){
		$user_id = $_GET['user_id'];
		//账户信息
		$where['user_id'] = $user_id;
		$UserAcc = new UserAccountModel();
		$AccInfo = $UserAcc->getAcountInfo($where);
		$this->assign(array('AccInfo'=>$AccInfo));

		$show = $_GET['show'];


		$start_time = $_GET['start'];
		$end_time = $_GET['end'];

		$sort = $start_time.','.$end_time;

		$order = $_GET['order'];


		//页码
		if ($_GET['p']=='') {
			$p = 1;
		} else {
			$p = $_GET['p'];
		}

		if ($show=='1'){
			//显示消费
			$this->DetailConsume($user_id,$p,$sort);

		}elseif ($show=='0'){
			//显示充值
			$this->DetailRecharge($user_id,$p,$sort,$order);
		}elseif ($show=='2'){

            $this->DetailTotal($user_id,$p,$sort,$order);
		}elseif($show==''){
			$show = '0';
			//默认显示充值
			$p =1;
			$this->DetailRecharge($user_id,$p,$sort,$order);
		}


		//赋值显示标识
		$this->assign('show_project',$show);

		
		
		$this->display('Service/Account/account_detail');
	}
	//账户安全
	public function AccountSafe(){
		$user_id = $_GET['user_id'];
		//账户信息
		$where['user_id'] = $user_id;
		$User = new UserModel();
		$UserInfo = $User->getUserInfo($where);
		$this->assign(array('UserInfo'=>$UserInfo));

		if($_POST){

        }
		
		$this->display('Service/Account/safety');
	}
    /**
	 * 修改密码
	 */
	public function ModifyPass(){
		$user_id = $_COOKIE['user_id'];
		$user_pass = $_POST['password'];
		$new_pass = $_POST['new_password'];

		$where['user_id'] = $user_id;
		$where['user_password'] = md5($user_pass);

		$data['user_password'] = md5($new_pass);

		$User = new UserModel();
		$result = $User->save($where,$data);

		if ($result){
			$this->success('修改成功',U('Service/index'));
		}else{
			$this->error('修改失败',U('Public/ForgetShow'));
		}
	}
	/**
	 * 资料修改显示
	 */
	public function ModifyData(){
		$user_id = $_GET['user_id'];
		$where['user_id'] = $user_id;
		$User = new UserModel();
		$UserInfo = $User->getUserInfo($where);
		
		$this->assign(array('info'=>$UserInfo));



		$this->display('Service/Information/modify_data');

	}

	/**
	 * 站内消息显示
	 */
	public function StationMsg(){
		//  $user_id = $_GET['user_id'];
		$user_id = $_COOKIE['user_id'];
		  $where['user_id'] = $user_id;
		  $where['chat_from'] = '0';
		//页码
		if ($_GET['p']=='') {
			$p = 1;
		} else {
			$p = $_GET['p'];
		}
		  $Chat = new ChatModel();
		  $ChatListShow = $Chat->getChatList($where,$num='5',$p);

		$page = $ChatListShow['page'];
		$page = $this->getPageUrl($page);
		$ChatList = $ChatListShow['list'];
		$count = $ChatListShow['count'];

        $this->assign(array('page'=>$page,'ChatList'=>$ChatList,'count'=>$count));

		$this->display('Service/Information/station_message');
	}


	/**
	 * 卖家实名认证显示
	 */
	public function Renzhengdata(){
		$user_id = $_COOKIE['user_id'];
		$where['user_id'] = $user_id;
		$User = new UserModel();
		$UserInfo = $User->getUserInfo($where);
		
	//	dump($UserInfo);
		
		$this->assign(array('info'=>$UserInfo));



		$this->display('Service/Information/renzheng_data');

	}





	/**
	 * 有问必答显示
	 */
	public function AnswerQuestion(){
	//	$user_id = $_GET['user_id'];
	$user_id = $_COOKIE['user_id'];
		$where['user_id'] = $user_id;
		$where['chat_from'] = '1';
		//页码
		if ($_GET['p']=='') {
			$p = 1;
		} else {
			$p = $_GET['p'];
		}
		$Chat = new ChatModel();
		$ChatListShow = $Chat->getChatList($where,$num='5',$p);

		$page = $ChatListShow['page'];
		$page = $this->getPageUrl($page);
		$ChatList = $ChatListShow['list'];
		$count = $ChatListShow['count'];

		$this->assign(array('page'=>$page,'ChatList'=>$ChatList,'count'=>$count));
		
          $this->display('Service/Information/answer_question');
	}

    //成为卖家
	public function ToBeSeller(){
		if($_POST){
			$name = I('name');
			$qq = I('qq');
			$alipay = I('alipay');
			$bankname = I('bankname');
			$subbankname = I('subbankname');
			$bankid = I('bankid');
			
			$UserAcc = new UserAccountModel();
			$User = new UserModel();

			$user_id = $_COOKIE['user_id'];
			$where['user_id'] = $user_id;
			$data_acc=array(
				'acct_name'=>$name,
			    'acct_bank'=>$bankname,
				'acct_sbank'=>$subbankname,
				'acct_alipay'=>$alipay,
				'acct_account'=>$bankid,
			);
			$data_user = array(
				'user_qq'=>$qq
			);
			$UserAcc->save($where,$data_acc);
			$User->save($where,$data_user);

			$this->success('编辑成功');


			
		}else{
			$user_id = $_COOKIE['user_id'];
		//	$user_id = $_GET['user_id'];
			$User = new UserModel();
			$user_info = $User->getUserInfo(array('user_id'=>$user_id));
				
			
			$UserAcc = new UserAccountModel();
			$info = $UserAcc->getAcountInfo(array('user_id'=>$user_id));
			$this->assign(array('info'=>$info,'user_info'=>$user_info));


			$this->display('Service/Quick/seller');
		}
		
	}
	public function Phone(){
		$this->display('Service/Quick/phone');
	}
			
	//素材上传
	public function MaterialUpload(){
	
		
        /*获取传值*/
             $pid = I('pid');
        if($pid!=''){
            cookie('pid',$pid);
			
		if (!isset($_COOKIE['user_id'])){
			$this->error('尚未登录！',U('Public/loginShow'));
		}			
			
        }

        $cid = $_COOKIE['pid'];

            $cate = M('classify');
			$cate_list = $cate->where(array('pid'=>'1'))->select();
			
		//	dump($cate_list);

			$Public = new PublicAction();
			$Public->header();
		
			$user_id = $_COOKIE['user_id'];
			$where['user_id'] = $user_id;

	
			$Chat = M('chat');
			$orderNew = 'chat_time DESC';
			$where_chat = array(
				'user_id'=>$user_id,
				'chat_state'=>'1',
				'chat_from'=>'0'
			);
			$msg = $Chat->where($where_chat)->count();
			
			$list1 =  $Chat->where($where_chat)->order('chat_time DESC')->limit(1)->select();		 //倒序显示最新 消息提示
		//	dump($list1);
		$this->assign(array('list1'=>$list1,'msg'=>$msg,'cate_list'=>$cate_list));	

			$this->display('Service/materialupload');	

	}

	//素材上传
	public function MaterialUploads(){
	
		if($_POST){

			$post = array();
			foreach($_POST as $key=>$value){
				if ($key!='file'){
					$post[$key]=$value;
				}
			}
			$user_id = $_COOKIE['user_id'];
			if($post['method']=='1'){
				$url = preg_replace('/\//','\\',$post['yuanjian']);
				$down_url ='/index.php/ajax/down?path='.$_SERVER['DOCUMENT_ROOT'].$url;
				$source = $post['yuanjian'];
                $file_url = '';
                $pass = '';
			}elseif ($post['method']==2){
				$down_url = "";
				$file_url = $post['down_url'];
				$pass = $post['pass'];
				$source='';
			}
			if (array_key_exists('is_half',$post)){

				$is_half = '1';
			}else{
				$is_half = '0';
			}
			
			if (array_key_exists('is_type',$post)){
				$is_type = '1';
			}else{
				$is_type = '0';
			}			
			if (array_key_exists('is_type1',$post)){
				$is_type1 = '1';
			}else{
				$is_type1 = '0';
			}						
			if ($is_type1 > $is_type){
				$is_typ = '67';
			}else if($is_type1 < $is_type){
				$is_typ = '66';
			}else if($is_type1 == $is_type){
				$is_typ = '';
			}

			
			
			$data = array(
				'user_id'=>$user_id,
				'opus_title'=>$post['opus_title'],
				'opus_keyword'=>$post['opus_keyword'],
				'price'=>$post['opus_price'],
				//'price'=>'0',
				//'is_half'=>$is_half,
				'is_half'=>'1',
				'tip_use'=>$post['use'],
				'tip_industry'=>$post['industry'],
				'tip_style'=>$post['style'],
				'tip_color'=>$post['color'],
				'tip_software'=>$post['software'],
				'tip_type'=>$is_typ,
				'tip_scale'=>$post['scale'],
				'opus_createip'=>get_client_ip(),
                'opus_video'=>$post['zhanshi'],				
				'opus_pic'=>$post['yulan'],
				'opus_pic_big'=>$post['yulan'],
				'opus_pic_cons'=>$post['yulan1'],	
				'opus_filedown'=>$post['yuanjian'],			
				//'opus_filedown'=>$down_url,
				//'opus_source'=>$source,
				//'opus_fileurl'=>$file_url,
				//'opus_zippass'=>$pass,


				'opus_sort'=>$post['cate'],
				'opus_createtime'=>date('Y-m-d H:i:s'),
				'opus_updatetime'=>date('Y-m-d H:i:s'),
			);

			$Opus = M('opus');
            if($_POST['edit']){

                 $opus_id = $_POST['opus_id'];

                 $info_file = $Opus->where(array('opus_id'=>$opus_id))->find();

                 $file = array(
                     'opus_source'=>$info_file['opus_source'],
                     'opus_pic'=>$info_file['opus_pic'],
                     'opus_big_pic'=>$info_file['opus_big_pic']
                 );
                 foreach ($file as $key=>$value){
                     if($value!=$data[$key]){
                         $path = $_SERVER['DOCUMENT_ROOT'].$value;
                         unlink($path);
                     }
                 }

                $result = $Opus->where(array('opus_id'=>$opus_id))->save($data);

            }else{
                $result = $Opus->data($data)->add();
            }

			if ($result){
				//$this->assign('jumpUrl',"javascript:history.back(-1);");
				$this->success('操作成功'.$down_url,U('Service/index'));

				
				//$this->success('操作成功'.$down_url,U('Service/Close'));
			}else{

				

                $this->error('操作失败',U('Service/Close'));
            }

		}else{
            $sort = M('sort');

		   if($_GET['opus_id']){

		       $Opus = M('opus');
		        $info = $Opus->where(array('opus_id'=>$_GET['opus_id']))->find();
		        //var_dump($info);
		       //栏目
                $path = $info['opus_sort'];
                preg_match('/-([0-9]+)$/',$path,$get);
                $cate_id = $get[1];
                $Cate = M('classify');
                $edit_cate = $Cate->where(array('cid'=>$cate_id))->find();

				$this->assign(array('edit_cate'=>$edit_cate));
	
               //分类
            $tip = array($info['tip_software'],$info['tip_type'],$info['tip_scale'],$info['tip_color'],$info['tip_use'],$info['tip_style'],$info['tip_industry']);
            $edit_sort_list = array();
             foreach ($tip as $key=>$value){
                 $edit_sort = $sort->where(array('id'=>$value))->find();
                 $edit_sort_list[$edit_sort['kind']] = $edit_sort;
             }
             $this->assign(array('edit_list'=>$edit_sort_list));

			   $this->assign(array('info'=>$info));

            }
            $cate = M('classify');
            $cate_list = $cate->where(array('pid'=>'1','type'=>array('neq','half')))->select();
            $this->assign(array('cate_list'=>$cate_list));
            $first = $sort->where(array('pid'=>0))->select();
            foreach ($first as $key=>$value){
                $pid = $value['id'];
                $second = $sort->where(array('pid'=>$pid))->select();
                $value['second'] = $second;
                preg_match('/_([a-zA-Z]+)$/',$value['kind'],$get_kind);
                $value['kind'] = $get_kind[1];
                $first[$key] = $value;
            }
			dump($cate_list);
			
            $this->assign(array('sort_list'=>$first));
			$this->display('Service/material_upload');		
			

		}	
	
	}










public function Close(){

	    $this->display();
}

public function set_acct(){
    $this->display();
}
	
	
	

}
<?php
class UserModel extends Model{
    static $User;
public function __construct()
{
    self::$User = M('user');
}
   /* public function validate($data){
        $validate = array(
            array('verify','require','验证码必须！'), //默认情况下用正则进行验证
            array('name','','帐号名称已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
            array('value',array(1,2,3),'值的范围不正确！',2,'in'), // 当值不为空的时候判断是否在一个范围内
            array('repassword','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
            array('password','checkPwd','密码格式不正确',0,'function'), // 自定义函数验证密码格式
        );
        self::$User-> setProperty("_validate",$validate);
        $result = self::$User->create();
    }*/
    /**
     * 用户信息分页
     * @param $num
     * @param $Count
     * @return mixed|string
     */
    public function getPage($num,$Count){
        import('ORG.Util.Page');// 导入分页类
        //$count      = $User->where('opus_category="'.$where.'"')->count();// 查询满足要求的总记录数
        $Page = new Page($Count,$num);// 实例化分页类 传入总记录数和每页显示的记录数
        // $page -> setConfig('header','个会员');
        $Page -> setConfig('prev', "<");//(对thinkphp自带分页的格式进行自定义▲▼)
        $Page -> setConfig('next','>');
        $Page -> setConfig('first','首');
        $Page -> setConfig('last','尾');
        $Page -> setConfig('theme',"%first% %upPage% %linkPage% %downPage% %end%");

        $page = $Page->show();

        return $page;
    }

    public function login($data){
        //创建查询条件
        $where['user_name|user_email|user_mobilephone'] = $data['username'];
        $where['user_password'] = md5($data['password']);
           

        //查询用户数据
        $result = self::$User->where($where)->find();

        if ($result){
            if ($result['user_state']=='0'){

               return false;
            }else{
                //登录成功
                //写入cookie
                if ($data['cookie_time']){
                    //记住密码
                    cookie('user_id',$result['user_id']);
                    cookie('is_login',true);
                }else{
                    //一天后失效
                    cookie('user_id',$result['user_id'],3600*24);
                    cookie('is_login',true,3600*24);
                }
                
               return true;
            }
             
            
        }else{

             return false;
        }
       
    }
    
    public function getUserInfo($where){
        
        $UserInfo = self::$User->where($where)->find();
        return $UserInfo;
    }
    
    public function findOne($where){
        $result = self::$User->where($where)->find();
		var_dump($result);
        
        return $result;
    }

	
	public function getUserList($where,$num,$p){
		$count = self::$User->where($where)->count();
		
		$page = $this->getPage($num,$count);
		
		$list = self::$User->where($where)->page($p.','.$num)->select();
		
		foreach($list as $key=>$value){
			
			$acc = M('user_account');
            $gold_coin = $acc->getField('gold_coin');
          //  $gold_coins = $acc->getField('gold_coins');            
           $value['gold_coin']=$gold_coin;
          // $value['gold_coins']=$gold_coins;
          $list[$key]=$value;			
		};
		$ListShow = array('count'=>$count,'page'=>$page,'list'=>$list);
		
		return $ListShow;
		
	}
    /**
     * 创建一条数据
     * @param $data 、添加数据
     * @return bool   true or false
     */
    public function addData($data){
      
        $result = self::$User->data($data)->add();

      if ($result){
            return true;
        }else{
            return false;
        }

    }
    
    public function delData($where){
        self::$User->where($where)->delete();
    }
    public function show(){
		var_dump(12312);
	}
	
		
	
    public function save($where,$data){
        
        $result = self::$User->where($where)->save($data);
        
        return $result;
    }
}
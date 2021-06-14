<?php
class UserModel extends Model{
    static $User;
public function __construct()
{
    self::$User = M('user');
}

    /**
     * User Information Pagination
     * @param $num
     * @param $Count
     * @return mixed|string
     */
    public function getPage($num,$Count){
        import('ORG.Util.Page');// Import pagination class
        //$count      = $User->where('opus_category="'.$where.'"')->count();// Query the total number of records that meet the requirements
        $Page = new Page($Count,$num);// Instantiate the paging class, pass in the total number of records and the number of records displayed on each page
        // $page -> setConfig('header','Members');
        $Page -> setConfig('prev', "<");//(Customize the format of thinkphp's own pagination▲▼)
        $Page -> setConfig('next','>');
        $Page -> setConfig('first','First');
        $Page -> setConfig('last','Last');
        $Page -> setConfig('theme',"%first% %upPage% %linkPage% %downPage% %end%");

        $page = $Page->show();

        return $page;
    }

    public function login($data){
        //Create query conditions
        $where['user_name|user_email|user_mobilephone'] = $data['username'];
        $where['user_password'] = md5($data['password']);
           

        //Query user data
        $result = self::$User->where($where)->find();

        if ($result){
            if ($result['user_state']=='0'){

               return false;
            }else{
                //login successful
                //Write cookie
                if ($data['cookie_time']){
                    //Remember password
                    cookie('user_id',$result['user_id']);
                    cookie('is_login',true);
                }else{
                    //Expires after one day
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
     * Create a piece of data
     * @param $data 、adding data
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
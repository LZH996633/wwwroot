<?php
class InformationAction extends CommonAction{
    /**
     * 发送信息显示
     */
    public function edit(){
        $User = new UserModel();

        if($_GET['p']){
            $p = $_GET['p'];
        }else{
            cookie('admin_search',null);
            $p = '1';
        }
        $where=array();
        if($_POST){
            cookie('admin_search',$_POST['searchop']);
        }
        $search = cookie('admin_search');

        if($search!=null){

            $where['user_name'] = array('like','%'.$search.'%');
            $where['user_nickname'] = array('like','%'.$search.'%');
            $where['user_email'] = array('like','%'.$search.'%');
            $where['user_mobilephone'] = array('like','%'.$search.'%');
            $where['_logic'] = 'or';
        }
        $this->assign(array('search'=>cookie('admin_search')));


        $ListShow = $User->getUserList($where,$num='15',$p);
        foreach ($ListShow['list'] as $key=>$value){
            if($value['user_nickname']==null){
                $value['user_nickname']='暂无';
            }
            $acc = M('user_account');

            $user_money =  $acc->where(array('user_id'=>$value['user_id']))->getField('gold_coin');
            $value['user_money'] = $user_money;
            $ListShow['list'][$key]= $value;
        }

        //var_dump($ListShow);

        $this->assign($ListShow);


        $this->display();
    }

    /**
     * 信息回复
     */
    public function do_edit(){
     //批量发送
     if($_POST['select']){

         $select = $_POST['select'];
         $str='';
         foreach ($select as $key=>$value){
             if($key==0){
                 $str = $value;
             }else{
                 $str = $str.'-'.$value;
             }

         }
         //var_dump($str);
         $this->assign(array('select'=>$str));
     }
     //群发
        if($_GET['all']){
         if($_GET['all']=='true'){
             $User = M('user');
             $list = $User->select();
             $str_all = '';
             foreach ($list as $key=>$value){
                 if($key==0){
                     $str_all = $value['user_id'];
                 }else{
                     $str_all = $str_all.'-'.$value['user_id'];
                 }
             }
             $this->assign(array('select'=>$str_all));
         }
        }
     //单个发送
     if($_GET['id']){
         $id = $_GET['id'];
         $this->assign(array('select'=>$id));
        }
      //发送数据写入
     if($_POST['select_send']){
         $select_send = $_POST['select_send'];
        $select_send =  explode('-',$select_send);

        $title = $_POST['title'];
        $content = $_POST['content'];

        $data = array(
            'chat_title'=>$title,
            'chat_content'=>$content,
            'chat_form'=>'0',
            'chat_state'=>'1',
            'chat_time'=>date('Y-m-d H:i:s')
        );

        $Chat = M('chat');
        foreach ($select_send as $key=>$value){
            $data['user_id'] = $value;
            $Chat->data($data)->add();
        }
         $this->redirect('Information/edit');

     }
      $this->display();
    }

    /**
     * 用户反馈
     */
    public function feedback(){

        $Chat = new ChatModel();

        $User = M('user');
        if($_GET['p']){
            $p = $_GET['p'];
        }else{
            cookie('admin_search',null);
            $p = '1';
        }

        $where=array();
        if($_POST){
            cookie('admin_search',$_POST['searchop']);
        }
        $search = cookie('admin_search');
        $this->assign(array('search'=>cookie('admin_search')));
        if($search!=null){

            $where['user_name'] = array('like','%'.$search.'%');
            $where['user_nickname'] = array('like','%'.$search.'%');
            $where['user_mobilephone'] = array('like','%'.$search.'%');
            $where['_logic'] = 'or';

            $result = $User->where($where)->select();
            $id_list = array();
            if($result){
                foreach ($result as $key=>$value){
                    $id_list = $value['user_id'];
                }
                $where_c['user_id'] = array('in',$id_list);
            }

        }

        $where_c['chat_from']='1';
        // $where_c['chat_state']='1';

        $ListShow = $Chat->getChatList($where_c,$num=10,$p);

        foreach ($ListShow['list'] as $key=>$value){
            $user_info = $User->where(array('user_id'=>$value['user_id']))->find();

            $value['user_name'] = $user_info['user_name'];

            $value['user_nickname'] = $user_info['user_nickname'];
            if($user_info['user_nickname']==null){
                $value['user_nickname'] = '暂无';
            }
            $value['user_mobilephone']= $user_info['user_mobilephone'];


            $ListShow['list'][$key] = $value;
        }

        $this->assign($ListShow);

        $this->assign(array('search'=>cookie('admin_search')));
        $this->display();
    }

    /**
     * 提现信息
     */
    public function Withdrawal(){
        $Acc = M('user_account');
        $User = M('user');
        $Chat = new ChatModel();


        if($_GET['p']){
            $p = $_GET['p'];
        }else{
            cookie('admin_search',null);
            $p = '1';
        }
        $where=array();
        if($_POST){
            cookie('admin_search',$_POST['searchop']);
        }
        $search = cookie('admin_search');
        $this->assign(array('search'=>cookie('admin_search')));
        if($search!=null){

            $where['user_name'] = array('like','%'.$search.'%');
            $where['user_nickname'] = array('like','%'.$search.'%');
            $where['user_mobilephone'] = array('like','%'.$search.'%');
            $where['_logic'] = 'or';

            $result = $User->where($where)->select();
            $id_list = array();
            if($result){
                foreach ($result as $key=>$value){
                    $id_list = $value['user_id'];
                }
                $where_c['user_id'] = array('in',$id_list);
            }

        }

        $where_c['chat_from']='2';
       // $where_c['chat_state']='1';

        $ListShow = $Chat->getChatList($where_c,$num=10,$p);


        foreach ($ListShow['list'] as $key=>$value){
            $user_info = $User->where(array('user_id'=>$value['user_id']))->find();
            $acc_info = $Acc->where(array('user_id'=>$value['user_id']))->find();
            $value['user_name'] = $user_info['user_name'];

            $value['user_nickname'] = $user_info['user_nickname'];
            if($user_info['user_nickname']==null){
                $value['user_nickname'] = '暂无';
            }
            $value['user_mobilephone']= $user_info['user_mobilephone'];
            $value['user_account'] = $acc_info['gold_coin'];

            $ListShow['list'][$key] = $value;
        }

        $this->assign($ListShow);
        $this->assign(array('search'=>cookie('admin_search')));


        $this->display();
    }

    /**
     * 信息删除
     */
    public function del(){
        if($_POST)
        {

            $del = $_POST['select'];
            $Chat=M('chat');
            $data['user_id']=array('in',$del);
            $result = $Chat->where($data)->delete();

           if($result){
               $this->redirect('Information/Withdrawal');
           } else
           {
               $this->redirect('Information/Withdrawal','','2','删除失败！');
           }

        }

    }

    /**
     * 信息回复
     */
    public function replay(){
        $Chat = M('chat');
        if($_POST){
            $replay = $_POST['replay'];
            $id = $_POST['id'];

            $result = $Chat->where(array('id'=>$id))->save(array('chat_replay'=>$replay,'chat_state'=>'3'));
            if($result){
                $this->redirect('Information/feedback');
            } else
            {
                $this->redirect('Information/feedback','','2','回复失败！');
            }

        }else{
            if($_GET['id']){
                $id= $_GET['id'];
                $Chat->where(array('id'=>$id))->save(array('chat_state'=>'2'));
                $info =$Chat->where(array('id'=>$id))->find();
                $this->assign(array('info'=>$info));
            }
        }

        $this->display();
    }
}
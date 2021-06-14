<?php

class InterfaceAction extends CommonAction{

    /**
     * Alipay payment operation
     */
    public function Ali_pay(){

        $post = $_POST;
        $time = time();

        $data_acc=array();$data_id=array();$data_key=array();
        foreach ($post as $key=>$value){
            switch ($key){
                case 'Ali_pay_id':
                    $data_id = ['value'=>$value,'title'=>'Alipay Development ID','name'=>$key,'cate'=>1,'update_time'=>$time];
                    break;
                case 'Ali_pay_acc':
                    $data_acc = ['value'=>$value,'title'=>'Alipay receiving account','name'=>$key,'cate'=>1,'update_time'=>$time];
                    break;
                case 'Ali_pay_key':
                    $data_key = ['value'=>$value,'title'=>'Alipay secret key','name'=>$key,'cate'=>1,'update_time'=>$time];
                    break;
            }

        }
        $data =[$data_id,$data_acc,$data_key] ;

        $config = M('sys_config');

        foreach ($data as $key=>$value){
            $where['name'] = $value['name'];
            $config->where($where)->save($value);

        }
        $this->Ali_pay_form();
    }

    /**
     * Alipay payment information display
     */
    public function Ali_pay_form(){
        $config=M('sys_config');
        $Ali_pay_id=$config-> getFieldByName('Ali_pay_id','value');
        $Ali_pay_key=$config-> getFieldByName('Ali_pay_key','value');
        $Ali_pay_acc=$config-> getFieldByName('Ali_pay_acc','value');


        $this->assign(array('Ali_pay_id'=>$Ali_pay_id,'Ali_pay_key'=>$Ali_pay_key,'Ali_pay_acc'=>$Ali_pay_acc));

        $this->display('Interface/Pay/ali');

    }

    /**
     * WeChat payment operation
     */
    public function WeChat_pay(){

        $post = $_POST;

        $time = time();

        $data_acc=array();$data_id=array();$data_key=array();
        foreach ($post as $key=>$value){
            switch ($key){
                case 'WeChat_pay_id':
                    $data_id = ['value'=>$value,'title'=>'WeChat Development ID','name'=>$key,'cate'=>1,'update_time'=>$time];
                    break;
                case 'WeChat_pay_acc':
                    $data_acc = ['value'=>$value,'title'=>'business number','name'=>$key,'cate'=>1,'update_time'=>$time];
                    break;
                case 'WeChat_pay_key':
                    $data_key = ['value'=>$value,'title'=>'Payment key','name'=>$key,'cate'=>1,'update_time'=>$time];
                    break;
            }

        }
        $data =[$data_id,$data_acc,$data_key] ;

        $config = M('sys_config');

        foreach ($data as $key=>$value){
            $where['name'] = $value['name'];
            //$config->data($data)->add($value);//Add to
           $config->where($where)->save($value);//modify

        }
        $this->WeChat_pay_form();
    }

    /**
     * WeChat payment information display
     */
    public function WeChat_pay_form(){

        $config=M('sys_config');
        $WeChat_pay_id=$config-> getFieldByName('WeChat_pay_id','value');
        $WeChat_pay_key=$config-> getFieldByName('WeChat_pay_key','value');
        $WeChat_pay_acc=$config-> getFieldByName('WeChat_pay_acc','value');


        $this->assign(array('WeChat_pay_id'=>$WeChat_pay_id,'WeChat_pay_key'=>$WeChat_pay_key,'WeChat_pay_acc'=>$WeChat_pay_acc));

        $this->display('Interface/Pay/wechat');
    }

    /**
     * QQ login operation
     */
    public function QQ_login(){

        $post = $_POST;
        $time = time();

        $data_acc=array();$data_id=array();$data_key=array();
        foreach ($post as $key=>$value){
            switch ($key){
                case 'QQ_login_id':
                    $data_id = ['value'=>$value,'title'=>'QQ开发ID','name'=>$key,'cate'=>2,'update_time'=>$time];
                    break;
                case 'QQ_login_key':
                    $data_acc = ['value'=>$value,'title'=>'QQ秘钥','name'=>$key,'cate'=>2,'update_time'=>$time];
                    break;
                case 'QQ_login_callback':
                    $data_key = ['value'=>$value,'title'=>'QQ回调域','name'=>$key,'cate'=>2,'update_time'=>$time];
                    break;
            }

        }
        $data =[$data_id,$data_acc,$data_key] ;

        $config = M('sys_config');

        foreach ($data as $key=>$value){
            $where['name'] = $value['name'];
         //  $config->data($data)->add($value);//Add to
           $config->where($where)->save($value);//modify

        }
        $this->QQ_login_form();
    }

    /**
     * QQ login information display
     */
    public function QQ_login_form(){

        $config=M('sys_config');
        $QQ_login_id=$config-> getFieldByName('QQ_login_id','value');
        $QQ_login_key=$config-> getFieldByName('QQ_login_key','value');
        $QQ_login_callback=$config-> getFieldByName('QQ_login_callback','value');


        $this->assign(array('QQ_login_id'=>$QQ_login_id,'QQ_login_key'=>$QQ_login_key,'QQ_login_callback'=>$QQ_login_callback));


        $this->display('Interface/Login/qq');

    }

    /**
     * WeChat login operation
     */
    public function WeChat_login(){
        $post = $_POST;
        $time = time();

        $data_acc=array();$data_id=array();$data_key=array();
        foreach ($post as $key=>$value){
            switch ($key){
                case 'WeChat_login_id':
                    $data_id = ['value'=>$value,'title'=>'WeChat Development ID','name'=>$key,'cate'=>2,'update_time'=>$time];
                    break;
                case 'WeChat_login_key':
                    $data_acc = ['value'=>$value,'title'=>'WeChat secret key','name'=>$key,'cate'=>2,'update_time'=>$time];
                    break;
                case 'WeChat_login_callback':
                    $data_key = ['value'=>$value,'title'=>'WeChat callback domain','name'=>$key,'cate'=>2,'update_time'=>$time];
                    break;
            }

        }
        $data =[$data_id,$data_acc,$data_key] ;

        $config = M('sys_config');

        foreach ($data as $key=>$value){
            $where['name'] = $value['name'];
            //$config->data($data)->add($value);//Add to
           $config->where($where)->save($value);//modify

        }
        $this->WeChat_login_form();
    }

    /**
     * WeChat login information display
     */

    public function WeChat_login_form(){

        $config=M('sys_config');
        $WeChat_login_id=$config-> getFieldByName('WeChat_login_id','value');
        $WeChat_login_key=$config-> getFieldByName('WeChat_login_key','value');
        $WeChat_login_callback=$config-> getFieldByName('WeChat_login_callback','value');

        $this->assign(array('WeChat_login_id'=>$WeChat_login_id,'WeChat_login_key'=>$WeChat_login_key,'WeChat_login_callback'=>$WeChat_login_callback));

        $this->display('Interface/Login/wechat');
    }



    /**
     * Mail sending operation
     */
    public  function eMail_send(){

        $post = $_POST;
        $time = time();

        $data_acc=array();$data_id=array();$data_key=array();
        $data_sender=array();$data_title=array();$data_content=array();
        $data_port=array();
        foreach ($post as $key=>$value){
            switch ($key){
                case 'eMail_SMTP':
                    $data_id = ['value'=>$value,'title'=>'SMTP server','name'=>$key,'cate'=>3,'update_time'=>$time];
                    break;
                case 'eMail_port':
                    $data_port = ['value'=>$value,'title'=>'SMTP The port number','name'=>$key,'cate'=>3,'update_time'=>$time];
                    break;
                case 'eMail_acc':
                    $data_acc = ['value'=>$value,'title'=>'SMTP account number','name'=>$key,'cate'=>3,'update_time'=>$time];
                    break;
                case 'eMail_key':
                    $data_key = ['value'=>$value,'title'=>'SMTP password','name'=>$key,'cate'=>3,'update_time'=>$time];
                    break;
                case 'eMail_sender':
                    $data_sender = ['value'=>$value,'title'=>'SMTP Sender name','name'=>$key,'cate'=>3,'update_time'=>$time];
                    break;
                case 'eMail_title':
                    $data_title = ['value'=>$value,'title'=>'SMTP title','name'=>$key,'cate'=>3,'update_time'=>$time];
                    break;
                case 'eMail_content':
                    $data_content = ['value'=>$value,'title'=>'SMTP content','name'=>$key,'cate'=>2,'update_time'=>$time];
                    break;
            }

        }
        $data =[$data_id,$data_acc,$data_key,$data_key,$data_content,$data_sender,$data_title,$data_port] ;

        $config = M('sys_config');

        foreach ($data as $key=>$value){
            $where['name'] = $value['name'];
           // $config->data($data)->add($value);//Add to
           $config->where($where)->save($value);//modify

        }
        $this->eMail_send_form();
    }

    /**
     * Email sending information display
     */
    public function eMail_send_form(){

        $config=M('sys_config');
        $eMail_SMTP=$config-> getFieldByName('eMail_SMTP','value');
        $eMail_port=$config-> getFieldByName('eMail_port','value');
        $eMail_acc=$config-> getFieldByName('eMail_acc','value');
        $eMail_key=$config-> getFieldByName('eMail_key','value');
        $eMail_sender=$config-> getFieldByName('eMail_sender','value');
        $eMail_title=$config-> getFieldByName('eMail_title','value');
        $eMail_content=$config-> getFieldByName('eMail_content','value');

        $this->assign(array('eMail_SMTP'=>$eMail_SMTP,'eMail_port'=>$eMail_port,'eMail_acc'=>$eMail_acc,'eMail_key'=>$eMail_key,'eMail_sender'=>$eMail_sender,'eMail_title'=>$eMail_title,'eMail_content'=>$eMail_content));

        $this->display('Interface/Validate/email');
    }

    /**
     * SMS sending operation
     */
    public function SMS_send(){
        $post = $_POST;
        $time = time();

        $data_acc=array();$data_key=array();
        $data_sign=array();$data_location=array();

        foreach ($post as $key=>$value){
            switch ($key){
                case 'SMS_acc':
                    $data_acc = ['value'=>$value,'title'=>'SMS account','name'=>$key,'cate'=>3,'update_time'=>$time];
                    break;
                case 'SMS_key':
                    $data_key = ['value'=>$value,'title'=>'SMS password','name'=>$key,'cate'=>3,'update_time'=>$time];
                    break;
                case 'SMS_sign':
                    $data_sign= ['value'=>$value,'title'=>'SMS signature','name'=>$key,'cate'=>3,'update_time'=>$time];
                    break;
                case 'SMS_location':
                    $data_location = ['value'=>$value,'title'=>'SMS submission address','name'=>$key,'cate'=>3,'update_time'=>$time];
                    break;

            }

        }
        $data =[$data_location,$data_acc,$data_key,$data_sign] ;

        $config = M('sys_config');

        foreach ($data as $key=>$value){
            $where['name'] = $value['name'];
           $config->data($data)->add($value);//Add to
          // $config->where($where)->save($value);//modify

        }
        $this->SMS_send();
    }

    /**
     * SMS sending information display
     */
    public function SMS_send_form(){

        $config=M('sys_config');
        $SMS_acc=$config-> getFieldByName('SMS_acc','value');
        $SMS_key=$config-> getFieldByName('SMS_key','value');
        $SMS_sign=$config-> getFieldByName('SMS_sign','value');
        $SMS_location=$config-> getFieldByName('SMS_location','value');


        $this->assign(array('SMS_acc'=>$SMS_acc,'SMS_key'=>$SMS_key,'SMS_sign'=>$SMS_sign,'SMS_location'=>$SMS_location));


        $this->display('Interface/Validate/sms');
    }

}
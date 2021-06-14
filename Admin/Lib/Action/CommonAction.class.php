<?php
header('Content-Type:text/html;charset=UTF-8');
// Business-based controller
//Basic call file
class CommonAction extends Action {
	function _initialize() {
     // Address bar icon
        //From local
        // $addressbar_icon = '__PUBLIC__/images/logo/bar_icon.ico';
        // $this->assign('addressbar_icon',$addressbar_icon);
        //From the database
        // $i = M('config')->field('value')->where('id=4')->find();
        // $addressbar_icon = '__ROOT__'.$i['value'];
        // $this->assign('addressbar_icon',$addressbar_icon);

        //Load the extension library
        // Load('extend');
        vendor('sliver.upload');

        // 
        $re=str_repeat('&nbsp;', 4);
        $this->assign('repeat',$re);

        //Time processing Remove leading 0
        // function clear_0()
        // {
        //     $hour=date("G");
        //     $minute=date("i");
        //     $secd=date("s");
        //     $minute=$minute>9:$minute?(int)$minute;
        //     $secd=$secd>9:$secd?(int)$secd;
        //     return  $hour+'-'+$minute+'$secd';
        // }

	    //The login information of the administrator is used to judge the login status
        $uid= session('admin_id');
        $this->assign('uid',$uid);
        

        // Administrator information
        $this->assign('admin_name',session('admin_name'));
       
        if (cookie('admin_pic')) {
           $this->assign('face',cookie('admin_pic'));
        } else {
           $this->assign('face','userFace64.gif');
        }

        $map['admin_id'] = session('admin_id');
        $admin = M('sys_admin')->where($map)->find();
        $lasttime = date("Y-m-d H:i:s",$admin['lasttime']);
        // var_dump($lasttime);die();
        $this->assign('lasttime',$lasttime);
        $this->assign('admin',$admin);



     
        // Website information
        $site = M('sys_config');

        $title = $site->where('id=2')->getField('value');
        $this->assign('title',$title);

        $logo = $site->where('id=4')->getField('value');
        $this->assign('logo',$logo);

        $key = $site->where('id=5')->getField('value');
        $this->assign('key',$key);

        $des = $site->where('id=6')->getField('value');
        $this->assign('des',$des);

        $tj = $site->where('id=7')->getField('value');
        $this->assign('tj',$tj);

        $integral = $site->where('id=11')->getField('value');
        $this->assign('integral',$integral);

        $icp = $site->where('id=12')->getField('value');
        $this->assign('icp',$icp);

        $notice = $site->where('id=17')->getField('value');
        $this->assign('notice',$notice);

        $webswitch = $site->where('id=17')->getField('value');
        $this->assign('webswitch',$webswitch);

        $shortcut = $site->where('id=18')->getField('value');
        $this->assign('shortcut',$shortcut);

        // footer bottom information
        // $z = M('config');

        // $pspay = $z -> where('id=16')->find();
        // $this->assign('pspay',$pspay['value']);

        
	}

}

?>

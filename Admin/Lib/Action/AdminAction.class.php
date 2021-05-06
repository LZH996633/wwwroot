<?php
class AdminAction extends CommonAction{
    /**
     * 修改密码
     */
    public function person(){
        $Admin = M('sys_admin');
        if($_POST){
            $yuan_name = $_POST['yuan_admin_username'];
            $yuan_pass = $_POST['yuan_admin_pass'];
            $admin_name = $_POST['admin_username'];
            $admin_pass = $_POST['admin_pass'];
            $result =$Admin->where(array('admin_username'=>$yuan_name,'admin_password'=>md5($yuan_pass)))->find();
            if($result){
                $admin_id = $result['admin_id'];
                $data = array(
                    'admin_username'=>$admin_name,
                    'admin_password'=>md5($admin_pass),
                );
                $result_1 = $Admin->where(array('admin_id'=>$admin_id))->save($data);
                if($result_1){
                    $this->redirect('Admin/person','','3','修改成功！');

                }else{

                    $this->redirect('Admin/person','','3','修改失败！请重试！');

                }
            }else{
                $this->redirect('Admin/person','','3','修改失败！请重试！');
            }


        }
         $this->display();
    }

    /**
     * 个人账户
     */
    public function account(){
        $Account = new AdminAccountModel();
       // var_dump($Account);
        if($_GET['p']){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }

        $ListShow = $Account->getLinkList($where='',$num=6,$p);

        $this->assign($ListShow);


        $this->display('Admin/account/index');
    }

    public function ac_add(){
        if($this->isPost()){
            $Account = M('admin_account');
            $data = $_POST;
            $ret = $Account->add($data);
            if($ret){
                $this->redirect('Admin/ac_add');
            }else{
                $this->redirect('Admin/ac_add','','2','添加失败');
            }
        }else{
            $this->display('Admin/account/add');
        }

    }

    public function ac_edit(){
        $Account= M('admin_account');
        $id = $_GET['id'];

        //var_dump($id);
        if($id){
            $info = $Account->where('id='.$id)->find();
        }

        if($_POST){ //var_dump($_POST);die;
            // var_dump($_POST);die;
            $id = $_POST['id'];
            $new_url =$_POST['account_pic'];
            $url = $Account->where(array('id'=>$id))->getField('account_pic');
            if($new_url!=$url){
                $path = $_SERVER['DOCUMENT_ROOT'].$url;
                unlink($path);
            }

            $ret = $Account->where(array('id'=>$id))->save($_POST);


            if($ret){
                $this->redirect('Admin/ac_edit?id='.$id);
            }else{
                $this->redirect('Admin/ac_edit?id='.$id,'','2','编辑失败');
            }
        }else{
            $this->assign('account', $info);
            $this->display('Admin/account/edit');
        }
    }
    /**
     * 清除缓存
     */
    public function cache(){

        $hou_path =  $_SERVER['DOCUMENT_ROOT'].'/Admin/Runtime';
        $qian_path =  $_SERVER['DOCUMENT_ROOT'].'/Home/Runtime';

        $arr = array(
            'qian' => $qian_path,
            'hou'=>$hou_path
        );
        if($_POST){

              $this->del_dir( $arr[$_POST['cache']]);
              $this->redirect('Admin/cache');

        }else{

           foreach ($arr as $key=>$value){
               $result =  $this->getDirSize($value);
               $size =  $this->getRealSize($result);
               $this->assign(array($key=>$size));
           }

        }

        $this->display();
    }

    /**
     * @param $dir
     * 删除
     */
    public function del_dir($dir){
        $dh=opendir($dir);
        while ($file=readdir($dh)) {
            if($file!="." && $file!="..") {
                $fullpath=$dir."/".$file;
                if(!is_dir($fullpath)) {
                    unlink($fullpath);
                } else {
                    $this->del_dir($fullpath);
                }
            }
    }
    }

    // 获取文件夹大小
    function getDirSize($dir,$sizeResult='')
    {
        $handle = opendir($dir);
        while (false!==($FolderOrFile = readdir($handle)))
        {
            if($FolderOrFile != "." && $FolderOrFile != "..")
            {
                if(is_dir("$dir/$FolderOrFile"))
                {
                    $sizeResult += $this->getDirSize("$dir/$FolderOrFile");
                }
                else
                {
                    $sizeResult += filesize("$dir/$FolderOrFile");
                }
            }
        }
        closedir($handle);
        return $sizeResult;
    }

    // 单位自动转换函数
    function getRealSize($size)
    {
        $kb = 1024;         // Kilobyte
        $mb = 1024 * $kb;   // Megabyte
        $gb = 1024 * $mb;   // Gigabyte
        $tb = 1024 * $gb;   // Terabyte

        if($size < $kb)
        {
            return $size." B";
        }
        else if($size < $mb)
        {
            return round($size/$kb,2)." KB";
        }
        else if($size < $gb)
        {
            return round($size/$mb,2)." MB";
        }
        else if($size < $tb)
        {
            return round($size/$gb,2)." GB";
        }
        else
        {
            return round($size/$tb,2)." TB";
        }
    }

}
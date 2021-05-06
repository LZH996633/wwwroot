<?php
class LinkAction extends CommonAction {

    public function index(){

        $Link = new SysLinkModel();
        if($_GET['p']){
            $p = $_GET['p'];
        }else{
            $p = 1;
        }

        $ListShow = $Link->getLinkList($where='',$num=6,$p);

        $this->assign($ListShow);

        $this->display();
    }

    /**
     * 添加
     */
    public function add(){

        if($this->isPost()){
            $link = M('sys_link');
            $data = $_POST;
            $ret = $link->add($data);
             if($ret){
                $this->redirect('Link/add');
            }else{
                $this->redirect('Link/add','','2','添加失败');
            }
        }else{
            $this->display();
        }

    }

    /**
     * 编辑
     */
    public function edit(){
        $link= M('sys_link');
        $id = $_GET['id'];

        //var_dump($id);
        if($id){
            $info = $link->where('link_id='.$id)->find();
        }

        if($_POST){ //var_dump($_POST);die;
            // var_dump($_POST);die;
            $id = $_POST['link_id'];
            $new_url =$_POST['link_logo'];
            $url = $link->where(array('link_id'=>$id))->getField('link_logo');
            if($new_url!=$url){
                $path = $_SERVER['DOCUMENT_ROOT'].$url;
                unlink($path);
            }

            $ret = $link->where(array('link_id'=>$id))->save($_POST);


            if($ret){
                $this->redirect('Link/edit?id='.$id);
            }else{
                $this->redirect('Link/edit?id='.$id,'','2','编辑失败');
            }
        }else{
            $this->assign('link', $info);
            $this->display();
        }

    }

    /**
     * 删除
     */
    public function del(){
        if($_POST){
            //var_dump($_POST);die;
            $Link = M('sys_link');
            $select = $_POST['select'];
            $where['link_id'] = array('in',$select);

            $filelist = $Link->where($where)->select();
            foreach ($filelist as $key=>$value) {
                $file_list[] = $value['link_logo'];
            }
            foreach ($file_list as $key=>$value){
                $path = $_SERVER['DOCUMENT_ROOT'].$value;
                unlink($path);
            }

            $result = $Link->where($where)->delete();
            //var_dump($Ad->_sql());die;
            if($result){

                    $this->redirect('Link/index');


            }else{

                    $this->redirect('Link/index','','2','删除失败');

            }

        }
    }



}
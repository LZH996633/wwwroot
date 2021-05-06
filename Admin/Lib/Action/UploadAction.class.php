<?php
class UploadAction extends CommonAction{
    public function show(){
        var_dump($_FILES);
    }
     public function upload(){

     $dir_station =$_SERVER['DOCUMENT_ROOT'];
     $file = isset($_FILES['file']) ? $_FILES['file'] : null;
if ($file) {
    
    $file_size = 1024*1024*800;//限制大小800M
    $allowedExts = array('gif', 'jpeg', 'jpg', 'png', 'mp4', 'flv','zip','rar','psd');
    $video = array('flv','mp4');//视频
    $compression = array('zip','rar');//压缩
    $pic = array('gif','jpeg','jpg','png','psd');
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if (in_array($extension, $allowedExts)) {
        
        if ($file['error'] == 0) {
            $uid = microtime(true);

            $fileName = $uid . '.' . $extension;
            if(in_array($extension,$video)){
                $dir_up = '/Public/upload/video/';
            }if(in_array($extension,$pic)){
               $dir_up = '/Public/upload/images/';
                // $dir_up = '/Public/upload/video/';
            }if(in_array($extension,$compression)){
                $dir_up = '/Public/upload/files/';
            }
            
            $dir = $dir_station.$dir_up;
            $newFile = $dir . $fileName;


            if (!is_dir($dir)) {
                @mkdir($dir, 0777, true);
            }
            if (is_file($newFile)) {
                //$fileName = md5(microtime(true)) . $fileName;
                //$newFile = $dir . $fileName;
            }

            if ($file['size']>$file_size){
                $result['error'] = 5;
                $result['message'] = "上传失败，文件最大500M";
            }else{
                $filePath = $dir_up . $fileName;
                if (move_uploaded_file($file['tmp_name'], $newFile)) {
                    $result['error'] = 0;
                    $result['message'] = "上传成功";
                    $result['filePath'] = $filePath;

                } else {
                    $result['error'] = 1;
                    $result['message'] = "保存失败，请重新上传";
                }
            }
           
        } else {

            $result['error'] = 2;
            $result['message'] = $file['error'];
        }
    } else {
        $result['error'] = 3;
        $result['message'] = "上传格式不正确";
    }
} else {
    $result['error'] = 4;
    $result['message'] = "上传失败，请重新上传";
}
echo json_encode($result);
    }
}
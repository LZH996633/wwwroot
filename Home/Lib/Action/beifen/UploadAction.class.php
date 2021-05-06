<?php
class UploadAction extends CommonAction{
    public function show(){
        var_dump($_FILES);
    }
     public function upload(){

     $dir_station =$_SERVER['DOCUMENT_ROOT'];
     $file = isset($_FILES['file']) ? $_FILES['file'] : null;
    
    
     if ($file) {
    
    $file_size = 1024*1024*500;//限制大小500M
    $allowedExts = array('gif', 'jpeg', 'jpg', 'png', 'mp4', 'flv', 'mov','zip','rar','psd');
    $video = array('flv','mp4','mov');//视频
    $compression = array('zip','rar');//压缩
    $pic = array('gif','jpeg','jpg','png','psd');
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if (in_array($extension, $allowedExts)) {
    

        if ($file['error'] == 0) {
            $uid = microtime(true);

            $fileName = $uid . '.' . $extension;
            if(in_array($extension,$video)){
               // $dir_up = '/Uploads/video/';
                $dir_up = '/Uploads/upload/';
            }if(in_array($extension,$pic)){
                $dir_up = '/Uploads/images/';
            }if(in_array($extension,$compression)){
                $dir_up = '/Uploads/files/';
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
                $result['message'] = "上传失败，文件最大100M";
            }else{
                
                if (move_uploaded_file($file['tmp_name'], $newFile)) {
                 //   system("ffmpeg.exe -i D:\\wwwroot\\Uploads\\upload\\$fileName -ss 2 -vframes 1 D:\\wwwroot\\Uploads\\images\\$uid.jpg");
                // system("ffmpeg.exe -i D:\\wwwroot\\Uploads\\upload\\$fileName D:\\wwwroot\\Uploads\\images\\$uid%04d.jpg -vcodec mjpeg -ss 0:0:5 -t 0:0:1 ");  每秒25帧速度截取1秒的图片并生产4位数的序列图片
                system("ffmpeg.exe -i D:\\wwwroot\\Uploads\\upload\\$fileName -r 1 -ss 00:00:02 -t 00:00:05 D:\\wwwroot\\Uploads\\images\\$uid%03d.jpg");
                      //      ffmpeg -i toolba.mkv -r 1 -ss 00:00:26 -t 00:00:07 %03d.png

       //每秒一帧的速度，从第 26 秒开始一直截取 4 秒长的时间，截取到的每一幅图像，都用 3 位数字自动生成从小到大的文件名。
                 
                 //ffmpeg -i /mnt/11m夜店_H264.vod /mnt/h264/ffmpeg-0.5.1/picture/1m%04d.jpg -vcodec mjpeg -ss 0:1:2 -t 0:0:1
                 if(in_array($extension,$video)){ 
                       // $videoFilemp3= 'D:\\wwwroot\\Uploads\\images\\' . $uid . 'jpg';
                       // if(is_file($videoFilemp3)){  //如果新文件已经生成  则 执行删除老视频文件操作 
                    system("ffmpeg.exe -i D:\\wwwroot\\Uploads\\upload\\$fileName -i aaa.png -filter_complex overlay=10:30 -b:v 9024k D:\\wwwroot\\Uploads\\video\\$uid.mp4");
                      //  }
                    //  $videoFilemp4= 'D:\\wwwroot\\Uploads\\video\\' . $uid . '1.mp4';
                 // $videoFilemp5= 'D:\\wwwroot\\Uploads\\video\\' . $fileName;
                 $videoFilemp4= 'D:\\wwwroot\\Uploads\\video\\' . $uid . '.mp4';
                 $videoFilemp5= 'D:\\wwwroot\\Uploads\\upload\\' . $fileName;
                 $videoFilemp6= 'D:\\wwwroot\\Uploads\\images\\' . $uid . '001.mp4';
              if($videoFilemp4){  //如果新文件已经生成  则 执行删除老视频文件操作
                if(is_file($videoFilemp4)){  //如果新文件已经生成  则 执行删除老视频文件操作               
                // if(unlink($videoFilemp4)){               //如果删除成功 则执行 文件名更改操作
                    array_map("unlink", glob($videoFilemp5));
                    array_map("unlink", glob($videoFilemp6));
                    $dir_up = '/Uploads/video/';
                   
                 } 
                 
                 } 
                  
               $video1=  '/Uploads/video/' . $uid . '.mp4';	
               $img=  '/Uploads/images/' . $uid . '001.jpg';
               $img1=  '/Uploads/images/' . $uid . '002.jpg';
               $img2=  '/Uploads/images/' . $uid . '003.jpg';
               $img3=  '/Uploads/images/' . $uid . '004.jpg';
               $img4=  '/Uploads/images/' . $uid . '005.jpg';
      }

                   $filePath = $dir_up . $fileName;


                    $result['error'] = 0;
                    $result['message'] = $file . "上传成功";
                    $result['filePath'] = $filePath;
                    $result['img'] = $img;
                    $result['img1'] = $img1;
                    $result['img2'] = $img2;
                    $result['img3'] = $img3;
                    $result['img4'] = $img4;
                    $result['video1'] = $video1;
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
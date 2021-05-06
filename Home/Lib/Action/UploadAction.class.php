<?php

class UploadAction extends CommonAction{
	
    public function show(){
        var_dump($_FILES);
    }
     public function upload(){
        
     $dir_station =$_SERVER['DOCUMENT_ROOT'];
     $file = isset($_FILES['file']) ? $_FILES['file'] : null;
    
    
     if ($file) {

    $file_size = 1024*1024*1000;//限制大小1000M
    $allowedExts = array('gif', 'jpeg', 'jpg', 'png', 'mp4', 'mpeg', 'avi', 'mov', 'zip', 'rar');
    $video = array('mpeg','mp4','mov','avi');//视频
    $compression = array('zip','rar');//压缩
    $pic = array('gif','jpeg','jpg','png');
	$md5file = md5_file($_FILES['file']['tmp_name']);
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
	
	

    
    if (in_array($extension, $allowedExts)) {
    

        if ($file['error'] == 0) {
            $uid = $md5file;
			
		

			
			
			

            $fileName = $uid . '.' . $extension;
            if(in_array($extension,$video)){
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
             $ip = get_client_ip();
			$user_id = $_COOKIE['user_id'];
		    $detection = M("detection"); // 验证其他用户是否也上传过相同文件
        
		$condition['md5'] = $uid;
        $jianyan = $detection->where($condition)->find(); //find  方法用于判断是否有数值
			if($jianyan!= null){
				$result['error'] = 6;
				 $result['message'] = "上传失败，你的作品已上传或者重复！";
				 
				 
				 
			}else if ($file['size']>$file_size){
                $result['error'] = 5;
                $result['message'] = "上传失败，文件最大1000M";
            }else{
              // $User = new M("User"); // 实例化User对象
               $data['name'] = $user_id;
               $data['md5'] = $uid;
               $data['ip'] = $ip;
               $data['detectiontime']=date ( 'Y-m-d H:i:s',time());			   
               $detection->add($data);


                
                if (move_uploaded_file($file['tmp_name'], $newFile)) {
                   

                //  每秒25帧速度截取1秒的图片并生产4位数的序列图片
                system("ffmpeg.exe -i F:\\wwwroot\\Uploads\\upload\\$fileName -r 1 -ss 00:00:02 -t 00:00:05 F:\\wwwroot\\Uploads\\images\\$uid%03d.jpg");
       //每秒一帧的速度，从第 26 秒开始一直截取 4 秒长的时间，截取到的每一幅图像，都用 3 位数字自动生成从小到大的文件名。

	   			   		$videoFilemp10= 'F:\\wwwroot\\Uploads\\images\\' . $uid . '005.jpg';

			    if(is_file($videoFilemp10)){  //如果新文件已经生成  则 执行合并文件操作
				
				 $img1=  './Uploads/images/' . $uid . '002.jpg';
                 $img2=  './Uploads/images/' . $uid . '003.jpg';
                 $img3=  './Uploads/images/' . $uid . '004.jpg';
                 $img4=  './Uploads/images/' . $uid . '005.jpg';

				
				
				 $pic_list  = array(
				 $img1,
				 $img2,
				 $img3,
				 $img4,
				 ); 

                 $pic_list = array_slice($pic_list, 0, 4); // 只操作4个图片 

                 $bg_w = 720; // 背景图片宽度 
                 $bg_h = 406; // 背景图片高度 

                 $background = imagecreatetruecolor($bg_w,$bg_h); // 背景图片 画布 
                 $color = imagecolorallocate($background, 202, 201, 201); // 为真彩色画布创建白色背景，再设置为透明 
                  imagefill($background, 0, 0, $color); 
                  imageColorTransparent($background, $color); 
                 $pic_count = count($pic_list); 
                 $lineArr = array(); // 需要换行的位置 

                 $space_x = 0; 
				 $space_y = 0; 
                 $line_x = 0;  
                  switch($pic_count) { 
                  case 1: // 正中间 
                 $start_x = intval($bg_w/4); // 开始位置X 
                 $start_y = intval($bg_h/4); // 开始位置Y 
                 $pic_w = intval($bg_w/2); // 宽度 
                 $pic_h = intval($bg_h/2); // 高度 
                  break; 
                  case 2: // 中间位置并排 
                 $start_x = 2; 
                 $start_y = intval($bg_h/4); 
                 $pic_w = intval($bg_w/2) - 5; 
                 $pic_h = intval($bg_h/2); 
                 $space_x = 0; 
                  break; 
                  case 3: 
                 $start_x = 40; // 开始位置X 
                 $start_y = 0; // 开始位置Y 
                 $pic_w = intval($bg_w/2) ; // 宽度 
                 $pic_h = intval($bg_h/2); // 高度 
                 $lineArr = array(2); 
                 $line_x = 0; 
                  break; 
                  case 4: 
                 $start_x = 0; // 开始位置X 
                 $start_y = 0; // 开始位置Y 
                 $pic_w = intval($bg_w/2); // 宽度 
                 $pic_h = intval($bg_h/2); // 高度 
                 $lineArr = array(3); 
                 $line_x = 0; 
                  break; 
               
 } 

                 foreach( $pic_list as $k=>$pic_path ) { 

                  $kk = $k + 1; 

                if ( in_array($kk, $lineArr) ) { 

                    $start_x = $line_x; 

                    $start_y = $start_y + $pic_h + $space_y; 

                  } 

                 $pathInfo = pathinfo($pic_path); 

                  switch( strtolower($pathInfo['extension']) ) { 
                  case 'jpg': 
                  case 'jpeg':  
                   default: 
                 $imagecreatefromjpeg = 'imagecreatefromstring'; 
                 $pic_path = file_get_contents($pic_path); 
                     break; 
                 } 

                  $resource = $imagecreatefromjpeg($pic_path); 
                  imagecopyresized($background,$resource,$start_x,$start_y,0,0,$pic_w,$pic_h,imagesx($resource),imagesy($resource)); //最后两个参数为原始图片宽度和高度，倒数两个参数为copy时的图片宽度和高度 
                  $start_x = $start_x + $pic_w + $space_x; 
                 } 
                   $img5=  './Uploads/images/' . $uid . '05.jpg';
                //  header("Content-type: image/jpg"); 
                 //imagejpeg($background,$img5);
                 imagegif($background,$img5); 
				 
//-----------------------------------------合成图片完成-------------------------------------------------------------------//	

                 }    
				 

			
		//	   ignore_user_abort(true); // 后台运行
       //        set_time_limit(0); // 取消脚本运行时间的超时上限
	   
	   
                 if(in_array($extension,$video)){ 
				    $result['error'] = 7;
                    $result['message'] =  "正在做视频处理请稍后！";
					
                    system("ffmpeg.exe -i F:\\wwwroot\\Uploads\\upload\\$fileName -i aaa.png -filter_complex overlay=60:120 -b:v 904k F:\\wwwroot\\Uploads\\video\\$uid.mp4");

                 $videoFilemp4= 'F:\\wwwroot\\Uploads\\video\\' . $uid . '.mp4';
                 $videoFilemp5= 'F:\\wwwroot\\Uploads\\upload\\' . $fileName;

			   $videoFilemp7= 'F:\\wwwroot\\Uploads\\images\\' . $uid . '002.jpg';
				$videoFilemp8= 'F:\\wwwroot\\Uploads\\images\\' . $uid . '003.jpg';
				$videoFilemp9= 'F:\\wwwroot\\Uploads\\images\\' . $uid . '004.jpg';	
                $videoFilemp11= 'F:\\wwwroot\\Uploads\\images\\' . $uid . '005.jpg';				
              if($videoFilemp4){  //如果新文件已经生成  则 执行删除老视频文件操作
                if(is_file($videoFilemp4)){  //如果新文件已经生成  则 执行删除老视频文件操作               
                    array_map("unlink", glob($videoFilemp5));
                    array_map("unlink", glob($videoFilemp7));
                    array_map("unlink", glob($videoFilemp8));					
                    array_map("unlink", glob($videoFilemp9));
                    array_map("unlink", glob($videoFilemp11));					
                    $dir_up = '/Uploads/video/';
					
			
                   
                 } 
                 
                 } 
                  
               $video1=  '/Uploads/video/' . $uid . '.mp4';	
			   
			   $img=  '/Uploads/images/' . $uid . '001.jpg';
			   
			   $img5=  '/Uploads/images/' . $uid . '05.jpg';
			   
			        $result['video1'] = $video1;
					
				if(in_array($extension,$pic)){ 

				} else{
					 $result['img'] = $img;
                    $result['img5'] = $img5;
				}
				
      }

	   else if(in_array($extension,$compression)){ 
	   $filePath = $dir_up . $fileName;
	   $result['filePath'] = $filePath;
	  
	   }else if(in_array($extension,$pic)){ 
	   
	   $img8=  '/Uploads/images/' . $fileName; 	   
	   $result['img8'] = $img8;
	   
	   
	   }



                   
               //    dump($img5);

                    $result['error'] = 0;
                    $result['message'] =  $img8."上传成功";
                    


                   
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
   // $result['message'] = "上传失败，请重新上传";
    $result['message'] = $_FILES;
	
}
echo json_encode($result);
    }
	
	
	



	     public function uploads(){

     $dir_station =$_SERVER['DOCUMENT_ROOT'];
     $file = isset($_FILES['file']) ? $_FILES['file'] : null;
if ($file) {
    
    $file_size = 1024*1024*500;//限制大小500M
    $allowedExts = array('gif', 'jpeg', 'jpg', 'png');
    $video = array('flv','mp4');//视频
    $compression = array('zip','rar');//压缩
    $pic = array('gif','jpeg','jpg','png','psd');
    $extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    
    if (in_array($extension, $allowedExts)) {
        
        if ($file['error'] == 0) {
            $uid = microtime(true);

            $fileName = $uid . '.' . $extension;
            if(in_array($extension,$video)){
                $dir_up = '/Uploads/video/';
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
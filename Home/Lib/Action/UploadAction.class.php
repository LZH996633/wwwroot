<?php

class UploadAction extends CommonAction{
	
    public function show(){
        var_dump($_FILES);
    }
     public function upload(){
        
     $dir_station =$_SERVER['DOCUMENT_ROOT'];
     $file = isset($_FILES['file']) ? $_FILES['file'] : null;
    
    
     if ($file) {

    $file_size = 1024*1024*500;//Limit size 500M
    $allowedExts = array('gif', 'jpeg', 'jpg', 'png', 'mp4', 'mpeg', 'avi', 'mov', 'zip', 'rar');
    $video = array('mpeg','mp4','mov','avi');//video
    $compression = array('zip','rar');//compression
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
		    $detection = M("detection"); // Verify that other users have also uploaded the same file
        
		$condition['md5'] = $uid;
        $jianyan = $detection->where($condition)->find(); //find  Method is used to determine whether there is a value
			if($jianyan!= null){
				$result['error'] = 6;
				 $result['message'] = "Upload failed, your work has been uploaded or duplicated！";
				 
				 
				 
			}else if ($file['size']>$file_size){
                $result['error'] = 5;
                $result['message'] = "Upload failed, the maximum file size is 1000M";
            }else{
              // $User = new M("User"); // Instantiate the User object
               $data['name'] = $user_id;
               $data['md5'] = $uid;
               $data['ip'] = $ip;
               $data['detectiontime']=date ( 'Y-m-d H:i:s',time());			   
               $detection->add($data);


                
                if (move_uploaded_file($file['tmp_name'], $newFile)) {
                   

                //  Capture 1 second pictures at 25 frames per second and produce 4-digit sequence pictures
                system("ffmpeg.exe -i F:\\wwwroot\\Uploads\\upload\\$fileName -r 1 -ss 00:00:02 -t 00:00:05 F:\\wwwroot\\Uploads\\images\\$uid%03d.jpg");
       //At the rate of one frame per second, it has been intercepted for 4 seconds from the 26th second, and each image intercepted is automatically generated with a 3-digit number in the file name from small to large.

	   			   		$videoFilemp10= 'F:\\wwwroot\\Uploads\\images\\' . $uid . '005.jpg';

			    if(is_file($videoFilemp10)){  //If the new file has been generated, perform the merge file operation
				
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

                 $pic_list = array_slice($pic_list, 0, 4); // Only operate 4 pictures

                 $bg_w = 720; // Background image width
                 $bg_h = 406; // Background image height

                 $background = imagecreatetruecolor($bg_w,$bg_h); // Background image canvas
                 $color = imagecolorallocate($background, 202, 201, 201); // Create a white background for the true color canvas and set it to transparent
                  imagefill($background, 0, 0, $color); 
                  imageColorTransparent($background, $color); 
                 $pic_count = count($pic_list); 
                 $lineArr = array(); // Where to wrap

                 $space_x = 0; 
				 $space_y = 0; 
                 $line_x = 0;  
                  switch($pic_count) { 
                  case 1: // The middle
                 $start_x = intval($bg_w/4); // Start position X
                 $start_y = intval($bg_h/4); // Start position Y
                 $pic_w = intval($bg_w/2); // width
                 $pic_h = intval($bg_h/2); // height
                  break; 
                  case 2: // Middle position side by side
                 $start_x = 2; 
                 $start_y = intval($bg_h/4); 
                 $pic_w = intval($bg_w/2) - 5; 
                 $pic_h = intval($bg_h/2); 
                 $space_x = 0; 
                  break; 
                  case 3: 
                 $start_x = 40; // Start position X
                 $start_y = 0; // Start position Y
                 $pic_w = intval($bg_w/2) ; // width
                 $pic_h = intval($bg_h/2); // height
                 $lineArr = array(2); 
                 $line_x = 0; 
                  break; 
                  case 4: 
                 $start_x = 0; // Start position X
                 $start_y = 0; // Start position Y
                 $pic_w = intval($bg_w/2); // width
                 $pic_h = intval($bg_h/2); // height
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
                  imagecopyresized($background,$resource,$start_x,$start_y,0,0,$pic_w,$pic_h,imagesx($resource),imagesy($resource)); //The last two parameters are the width and height of the original image, and the last two parameters are the width and height of the image when copying
                  $start_x = $start_x + $pic_w + $space_x; 
                 } 
                   $img5=  './Uploads/images/' . $uid . '05.jpg';
                //  header("Content-type: image/jpg"); 
                 //imagejpeg($background,$img5);
                 imagegif($background,$img5); 
				 
//-----------------------------------------The composite picture is complete-------------------------------------------------------------------//

                 }    
				 

			
		//	   ignore_user_abort(true); // Background process
       //        set_time_limit(0); // Cancel the timeout limit of script running time
	   
	   
                 if(in_array($extension,$video)){ 
				    $result['error'] = 7;
                    $result['message'] =  "Video processing is in progress, please wait！";
					
                    system("ffmpeg.exe -i F:\\wwwroot\\Uploads\\upload\\$fileName -i aaa.png -filter_complex overlay=60:120 -b:v 904k F:\\wwwroot\\Uploads\\video\\$uid.mp4");

                 $videoFilemp4= 'F:\\wwwroot\\Uploads\\video\\' . $uid . '.mp4';
                 $videoFilemp5= 'F:\\wwwroot\\Uploads\\upload\\' . $fileName;

			   $videoFilemp7= 'F:\\wwwroot\\Uploads\\images\\' . $uid . '002.jpg';
				$videoFilemp8= 'F:\\wwwroot\\Uploads\\images\\' . $uid . '003.jpg';
				$videoFilemp9= 'F:\\wwwroot\\Uploads\\images\\' . $uid . '004.jpg';	
                $videoFilemp11= 'F:\\wwwroot\\Uploads\\images\\' . $uid . '005.jpg';				
              if($videoFilemp4){  //If the new file has been generated, delete the old video file operation
                if(is_file($videoFilemp4)){  //If the new file has been generated, delete the old video file operation
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
                    $result['message'] =  $img8."Uploaded successfully";
                    


                   
                } else {
                    $result['error'] = 1;
                    $result['message'] = "Save failed, please re-upload";
                }
            }
           
		   
		
		   
        } else {

            $result['error'] = 2;
            $result['message'] = $file['error'];
        }
    } else {
        $result['error'] = 3;
        $result['message'] = "Incorrect upload format";
    }
} else {
    $result['error'] = 4;
   // $result['message'] = "Upload failed, please upload again";
    $result['message'] = $_FILES;
	
}
echo json_encode($result);
    }
	
	
	



	     public function uploads(){

     $dir_station =$_SERVER['DOCUMENT_ROOT'];
     $file = isset($_FILES['file']) ? $_FILES['file'] : null;
if ($file) {
    
    $file_size = 1024*1024*500;//Limit size 500M
    $allowedExts = array('gif', 'jpeg', 'jpg', 'png');
    $video = array('flv','mp4');//video
    $compression = array('zip','rar');//compression
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
                $result['message'] = "Upload failed, the maximum file size is 100M";
            }else{
                $filePath = $dir_up . $fileName;
                if (move_uploaded_file($file['tmp_name'], $newFile)) {
                    $result['error'] = 0;
                    $result['message'] = "Uploaded successfully";
                    $result['filePath'] = $filePath;

                } else {
                    $result['error'] = 1;
                    $result['message'] = "Save failed, please re-upload";
                }
            }
           
        } else {

            $result['error'] = 2;
            $result['message'] = $file['error'];
        }
    } else {
        $result['error'] = 3;
        $result['message'] = "Incorrect upload format";
    }
} else {
    $result['error'] = 4;
    $result['message'] = "Upload failed, please upload again";
}
echo json_encode($result);
    }
	


	
	
	
}
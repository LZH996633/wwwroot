<?php
     /*
     ����session����ע����session_start()֮ǰ���벻Ҫ���������������ݵĶ�������������������
     */
  
    session_start();
 
     //ini_get()��ȡphp.ini�л���������ֵ
     $i = ini_get('session.upload_progress.name');
 
     //ajax������ʹ�õ���get��������������Ϊini�ļ��ж����ǰ׺ ƴ�� �������Ĳ���
     $key = ini_get("session.upload_progress.prefix") . $_GET[$i];    
     //�ж� SESSION ���Ƿ����ϴ��ļ�����Ϣ
     if (!empty($_SESSION[$key])) {                                        
         //���ϴ���С
         $current = $_SESSION[$key]["bytes_processed"];
         //�ļ��ܴ�С
         $total = $_SESSION[$key]["content_length"];
 
        //�� ajax ���ص�ǰ���ϴ����Ȱٷֱȡ�
         echo $current < $total ? ceil($current / $total * 100) : 100;
     }else{
         echo 100;                                                       
     }
     ?>
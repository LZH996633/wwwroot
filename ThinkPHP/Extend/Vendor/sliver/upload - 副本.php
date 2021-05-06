<?php
class silverUpload
{
	/*
	2015-7-3	修复续传上传文件超过2G文件时服务器端验证码不正确的问题。
				bug描述：fseek无法定位超过PHP_INT_MAX的位置。filesize无法获取正确的服务器文件大小。
	*/
	function __construct()
	{
		//返回的json
		$this->serverfileurl="";		//服务器上同名文件的站内绝对url
		$this->serverfilesize="0";		//当前服务器上同名文件的文件大小
		$this->errdescription="";		//用于携带返回错误信息
		$this->info="";					//用于携带返回信息以便跟客户端javascript互交
		$this->validatedata="";			//服务器返回的文件验证码
		$this->validatepos=0;			//要验证的文件开始偏移量
		$this->validatelength=64;		//配置验证的文件字节长度
		$this->streammd5="";			//分段md5校验码
		//返回的json
		$path = $_SERVER['DOCUMENT_ROOT']."/Uploads/files";
		$this->TempFolderPath= "/Uploads/files";	//文件保存的基准文件夹路径
		$this->localfilepath="";		//客户端传送过来的文件名或文件路径
		$this->saveFolderPath="";		//服务器上的文件所在文件夹的物理路径
		$this->extName="";				//文件后缀名
		$this->filenameonly="";			//文件名（不含后缀）
		$this->saveToFilePath="";		//服务器上的文件的物理路径

		$this->switchStreamMd5=false;		//是否启用分段md5校验功能
	}

	function CatServerFile()
	{
		//计算上传后的文件的路径和文件名
		$this->localfilepath=$_POST["localfilepath"];

		$this->localfilepath=iconv("UTF-8","GBK//IGNORE",$this->localfilepath);
		$this->saveFolderPath=$this->getDocumentRoot().$this->TempFolderPath;
		$this->extName=$this->getFileExtensionName($this->localfilepath);
		$this->filenameonly=$this->GetFileNameOnly($this->localfilepath);
		$this->serverfileurl=$this->TempFolderPath."/".iconv("GBK//IGNORE","UTF-8",$this->filenameonly).".".$this->extName;
		$this->saveToFilePath=$this->saveFolderPath."/".$this->filenameonly.".".$this->extName;
	}

	function validate()
	{
		$this->CatServerFile();
		if($this->localfilepath=="")
		{
			$this->errdescription="文件名不能为空";
			$this->PrintValidateJson();
			return;
		}
		

		if(file_exists($this->saveToFilePath))
		{
			$this->info="file_exist";
			clearstatcache();
			$this->serverfilesize=$this->getFileSize($this->saveToFilePath);
			$this->validatepos=(float) $this->serverfilesize-$this->validatelength;
			if($this->validatepos<0)
			{
				//如果文件长度不足验证长度,则从开始位置读取
				$this->validatepos=0;
			}
			if ($this->validatelength>$this->serverfilesize)
			{
				$this->validatelength=$this->serverfilesize;
			}

			//$handle = fopen($this->saveToFilePath,"r");

			//$this->my_fseek($handle,$this->validatepos);		//定位到要验证的文件开始偏移量
			//fseek($handle,-$this->validatelength,SEEK_END);

			//$filestream=fread($handle,$this->validatelength);
			//fclose($handle);

			$filestream=$this->getServerFileStream($this->validatepos,$this->validatelength);
			$this->validatelength=strlen($filestream);
			$this->validatedata=base64_encode($filestream);

			if($this->switchStreamMd5)
			{
				$this->streammd5=strtoupper(md5($filestream));
			}
		}
		else
		{
			$this->info="file_not_exist";
			$this->validatedata="";
		}
		$this->PrintValidateJson();
	}

	function getServerFileStream($start,$len)
	{
		//利用web服务自身的http功能获取二进制数据
		$start=floatval($start);
		$len=floatval($len);
		$opts = array('http'=>array('method'=>'GET','header'=>"Range: bytes=$start-".($start+$len-1)));
		$context = stream_context_create($opts);
		$result = file_get_contents("http://".$_SERVER['HTTP_HOST'].$this->serverfileurl, false, $context);
		return $result;
	}

	function my_fseek($fp,$pos,$first=0) {

		// set to 0 pos initially, one-time
		if($first) fseek($fp,0,SEEK_SET);

		// get pos float value
		$pos=floatval($pos);

		// within limits, use normal fseek
		if($pos<=PHP_INT_MAX)
		{
			fseek($fp,$pos,SEEK_CUR);
			// out of limits, use recursive fseek
		}
		else {
			fseek($fp,PHP_INT_MAX,SEEK_CUR);
			$pos -= PHP_INT_MAX;
			$this->my_fseek($fp,$pos);
		}
	}

	function save()
	{
		clearstatcache();	//清除文件状态缓存
		$this->CatServerFile();
		$filesize=$_POST["filesize"];
		//$filedata=$_POST["filedata"];
		$filepos=$_POST["filepos"];

		$tmpfile=$_FILES['file1']['tmp_name'];

		$this->DebugLogFile($tmpfile."\n");

		if(is_uploaded_file($tmpfile))
		{
			clearstatcache();	//清除文件状态缓存
			$size=(float) $this->getFileSize($tmpfile);
			$file=fopen($tmpfile,"rb");
			$filestream=fread($file,$size);

			$this->DebugLogFile($filestream."\n");
			fclose($file);
			
		}
		else
		{
			$this->errdescription="0无效上传文件";
			$this->PrintSaveJson();
			die();
		}

		if($this->localfilepath!="" && $filesize!="" && $filepos!="")
		{
			$this->DebugLogFile("save:".$size."\n");


			$this->MD2($this->saveFolderPath);

			$fp=(float) $filepos;
			$filesize=(float) $filesize;
			if($fp>$filesize)
			{
				$this->errdescription="1文件索引位置错误";
				$this->PrintSaveJson();
				return;
			}

			//如果需要数据分段md5校验，那么请计算分段md5码

			if(file_exists($this->saveToFilePath))
			{
				clearstatcache();	//清除文件状态缓存
				$this->serverfilesize=(float) $this->getFileSize($this->saveToFilePath);


				if($this->switchStreamMd5)
				{
					$this->streammd5=strtoupper(md5($filestream));
				}

				if($filesize==$this->serverfilesize)
				{
					//如果上传文件大小与服务器文件大小相等，表示上传完毕
					$this->info="2上传完毕";
					$this->PrintSaveJson();
					return;
				}
				if($fp==0)
				{
					//客户端不管是新开始上传，还是续传，都首先传递fp值为0
					//如果服务器文件已经存在，那么可以判断出来，fp为0时是续传请求动作。这时候获取服务器文件大小，返回给客户端，通知客户端开始续传的文件偏移量。
					$this->info="3开始恢复上传";
					$this->PrintSaveJson();
					return;
				}
				else
				{
					//上传过程中fp肯定是大于0。这时候续写服务器上的文件，写入完毕后，返回给客户端，通知客户端开始续传的文件偏移量。
					
					$handle = fopen($this->saveToFilePath,"a");		//文件续写
					fwrite($handle,$filestream);
					fclose($handle);
					clearstatcache();	//清除文件状态缓存
					$this->serverfilesize=(float) $this->getFileSize($this->saveToFilePath);
					$this->info="4正在续传";

					$this->PrintSaveJson();
					return;
				}

			}
			else
			{
				//如果服务器文件不存在，那么表示是新文件的上传，写入完毕后，返回给客户端，通知客户端开始续传的文件偏移量。
				$handle = fopen($this->saveToFilePath,"w");		//文件续写
				fwrite($handle,$filestream);
				fclose($handle);
				clearstatcache();	//清除文件状态缓存
				$this->serverfilesize=(float) $this->getFileSize($this->saveToFilePath);
				$this->info="5开始上传";
				$this->PrintSaveJson();
				return;
			}
		}
		else
		{
			$this->errdescription="6数据请求错误";
			$this->PrintSaveJson();
		}


		return true;
		
	}

	function md5()
	{
		$this->CatServerFile();
		$r=strtoupper(md5_file($this->saveToFilePath));
		Header("Pragma:no-cache");
		Header('Content-Type: text/html; charset=GBK');
		ECHO "{";
		ECHO "serverfileurl:\"".$this->serverfileurl."\",";
		ECHO "serverfilesize:\"".$this->serverfilesize."\",";
		ECHO "md5:\"".$r."\"";
		ECHO "}";
		die();
	}

	function getDocumentRoot()
	{
		//修正IIS+PHP中$_SERVER["DOCUMENT_ROOT"]为空的问题
		
		if ($_SERVER["DOCUMENT_ROOT"]=="")
		{
			$pathinfo=str_replace("\\","\/",$_SERVER["ORIG_PATH_INFO"]);
			$scriptFileName=str_replace("\\","/",$_SERVER["SCRIPT_FILENAME"]);
			return str_replace($pathinfo,"",$scriptFileName);
		}
		else
		{
			return $_SERVER["DOCUMENT_ROOT"];
		}
	}


	function MD($sDirPath)
	{
		//建立单层目录,虚拟机由于权限问题，仅用is_dir判断会遇到open_basedir的错误。所以加上$this->getDocumentRoot()来判断。
		//echo($this->getDocumentRoot()."(".$sDirPath.")<br>");
		//return true;
		if (strstr($sDirPath,$this->getDocumentRoot())=="")
		{
			return true;
		}
		if (is_dir($sDirPath))
		{
			return true;
		}
		
		$oldumask=umask(0);
		$r=mkdir($sDirPath,0775);
		umask($oldumask);
		return $r;
		
	}

	function MD2($sDirPath)
	{
		//建立多层目录
		$mdir = "";
		foreach( explode( "/", $sDirPath ) as $val )
		{
			$mdir .= $val."/";
			if( $val == ".." || $val == "." ) continue;
			if(!$this->MD($mdir)){
				return false;
			}
		}
		return true;

	}


	function getFileExtensionName($FileFullPath)
	{
		$extend = pathinfo($FileFullPath); 
		$extend = strtolower($extend["extension"]); 
		return $extend; 
	}

	function getFileNameOnly($Filename)
	{
		//返回不含文件后缀的文件名
		return str_replace(".".$this->getFileExtensionName($Filename),"",strtolower($Filename));
	}

	function getFileSize($file) {
		//windows下获取文件大小
		//http://www.kaijia.me/2013/09/php-32bit-filesize-function-2gb-file-issue-solved/
		//$size = filesize($file);
		//if ($size < 0)
		//{
			if (!(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN'))
				$size = trim('stat -c%s $file');
			else {
			   $fsobj = new COM("Scripting.FileSystemObject");
			   $f = $fsobj->GetFile($file);
			   $size = $f->Size;
			}
		//}
		return $size;
	}

	function PrintSaveJson()
	{	
		Header("Pragma:no-cache");
		Header('Content-Type: text/html; charset=GBK');
		ECHO "{";
		ECHO "serverfileurl:\"".$this->serverfileurl."\",";
		ECHO "serverfilesize:\"".$this->serverfilesize."\",";
		ECHO "streammd5:\"".$this->streammd5."\",";
		ECHO "errdescription:\"".$this->errdescription."\"";
		ECHO "}";
		die();

	}

	function PrintValidateJson()
	{	
		Header("Pragma:no-cache");
		Header('Content-Type: text/html; charset=GBK');
		ECHO "{";
		ECHO "serverfileurl:\"".$this->serverfileurl."\",";
		ECHO "serverfilesize:\"".$this->serverfilesize."\",";
		ECHO "info:\"".$this->info."\",";
		ECHO "validate length:\"".$this->validatelength."\",";
		ECHO "streammd5:\"".$this->streammd5."\",";
		ECHO "validatedata:\"".$this->validatedata."\"";
		ECHO "}";
		die();
	}

	function DebugLogFile($s)
	{
		return;
		$myfile = 'log.txt';
		$file_pointer = fopen($myfile,"a");
		fwrite($file_pointer,$s);
		fclose($file_pointer);
	}
}
?>
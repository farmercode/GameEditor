<?php
/**
 * 日志文件解析类
 * @author dk <wangchangchun@nenxun.com>
 * $file = "l.log";
 * $info = filesize($file);
 * print_r($info);
 * echo "<pre>";
 * $parser = new ParseLog($file);
 * $parser->exec();
 * print_r($parser->data);
 */

namespace Org\Extend;

class ParseLog{
        
        var $filePath;
        /**
         * 文件名称
         * @var string
          */
         var $fileName;

         var $fileMd5Info;

         var $data;
         /**
          *  文件大小，单位byte
          * @var int
          * */

         var $fileSize;
         var $modifyTime;
         var $postion;

         /**
          * 服务器识别码
          * @var string
          */
         var $serverCode = '';

         private $handle;
         
         function ParseLog(){
                 $this->init();
         }
        
        function init(){
                $this->filePath = '';
                $this->fileName = '';
                $this->fileMd5Info = '';
                $this->fileSize = 0;
                $this->modifyTime = 0;
                $this->postion = 0;
                $this->handle = null;
                $this->data = array();
        }

        /**
         * 解析文件
         * @param  string $file_path [description]
         * @return void
         */
        function parseFile($file_path,$seek = 0){
                $path = realpath($file_path);
                if($path === false)	throw new Exception("无效的路径");
                $this->serverCode = "test";
                $this->filePath = $path;
                $this->fileName = basename($path);
                $this->fileSize = filesize($path);
                $this->fileMd5Info = md5_file($path);
                $this->modifyTime = filemtime($path);
                $this->_openLog();

                 /*设置文件偏移量*/
                 if($seek){
                 	fseek($this->handle,$seek);
                 }
                 $this->exec();
         }

         function exec(){
                 $this->data["resLog"] = array();
                 $this->data["onlinePlayers"] = array();
                 $this->data["playerLogin"] = array();
                 while (!feof($this->handle)) {
                 	$line = $this->_readLine();
                 	/*解析资源日志*/
                 	if(preg_match("%\|ResourceLog\|%", $line)){
                 	        $d = $this->parseResource($line);
                 	        array_push($this->data["resLog"], $d);
                 	}else if(preg_match("%\|OnlinePlayers\|%", $line)){ //解析在线用户日志
                 	        $d = $this->parseResource($line);
                 	        array_push($this->data["onlinePlayers"], $d);
                 	}else if(preg_match("%\|(Login|Reconnect|Logout)\|%", $line)){
                 	        $d = $this->parseLogin($line);
                 	        array_push($this->data["playerLogin"], $d);
                 	}
                 }
         }

         private function _openLog(){
                 $this->handle = fopen($this->filePath, "r");
                 if($this->handle === false)        throw_exception("文件打开失败");
         }

        /**
         * 解析单条资源记录
         * @param  string $buffer 资源单条记录字符串
         * @return [type]         [description]
        */
       function parseResource($buffer){
                $tmp_array = explode("|", $buffer);
                $result = array();
                foreach ($tmp_array as $key => $value) {
                	if($key === 0 || $key === 1){
                	        continue;
                	}else if($key === 2){
                	        $tmp = explode("=", $value);                	       
                	        $result['logtime'] = trim($tmp[1]);
                	}else{
                	        $tmp = explode("=", $value);
                	        $tmp[0] = strtolower($tmp[0]);
                	        $result[$tmp[0]] = $tmp[1];
                	}
                }
                $result['server_code'] = $this->serverCode;
                return $result;
        }

        function parseLogin($buffer){
                $tmp_array = explode("|", $buffer);
                $result = array();
                foreach ($tmp_array as $key => $value) {
                	if($key === 0){
                	        continue;
                	}else if($key === 1){
                	         $tmp = explode("=", $value);
                	         $type = strtolower($tmp[0]);
                	        $result['oper_type'] = trim($type);	
                	}else if($key === 2){
                	        $tmp = explode("=", $value);   
                	        $stamp = trim($tmp[1]); 	       
                	        $result['login_time'] = $stamp;
                	        $result['login_date'] = date("Y-m-d",$stamp);
                	}else{
                	        $tmp = explode("=", $value);
                	        $tmp[0] = strtolower($tmp[0]);
                	        $result[$tmp[0]] = $tmp[1];
                	}
                }
                $result['server_code'] = $this->serverCode;
                return $result;
        }

        /**
         * 获得文件基本信息
         * @return array 文件信息数组 
         */
        function getFileInfo(){
               return array(
               	'file_name'	=> $this->fileName,
               	'file_path'	=> $this->filePath,
               	'file_seek'	=> $this->postion,
               	'file_size'	=> $this->fileSize,
               	'modify_time'	=> $this->modifyTime,
               	'md5_info'	=> $this->fileMd5Info
               );
       }

        /**
         * 读取一行记录
         * @return string 
         */
        private function _readLine(){
                 $buffer='';
                 $line="";
                 $isFirst = true;
                 while (!feof($this->handle)) {
                 	$this->postion = ftell($this->handle);
                 	$buffer = fgets($this->handle);
                 	if(preg_match("%(\[([0-9\:\s-])*\])%u", $buffer)){		
	        if($isFirst){
	                $isFirst = false;
	        }else{
	                 fseek($this->handle, $this->postion);
	                 break;
	         }
	 }
	 $line.=$buffer;
                  }
                  return $line;
          }
}



<?php
class Message{
	private $username="shanmingke58";
	//以下所有xxxx都是需要你赋值的
	private $sendno="1";
	private $appkeys="xxxxxxxxxxxxx";
	private $receiver_type="xxxxxxxxxxx";
	//后面还有参数，截图看不到 你自己加一下
	//private xxx = "xxx";
	//下面这些__get等等是php的函数，不过需要自己手动写实现，我都写好了
	public function __get($val_name) {
		if(isset($this->$val_name)){
			return ($this->$val_name);
		}else {
			return (NULL);
		}
	}
	public function __set($val_name, $val_value) {
		$this->$val_name = $val_value;
	}
	public function __isset($val_name) {
		return isset($this->$val_name);
	}
	public function __unset($val_name) {
		unset($this->$val_name);
	}

	function send_message(){
		$postparameter = "username=".$this->username."&sendno="
					.$this->sendno."&appkeys=".$this->appkeys
					."receiver_type=".$this->receiver_type;
					//后面还有参数你给截图看不到自己加吧 .是字符串连接	
		$fp = fsockopen("api.jpush.cn", 8800, $errno, $errstr, 30);
		if(!$fp) {
			echo "$errstr ($errno) </br>\n";
		} else
		{
			$out .= "POST /sendmsg/sendmsg HTTP/1.1\r\n";
			$out .= "User-Agent: User-Agent: Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:20.0) Gecko/20100101 Firefox/20.0\r\n"; 
			$out .= "Path: /sengmsg/sendmsg\r\n";
			$out .= "Host: api.jpush.cn\r\n";
			$out .= "Connection: Close\r\n\r\n".$postparameter;
			fputs($fp, $out);
			while(!feof($fp)) {
				$result .= fgets($fp, 128);			
			}
			fclose($fp);
		}
		echo "$result";
		return $result;
	}
}
$message = new Message();
//下面的数据是传过来的
$message->__set(sendno, 1);
$message->__set(appkeys, "xxx");
//还有很多....api指定的
$message->send_message();
?>

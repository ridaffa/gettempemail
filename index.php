<?php

$email = $_GET['email'];
$emailmd5 = md5($email);
$cookie = tempnam("~c", rand(0,99999).".tmp");
$rz_web = zCurl("https://privatix-temp-mail-v1.p.rapidapi.com/request/mail/id/$emailmd5/",0,$cookie,0,0);
echo $rz_web[0];			
function zCurl($url,$fields=false,$cookie=false,$proxy=false,$proxy_pw=false){
		
		$ch = curl_init($url);
	    $header = array();
	    $header[] 	= "x-rapidapi-host: privatix-temp-mail-v1.p.rapidapi.com";
	    $header[]	= "Origin: https://privatix-temp-mail-v1.p.rapidapi.com";
	    $header[] 	= "User-Agent: ".$_SERVER['HTTP_USER_AGENT'];
	    $header[] 	= "x-rapidapi-key: 788164826fmshfa97642d649d895p10450fjsn700932c7e356";
	    if($fields){
	        curl_setopt($ch, CURLOPT_POST, true);
	        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
	    }else{
	        curl_setopt($ch, CURLOPT_POST, false);
	    }
	    if($cookie){
		    curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
			curl_setopt ($ch, CURLOPT_COOKIEJAR, $cookie);    
		}
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
		curl_setopt($ch, CURLOPT_TIMEOUT, 15);
	    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		if ($proxy){
			curl_setopt($ch, CURLOPT_PROXY, $proxy);
			// curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_SOCKS5);
		}
		if($proxy_pw){
			curl_setopt($ch, CURLOPT_PROXYUSERPWD, $proxy_pw);
		}
	    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
	    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	    curl_setopt($ch, CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_REFERER, $url);
	    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		if(curl_errno($ch))
		{
					$code = 1;
					$status = "UNKNOWN";
					$reason = "UNKNOWN";
					$hasil		= array('code' => $code,'status' => $status, 'CC_NUM' => $cc_num, 'CC_EXP_MONTH' => $cc_exp_m,'CC_EXP_YEAR' => $cc_exp_y,'CVV' => $cc_cvv,'reason' => $reason );	
					$cantik = json_encode($hasil);
					print_r($cantik);
					unlink($cookie);
					exit;
		}
		$res = curl_exec($ch);
		if($res === false){
			curl_close($ch);
			return array(false,false);
		}
		$http_info = curl_getinfo($ch,CURLINFO_HTTP_CODE);
		curl_close($ch);
		return array($res,$http_info);
		
}
?>

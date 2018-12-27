<?php 
	function http_redirect_to($dest='./index.html'){		//  这里是缺省参数,不提供参数时使用缺省参数
				header("HTTP/1.1 301 Moved Permanently");
				header("Location:$dest");
	}
	function http_redirect_back(){
		header("HTTP/1.1 301 Moved Permanently");
		header("Location: {$_SERVER['HTTP_REFERER']}");
	}
 ?>
<?php 
	function http_redirect_to($dest='./index.html'){		//  这里是缺省参数,不提供参数时使用缺省参数
				header("HTTP/1.1 301 Moved Permanently");
				header("Location:$dest");
	}
	function execute($sql,$db,$array){		//
		$query=$db->prepare($sql);
		foreach ($array as $key => $value) {
			if(gettype($value)=="string")
				$query->bindValue("$key",$value,PDO::PARAM_STR);
			elseif(gettype($value)=="integer")
				$query->bindValue("$key",$value,PDO::PARAM_INT);
		}
		if(!$query->execute()){
			// print_r($query->errorInfo());
			return false;
		}else{
			return $query;
		}
	}
	function error_redirect($url,$bool){
		if(!$bool)
			echo "<a href=\"".$url."\">出错了,点击返回</a>";
		else
			http_redirect_to($url);
	}
 ?>
<?php 
	try{
		$db = new PDO("mysql:host=127.0.0.1;dbname=dictionary","root","root");
		$db->query("SET NAMES UTF-8");
		$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
	}catch(PDOException $e){
		echo $e->getMessage().'<br/>';
	}
	date_default_timezone_set('Asia/Shanghai');
 ?>
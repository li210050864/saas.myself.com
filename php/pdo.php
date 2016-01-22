<?php
try{
	$dns="mysql:host=localhost;dbname=test";
	$db = new PDO($dns,"root","");
	$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	$db->exec("SET NAMES 'utf8'");
	$sql = "INSERT INTO test (PROD_ID,PROD_DESC,COST) VALUES ('admin3','desc admin',300)";
	$db->exec($sql);
	$insert = $db->prepare("INSERT INTO test (PROD_ID,PROD_DESC,COST) VALUES (?,?,?)");
	$insert->execute(array('admin4','admin1_desc',200));
	$insert->execute(array('admin5','admin2_desc',100));
	$sql = "SELECT * FROM test";
	$query = $db->prepare($sql);
	$query->execute();
	var_dump($query->fetchAll(PDO::FETCH_ASSOC));
	var_dump($db);
}catch(PDOException $err){
	echo $err->getMessage();
}

function bindParam(&$sql,$location,$var,$type){
		switch($type){
			default:
			case 'STRING':
				$var  = addslashes($var);
				$var = "'".$var."'";
			break;	
			case 'INT':
			case 'INTEGER':
				$var = parseInt($var);
			break;
		}
		for($i=1,$pos=0;$i<=$location;$i++){
				$pos = strpos($sql,'?',$pos+1);
		}
		$sql = substr($sql,0,$pos).$var.substr($sql,$pos+1);
}
?>
<?php
  header("Content-type:text/html;charset=utf-8");
  session_start();
  if(isset($_POST["submit"])){
  	$username = $_POST["username"];
  	$password = $_POST["password"];
  	$alias = $_POST["alias"];
  	
  	require_once 'db_config.php';
  	
  	$db = new ConnectionMySQL();
  	$sql = "INSERT INTO ing_member(LOGINID,PASSWORD,BRANCHTITLE,STATUS) VALUES('$username','$password','$alias',1);";
  	$db->query($sql);
  	$id = $db->insert_id();
  	
  	$result = "保存失败！";
  	if($id>0){
  		$result = "保存成功！";
  	}
  	
  	echo "<script type='text/javascript'>alert('$result');location.href='user_add.php'</script>";
  	//header("location: user_add.php");
  	
  }
?>
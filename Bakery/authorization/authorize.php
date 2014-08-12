<?php
   header("Content-type:text/html;charset=utf-8");
   require '../admin/db_config.php';
   $username = $_GET["username"];
   $password = $_GET["password"];
   
   $authorization=0;
   if(isset($username) && isset($password)){
   	  $db = new ConnectionMySQL();
   	  $query = "SELECT * FROM ING_MEMBER WHERE LOGINID='$username' AND PASSWORD = '$password' LIMIT 1;";
   	  $archive = $db->query($query);
   	  if($archive){
   	  	$authorization=1;//驗證成功
   	  }
   }
   
   echo $authorization;
?>
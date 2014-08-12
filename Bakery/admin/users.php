<?php
  header("Content-type:text/html;charset=utf-8");
  if(isset($_GET["username"])){
  	 require_once 'db_config.php';
  	 $db = new ConnectionMySQL();
  	 
  	 $username = $_GET["username"];
  	 $sql = "SELECT * FROM ing_member WHERE LOGINID='$username' LIMIT 1;";
  	 
  	 $result = $db->query($sql);
  	 if($db->num_rows($result)){
  	 	echo "false";
  	    exit();
  	 }
  	 echo "true";
  }
?>
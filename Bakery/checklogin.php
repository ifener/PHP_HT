<?php
    session_start();
    
    if(isset($_GET["action"]) && $_GET["action"]=="logoff"){
    	unset($_SESSION["username"]);
    	unset($_SESSION["memberId"]);
    	header("Location:login.php");
    	exit();
    }
    
    
    if(!isset($_POST["submit"])){
    	//header("Content-Type:text/html;charset=UTF-8");
    	header("Location:login.php");
    	exit('非法访问');
    }
    
    
    $username = htmlspecialchars($_POST["username"]);
    $password = htmlspecialchars($_POST["password"]);
    
    require_once 'admin/db_config.php';
    $db = new ConnectionMySQL();
    $query = "SELECT * FROM ING_MEMBER WHERE LOGINID='$username' AND PASSWORD='$password' LIMIT 1";
    
    $result = $db->query($query);
    if($result_row = $db->fetch_array($result)){
    	//var_dump($result_row);
    	//when login success
    	
    	$_SESSION['username'] = $username;
    	
    	$_SESSION['memberId'] = $result_row["MemberId"];
    	header("Location:admin/index.php");
    	//echo $result_row['MemberId']."success";
    }else{
    	header("Location: login.php?error=true");
    }
    
?>
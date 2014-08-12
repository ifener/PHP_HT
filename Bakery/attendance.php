<?php

  if(isset($_GET["id"]) && isset($_GET["dt"])){
	  $id = $_GET["id"];
	  $dt = $_GET["dt"];
	  $type =$_GET["t"];
	  
	  include_once 'db_config.php';
	  
	  $db = new ConnectionMySQL();
	  
	  $query = "call get_Attendances('$dt',$id)";
	  if(isset($_GET["t"]) && $_GET["t"]=="diff"){
	  	 $query = "call get_Attendances_diff_unit('$dt',$id)";
	  }
	  
	  
	  $result = $db->query($query);
	  
	  $json = "[]";
	  if(empty($result) || $db->num_rows($result)<=0){
	  	
	  }else{
	  	$attendances = array();
	  	while($obj = $db->fetch_array($result)){
	  	  //var_dump($array);
	  		foreach($obj as $key=>$value){
	  			//echo $key."<br>";
	  			$obj[$key]= urlencode($value);
	  			
	  		}
	  		
	  	  array_push($attendances, $obj);
	  	}
	  	
	  	
	  	$json = urldecode(json_encode($attendances));
	  	
	  }
	  
	  echo $json;
	  
	  
  }
?>
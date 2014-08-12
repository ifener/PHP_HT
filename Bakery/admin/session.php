<?php
  session_start();  //must add session_start() at first line;
  if(!isset($_SESSION["username"]) || !isset($_SESSION["memberId"]) || empty($_SESSION["username"]) || empty($_SESSION["memberId"])){
  	 header("location:../login.php");
  	 exit(); //must add this code
  }
?>
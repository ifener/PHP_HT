<!DOCTYPE html>
<html>
  <head>
    <title>登录</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link href="css/cssreset.css" type="text/css" rel="stylesheet" />
    <style type="text/css">
	  body{background:#ffffff;}
	  #container{width:250px; padding:15px; border:1px solid #000; position:absolute; left:50%; top:50%; margin-left:-150px; margin-top:-200px; background:#ffffff; border-radius:10px; box-shadow: 0 0 10px rgba(0,0,0,.36);}
	  ul{padding:10px;}
	  ul li.input{padding:5px;}
	  ul li.input input{width:210px; height:22px; line-height:22px; padding:2px 5px; border:1px solid #ccc; border-radius:5px; -webkit-transition:all 0.2s linear; }
	  ul li.input input:focus{box-shadow:inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px rgba(82, 168, 236, 0.6); border-color:rgba(82, 168, 236, 0.8);outline:0;}
	  ul li.tip{padding-left:5px;}
	  .title{text-align:center; font-size:15px; font-weight:bold; border-bottom:1px dotted #ccc;}
	  .submit{background:#0e9ac7; color:#fff; display:block; width:100%; min-height:30px; border:0; border-radius:5px; margin-top:5px;}
	  .submit:hover,ul li.input input:hover{box-shadow:0 0 10px rgba(0,0,0,.36);}
	</style>
  </head>
  <body>
     <div id="container">
        <form name="loginform" action="checklogin.php" method="post">
          <ul>
             <li class="title">登录系统</li>
             <li class="tip" style="padding-top:5px;">用户名:</li>
             <li class="input"><input type="text" name="username" /></li>
             <li class="tip">密码:</li>
             <li class="input"><input type="password" name="password" /></li>
             <li class="tip">
               <input type="submit" value="登  录" class="submit" name="submit" />
             </li>
             <?php
               if(isset($_GET["error"])){
               	echo "<li style='padding:5px; color:red;'>用户名或者密码错误.</li>";
               } 
             ?>
           </ul>
        </form>
     </div>
  </body>
</html>

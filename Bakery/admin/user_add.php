<?php
  include 'session.php';
?>

<!DOCTYPE html>
<html>
<head>
<title>添加员工</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="css/cssreset.css" type="text/css" rel="stylesheet" />
<link href="css/ambitious.css" type="text/css" rel="stylesheet" />
<link href="css/font-alpona.css" type="text/css" rel="stylesheet" />
<style type="text/css">
#add_user{width:400px; margin:0 auto;margin-top:20px; border:1px solid #d74d54; border-radius:5px; overflow:hidden; box-shadow:0 0 10px rgba(0,0,0,.56);}
#add_user h1{background:#d74d54; text-align:center; padding:5px; color:#fff;}
#add_user table{width:100%;}
#add_user td.title{text-align:right; width:30%;}
#add_user td{padding:5px;}
label.error{display:block;color:red; font-size:12px;}
</style>
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript" src="js/jquery.validate.js"></script>
<script type="text/javascript">
  $(function(){ 
     
     $("#myform").validate({
		 rules:{
			 username:{required:true,remote: "users.php"},
			 password:"required",
			 confirm_password:{
				    required: true,
					equalTo: "#password"
				 },
			 alias:"required"
		 },
		 messages:{
			 username:{required:"請輸入用戶名",remote:jQuery.validator.format("{0} 已被使用")},
			 password:"請輸入確認密碼",
			 confirm_password:{
				    required: "請輸入確認密碼",
					equalTo: "兩次密碼輸入不一致"
				 },
			 alias:"請輸入別名"
	     }
	 });
  });
</script>
</head>

<body>
    <?php include_once 'right_part.php'; ?>
    <div class="wrapper">
      <div id="add_user">
        <h1>添加用户</h1>
        <div>
         <form name="myform" id="myform" method="post" action="user_add_result.php">
          <table>
            <tr>
               <td class="title">用户名：</td>
               <td><input type="text" name="username" id="username" class="input" /></td>
            </tr>
            <tr>
               <td class="title">密码：</td>
               <td><input type="password" name="password" id="password" class="input"  /></td>
            </tr>
            <tr>
               <td class="title">确认密码：</td>
               <td><input type="password" name="confirm_password" id="confirm_password" class="input"  /></td>
            </tr>
            <tr>
               <td class="title">别名：</td>
               <td><input type="text" name="alias" id="alias" class="input"  /></td>
            </tr>
            <tr>
              <td colspan="2">
                <input type="submit" value="添 加" name="submit" class="submit" />
              </td>
            </tr>
          </table>
         </form>
        </div>
      </div>        
    </div>
        
    <?php include_once 'right_part_footer.php'; ?>
    <?php include_once 'menu.php'; ?>
    
</body>
</html>

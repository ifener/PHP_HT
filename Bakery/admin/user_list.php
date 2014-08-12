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
#user_search,#users_list{margin:0 auto;margin-top:20px; border:1px solid #d74d54; border-radius:5px; overflow:hidden; box-shadow:0 0 10px rgba(0,0,0,.56);}

#user_search h1,#users_list h1{background:#d74d54; text-align:center; padding:5px; color:#fff;}
#user_search table{width:100%;}
#user_search td.title{text-align:right; width:15%;}
#user_search td.content{width:35%;}
#user_search td{padding:5px;}
table.datatable{width:100%;}
table.datatable th{text-align:center; background:#292d30; color:#fff; padding:2px 0;}
table.datatable td{border:1px solid #ccc; text-align:center;}
</style>
<script type="text/javascript" src="js/jquery-1.6.1.min.js"></script>
<script type="text/javascript">
  $(function(){ 
     
   
  });
</script>
</head>

<body>
    <?php include_once 'right_part.php'; ?>
    <div class="wrapper">
      <div id="user_search">
        <h1>用户查詢</h1>
        <div>
         <form name="myform" id="myform" method="get" action="user_list.php">
          <table>
            <tr>
               <td class="title">用户名：</td>
               <td class="content"><input type="text" name="username" id="username" value="<?php echo $_GET[username] ?>" class="input" /></td>
               <td class="title">别名：</td>
               <td class="content"><input type="text" name="alias" id="alias" value="<?php echo $_GET[alias]?>" class="input"  /></td>
            </tr>
            <tr>
              <td colspan="4">
                <input type="submit" value="查 詢" name="submit" class="submit" style="width:30%;" />
              </td>
            </tr>
          </table>
         </form>
        </div>
      </div> 
      
      <!--user list-->       
      <div id="users_list">
        <h1>用户列表</h1>
        <div class="users">
          <table class="datatable">
            <tr>
              <th>編號</th>
              <th>用戶名</th>
              <th>密碼</th>
              <th>別名</th>
            </tr>
            <?php
               include_once 'db_config.php';
               require_once 'Paging.php';
               
               $db = new ConnectionMySQL();
               
               $PAGE_SIZE = 10;
               $PAGE_INDEX = 1;
               
               if(isset($_GET["page"])){
                 $PAGE_INDEX= intval($_GET["page"]);
               }
               
               $RECORD_COUNTS = 0;
               
               $username=$_GET["username"];
               $alias=$_GET["alias"];

               
               $query="SELECT COUNT(*) FROM ING_MEMBER WHERE 1=1 ";
               if(isset($username)){

                  $query.=" And loginid like '%$username%' ";
               }
               
               if(isset($alias)){
               	   $query.=" And BranchTitle like '%$alias%' ";
               }
               
        
               
               
               
               $counts = $db->query($query);
               if($counts){
               	  $rs=$db->fetch_array($counts);
               	  $RECORD_COUNTS=$rs[0];
               	 // echo $RECORD_COUNTS;
               }
               
               $paging_start = ($PAGE_INDEX-1)*$PAGE_SIZE;
               $paging_end = $PAGE_SIZE;

               $sql="SELECT * FROM ING_MEMBER WHERE 1=1 ";
               
               if(isset($username)){
                  $sql.=" And loginid like '%$username%' ";
               }
               
               if(isset($alias)){
               	   $sql.=" And BranchTitle like '%$alias%' ";
               }
               
               $sql.=" LIMIT $paging_start,$paging_end";
               
               //echo $sql;
               $result = $db->query($sql);
               if($result){
               	  while(($obj = $db->fetch_array($result))){
                    $memberid = $obj["MemberId"];
                    $loginid = $obj["loginId"];
                    $password = $obj["password"];
                    $alias = $obj["branchTitle"];
                    echo "<tr><td>$memberid</td><td>$loginid</td><td>$password</td><td>$alias</td></tr>";
                  }
                  
                 
                  
               }else{
               	  
               }
            
            ?>
          </table>
          <?php
           if($result){
             $paging = new Paging($PAGE_SIZE,10,$RECORD_COUNTS,$PAGE_INDEX,"user_list.php?username=$_GET[username]&alias=$_GET[alias]");
             $paging->BuildPaging();
           }
          ?>
        </div>
      </div>
    </div>
        
    <?php include_once 'right_part_footer.php'; ?>
    <?php include_once 'menu.php'; ?>
    
</body>
</html>

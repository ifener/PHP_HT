<div id="left">
  <h1 class="logo">
    <img src="../images/logo.png" alt="" />
  </h1>
  <?php 
    $file_name = basename($_SERVER['PHP_SELF']);
    $menus = array(
    	array(icon=>"icon-home",url=>"index.php",name=>"我的主页"),
    	array(icon=>"icon-users",url=>"user_list.php",name=>"用户列表"),
        array(icon=>"icon-user",url=>"user_add.php",name=>"添加用户")
    );
    
    
  ?>
  <ul class="menu">
    <?php
      
      foreach($menus as $key=>$menu){
        $icon =  $menu["icon"];
        $url =  $menu["url"];
        $name =  $menu["name"];
        $class = "";
        if($url==$file_name){
			 $class = "class='current'";
		}
        
        echo "<li><a href='$url' $class><i class='$icon'></i><span class='text'>$name</span><span class='flag'></span></a></li>";
       }
    ?>
  
  </ul>
</div>
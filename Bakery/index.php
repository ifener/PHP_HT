<!DOCTYPE html>
<html>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="apple-mobile-web-app-capable" content="yes" />  <!-- 离线应用的另一个技巧     -->
<meta name="apple-mobile-web-app-status-bar-style" content="black" /> <!--隐藏状态栏  -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport" />
<title></title>
<link href="css/cssreset.css" type="text/css" rel="stylesheet" />
<link href="css/jquery.mobile-1.3.0.min.css" type="text/css" rel="stylesheet" />
<link href="css/mobiscroll.css" type="text/css" rel="stylesheet" />
<style type="text/css">
#logo{ text-align:center; padding-top:10px;}
#local{border-top:1px solid #6699ff; padding-top:5px;}
table{width:100%;}
table th{font-weight:bold; padding:5px 0;text-align:center; background:#004a80; color:#fff; text-shadow:none;}
table td{padding:2px 0; text-align:center;text-shadow:none; border-bottom:1px dotted #666;}
table tr:nth-child(odd){background:#eee;}
.empty{border:1px solid #963; border-radius:5px; padding:10px;width:90%; margin:0 auto; color:red;}
.title{text-align:center; padding-top:10px; font-size:18px; font-weight:bold;}
.attendances{width:90%; margin:0 auto; border:1px solid #996636; border-radius:5px; overflow:hidden; box-shadow:0 0 10px rgba(160,160,160,.89);}
</style>
<script type="text/jscript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/jscript" src="js/jquery.mobile-1.3.0.min.js"></script>
<script type="text/jscript" src="js/dateformat.js"></script>
<script type="text/jscript" src="js/mobiscroll.js"></script>
<script type="text/javascript">
  function setCss(o) {
    $('input:jqmData(role="datebox")').mobiscroll(o);
  }
  var _dt = new Date().format("yyyy-MM-dd");    
  //_dt='2014-08-04';
  $(function(){
	  var fragment = {
			  header : "<table><tr><th>姓名</th><th>編號</th><th>打卡時間</th></tr>",
			  item:"<tr><td>#staff_name#</td><td>#staff_no#</td><td>#time#</td></tr>",
			  footer:"</table>",
			  empty:"<div class='empty'>暫無打卡數據...</div>"
	  };

	  function loadData(){
		  $.getJSON("attendance.php",{dt:function(){return $("#dt").val();},id:function(){
			     return $("#unit").val();
			  }
		   },function(json){ 
			   if(json && json.length>0){
				   var html=fragment.header;
				  
				   for(var i=0;i<json.length;i++){ 
					   html+=fragment.item.replace("#staff_name#",json[i].STAFF_NAME).replace("#staff_no#",json[i].EMP_NO).replace("#time#",json[i].RECORD_TIME);
				   }
				   html+=fragment.footer;
				   $("#local >.attendances").html(html);
			   }else{
				   $("#local>.attendances").html(fragment.empty);
			   }
		  });

		 setTimeout(function(){
			  $.getJSON("attendance.php",{dt:function(){return $("#dt").val();},id:function(){
				     return $("#unit").val();
				  },t:"diff"
			   },function(json){
				   if(json && json.length>0){
					   var html=fragment.header;
					  
					   for(var i=0;i<json.length;i++){ 
						   html+=fragment.item.replace("#staff_name#",json[i].STAFF_NAME).replace("#staff_no#",json[i].EMP_NO).replace("#time#",json[i].RECORD_TIME);
					   }
					   html+=fragment.footer;
					
					   $("#other").show();
					   $("#other >.attendances").html(html);
				   }else{
					   //$("#other>.attendances").html(fragment.empty);
					   $("#other").hide();
				   }
			  });
		 },500);
	  }

	  loadData();

	      var opt1 = {
              preset: 'date', //日期
              theme: 'jqm', //皮肤样式
              display: 'modal', //显示方式 
              mode: 'mixed', //日期选择模式
              dateFormat: 'yy-mm-dd', // 日期输出格式
              dateOrder: 'yymmdd', //面板中日期排列格式
              setText: '确定', //确认按钮名称
              cancelText: '取消',//取消按钮名籍我
              dayText: '日', //面板中日文字
              monthText: '月', //面板中月文字
              yearText: '年', //面板中年文字
              endYear: 2020, //结束年份
              hourText: '时',
              minuteText: '分',
              secText: '秒',
              lang: 'zh'
          };
          $('#dt').mobiscroll(opt1);


       $("#search").click(function(){
    	   loadData();
       });
	  
  })
</script>
</head>
  
<body>
  <div id="logo"><img src="images/bakery.png" /></div>
  <div style="text-align:center; padding:10px;">
	  <?php
	      include_once 'admin/db_config.php';
	      $unit_sql="SELECT * FROM dw_stores ORDER BY OUTLET DESC";
	      
	      $db = new ConnectionMySQL();
	      
	      $result = $db->query($unit_sql);
	      
	      if($db->num_rows($result)<1){
	      	echo '<div class=empty>记录集为空</div>';
	      }else{
	        echo "<select name='unit' id='unit'>";
	      	while($result_row=$db->fetch_row($result)){
	      		$outlet = $result_row[0];
	      		$sapname = $result_row[1];
	      		echo "<option value='$outlet'>$sapname</option>";
	      		
	      	}
	      	echo "</select>";
	      }
	      
	      $dt = date('Y-m-d',time());
	      
	  ?>
	  <input type="text" name="dt" id="dt" placeholder="日期" value="<?=$dt ?>" />
	  <input type="button" id="search" value="搜     索" data-theme="b" />
  </div>
  <div id="local">  
     <div class="title">本單位員工記錄</div>
     <div class="attendances">
        
     </div>
  </div>
  
  <div id="other">  
     <div class="title">非本單位員工記錄</div>
     <div class="attendances">
        
     </div>
     
  </div>
  <div style='height:80px;'></div>
</body>
</html>

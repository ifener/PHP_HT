<?
	class ConnectionMySQL{
		private $db_host='192.168.210.49';
		
		private $db_database='dongwang_attendances_bakery';
		
		private $db_username='root';
		
		private $db_password='db82208871';
		
		private $ut="utf-8";
		
		function __construct(){
			$this->ut=$ut;
			$this->connect();
		}
		
		
		function connect(){
			$link = mysql_connect($this->db_host,$this->db_username,$this->db_password) or die($this->error());
			mysql_select_db($this->db_database,$link) or die("没该数据库：".$this->db_database);
			mysql_query("SET NAMES '$this->ut'");
		}
		
	    function query($sql){
			if(!($query = mysql_query($sql))) $this->show('Say:',$sql);
			return $query;
		}
		
		function show($message = '', $sql = '') {
	         if(!$sql) echo $message;
	         else echo $message.'<br>'.$sql;
	    }
	    
	    function fetch_array($result){
	    	return mysql_fetch_array($result);
	    }
	    
	    function affected_rows() {
	    	
	    	 return mysql_affected_rows();
	    }
	    
	    function num_rows($result){
	    	return mysql_num_rows($result);
	    }
	    
	    function result($query, $row) {
	         return mysql_result($query, $row);
	    }
	    
	    function num_fields($query) {
	    	return mysql_num_fields($query);
	    }
	    
	    function free_result($query) {
           return mysql_free_result($query);
	    }
	    
	    function insert_id() {
	    	return mysql_insert_id();
	    }
	    
	    function fetch_row($query) {
	    	return mysql_fetch_row($query);
	    }
	    
	    function version() {
	    	return mysql_get_server_info();
	    }
	    
	    function close() {
	    	return mysql_close();
	    }
	    
	    //向$table表中插入值
	    function fn_insert($table,$name,$value){
	    	$this->query("insert into $table ($name) value ($value)");
	    }
	    //根据$id值删除表$table中的一条记录
	    function fn_delete($table,$id,$value){
	    	$this->query("delete from $table where $id=$value");
	    	echo "id为". $id." 的记录被成功删除!";
	    }
	    }
	    
	    //$db =  new ConnectionMySQL();
?>
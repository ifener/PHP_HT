<?php
	class Paging {
		
		private $Page_Size;
		
		private $Link_Counts;
		
		private $Record_Counts;
		
		private $Page_Total;
		
		private $Page_Index;
		
		private $Url;
		
		
		public function __construct($page_size=10,$link_counts=10,$record_counts,$page_index,$url){
			$this->Page_Size=$page_size;
			$this->Link_Counts=$link_counts;
			$this->Record_Counts=$record_counts;
		    $this->Url=$url;
		    
		    if(!$page_index){
		    	$page_index = 1;
		    }
		    $this->Page_Index=$page_index;
		    
		    
		    $this->Page_Index=$page_index;
		    $this->Page_Total=ceil($this->Record_Counts/$this->Page_Size);
		}
		
		public function __destruct() {
		}
		
		
		public function BuildPaging(){
			$center = ceil($this->Link_Counts/2);
			$paging_string="<div class='page'>";
			if($this->Page_Index>1){
				$paging_string.="<a href='$this->Url&page=1'>首頁</a>";
				$prev = ($this->Page_Index-1);
				$paging_string.="<a href='$this->Url&page=$prev'>上一頁</a>";
			}
			
			$begin_index = $this->Page_Index-$center;
			if($this->Page_Total-$this->Page_Index<$center){
				$begin_index-=($center-($this->Page_Total-$this->Page_Index)-1);
			}
			
			if($begin_index<=0){
				$begin_index=1;
			}

			
			$end_index = 0;
			if($this->Page_Total<=$this->Link_Counts){
				$begin_index=1;
				$end_index=$this->Page_Total;
			}else{
			    $end_index = $this->Page_Index+$center-1;
			    if($this->Page_Index <= $center) $end_index=$this->Link_Counts;
			    	//$end_index+= $center- $this->Page_Index +1;
			    if($end_index>$this->Page_Total){
			    	$end_index=$this->Page_Total;
			    }
			    	
			}
	
			
			
			for($begin_index;$begin_index<=$end_index;$begin_index++){
				if($begin_index==$this->Page_Index){
					$paging_string.="<span>$begin_index</span>";
				}else{
				   $paging_string.="<a href='$this->Url&page=$begin_index'>$begin_index</a>";
				}
			}
			

			if($this->Page_Index<$this->Page_Total){
				$next_index = $this->Page_Index+1;
				$paging_string.="<a href='$this->Url&page=$next_index'>下一頁</a>";
				$paging_string.="<a href='$this->Url&page=$this->Page_Total'>尾頁</a>";
			}
			
			$paging_string.="<span>總 $this->Page_Total 頁</span>";
			$paging_string.="</div>";
			echo $paging_string;

		}
		
		
		
		private function __get($property_name){
			//echo"在直接获取私有属性值的时候，自动调用了这个__get()方法<br>";
			if(isset($this->$property_name)){
				return $this->$property_name;
			}else{
				return null;
			}
		}
		
		private function __set($property_name,$value){
			//echo"在直接设置私有属性值的时候，自动调用了这个__set()方法为私有属性赋值<br>";
			$this->$property_name = $value;
		}
	}
?>
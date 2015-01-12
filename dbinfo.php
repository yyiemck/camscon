<?php
	class dbinfo {
		private $dbid = "root";	
		private $dbpass = "tkfakeh";
		private $dbname ="mydb";
		private $dbhost = "yj.dev";
		public $dblink;
		
		public function dbConnect(){
			$this->dblink = new mysqli($this->dbhost,$this->dbid,$this->dbpass,$this->dbname);
			if(mysqli_connect_errno()){
				echo "데이터베이스 접속 실패".mysqli_connect_error();
			}
			return $this->dblink;
		}	
	}
?>
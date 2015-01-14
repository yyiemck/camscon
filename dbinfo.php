<?php
	class dbinfo {
		private $dbid;
		private $dbpass;
		private $dbname;
		private $dbhost;
		private $query_se;
		public $dblink;
		
		public function dbConnect(){	
			$this->dblink = new mysqli($this->dbhost,$this->dbid,$this->dbpass,$this->dbname);
			if(mysqli_connect_errno()){
				echo "데이터베이스 접속 실패".mysqli_connect_error();
			}
			return $this->dblink;
		}
		public function queryInsertMember($id, $password, $token){
			$this->query_se = "INSERT INTO Member VALUES('$id' , '$password', '$token'	)";
			$this->query_se = $this->dblink->query($this->query_se);
			$this->query_se = $this->dblink->use_result();
		}
		public function __construct(){
			$this->dbhost = $_SERVER["MYSQL_HOST"];
			$this->dbid = $_SERVER["MYSQL_USER"];
			$this->dbpass = $_SERVER["MYSQL_PSWD"];
			$this->dbname = $_SERVER["MYSQL_DB"];
		}	
	}
?>
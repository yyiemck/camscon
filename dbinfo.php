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
		public function queryInsertBoard($writer, $password, $title, $content, $time, $hit, $boardNum){
			$this->query_se = "INSERT INTO board VALUES(NULL, '$writer', '$password', '$title', '$content', '$time', '$hit', '$boardNum')";
			$this->query_se = $this->dblink->query($this->query_se);
			$this->query_se = $this->dblink->use_result();
		}
		public function querySelectBoard($bySearch, $bySearchContent){
			$i = 0;
			$tmp;
			$resultArray=NULL;
			$this->query_se = "SELECT * FROM board WHERE `$bySearch`='$bySearchContent' ORDER BY board.index DESC;";
			$this->query_se = $this->dblink->query($this->query_se);
			while($tmp=$this->query_se->fetch_array()){
				$resultArray[$i] = $tmp;
				$i++;
			}
			return $resultArray;
		}
		public function queryDeleteBoard($byDelete, $byDeleteContent) {
			$this->query_se = "DELETE FROM board WHERE `$byDelete`='$byDeleteContent';";
			$this->query_se = $this->dblink->query($this->query_se);
		}
		public function __construct(){
			$this->dbhost = $_SERVER["MYSQL_HOST"];
			$this->dbid = $_SERVER["MYSQL_USER"];
			$this->dbpass = $_SERVER["MYSQL_PSWD"];
			$this->dbname = $_SERVER["MYSQL_DB"];
		}	
	}
?>